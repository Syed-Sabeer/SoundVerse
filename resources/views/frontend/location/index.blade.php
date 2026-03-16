@extends('layouts.frontend.master')

@section('css')
<style>
.location-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 50px 0;
}

.location-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 40px;
    margin-bottom: 30px;
}

.location-title {
    color: #333;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 10px;
}

.location-subtitle {
    color: #666;
    text-align: center;
    margin-bottom: 40px;
    font-size: 1.1rem;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
    font-size: 1.1rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
}

.form-control:focus {
    outline: none;
    border-color: #9f54f5;
    box-shadow: 0 0 0 0.2rem rgba(159, 84, 245, 0.25);
}

.btn-location {
    background: linear-gradient(135deg, #9f54f5 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 10px;
}

.btn-location:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(159, 84, 245, 0.3);
}

.btn-location:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.result-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
    border-left: 4px solid #9f54f5;
}

.result-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.result-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.result-item:last-child {
    border-bottom: none;
}

.result-label {
    font-weight: 600;
    color: #555;
}

.result-value {
    color: #333;
    font-family: 'Courier New', monospace;
}

.coordinates-display {
    background: #e9ecef;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
}

.map-container {
    height: 400px;
    border-radius: 12px;
    overflow: hidden;
    margin-top: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.loading {
    display: none;
    text-align: center;
    padding: 20px;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #9f54f5;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.error-message {
    background: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    border-left: 4px solid #dc3545;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    border-left: 4px solid #28a745;
}
</style>
@endsection

@section('content')
<div class="location-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="location-card">
                    <h1 class="location-title">📍 Location Services</h1>
                    <p class="location-subtitle">Convert addresses to coordinates and calculate distances using Google Maps API</p>
                    
                    <!-- Address to Coordinates Form -->
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="color: #333; margin-bottom: 25px;">📍 Address to Coordinates</h3>
                            <form id="addressToCoordsForm">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="address">Enter Address</label>
                                    <input type="text" class="form-control" id="address" name="address" 
                                           placeholder="e.g., 1600 Amphitheatre Parkway, Mountain View, CA" required>
                                </div>
                                <button type="submit" class="btn-location">
                                    Get Coordinates
                                </button>
                            </form>
                            
                            <div id="addressResult" class="result-card" style="display: none;">
                                <h4 class="result-title">📍 Coordinates Found</h4>
                                <div id="addressResultContent"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h3 style="color: #333; margin-bottom: 25px;">🗺️ Coordinates to Address</h3>
                            <form id="coordsToAddressForm">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <input type="number" class="form-control" id="latitude" name="latitude" 
                                           step="any" placeholder="e.g., 37.4224764" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <input type="number" class="form-control" id="longitude" name="longitude" 
                                           step="any" placeholder="e.g., -122.0842499" required>
                                </div>
                                <button type="submit" class="btn-location">
                                    Get Address
                                </button>
                            </form>
                            
                            <div id="coordsResult" class="result-card" style="display: none;">
                                <h4 class="result-title">🏠 Address Found</h4>
                                <div id="coordsResultContent"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Distance Calculator -->
                    <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #e9ecef;">
                        <h3 style="color: #333; margin-bottom: 25px;">🚗 Distance Calculator</h3>
                        <form id="distanceForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fromAddress">From Address</label>
                                        <input type="text" class="form-control" id="fromAddress" name="from_address" 
                                               placeholder="Starting location" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="toAddress">To Address</label>
                                        <input type="text" class="form-control" id="toAddress" name="to_address" 
                                               placeholder="Destination" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn-location">
                                Calculate Distance
                            </button>
                        </form>
                        
                        <div id="distanceResult" class="result-card" style="display: none;">
                            <h4 class="result-title">📏 Distance & Duration</h4>
                            <div id="distanceResultContent"></div>
                            <div id="mapContainer" class="map-container"></div>
                        </div>
                    </div>
                    
                    <!-- Loading Indicator -->
                    <div id="loading" class="loading">
                        <div class="spinner"></div>
                        <p>Processing your request...</p>
                    </div>
                    
                    <!-- Error/Success Messages -->
                    <div id="messageContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Address to Coordinates Form
    document.getElementById('addressToCoordsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const address = document.getElementById('address').value;
        
        if (!address.trim()) {
            showError('Please enter an address');
            return;
        }
        
        showLoading();
        hideResults();
        
        fetch('/api/location/address-to-coordinates', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ address: address })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                displayAddressResult(data.data);
                showSuccess('Address converted to coordinates successfully!');
            } else {
                showError(data.message || 'Error converting address');
            }
        })
        .catch(error => {
            hideLoading();
            showError('Network error occurred');
            console.error('Error:', error);
        });
    });
    
    // Coordinates to Address Form
    document.getElementById('coordsToAddressForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;
        
        if (!latitude || !longitude) {
            showError('Please enter both latitude and longitude');
            return;
        }
        
        showLoading();
        hideResults();
        
        fetch('/api/location/coordinates-to-address', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                latitude: parseFloat(latitude), 
                longitude: parseFloat(longitude) 
            })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                displayCoordsResult(data.data);
                showSuccess('Coordinates converted to address successfully!');
            } else {
                showError(data.message || 'Error converting coordinates');
            }
        })
        .catch(error => {
            hideLoading();
            showError('Network error occurred');
            console.error('Error:', error);
        });
    });
    
    // Distance Calculator Form
    document.getElementById('distanceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const fromAddress = document.getElementById('fromAddress').value;
        const toAddress = document.getElementById('toAddress').value;
        
        if (!fromAddress.trim() || !toAddress.trim()) {
            showError('Please enter both from and to addresses');
            return;
        }
        
        showLoading();
        hideResults();
        
        fetch('/api/location/distance', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                from_address: fromAddress, 
                to_address: toAddress 
            })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                displayDistanceResult(data.data);
                showSuccess('Distance calculated successfully!');
            } else {
                showError(data.message || 'Error calculating distance');
            }
        })
        .catch(error => {
            hideLoading();
            showError('Network error occurred');
            console.error('Error:', error);
        });
    });
    
    function displayAddressResult(data) {
        const resultContent = document.getElementById('addressResultContent');
        resultContent.innerHTML = `
            <div class="result-item">
                <span class="result-label">Address:</span>
                <span class="result-value">${data.address}</span>
            </div>
            <div class="coordinates-display">
                <div class="result-item">
                    <span class="result-label">Latitude:</span>
                    <span class="result-value">${data.latitude}</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Longitude:</span>
                    <span class="result-value">${data.longitude}</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Place ID:</span>
                    <span class="result-value">${data.place_id}</span>
                </div>
            </div>
        `;
        document.getElementById('addressResult').style.display = 'block';
    }
    
    function displayCoordsResult(data) {
        const resultContent = document.getElementById('coordsResultContent');
        resultContent.innerHTML = `
            <div class="result-item">
                <span class="result-label">Address:</span>
                <span class="result-value">${data.address}</span>
            </div>
            <div class="coordinates-display">
                <div class="result-item">
                    <span class="result-label">Latitude:</span>
                    <span class="result-value">${data.latitude}</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Longitude:</span>
                    <span class="result-value">${data.longitude}</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Place ID:</span>
                    <span class="result-value">${data.place_id}</span>
                </div>
            </div>
        `;
        document.getElementById('coordsResult').style.display = 'block';
    }
    
    function displayDistanceResult(data) {
        const resultContent = document.getElementById('distanceResultContent');
        resultContent.innerHTML = `
            <div class="result-item">
                <span class="result-label">From:</span>
                <span class="result-value">${data.from.address}</span>
            </div>
            <div class="result-item">
                <span class="result-label">To:</span>
                <span class="result-value">${data.to.address}</span>
            </div>
            <div class="result-item">
                <span class="result-label">Distance:</span>
                <span class="result-value">${data.distance.text}</span>
            </div>
            <div class="result-item">
                <span class="result-label">Duration:</span>
                <span class="result-value">${data.duration.text}</span>
            </div>
        `;
        document.getElementById('distanceResult').style.display = 'block';
        
        // Initialize map
        initMap(data.from, data.to);
    }
    
    function initMap(from, to) {
        const mapContainer = document.getElementById('mapContainer');
        
        // Create map
        const map = new google.maps.Map(mapContainer, {
            zoom: 10,
            center: { lat: from.latitude, lng: from.longitude }
        });
        
        // Add markers
        const fromMarker = new google.maps.Marker({
            position: { lat: from.latitude, lng: from.longitude },
            map: map,
            title: 'From: ' + from.address,
            icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
            }
        });
        
        const toMarker = new google.maps.Marker({
            position: { lat: to.latitude, lng: to.longitude },
            map: map,
            title: 'To: ' + to.address,
            icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        });
        
        // Add info windows
        const fromInfoWindow = new google.maps.InfoWindow({
            content: '<strong>From:</strong><br>' + from.address
        });
        
        const toInfoWindow = new google.maps.InfoWindow({
            content: '<strong>To:</strong><br>' + to.address
        });
        
        fromMarker.addListener('click', () => {
            fromInfoWindow.open(map, fromMarker);
        });
        
        toMarker.addListener('click', () => {
            toInfoWindow.open(map, toMarker);
        });
    }
    
    function showLoading() {
        document.getElementById('loading').style.display = 'block';
    }
    
    function hideLoading() {
        document.getElementById('loading').style.display = 'none';
    }
    
    function hideResults() {
        document.getElementById('addressResult').style.display = 'none';
        document.getElementById('coordsResult').style.display = 'none';
        document.getElementById('distanceResult').style.display = 'none';
        clearMessages();
    }
    
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonColor: '#9f54f5',
            background: '#1a1a1a',
            color: 'white',
            confirmButtonText: 'OK'
        });
    }
    
    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            confirmButtonColor: '#9f54f5',
            background: '#1a1a1a',
            color: 'white',
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true
        });
    }
    
    function clearMessages() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.innerHTML = '';
    }
});
</script>

<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAD0tOMonmKfcNxie-qTyxEEr7ZuB7X-M&callback=initMap"></script>
@endsection

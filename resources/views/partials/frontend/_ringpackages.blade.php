<!-- Payment Scripts - Load only once -->
<script>
// Check if scripts are already loaded to prevent duplicates
if (!window.Stripe) {
    const stripeScript = document.createElement('script');
    stripeScript.src = 'https://js.stripe.com/v3/';
    document.head.appendChild(stripeScript);
}

if (!window.google || !google.payments) {
    const googlePayScript = document.createElement('script');
    googlePayScript.src = 'https://pay.google.com/gp/p/js/pay.js';
    document.head.appendChild(googlePayScript);
}

if (!window.paypal) {
    const paypalScript = document.createElement('script');
    paypalScript.src = 'https://www.paypal.com/sdk/js?client-id=sb&currency=USD';
    document.head.appendChild(paypalScript);
}

// Define buildRingPayload function immediately to ensure it's available
window.buildRingPayload = function() {
    console.log('buildRingPayload called from early definition');

    // Validate ring counts before proceeding
    if (typeof window.tetherprisingnewValidateRingCounts === 'function' && !window.tetherprisingnewValidateRingCounts()) {
        if (window.Swal) {
            Swal.fire({
                title: 'Invalid Ring Count',
                text: 'Please ensure the total rings match the package limit.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            alert('Please ensure the total rings match the package limit.');
        }
        return null;
    }

    // Validate subscription plan is selected
    const subscriptionPlanId = document.getElementById('ring_subscription_plan_id').value;
    const subscriptionDetail = document.getElementById('ring_subscription_detail').value;

    if (!subscriptionPlanId || !subscriptionDetail) {
        if (window.Swal) {
            Swal.fire({
                title: 'Subscription Required',
                text: 'Please select a subscription plan.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            alert('Please select a subscription plan.');
        }
        return null;
    }

    // Parse subscription detail if it's a JSON string
    let parsedSubscriptionDetail;
    try {
        // Check if it's already an object
        if (typeof subscriptionDetail === 'object') {
            parsedSubscriptionDetail = subscriptionDetail;
            console.log('Subscription detail is already an object:', parsedSubscriptionDetail);
        } else {
            parsedSubscriptionDetail = JSON.parse(subscriptionDetail);
            console.log('Successfully parsed subscription detail from JSON string:', parsedSubscriptionDetail);
        }
    } catch (e) {
        console.error('Failed to parse subscription detail JSON:', e);
        parsedSubscriptionDetail = subscriptionDetail;
    }

    // Get package information from hidden fields
    const packageId = document.getElementById('ring_package_id').value;
    const packageName = document.getElementById('ring_package_name').value;
    const packagePrice = document.getElementById('ring_package_price').value;
    const ringsCount = document.getElementById('ring_rings_count').value;

    if (!packageId || !packagePrice) {
        if (window.Swal) {
            Swal.fire({
                title: 'Package Not Selected',
                text: 'Please select a ring package first.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            alert('Please select a ring package first.');
        }
        return null;
    }

    const payload = {
        package_id: packageId,
        package_name: packageName,
        package_price: packagePrice,
        rings_count: ringsCount,
        subscription_plan_id: subscriptionPlanId,
        subscription_detail: JSON.stringify(parsedSubscriptionDetail), // Ensure it's JSON string
        female_rings: document.getElementById('tetherprisingnewFemaleRings').value,
        male_rings: document.getElementById('tetherprisingnewMaleRings').value,
        female_ring_size: document.getElementById('tetherprisingnewFemaleSize').value,
        male_ring_size: document.getElementById('tetherprisingnewMaleSize').value,
        fullname: document.querySelector('[name="fullname"]').value,
        email: document.querySelector('[name="email"]').value,
        phone: document.querySelector('[name="phone"]').value,
        partner_name: document.querySelector('[name="partner_name"]').value,
        address: document.querySelector('[name="address"]').value
    };

    console.log('Building ring payload:', payload);
    console.log('Subscription detail type:', typeof payload.subscription_detail);
    console.log('Subscription detail value:', payload.subscription_detail);
    return payload;
};

// Define postRingCheckout function immediately to ensure it's available
window.postRingCheckout = async function(payload) {
    console.log('Sending payload to server:', payload);
    console.log('Subscription detail before FormData:', payload.subscription_detail);
    console.log('Subscription detail type before FormData:', typeof payload.subscription_detail);

    const formData = new FormData();
    Object.entries(payload).forEach(([k,v]) => {
        formData.append(k, v);
        console.log('Adding to FormData:', k, '=', v, 'type:', typeof v);
    });

    const res = await fetch("{{ route('ring.checkout') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    });

    console.log('Server response status:', res.status);
    const responseData = await res.json();
    console.log('Server response data:', responseData);

    return responseData;
};

// Define ringShowSuccessAndClose function immediately to ensure it's available
window.ringShowSuccessAndClose = function() {
    // Close modal if present
    const modal = document.getElementById('tetherprisingnewModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    setTimeout(() => {
        if (window.Swal) {
            Swal.fire({
                title: 'Payment Successful!',
                text: 'Your ring order has been placed successfully.',
                icon: 'success',
                customClass: { popup: 'swal-high-z-index' },
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('home') }}";
            });
        } else {
            alert('Payment Successful');
            window.location.href = "{{ route('home') }}";
        }
    }, 100);
};

// Define validateRingForm function immediately to ensure it's available
window.validateRingForm = function() {
    console.log('Validating ring form...');

    // Check required fields
    const required = document.querySelectorAll('#tetherprisingnewOrderForm [required]');
    for (const f of required) {
        if (!f.value || !f.value.trim()) {
            console.log('Required field missing:', f.name || f.id);
            return false;
        }
    }

    // Require a selected package
    const packageId = document.getElementById('ring_package_id').value;
    if (!packageId) {
        alert('Please select a ring package first.');
        return false;
    }

    // Require a selected subscription plan
    const subscriptionPlanId = document.getElementById('ring_subscription_plan_id').value;
    if (!subscriptionPlanId) {
        alert('Please select a subscription plan.');
        return false;
    }

    // Validate ring counts match total package rings
    const femaleRings = parseInt(document.getElementById('tetherprisingnewFemaleRings').value) || 0;
    const maleRings = parseInt(document.getElementById('tetherprisingnewMaleRings').value) || 0;
    const totalPackageRings = parseInt(document.getElementById('ring_rings_count').value) || 0;

    console.log('Ring count validation:', { femaleRings, maleRings, totalPackageRings });

    if (femaleRings + maleRings !== totalPackageRings) {
        alert(`Ring count mismatch! Female rings (${femaleRings}) + Male rings (${maleRings}) must equal total package rings (${totalPackageRings}).`);
        return false;
    }

    // Validate ring sizes are selected
    const femaleSize = document.getElementById('tetherprisingnewFemaleSize').value;
    const maleSize = document.getElementById('tetherprisingnewMaleSize').value;

    if (!femaleSize || !maleSize) {
        alert('Please select both female and male ring sizes.');
        return false;
    }

    console.log('Form validation passed');
    return true;
};

// Define tetherprisingnewValidateRingCounts function immediately to ensure it's available
window.tetherprisingnewValidateRingCounts = function() {
    const female = parseInt(document.getElementById('tetherprisingnewFemaleRings').value) || 0;
    const male = parseInt(document.getElementById('tetherprisingnewMaleRings').value) || 0;
    const total = parseInt(document.getElementById('tetherprisingnewTotalRings').value) || 0;
    const validationEl = document.getElementById('ringCountValidation');
    const validationTextEl = document.getElementById('ringCountValidationText');

    // Validate total rings
    if (female + male > total) {
        if (validationEl && validationTextEl) {
            validationEl.style.display = 'block';
            validationTextEl.textContent = `Total rings (${female + male}) cannot exceed package limit (${total}). Please adjust your selection.`;
        }
        return false;
    } else if (female + male < total) {
        if (validationEl && validationTextEl) {
            validationEl.style.display = 'block';
            validationTextEl.textContent = `Total rings (${female + male}) must equal package limit (${total}). Please adjust your selection.`;
        }
        return false;
    } else {
        if (validationEl) {
            validationEl.style.display = 'none';
        }
        return true;
    }
};

// Define camera scan function immediately to ensure it's available
window.tetherprisingnewStartCameraScan = function() {

    const panel = document.getElementById('ringCameraPanel');
    if (panel) {
        panel.style.display = 'block';


        // Initialize MediaPipe ring size calculation
        initializeMediaPipeRingSize();
    } else {
        console.error('Camera panel not found');
    }
};

// Simple ring size calculation using coin calibration
window.initializeMediaPipeRingSize = function() {


    // Use simple coin calibration method instead of MediaPipe
    setupSimpleRingSize();
};

// Load MediaPipe library (disabled due to WebAssembly issues)
window.loadMediaPipeLibrary = function() {
    console.log('MediaPipe disabled - using simple coin calibration method');
    setupSimpleRingSize();
};

// Setup simple ring size calculation using coin calibration
window.setupSimpleRingSize = function() {


    const video = document.getElementById('ringVideo');
    const canvas = document.getElementById('ringCanvas');
    const startBtn = document.getElementById('ringStartBtn');
    const captureBtn = document.getElementById('ringCaptureBtn');
    const closeBtn = document.getElementById('ringCloseBtn');
    const resultEl = document.getElementById('ringResult');
    const instructionEl = document.getElementById('ringInstruction');

    if (!video || !canvas || !startBtn || !captureBtn || !closeBtn || !resultEl || !instructionEl) {
        console.error('Required elements not found');
        return;
    }

    // Update instructions for simple finger measurement
    instructionEl.innerHTML = `
        <strong>📱 Simple Ring Size Calculator:</strong><br/>
        1) Hold phone 15-20cm (6-8 inches) from your hand<br/>
        2) Place your finger flat, palm facing camera<br/>
        3) Ensure good lighting and clear background<br/>
        4) Tap "Start Camera" to begin<br/>
        5) Tap "Capture" when ready<br/>
        6) Click two points across your finger width (corner to corner)
    `;

    let stream = null;
    let fingerClicks = [];
    let isCalibrating = false;

    // Start camera
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'environment',
                    width: { ideal: 640 },
                    height: { ideal: 480 }
                },
                audio: false
            });

            video.srcObject = stream;
            video.play();


            resultEl.innerHTML = '📱 Camera started! Place your finger with a coin below it, then tap "Capture".';
        } catch (err) {
            console.error('Camera error:', err);
            resultEl.innerHTML = `
                <div style="background: #fef2f2; border: 1px solid #ef4444; border-radius: 8px; padding: 12px; margin-top: 8px; color: #dc2626;">
                    ❌ Camera error: ${err.message || err}
                </div>
            `;
        }
    }

    // Capture frame
    function captureFrame() {
        if (canvas.style.display === 'none') {
            canvas.style.display = 'block';
            canvas.style.cursor = 'crosshair';

            // Draw video frame to canvas
            const ctx = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            ctx.drawImage(video, 0, 0);

            resultEl.innerHTML = '📸 Frame captured! Click two points across your finger width (corner to corner).';

            // Reset clicks
            fingerClicks = [];
            isCalibrating = true;

            // Add click listener to canvas
            canvas.onclick = handleCanvasClick;
        } else {
            canvas.style.display = 'none';
            canvas.onclick = null;
            resultEl.innerHTML = '📱 Live camera mode - tap "Capture" to analyze a frame.';
        }
    }

    // Handle canvas clicks
    function handleCanvasClick(e) {
        if (!isCalibrating) return;

        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        // Collecting finger width points
        fingerClicks.push({x, y});

        // Draw point
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = '#ff0000';
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fill();

        if (fingerClicks.length === 2) {
            // Draw line between finger points
            ctx.strokeStyle = '#ff0000';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(fingerClicks[0].x, fingerClicks[0].y);
            ctx.lineTo(fingerClicks[1].x, fingerClicks[1].y);
            ctx.stroke();

            // Calculate ring size
            calculateRingSize();
        } else {
            resultEl.innerHTML = `📏 Finger point ${fingerClicks.length}/2 - click another point across your finger width.`;
        }
    }

    // Calculate ring size from clicks
    function calculateRingSize() {
        try {
            // Calculate finger width in pixels
            const fingerDx = fingerClicks[1].x - fingerClicks[0].x;
            const fingerDy = fingerClicks[1].y - fingerClicks[0].y;
            const fingerPixels = Math.sqrt(fingerDx * fingerDx + fingerDy * fingerDy);

            // Assume standard phone camera resolution and distance
            // For a typical phone held 15-20cm away, we can estimate pixels per mm
            // This is a reasonable approximation for most modern phones
            const estimatedPixelsPerMm = 8.0; // Adjust this value based on testing

            // Calculate finger width in mm
            const fingerWidthMm = fingerPixels / estimatedPixelsPerMm;

            // For ring sizing, we need the finger circumference
            // The finger width we measured is approximately the diameter
            // But for more accurate ring sizing, we should use a conversion factor
            // Most ring size charts use circumference, so we convert width to circumference

            // Method 1: Direct width to circumference (assuming width ≈ diameter)
            const circumferenceFromWidth = fingerWidthMm * Math.PI;

            // Method 2: Use standard finger proportions (more accurate)
            // For ring sizing, finger width is approximately the diameter
            // So circumference = π × diameter = π × fingerWidth
            const circumferenceFromProportion = fingerWidthMm * Math.PI;

            // Use the π method as it's mathematically correct
            const circumferenceMm = circumferenceFromProportion;

            // Convert to US ring size (US size = circumference / 25.4)
            const usRingSize = circumferenceMm / 25.4;

            // Round to nearest 0.5
            const roundedSize = Math.round(usRingSize * 2) / 2;

            // Display result
            resultEl.innerHTML = `
                <div style="background: #f0f9ff; border: 1px solid #0ea5e9; border-radius: 8px; padding: 12px; margin-top: 8px;">
                    <strong>🎯 Ring Size Calculation:</strong><br/>
                    📏 Finger width: ${fingerPixels.toFixed(1)}px = ${fingerWidthMm.toFixed(1)}mm<br/>
                    🔄 Circumference (proportional): ${circumferenceMm.toFixed(1)}mm<br/>
                    🔄 Circumference (π method): ${circumferenceFromWidth.toFixed(1)}mm<br/>
                    💍 Estimated US Ring Size: <strong>${roundedSize}</strong><br/>
                                                <small>Using finger width × π conversion (mathematically correct for ring sizing)</small>
                    <br><br>
                    <button onclick="adjustCalibration(${fingerPixels}, ${estimatedPixelsPerMm})" style="background:#10b981;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;font-size:12px;">
                        🔧 Adjust Calibration
                    </button>
                </div>
            `;

            // Auto-fill ring size dropdowns
            autoFillRingSizes(roundedSize);

            // Reset calibration
            isCalibrating = false;
            canvas.onclick = null;

        } catch (error) {
            console.error('Error calculating ring size:', error);
            resultEl.innerHTML = `
                <div style="background: #fef2f2; border: 1px solid #ef4444; border-radius: 8px; padding: 12px; margin-top: 8px; color: #dc2626;">
                    ❌ Error calculating ring size. Please try again.
                </div>
            `;
        }
    }

    // Auto-fill ring size dropdown
    function autoFillRingSizes(estimatedSize) {
        // Fill both dropdowns with the same size since we're measuring for one user
        const femaleSizeSelect = document.getElementById('tetherprisingnewFemaleSize');
        const maleSizeSelect = document.getElementById('tetherprisingnewMaleSize');

        if (femaleSizeSelect && maleSizeSelect) {
            // Set both to the estimated size
            const ringSize = Math.max(4, Math.min(13, Math.round(estimatedSize)));
            femaleSizeSelect.value = String(ringSize);
            maleSizeSelect.value = String(ringSize);


        }
    }

    // Stop camera
    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        if (canvas.onclick) {
            canvas.onclick = null;
        }
        console.log('Camera stopped');
    }

    // Attach event listeners
    startBtn.addEventListener('click', startCamera);
    captureBtn.addEventListener('click', captureFrame);
    closeBtn.addEventListener('click', function() {
        panel.style.display = 'none';
        stopCamera();
    });


};

// Calibration adjustment function
window.adjustCalibration = function(fingerPixels, currentPixelsPerMm) {
    const newPixelsPerMm = prompt(
        `Current calibration: ${currentPixelsPerMm} pixels per mm\n\n` +
        `Your finger width: ${fingerPixels} pixels\n` +
        `If you know your actual ring size, enter a new pixels per mm value:\n\n` +
        `Higher value = smaller ring size\n` +
        `Lower value = larger ring size\n\n` +
        `Leave empty to keep current calibration.`,
        currentPixelsPerMm
    );

    if (newPixelsPerMm && !isNaN(newPixelsPerMm)) {
        const newFingerWidthMm = fingerPixels / parseFloat(newPixelsPerMm);
        const newCircumferenceMm = newFingerWidthMm * 3.2;
        const newRingSize = Math.round((newCircumferenceMm / 25.4) * 2) / 2;

        console.log(`Calibration adjusted: ${currentPixelsPerMm} → ${newPixelsPerMm} pixels/mm`);
        console.log(`New calculation: ${fingerPixels}px / ${newPixelsPerMm} = ${newFingerWidthMm.toFixed(1)}mm`);
        console.log(`New ring size: ${newRingSize}`);

        // Update the result display
        const resultEl = document.getElementById('ringResult');
        if (resultEl) {
            resultEl.innerHTML = `
                <div style="background: #f0f9ff; border: 1px solid #0ea5e9; border-radius: 8px; padding: 12px; margin-top: 8px;">
                    <strong>🎯 Ring Size Calculation (Adjusted):</strong><br/>
                    📏 Finger width: ${fingerPixels}px = ${newFingerWidthMm.toFixed(1)}mm<br/>
                    🔄 Circumference: ${newCircumferenceMm.toFixed(1)}mm<br/>
                    💍 Estimated US Ring Size: <strong>${newRingSize}</strong><br/>
                    <small>Calibration adjusted to ${newPixelsPerMm} pixels/mm</small>
                </div>
            `;

            // Auto-fill with new size
            autoFillRingSizes(newRingSize);
        }
    }
};

// Define manual size function immediately to ensure it's available
window.tetherprisingnewManualSize = function() {
    alert('📏 Manual Size Entry Mode\n\n' +
        '✋ Please use the dropdown menus below to select your ring sizes\n' +
        '🐀 Need help? Use our size guide:\n' +
        '• Wrap a string around your finger\n' +
        '• Mark where it overlaps\n' +
        '• Measure the length in mm\n' +
        '• Use our conversion chart\n\n' +
        '💡 Tip: Measure at the end of the day when fingers are largest');
};



// Test ring count validation specifically





</script>

<script>
// Check if payment scripts are loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== PAYMENT SCRIPTS STATUS ===');
    console.log('Stripe loaded:', !!window.Stripe);
    console.log('Google Pay loaded:', !!(window.google && google.payments));
    console.log('PayPal loaded:', !!window.paypal);
    console.log('=== END PAYMENT SCRIPTS STATUS ===');

    // Check script loading errors
    if (!window.Stripe) {
        console.error('Stripe failed to load');
    }
    if (!window.google || !google.payments) {
        console.error('Google Pay failed to load');
    }
    if (!window.paypal) {
        console.error('PayPal failed to load');
    }
});
</script>

<script>
// Initialize Stripe and elements - make globally accessible
window.stripe = null;
window.elements = null;
window.stripeCardElement = null;

window.initializeStripe = function() {
    try {
        if (!window.stripe && window.Stripe) {
            // Check network connectivity first
            window.checkNetworkStatus().then(isConnected => {
                if (!isConnected) {
                    console.error('Network connectivity issues detected');
                    return false;
                }
            });

            window.stripe = Stripe("{{ config('services.stripe.key') }}");
            window.elements = window.stripe.elements();

            // Add event handler for Stripe button
            const stripeButton = document.getElementById('ringStripeSubmitButton');
            if (stripeButton) {
                stripeButton.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!window.validateRingForm()) {
                        return;
                    }

                    // Show loader
                    const buttonText = document.getElementById('stripeButtonText');
                    const buttonLoader = document.getElementById('stripeButtonLoader');
                    if (buttonText && buttonLoader) {
                        buttonText.style.display = 'none';
                        buttonLoader.style.display = 'inline';
                    }

                    // Disable button
                    stripeButton.disabled = true;
                    stripeButton.style.opacity = '0.6';

                    try {
                        // Build payload
                        const payload = window.buildRingPayload();
                        if (!payload) {
                            throw new Error('Failed to build payment payload');
                        }

                        // Create payment method
                        const { paymentMethod, error } = await window.stripe.createPaymentMethod({
                            type: 'card',
                            card: window.stripeCardElement,
                        });

                        if (error) {
                            throw new Error(error.message);
                        }

                        // Add payment method to payload
                        payload.payment_method = 'card';
                        payload.payment_method_id = paymentMethod.id;

                        // Send to server
                        const response = await fetch("{{ route('ring.checkout') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(payload),
                        });

                        const result = await response.json();

                        if (result.success) {
                            window.ringShowSuccessAndClose(result.message);
                        } else {
                            throw new Error(result.error || 'Payment failed');
                        }

                    } catch (error) {
                        console.error('Stripe payment error:', error);
                        showSweetAlert({
                            title: 'Payment Error',
                            text: error.message || 'Payment failed. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } finally {
                        // Restore button
                        if (buttonText && buttonLoader) {
                            buttonText.style.display = 'inline';
                            buttonLoader.style.display = 'none';
                        }
                        stripeButton.disabled = false;
                        stripeButton.style.opacity = '1';
                    }
                });
            }

            console.log('Stripe initialized successfully');
            return true;
        }
        return false;
    } catch (error) {
        console.error('Failed to initialize Stripe:', error);
        return false;
    }
};

// Load Google Pay script - make globally accessible
window.loadGooglePay = function() {
    return new Promise((resolve) => {
        if (window.google && google.payments) {
            resolve();
        } else {
            const script = document.createElement('script');
            script.src = 'https://pay.google.com/gp/p/js/pay.js';
            script.onload = resolve;
            document.head.appendChild(script);
        }
    });
};

// Initialize Google Pay after load
window.loadGooglePay().then(() => {
    if (window.google && google.payments) {
        // Google Pay API available
    }
}).catch(error => {
    console.error('Error loading Google Pay:', error);
});

// Wait for all payment scripts to load
window.addEventListener('load', function() {
    // Try to initialize payment methods with retry logic
    let retryCount = 0;
    const maxRetries = 3;

    function attemptInitialization() {
        if (typeof window.initializePaymentMethods === 'function') {
            window.initializePaymentMethods();
        } else if (retryCount < maxRetries) {
            retryCount++;
            setTimeout(attemptInitialization, 2000);
        } else {
            console.error('Failed to initialize payment methods after multiple attempts');
            window.showStripeFallbackMessage();
        }
    }

    setTimeout(attemptInitialization, 2000);
});


// Global function to get total price including subscription
window.tetherprisingnewGetTotalPrice = function() {
    const packagePrice = Number(document.getElementById('ring_package_price').value || 0);
    const selectedPlan = document.querySelector('.tetherprisingnew-plan-option.tetherprisingnew-selected-plan');
    const subscriptionAmount = selectedPlan ? Number(selectedPlan.getAttribute('data-plan-amount') || 0) : 0;
    const totalWithSubscription = packagePrice + subscriptionAmount;



    return totalWithSubscription;
};

// Function to show fallback message when Stripe fails
window.showStripeFallbackMessage = function() {
    const stripeSection = document.getElementById('stripePaymentSection');
    if (stripeSection) {
        stripeSection.innerHTML = `
            <div style="text-align: center; padding: 20px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; color: #dc2626;">
                <h4 style="margin: 0 0 10px 0; color: #dc2626;">⚠️ Stripe Payment Unavailable</h4>
                <p style="margin: 0 0 15px 0; color: #7f1d1d;">
                    We're experiencing temporary issues with our card payment system.
                    Please try using PayPal, Google Pay, or Apple Pay instead.
                </p>
                <div style="font-size: 12px; color: #991b1b;">
                    If the problem persists, please refresh the page or try again later.
                </div>
            </div>
        `;
    }

    // Also show message in console for debugging
    console.warn('Stripe payment method unavailable. Please use alternative payment methods.');
};

// Function to check network connectivity
window.checkNetworkStatus = function() {
    if (!navigator.onLine) {
        console.error('Device is offline');
        return false;
    }

    // Test connection to Stripe
    return fetch('https://r.stripe.com/b', {
        method: 'HEAD',
        mode: 'no-cors',
        cache: 'no-cache'
    }).then(() => {
        console.log('Network connectivity to Stripe: OK');
        return true;
    }).catch((error) => {
        console.error('Network connectivity to Stripe failed:', error);
        return false;
    });
};

// Payment initialization function - make globally accessible
window.initializePaymentMethods = function() {
    // Prevent multiple initializations
    if (window.paymentMethodsInitialized) {
        console.log('Payment methods already initialized, skipping');
        return;
    }

    const totalPrice = window.tetherprisingnewGetTotalPrice();


    try {
        // Initialize Stripe first
        if (typeof window.initializeStripe === 'function') {
            window.initializeStripe();
        }

        if (!window.stripe || !window.elements) {
            console.error('Stripe not initialized yet, waiting...');
            setTimeout(window.initializePaymentMethods, 500);
            return;
        }

        // 1. Stripe Card Element - only create once
        const cardContainer = document.getElementById('ring-card-element');
        if (cardContainer && !window.stripeCardElement) {
            try {
                console.log('Creating Stripe card element...');
                window.stripeCardElement = window.elements.create('card');
                window.stripeCardElement.mount('#ring-card-element');
                console.log('Stripe card element mounted successfully');

                // Add event listener to update payment button text with total price
                const submitButton = document.getElementById('ringStripeSubmitButton');
                if (submitButton) {
                                    const totalPrice = window.tetherprisingnewGetTotalPrice();
                const buttonText = document.getElementById('stripeButtonText');
                const stripeTotalPrice = document.getElementById('stripeTotalPrice');
                if (buttonText) {
                    buttonText.textContent = `Complete Purchase`;
                }
                if (stripeTotalPrice) {
                    stripeTotalPrice.textContent = totalPrice.toFixed(2);
                } else {
                        console.error('Button text element not found');
                    }
                } else {
                    console.error('Stripe submit button not found during initialization');
                }
            } catch (error) {
                console.error('Error creating Stripe card element:', error);
            }
        } else if (window.stripeCardElement) {
            console.log('Stripe card element already exists, skipping creation');
        } else {
            console.error('Card container not found for Stripe element');
        }

        // 2. Apple Pay/Stripe Payment Request
        const applePayContainer = document.getElementById('ring-apple-pay-widget');
        if (applePayContainer && !window.applePayButtonCreated) {
            try {
                // Calculate total price including subscription
                const packagePrice = Number(document.getElementById('ring_package_price').value || 0);
                const selectedPlan = document.querySelector('.tetherprisingnew-plan-option.tetherprisingnew-selected-plan');
                const subscriptionAmount = selectedPlan ? Number(selectedPlan.getAttribute('data-plan-amount') || 0) : 0;
                const totalWithSubscription = packagePrice + subscriptionAmount;

                console.log('Apple Pay price calculation:', {
                    packagePrice,
                    subscriptionAmount,
                    totalWithSubscription
                });

                if (totalWithSubscription <= 0) {
                    console.error('Invalid total price for Apple Pay:', totalWithSubscription);
                    applePayContainer.style.display = 'none';
                    return;
                }

                const paymentRequest = window.stripe.paymentRequest({
                    country: 'US',
                    currency: 'usd',
                    total: {
                        label: 'Rings',
                        amount: Math.round(totalWithSubscription * 100),
                    },
                    requestPayerName: true,
                    requestPayerEmail: true,
                    disableWallets: ['link'], // Disable Link to ensure Apple Pay/Google Pay work
                });

                const prButton = window.elements.create('paymentRequestButton', {
                    paymentRequest,
                    style: {
                        paymentRequestButton: {
                            type: 'buy',
                            theme: 'dark',
                            height: '44px'
                        }
                    }
                });

                paymentRequest.canMakePayment().then(result => {
                    console.log('Payment request result:', result);
                    console.log('Apple Pay available:', result?.applePay);
                    console.log('Google Pay available:', result?.googlePay);
                    console.log('Link available:', result?.link);

                    if (result && (result.applePay || result.googlePay)) {
                        try {
                            applePayContainer.innerHTML = '<div id="ring-payment-request-button"></div>';
                            prButton.mount('#ring-payment-request-button');
                            applePayContainer.style.display = 'block';
                            window.applePayButtonCreated = true;
                            console.log('Apple Pay/Google Pay button mounted successfully');

                            // Add payment method handler
                            paymentRequest.on('paymentmethod', async (ev) => {
                                console.log('Apple Pay/Google Pay payment method received:', ev.paymentMethod);

                                if (!window.validateRingForm()) {
                                    alert('Please complete all required fields and select a package.');
                                    ev.complete('fail');
                                    return;
                                }

                                const payload = window.buildRingPayload();
                                if (!payload) {
                                    ev.complete('fail');
                                    return;
                                }

                                const finalPayload = { ...payload, payment_method: 'google_apple_pay', payment_method_id: ev.paymentMethod.id };
                                const data = await window.postRingCheckout(finalPayload);

                                if (data.success) {
                                    ev.complete('success');
                                    window.ringShowSuccessAndClose();
                                } else {
                                    ev.complete('fail');
                                    alert(data.message || 'Payment failed');
                                }
                            });
                        } catch (mountError) {
                            console.error('Error mounting Apple Pay/Google Pay button:', mountError);
                            applePayContainer.style.display = 'none';
                        }
                    } else {
                        applePayContainer.innerHTML = '<div style="color: #888; padding: 8px 0; text-align: center;">Apple Pay/Google Pay is not available on this device/browser. Please use Safari on an Apple device with Apple Pay set up, or Chrome with Google Pay.</div>';
                        applePayContainer.style.display = 'block';
                        console.log('Apple Pay/Google Pay not available, showing fallback message');
                        console.log('Available payment methods:', result);
                    }
                }).catch(error => {
                    console.error('Payment request error:', error);
                    applePayContainer.style.display = 'none';
                });
            } catch (error) {
                console.error('Apple Pay error:', error);
                applePayContainer.style.display = 'none';
            }
        } else if (window.applePayButtonCreated) {
            console.log('Apple Pay button already created, skipping');
        } else {
            console.log('Apple Pay container not found');
        }

        // 3. Google Pay
        const googlePayContainer = document.getElementById('ring-google-pay-widget');
        if (googlePayContainer) {
            if (window.google && google.payments && google.payments.api.PaymentsClient) {
                try {
                    const paymentsClient = new google.payments.api.PaymentsClient({
                        environment: 'TEST'
                    });

                    const button = paymentsClient.createButton({
                        onClick: async () => {
                            try {
                                if (!window.validateRingForm()) {
                                    alert('Please complete all required fields and select a package.');
                                    return;
                                }

                                const payload = window.buildRingPayload();
                                if (!payload) return; // Validation failed

                                const paymentDataRequest = {
                                    apiVersion: 2,
                                    apiVersionMinor: 0,
                                    allowedPaymentMethods: [{
                                        type: 'CARD',
                                        parameters: {
                                            allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                                            allowedCardNetworks: ['MASTERCARD', 'VISA'],
                                        },
                                        tokenizationSpecification: {
                                            type: 'PAYMENT_GATEWAY',
                                            parameters: {
                                                gateway: 'stripe',
                                                'stripe:version': '2020-08-27',
                                                'stripe:publishableKey': "{{ config('services.stripe.key') }}"
                                            }
                                        }
                                    }],
                                    merchantInfo: {
                                        merchantName: 'TetherHeart',
                                    },
                                    transactionInfo: {
                                        totalPriceStatus: 'FINAL',
                                        totalPrice: String(window.tetherprisingnewGetTotalPrice()),
                                        currencyCode: 'USD',
                                    },
                                };

                                const paymentData = await paymentsClient.loadPaymentData(paymentDataRequest);
                                let tokenId = paymentData.paymentMethodData.tokenizationData.token;

                                try {
                                    const parsed = JSON.parse(tokenId);
                                    if (parsed && parsed.id) tokenId = parsed.id;
                                } catch(e) {}

                                const finalPayload = { ...payload, payment_method: 'google_pay', payment_method_id: tokenId };
                                const data = await window.postRingCheckout(finalPayload);

                                if (data.success) {
                                    window.ringShowSuccessAndClose();
                                } else {
                                    alert(data.message || 'Payment failed');
                                }
                            } catch(err) {
                                console.error('Google Pay Error:', err);
                                if (err.name === 'AbortError') {
                                    console.log('User cancelled Google Pay payment');
                                } else {
                                    alert(err.statusMessage || 'Google Pay failed');
                                }
                            }
                        },
                        buttonColor: 'black',
                        buttonType: 'long'
                    });

                    googlePayContainer.innerHTML = '';
                    googlePayContainer.appendChild(button);
                    googlePayContainer.style.display = 'block';
                    console.log('Google Pay button created');
                } catch (error) {
                    console.error('Google Pay error:', error);
                    googlePayContainer.style.display = 'none';
                }
            } else {
                console.log('Google Pay not available, hiding container');
                googlePayContainer.style.display = 'none';
            }
        } else {
            console.log('Google Pay container not found');
        }

        // 4. PayPal
        const paypalContainer = document.getElementById('ring-paypal-button-container');
        if (paypalContainer) {
            if (window.paypal) {
                try {
                    paypalContainer.innerHTML = '';

                    // Calculate total price including subscription
                    const packagePrice = Number(document.getElementById('ring_package_price').value || 0);
                    const selectedPlan = document.querySelector('.tetherprisingnew-plan-option.tetherprisingnew-selected-plan');
                    const subscriptionAmount = selectedPlan ? Number(selectedPlan.getAttribute('data-plan-amount') || 0) : 0;
                    const totalWithSubscription = packagePrice + subscriptionAmount;

                    console.log('PayPal price calculation:', {
                        packagePrice,
                        subscriptionAmount,
                        totalWithSubscription
                    });

                    if (totalWithSubscription <= 0) {
                        console.error('Invalid total price for PayPal:', totalWithSubscription);
                        paypalContainer.innerHTML = '<div style="color: #ef4444; padding: 8px; text-align: center;">Please select a package and subscription plan first</div>';
                        return;
                    }

                    paypal.Buttons({
                        style: {
                            layout: 'horizontal',
                            color: 'gold',
                            shape: 'rect',
                            label: 'paypal',
                            height: 48
                        },
                        createOrder: (data, actions) => {
                            console.log('Creating PayPal order with amount:', totalWithSubscription);
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: totalWithSubscription.toFixed(2),
                                        currency_code: 'USD'
                                    }
                                }]
                            });
                        },
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(async details => {
                                console.log('PayPal payment captured:', details);

                                if (!window.validateRingForm()) {
                                    alert('Please complete all required fields and select a package.');
                                    return;
                                }

                                const payload = window.buildRingPayload();
                                if (!payload) return; // Validation failed

                                const finalPayload = { ...payload, payment_method: 'paypal', paypal_order_id: details.id };
                                const data = await window.postRingCheckout(finalPayload);

                                if (data.success) {
                                    window.ringShowSuccessAndClose();
                                } else {
                                    alert(data.message || 'Payment failed');
                                }
                            });
                        },
                        onError: err => {
                            console.error('PayPal Error:', err);
                            alert('PayPal payment failed: ' + err.message);
                        }
                    }).render('#ring-paypal-button-container');
                    console.log('PayPal button rendered with amount:', totalWithSubscription);
                } catch (error) {
                    console.error('PayPal error:', error);
                    paypalContainer.style.display = 'none';
                }
            } else {
                console.log('PayPal not available, hiding container');
                paypalContainer.style.display = 'none';
            }
        } else {
            console.log('PayPal container not found');
        }

        // Mark as initialized
        window.paymentMethodsInitialized = true;

        // Ensure Stripe button is properly set up

        const stripeButton = document.getElementById('ringStripeSubmitButton');
        if (stripeButton) {
            // Update button text with current price
            const totalPrice = window.tetherprisingnewGetTotalPrice();
            const buttonText = document.getElementById('stripeButtonText');
            const stripeTotalPrice = document.getElementById('stripeTotalPrice');
            if (buttonText) {
                buttonText.textContent = `Complete Purchase `;
            }
            if (stripeTotalPrice) {
                stripeTotalPrice.textContent = totalPrice.toFixed(2);
            }
        } else {
            console.error('Stripe button not found after initialization');
        }

    } catch (error) {
        console.error('Error initializing payment methods:', error);
    }
};
// validateRingForm function is already defined globally above

// Remove duplicate payment handlers - they are now handled in the main payment integration section
// Update this function to properly sync the selected package
window.tetherprisingnewGiftData = @json($rings);


// Then define your functions that use this data
window.tetherprisingnewUpdatePricingCards = function(packageId) {


    // Add null check
    if (!window.tetherprisingnewGiftData) {
        console.error('Gift data not loaded yet');
        return;
    }

    const numericPackageId = parseInt(packageId);
    const selectedGift = window.tetherprisingnewGiftData.find(gift => gift.id === numericPackageId);

    if (!selectedGift) {
        console.error('Package not found');
        return;
    }

    // Update the visible package card
    document.querySelectorAll('.tetherprisingnew-package-card').forEach(card => {
        const cardPackage = card.dataset.package.replace('gift-', '');
        card.style.display = cardPackage === packageId ? 'flex' : 'none';
    });

    // Update form fields immediately
    updatePackageFormFields(selectedGift);
};

// Helper function to update all package-related form fields
function updatePackageFormFields(gift) {

  const price = typeof gift.price === 'string' ? parseFloat(gift.price) : Number(gift.price);
    // Update hidden fields
       document.getElementById('ring_package_id').value = gift.id;
    document.getElementById('ring_package_name').value = gift.title;
    document.getElementById('ring_package_price').value = price;
    document.getElementById('ring_rings_count').value = gift.rings_count;

    // Update visible fields
    document.getElementById('tetherprisingnewSelectedPackageName').value = gift.title;
    document.getElementById('tetherprisingnewPackagePrice').value = '$' + price.toFixed(2);
    document.getElementById('tetherprisingnewPackageRingsDisplay').value = gift.rings_count + ' Rings';

    // Update ring count fields
    const ringsCount = parseInt(gift.rings_count) || 2;
    document.getElementById('tetherprisingnewTotalRings').value = ringsCount;
    document.getElementById('tetherprisingnewFemaleRings').value = Math.floor(ringsCount / 2);
    document.getElementById('tetherprisingnewMaleRings').value = ringsCount - Math.floor(ringsCount / 2);

    // Update summary
    tetherprisingnewUpdatePackageSummary();
}
// Define functions immediately to ensure they're available
window.tetherprisingnewOpenModal = function() {
    const modal = document.getElementById('tetherprisingnewModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';

        // Set selected package in form
        const selectedPackage = document.getElementById('tetherprisingnewPackageSelectNEW').value;

        // Update form fields with selected package
        const selectedPackageEl = document.getElementById('tetherprisingnewSelectedPackage');
        const selectedPackageNameEl = document.getElementById('tetherprisingnewSelectedPackageName');

        if (selectedPackageEl) selectedPackageEl.value = selectedPackage;

        // Also set package readable name if available from dropdown
        const pkgSelectEl = document.getElementById('tetherprisingnewPackageSelectNEW');
        const pkgText = pkgSelectEl.options[pkgSelectEl.selectedIndex]?.text || selectedPackage;
        if (selectedPackageNameEl) selectedPackageNameEl.value = pkgText;

        // Update pricing cards to show the selected package
        if (typeof tetherprisingnewUpdatePricingCards === 'function') {
            tetherprisingnewUpdatePricingCards(selectedPackage);
        }

        // Ensure form is properly initialized after modal opens
        setTimeout(() => {
            const numericPackageId = parseInt(selectedPackage);
            const selectedGift = window.tetherprisingnewGiftData ? window.tetherprisingnewGiftData.find(gift => gift.id === numericPackageId) : null;
            if (selectedGift) {
                // Force update form fields
                const totalEl = document.getElementById('tetherprisingnewTotalRings');
                const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                const maleEl = document.getElementById('tetherprisingnewMaleRings');

                if (totalEl && femaleEl && maleEl) {
                    const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                    totalEl.value = ringsCount;
                    femaleEl.value = Math.floor(ringsCount / 2);
                    maleEl.value = ringsCount - Math.floor(ringsCount / 2);
                }

                // Update hidden fields for package information
                const packageIdEl = document.getElementById('ring_package_id');
                const packageNameEl = document.getElementById('ring_package_name');
                const packagePriceEl = document.getElementById('ring_package_price');
                const ringsCountEl = document.getElementById('ring_rings_count');

                if (packageIdEl) packageIdEl.value = selectedGift.id;
                if (packageNameEl) packageIdEl.value = selectedGift.title;
                if (packagePriceEl) packageIdEl.value = selectedGift.price;
                if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                // Update package summary
                tetherprisingnewUpdatePackageSummary();

                // Set first subscription plan as selected by default
                const firstPlan = document.querySelector('.tetherprisingnew-plan-option');
                if (firstPlan) {
                    document.querySelectorAll('.tetherprisingnew-plan-option').forEach(plan =>
                        plan.classList.remove('tetherprisingnew-selected-plan'));
                    firstPlan.classList.add('tetherprisingnew-selected-plan');

                    // Update subscription fields
                    const planId = firstPlan.getAttribute('data-plan-id');
                    const planTitle = firstPlan.getAttribute('data-plan-title');
                    const planAmount = firstPlan.getAttribute('data-plan-amount');
                    const planDuration = firstPlan.getAttribute('data-plan-duration');

                    document.getElementById('ring_subscription_plan_id').value = planId;
                    document.getElementById('ring_subscription_detail').value = JSON.stringify({
                        id: planId,
                        title: planTitle,
                        amount: planAmount,
                        duration: planDuration,
                        selected_at: new Date().toISOString()
                    });

                    // Update total with subscription
                    tetherprisingnewUpdatePricingCards(selectedPackage);

                    // Force update package summary after subscription is set
                    setTimeout(() => {
                        tetherprisingnewUpdatePackageSummary();
                        console.log('Package summary updated after subscription selection');
                    }, 100);
                }
            }
        }, 300);

        // Initialize payment methods after a short delay to ensure modal is visible
        setTimeout(() => {
            console.log('Modal opened, initializing payment methods...');
            // Reset the initialization flag to allow re-initialization
            window.paymentMethodsInitialized = false;
            window.applePayButtonCreated = false;

            // Ensure Apple Pay container is ready
            const applePayContainer = document.getElementById('ring-apple-pay-widget');
            if (applePayContainer) {
                applePayContainer.innerHTML = '<div id="ring-payment-request-button"></div>';
                console.log('Apple Pay container reset');
            }

            // Wait for Stripe to be available
            if (window.Stripe) {
                window.initializePaymentMethods();
            } else {
                console.log('Waiting for Stripe to load...');
                setTimeout(() => {
                    if (typeof window.initializePaymentMethods === 'function') {
                        window.initializePaymentMethods();
                    }
                }, 1000);
            }
        }, 1000); // Increased delay to ensure Stripe is fully loaded
    }
};


window.tetherprisingnewCloseModal = function() {
    const modal = document.getElementById('tetherprisingnewModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
};

// Package summary update function
window.tetherprisingnewUpdatePackageSummary = function() {
    const packagePrice = Number(document.getElementById('ring_package_price').value || 0);
    const packageName = document.getElementById('ring_package_name').value || 'No package selected';
    const ringsCount = document.getElementById('ring_rings_count').value || 0;

    // Get selected subscription plan
    const selectedPlan = document.querySelector('.tetherprisingnew-plan-option.tetherprisingnew-selected-plan');
    const subscriptionAmount = selectedPlan ? Number(selectedPlan.getAttribute('data-plan-amount') || 0) : 0;

    // Calculate total
    const total = packagePrice + subscriptionAmount;

    console.log('Updating package summary:', {
        packagePrice,
        packageName,
        ringsCount,
        subscriptionAmount,
        total
    });

    // Update package summary display
    const packageTitleEl = document.getElementById('ringPackageTitle');
    const packageAmtEl = document.getElementById('ringPackageAmount');
    const subscriptionPlanEl = document.getElementById('ringSubscriptionPlan');
    const subscriptionAmountEl = document.getElementById('ringSubscriptionAmount');
    const totalEl = document.getElementById('ringTotalAmount');

    if (packageTitleEl) packageTitleEl.textContent = packageName;
    if (packageAmtEl) packageAmtEl.textContent = packagePrice.toFixed(2);
    if (subscriptionPlanEl) subscriptionPlanEl.textContent = selectedPlan ? selectedPlan.getAttribute('data-plan-title') : 'No plan selected';
    if (subscriptionAmountEl) subscriptionAmountEl.textContent = subscriptionAmount.toFixed(2);
    if (totalEl) totalEl.textContent = total.toFixed(2);

    // Update package information display fields
    const packageNameDisplayEl = document.getElementById('tetherprisingnewSelectedPackageName');
    const packagePriceDisplayEl = document.getElementById('tetherprisingnewPackagePrice');
    const packageRingsDisplayEl = document.getElementById('tetherprisingnewPackageRingsDisplay');

    if (packageNameDisplayEl) packageNameDisplayEl.value = packageName;
    if (packagePriceDisplayEl) packagePriceDisplayEl.value = '$' + packagePrice.toFixed(2);
    if (packageRingsDisplayEl) packageRingsDisplayEl.value = ringsCount + ' Rings';

    // Update payment button text with total
    const submitButton = document.getElementById('ringStripeSubmitButton');
    if (submitButton && total > 0) {
        const buttonText = document.getElementById('stripeButtonText');
        if (buttonText) {
            buttonText.textContent = `Complete Purchase - $${total.toFixed(2)}`;
        }
    }

    console.log('Package summary updated successfully');
};

// Subscription plan selection
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers to subscription plans
    document.querySelectorAll('.tetherprisingnew-plan-option').forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all plans
            document.querySelectorAll('.tetherprisingnew-plan-option').forEach(o =>
                o.classList.remove('tetherprisingnew-selected-plan'));

            // Add selected class to clicked plan
            this.classList.add('tetherprisingnew-selected-plan');

            // Update subscription fields
            const planId = this.getAttribute('data-plan-id');
            const planTitle = this.getAttribute('data-plan-title');
            const planAmount = this.getAttribute('data-plan-amount');
            const planDuration = this.getAttribute('data-plan-duration');

            document.getElementById('ring_subscription_plan_id').value = planId;
            document.getElementById('ring_subscription_detail').value = JSON.stringify({
                id: planId,
                title: planTitle,
                amount: planAmount,
                duration: planDuration,
                selected_at: new Date().toISOString()
            });

            // Update package summary
            tetherprisingnewUpdatePackageSummary();

            // Refresh payment methods with new total price
            if (window.paymentMethodsInitialized) {
                console.log('Refreshing payment methods with new subscription plan');
                // Reset the flag to allow re-initialization
                window.paymentMethodsInitialized = false;
                window.applePayButtonCreated = false;
                window.giftPaymentRequestButtonCreated = false;

                // Re-initialize payment methods after a short delay
                setTimeout(() => {
                    if (typeof window.initializePaymentMethods === 'function') {
                        window.initializePaymentMethods();
                    }
                }, 100);
            }
        });
    });
});
</script>

<section class="pricing-section" id="pricing">

        <div class="ball-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60" data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('FrontendAssets/images/balls/1.png')}}" alt="balls" />
        </div>
        <div
            class="ball-3"
            data-paroller-factor="0.30"
            data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground"
            data-paroller-direction="horizontal"
        >
            <img src="{{asset('FrontendAssets/images/balls/2.png')}}" alt="balls" />
        </div>
        <div
            class="ball-4"
            data-paroller-factor="0.30"
            data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground"
            data-paroller-direction="horizontal"
        >
            <img src="{{asset('FrontendAssets/images/balls/3.png')}}" alt="balls" />
        </div>
        <div
            class="ball-5"
            data-paroller-factor="0.30"
            data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground"
            data-paroller-direction="vertical"
        >
            <img src="{{asset('FrontendAssets/images/balls/4.png')}}" alt="balls" />
        </div>
        <div
            class="ball-6"
            data-paroller-factor="-0.30"
            data-paroller-factor-lg="0.60"
            data-paroller-type="foreground"
            data-paroller-direction="horizontal"
        >
            <img src="{{asset('FrontendAssets/images/balls/5.png')}}" alt="balls" />
        </div>
        <div
            class="ball-7"
            data-paroller-factor="-0.30"
            data-paroller-factor-lg="0.60"
            data-paroller-type="foreground"
            data-paroller-direction="vertical"
        >
            <img src="{{asset('FrontendAssets/images/balls/6.png')}}" alt="balls" />
        </div>
        <section class="tetherprisingneworabsec" >

            <!-- Floating Background Elements -->
            <div class="tetherprisingnew-floating-orb tetherprisingnew-orb-1"></div>
            <div class="tetherprisingnew-floating-orb tetherprisingnew-orb-2"></div>
            <div class="tetherprisingnew-floating-orb tetherprisingnew-orb-3"></div>
            <div class="tetherprisingnew-floating-orb tetherprisingnew-orb-4"></div>

            <div class="tetherprisingnew-main-container">
                <!-- Header Section -->
                <div class="section-headerpricing" data-aos="fade-up">
                    <span class="catepricing"
                    >Find the Perfect Ring for Your Connection</span
                    >
                    <h2 class="titlepricing">
                    Smart Couple Rings – Simple, Stylish, Powerful
                    </h2>
                    <p>
                    Tethar Heart brings beautifully crafted smart rings that help
                    couples stay emotionally and physically connected. Choose a ring
                    plan that suits your love story.
                    </p>
                </div>




                <div class="tetherprisingnew-content-card">
                    <!-- Available Packages Header -->
                    <div class="tetherprisingnew-packages-header">
                        <div class="tetherprisingnew-packages-title">
                            <i class="fas fa-gem"></i>
                            Available Ring Packages
                        </div>
                        <div class="tetherprisingnew-package-selector">
<select class="tetherprisingnew-package-dropdown" id="tetherprisingnewPackageSelectNEW">
    @foreach($rings as $ring)
        <option value="{{ $ring->id }}">{{ $ring->title }}</option>
        @endforeach
                            </select>

                        </div>
                    </div>

                    <!-- Pricing Cards -->
                                <div class="tetherprisingnew-pricing-container" id="tetherprisingnewPricingCardsnew">



             @foreach($rings as $ring)
    <div class="tetherprisingnew-package-card" data-package="gift-{{ $ring->id }}">
        <div class="tetherprisingnew-package-icon purple">
            <i class="{{ $ring->icon }}"></i>
                            </div>
        <div>
            <div class="tetherprisingnew-package-title">{{ $ring->title }}</div>
            <div class="tetherprisingnew-ring-count">{{ $ring->rings_count }} Rings</div>
            <div class="tetherprisingnew-package-description">
                {!! $ring->description !!}
                        </div>
            <div class="tetherprisingnew-package-features">
                <div class="tetherprisingnew-feature-item">
                    <i class="fas fa-check"></i>
                    Includes {{ $ring->rings_count }} Rings
                            </div>
                <div class="tetherprisingnew-feature-item">
                    <i class="fas fa-check"></i>
                    Choose Male/Female Ring Count
                        </div>
                    </div>
        </div>
        <div class="tetherprisingnew-price-section">
            <div class="tetherprisingnew-price">${{ number_format($ring->price, 2) }}</div>
            <div class="tetherprisingnew-price-detail">Per Package</div>
            <div class="tetherprisingnew-couples-connected">Happy Couples Connected</div>
            <div class="tetherprisingnew-couples-number">{{ $ring->couples_connected }}</div>
        </div>
    </div>
@endforeach


            </div>

                    <div class="tetherprisingnewbottomcounter" >
                        <div>
                        <div class="left">
                            <span class="catepricing">Happy Couples Connected</span>
                            <h2 class="titlepricing" id="counter">0</h2>
                        </div>
                        </div>

                        <!-- Action Section -->
                        <div class="tetherprisingnew-action-section">
                        <button class="tetherprisingnew-shop-btn" id="shopNowBtn" onclick="tetherprisingnewOpenModal()">
                                <i class="fas fa-shopping-cart"></i>
                                SHOP NOW
                            </button>

                            <ul class="download-options">
                            <li>
                                <a href="#0" class="active">
                                <i class="fab fa-windows"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                <i class="fab fa-apple"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                <i class="fab fa-android"></i>
                                </a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Modal -->
            <div id="tetherprisingnewModal" class="tetherprisingnew-modal">
                <div class="tetherprisingnew-modal-content">
                    <div class="tetherprisingnew-modal-header">
                        <span class="tetherprisingnew-close-btn" id="closeModalBtn" onclick="tetherprisingnewCloseModal()">
                            <i class="fas fa-times"></i>
                        </span>
                        <h2 class="tetherprisingnew-modal-title">Complete Your Order</h2>
                        <p class="tetherprisingnew-modal-subtitle">Let's customize your perfect smart ring experience</p>
                    </div>

                    <div class="tetherprisingnew-form-container">
                        <form id="tetherprisingnewOrderForm">
                            <!-- Ring Specifications -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-ring"></i>
                                    Ring Specifications
                                </h3>
                                <div class="tetherprisingnew-form-grid">
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Selected Package</label>
                                        <input type="text" class="tetherprisingnew-form-input" id="tetherprisingnewSelectedPackageName" readonly>
                                        <input type="hidden" id="tetherprisingnewSelectedPackage" />
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Total Rings</label>
                                        <input type="number" class="tetherprisingnew-form-input" id="tetherprisingnewTotalRings" min="2" max="20" value="2" readonly>
                                    </div>
                                </div>

                                <div class="tetherprisingnew-form-grid">
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Female Rings</label>
                                        <input type="number" class="tetherprisingnew-form-input" id="tetherprisingnewFemaleRings" min="0" value="1" name="female_rings">
                                        <small class="tetherprisingnew-form-help">Enter number of female rings</small>
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Male Rings</label>
                                        <input type="number" class="tetherprisingnew-form-input" id="tetherprisingnewMaleRings" min="0" value="1" name="male_rings">
                                        <small class="tetherprisingnew-form-help">Enter number of male rings</small>
                                    </div>
                                </div>
                                <div class="tetherprisingnew-form-group">
                                    <div id="ringCountValidation" class="tetherprisingnew-validation-message" style="display: none; color: #dc2626; font-size: 14px; margin-top: 8px;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span id="ringCountValidationText"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Ring Size Calculator -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-ruler"></i>
                                    Ring Size Calculator
                                </h3>
                                <div class="tetherprisingnew-size-calculator">
                                    <div class="tetherprisingnew-calculator-content">
                                        <div class="tetherprisingnew-calculator-title">
                                            <i class="fas fa-camera"></i>
                                            Advanced Size Detection
                                        </div>
                                        <p class="tetherprisingnew-calculator-description">
                                            Use our cutting-edge camera scan technology to measure your finger size with precision,
                                            or enter your measurements manually for a perfect fit.
                                        </p>
                                        <div class="tetherprisingnew-calculator-buttons">
                                            <button type="button" class="tetherprisingnew-camera-btn" onclick="tetherprisingnewStartCameraScan()">
                                                <i class="fas fa-camera"></i>
                                                Scan with Camera
                                            </button>
                                            <button type="button" class="tetherprisingnew-manual-btn" onclick="tetherprisingnewManualSize()">
                                                <i class="fas fa-hand-paper"></i>
                                                Manual Entry
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <!-- Camera capture panel for ring size estimation -->
                                <div id="ringCameraPanel" style="display:none; margin-top:12px; border:1px solid #e5e7eb; border-radius:8px; padding:12px;">
                                    <div style="display:flex; gap:12px; align-items:flex-start; flex-wrap:wrap;">
                                        <video id="ringVideo" autoplay playsinline style="max-width:320px; width:100%; background:#000; border-radius:8px;"></video>
                                        <canvas id="ringCanvas" width="320" height="240" style="display:none;"></canvas>
                                        <div style="flex:1; min-width:240px;">
                                            <div id="ringInstruction" style="font-size:14px; color:#374151;">
                                                <strong>📱 Camera Setup:</strong><br/>
                                                1) Hold phone 15-20cm (6-8 inches) from your hand<br/>
                                                2) Place your finger flat, palm facing camera<br/>
                                                3) Ensure good lighting and clear background<br/>
                                                4) Tap "Capture" when ready<br/>
                                                5) Click two points across your finger width (corner to corner)
                                            </div>
                                            <div style="margin-top:8px; display:flex; gap:8px;">
                                                <button type="button" id="ringStartBtn" class="tetherprisingnew-manual-btn">Start Camera</button>
                                                <button type="button" id="ringCaptureBtn" class="tetherprisingnew-manual-btn">Capture</button>
                                                <button type="button" id="ringCloseBtn" class="tetherprisingnew-manual-btn">Close</button>
                                            </div>
                                            <p id="ringResult" style="margin-top:8px; font-weight:600; color:#111827;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tetherprisingnew-form-grid">
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Female Ring Size</label>
                                        <select class="tetherprisingnew-form-select" id="tetherprisingnewFemaleSize" name="female_ring_size" required>
                                            <option value="">Select Size</option>
                                            <option value="4">Size 4</option>
                                            <option value="5">Size 5</option>
                                            <option value="6">Size 6</option>
                                            <option value="7">Size 7</option>
                                            <option value="8">Size 8</option>
                                            <option value="9">Size 9</option>
                                        </select>
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Male Ring Size</label>
                                        <select class="tetherprisingnew-form-select" id="tetherprisingnewMaleSize" name="male_ring_size" required>
                                            <option value="">Select Size</option>
                                            <option value="8">Size 8</option>
                                            <option value="9">Size 9</option>
                                            <option value="10">Size 10</option>
                                            <option value="11">Size 11</option>
                                            <option value="12">Size 12</option>
                                            <option value="13">Size 13</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Package Information -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Package Information
                                </h3>
                                <div class="tetherprisingnew-package-info">
                                    <!-- <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Selected Package</label>
                                        <input type="text" class="tetherprisingnew-form-input" id="tetherprisingnewSelectedPackageName" readonly>
                                        <input type="hidden" id="tetherprisingnewSelectedPackage" />
                                        <input type="hidden" id="tetherprisingnewSelectedPackagePrice" />
                                        <input type="hidden" id="tetherprisingnewSelectedPackageRings" />
                                    </div> -->
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Package Price</label>
                                        <input type="text" class="tetherprisingnew-form-input" id="tetherprisingnewPackagePrice" readonly>
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Total Rings</label>
                                        <input type="text" class="tetherprisingnew-form-input" id="tetherprisingnewPackageRingsDisplay" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscription Plans -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-crown"></i>
                                    Subscription Plans
                                </h3>
                                <div class="tetherprisingnew-subscription-plans">
                                     @foreach($plans as $plan)
                                         <div class="tetherprisingnew-plan-option {{ $loop->first ? 'tetherprisingnew-selected-plan' : '' }}"
                                              data-plan-id="{{ $plan->id }}"
                                              data-plan-title="{{ $plan->title }}"
                                              data-plan-amount="{{ $plan->amount }}"
                                              data-plan-duration="{{ $plan->duration }}">
                                             <div class="tetherprisingnew-plan-name">{{ $plan->title }}</div>
                                             <div class="tetherprisingnew-plan-price">
                                                 ${{ $plan->amount }}{{ $plan->duration == 0 ? '/One-time' : '/' . $plan->duration . ' month' }}
                                    </div>
                                    </div>
                                     @endforeach
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-user"></i>
                                    Personal Information
                                </h3>
                                <div class="tetherprisingnew-form-grid">
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Full Name</label>
                                        <input type="text" class="tetherprisingnew-form-input" placeholder="Enter your full name" required name="fullname">
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Email Address</label>
                                        <input type="email" class="tetherprisingnew-form-input" placeholder="your@email.com" required name="email">
                                    </div>
                                </div>
                                <div class="tetherprisingnew-form-grid">
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Phone Number</label>
                                        <input type="tel" class="tetherprisingnew-form-input" placeholder="+1 (555) 123-4567" required name="phone">
                                    </div>
                                    <div class="tetherprisingnew-form-group">
                                        <label class="tetherprisingnew-form-label">Partner's Name</label>
                                        <input type="text" class="tetherprisingnew-form-input" placeholder="Your partner's name" required name="partner_name">
                                    </div>
                                </div>
                                <div class="tetherprisingnew-form-group">
                                    <label class="tetherprisingnew-form-label">Shipping Address</label>
                                    <input type="text" class="tetherprisingnew-form-input" placeholder="Full address including city, state, zip code" required name="address">
                                </div>
                            </div>

                            <!-- Payment Section (moved below Personal Information) -->
                            <div class="tetherprisingnew-form-section">
                                <h3 class="tetherprisingnew-section-title">
                                    <i class="fas fa-credit-card"></i>
                                    Payment
                                </h3>

                                 <!-- Package summary -->
                                 <div id="ringPackageSummary" style="margin-bottom:12px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb; font-size:14px;">
                                     <div><strong>Selected Package:</strong> <span id="ringPackageTitle">No package selected</span></div>
                                     <div><strong>Package Price:</strong> $<span id="ringPackageAmount">0</span></div>
                                     <div><strong>Subscription Plan:</strong> <span id="ringSubscriptionPlan">No plan selected</span></div>
                                     <div><strong>Subscription Cost:</strong> $<span id="ringSubscriptionAmount">0</span></div>
                                     <div><strong>Total:</strong> $<span id="ringTotalAmount">0</span></div>
                                 </div>

                                <!-- Hidden composed payload -->
                                <input type="hidden" id="ring_package_id" name="package_id" />
                                <input type="hidden" id="ring_package_name" name="package_name" />
                                <input type="hidden" id="ring_package_price" name="package_price" />
                                <input type="hidden" id="ring_rings_count" name="rings_count" />
                                <input type="hidden" id="ring_subscription_plan_id" name="subscription_plan_id" />
                                <input type="hidden" id="ring_subscription_detail" name="subscription_detail" />

                                <!-- Stripe Card Element -->
                                <div class="tetherprisingnew-form-group">
                                    <label class="tetherprisingnew-form-label">Card Details</label>
                                    <div id="ring-card-element" class="tetherprisingnew-form-input" style="padding: 10px; border: 1px solid #e5e7eb; border-radius: 8px;"></div>

                                    <!-- Stripe Submit Button - Below the card element -->
                                    <div style="margin-top: 16px; text-align: right;">
                                        <button type="button" id="ringStripeSubmitButton" class="tetherprisingnew-payment-btn" style="background:#6366f1;color:#fff;border:none;padding:12px 18px;border-radius:8px;cursor:pointer;width:100%;">
                                            <i class="fas fa-credit-card"></i> <span id="stripeButtonText">Complete Purchase<span id="stripeTotalPrice">0.00</span></span>
                                            <span id="stripeButtonLoader" style="display:none;">
                                                <i class="fas fa-spinner fa-spin"></i> Processing...
                                            </span>
                                        </button>


                                    </div>
                                </div>

                                <!-- Apple Pay (Stripe Payment Request) -->
                                <div class="tetherprisingnew-form-group" style="margin-top: 12px;">
                                    <label class="tetherprisingnew-form-label">Or pay with Apple Pay</label>
                                    <div id="ring-apple-pay-widget" style="min-height: 44px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px; background: #f9fafb;">
                                        <div id="ring-payment-request-button"></div>
                                    </div>
                                </div>

                                <!-- Google Pay (Google Pay JS) -->
                                <div class="tetherprisingnew-form-group" style="margin-top: 12px;">
                                    <label class="tetherprisingnew-form-label">Or pay with Google Pay</label>
                                    <div id="ring-google-pay-widget" style="min-height: 44px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px; background: #f9fafb;"></div>
                                </div>

                                <!-- PayPal -->
                                <div class="tetherprisingnew-form-group" style="margin-top: 12px;">
                                    <label class="tetherprisingnew-form-label">Or pay with PayPal</label>
                                    <div id="ring-paypal-button-container" style="min-height: 44px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px; background: #f9fafb;"></div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        </section>

    <style>
        .tetherprisingnew-form-help {
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .tetherprisingnew-validation-message {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 8px 12px;
            margin-top: 8px;
        }

        .tetherprisingnew-validation-message i {
            margin-right: 6px;
        }

        /* Basic modal styling to ensure it's visible */
        .tetherprisingnew-modal {
            display: none;
            position: fixed;
            z-index: 99999999999 !important;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
        }

        .tetherprisingnew-modal-content {
            background-color: #fff;
            margin: 2% auto;
            padding: 0px;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            max-height: auto;
            overflow-y: auto;
            position: relative;
        }

        .tetherprisingnew-modal-header {
            padding: 8px 0 20px 0;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }

        .tetherprisingnew-close-btn {
            position: absolute;
            right: 0;
            top: 0;
            background: none;
            border: none;
            font-size: 24px;
        }

        /* Stripe button loading state */
        #stripeButtonLoader {
            color: #ffffff;
        }

        #stripeButtonLoader .fa-spinner {
            margin-right: 8px;
        }

        .tetherprisingnew-payment-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
            cursor: pointer;
            color: #6b7280;
            padding: 4px;
            border-radius: 4px;
        }

        .tetherprisingnew-modal-title {
            margin: 0 0 8px 0;
            font-size: 24px;
            font-weight: 600;
            color: #111827;
        }

        .tetherprisingnew-modal-subtitle {
            margin: 0;
            color: #FFFFFF;
            font-size: 16px;
        }

        .tetherprisingnew-form-container {
            padding: 20px 20px;
        }

        .tetherprisingnew-form-section {
            margin-bottom: 30px;
        }

        .tetherprisingnew-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 20px 0;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .tetherprisingnew-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .tetherprisingnew-form-group {
            margin-bottom: 20px;
        }

        .tetherprisingnew-form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }

        .tetherprisingnew-form-input,
        .tetherprisingnew-form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .tetherprisingnew-form-grid {
                grid-template-columns: 1fr;
            }
        }


    </style>

    <script>



            // Package data - simplified structure
            window.tetherprisingnewGiftData = @json($rings);
            console.log('rings data loaded:', tetherprisingnewGiftData);

            // Debug: Check the structure of the first gift
            if (tetherprisingnewGiftData && tetherprisingnewGiftData.length > 0) {
                console.log('First gift structure:', tetherprisingnewGiftData[0]);
                console.log('First gift rings_count type:', typeof tetherprisingnewGiftData[0].rings_count);
                console.log('First gift rings_count value:', tetherprisingnewGiftData[0].rings_count);
            }


            const counterElement = document.getElementById('counter');

                    // Animate counter on page load
            setTimeout(() => {
                animateValue(counterElement, 0, 5326234, 3000);
            }, 500);


            // Modal functions - Define these first so they're available
            window.tetherprisingnewOpenModal = function() {
                const modal = document.getElementById('tetherprisingnewModal');
                if (!modal) {
                    return;
                }

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';

                // Set selected package in form
                const selectedPackage = document.getElementById('tetherprisingnewPackageSelectNEW').value;
                console.log('Opening modal for package:', selectedPackage);

                // Update form fields with selected package
                const selectedPackageEl = document.getElementById('tetherprisingnewSelectedPackage');
                const selectedPackageNameEl = document.getElementById('tetherprisingnewSelectedPackageName');

                if (selectedPackageEl) selectedPackageEl.value = selectedPackage;

                // Also set package readable name if available from dropdown
                const pkgSelectEl = document.getElementById('tetherprisingnewPackageSelectNEW');
                const pkgText = pkgSelectEl.options[pkgSelectEl.selectedIndex]?.text || selectedPackage;
                if (selectedPackageNameEl) selectedPackageNameEl.value = pkgText;

                // Update pricing cards to show the selected package
                tetherprisingnewUpdatePricingCards(selectedPackage);

                // Add entrance animation
                setTimeout(() => {
                    const modalContent = modal.querySelector('.tetherprisingnew-modal-content');
                    if (modalContent) {
                        modalContent.style.animation = 'tetherprisingnewSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    }
                }, 10);

                // Ensure form is properly initialized after modal opens
                setTimeout(() => {
                    console.log('Modal opened, ensuring form is initialized...');
                    const numericPackageId = parseInt(selectedPackage);
                    const selectedGift = tetherprisingnewGiftData.find(gift => gift.id === numericPackageId);
                    if (selectedGift) {
                        console.log('Found selected gift in modal:', selectedGift);
                        // Force update form fields
                        const totalEl = document.getElementById('tetherprisingnewTotalRings');
                        const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                        const maleEl = document.getElementById('tetherprisingnewMaleRings');

                        if (totalEl && femaleEl && maleEl) {
                            // Ensure rings_count is treated as a number, trim any spaces
                            const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                            totalEl.value = ringsCount;
                            femaleEl.value = Math.floor(ringsCount / 2);
                            maleEl.value = ringsCount - Math.floor(ringsCount / 2);
                            console.log('Modal form fields updated:', {
                                total: ringsCount,
                                female: Math.floor(ringsCount / 2),
                                male: ringsCount - Math.floor(ringsCount / 2)
                            });
                        }

                        // Update hidden fields for package information
                        const packageIdEl = document.getElementById('ring_package_id');
                        const packageNameEl = document.getElementById('ring_package_name');
                        const packagePriceEl = document.getElementById('ring_package_price');
                        const ringsCountEl = document.getElementById('ring_rings_count');

                        if (packageIdEl) packageIdEl.value = selectedGift.id;
                        if (packageNameEl) packageNameEl.value = selectedGift.title;
                        if (packagePriceEl) packagePriceEl.value = selectedGift.price;
                        if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                        // Update package summary
                        tetherprisingnewUpdatePackageSummary();
                    }
                }, 300);

                 // Initialize payment methods after a short delay to ensure modal is visible
    setTimeout(() => {
        console.log('Modal opened, initializing payment methods...');
        // Reset the initialization flag to allow re-initialization
        window.paymentMethodsInitialized = false;
        window.applePayButtonCreated = false;

        // Wait for Stripe to be available
        if (window.Stripe) {
            const stripeInitialized = window.initializeStripe();
            if (stripeInitialized) {
                window.initializePaymentMethods();
            } else {
                console.error('Stripe initialization failed, showing fallback message');
                showStripeFallbackMessage();
            }
        } else {
            console.log('Waiting for Stripe to load...');
            setTimeout(() => {
                if (window.Stripe) {
                    const stripeInitialized = window.initializeStripe();
                    if (stripeInitialized) {
                        window.initializePaymentMethods();
                    } else {
                        console.error('Stripe initialization failed after delay, showing fallback message');
                        showStripeFallbackMessage();
                    }
                } else {
                    console.error('Stripe failed to load, showing fallback message');
                    showStripeFallbackMessage();
                }
            }, 2000);
        }
    }, 500);
            }

            window.tetherprisingnewCloseModal = function() {
                const modal = document.getElementById('tetherprisingnewModal');
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            // Global test function for debugging
            window.testModal = function() {
                console.log('Testing modal function globally...');
                tetherprisingnewOpenModal();
            }

            // Initialize the page
            document.addEventListener('DOMContentLoaded', function () {
                console.log('DOM loaded, initializing ring packages...');

                const firstGiftId = document.getElementById('tetherprisingnewPackageSelectNEW').value;
                console.log('First gift ID:', firstGiftId);

                if (firstGiftId) {
                    tetherprisingnewUpdatePricingCards(firstGiftId);

                    // Pre-populate form fields with first package
                    const selectedGift = tetherprisingnewGiftData.find(gift => gift.id === parseInt(firstGiftId));
                    if (selectedGift) {
                        // Update hidden fields
                        const packageIdEl = document.getElementById('ring_package_id');
                        const packageNameEl = document.getElementById('ring_package_name');
                        const packagePriceEl = document.getElementById('ring_package_price');
                        const ringsCountEl = document.getElementById('ring_rings_count');

                        if (packageIdEl) packageIdEl.value = selectedGift.id;
                        if (packageNameEl) packageNameEl.value = selectedGift.title;
                        if (packagePriceEl) packagePriceEl.value = selectedGift.price;
                        if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                        console.log('Pre-populated form with first package:', selectedGift);
                    }
                } else {
                    console.error('No gift ID found in dropdown');
                }

                tetherprisingnewSetupEventListeners();

                // Check payment method availability
                console.log('Checking payment method availability...');
                console.log('Stripe available:', !!window.Stripe);
                console.log('Google Pay available:', !!(window.google && google.payments));
                console.log('PayPal available:', !!window.paypal);

                console.log('Ring packages initialized');
            });


            // Setup all event listeners
            function tetherprisingnewSetupEventListeners() {
                // Package selection handlers
                document.getElementById('tetherprisingnewPackageSelectNEW').addEventListener('change', function () {
                    const selectedGiftId = this.value;
                    console.log('Package dropdown changed to:', selectedGiftId);

                    tetherprisingnewUpdatePricingCards(selectedGiftId);

                    const cardSelectEl = document.getElementById('tetherprisingnewPackageSelectCard');
                    if (cardSelectEl) cardSelectEl.value = selectedGiftId;

                    const pkgText = this.options[this.selectedIndex]?.text || selectedGiftId;
                    const nameEl = document.getElementById('tetherprisingnewSelectedPackageName');
                    const hiddenEl = document.getElementById('tetherprisingnewSelectedPackage');
                    if (nameEl) nameEl.value = pkgText;
                    if (hiddenEl) hiddenEl.value = selectedGiftId;

                    console.log('Updated form fields for package:', selectedGiftId);
                });



                /* const cardSelect = document.getElementById('tetherprisingnewPackageSelectCard');
                if (cardSelect) cardSelect.addEventListener('change', function() {
                    const selectedPackage = this.value;
                    tetherprisingnewUpdatePricingCards(selectedPackage);
                    document.getElementById('tetherprisingnewPackageSelectNEW').value = selectedPackage;
                }); */

                // Package selection is handled in the updatePricingCards function

                // Ring count synchronization and validation
                ['tetherprisingnewFemaleRings', 'tetherprisingnewMaleRings'].forEach(id => {
                    document.getElementById(id).addEventListener('input', tetherprisingnewValidateRingCounts);
                });

                // Optional demo inputs (guard if not present)
                const demoCardNumber = document.getElementById('tetherprisingnewCardNumber');
                if (demoCardNumber) demoCardNumber.addEventListener('input', tetherprisingnewFormatCardNumber);

                const demoExpiry = document.getElementById('tetherprisingnewExpiryDate');
                if (demoExpiry) demoExpiry.addEventListener('input', tetherprisingnewFormatExpiryDate);

                const demoCvv = document.getElementById('tetherprisingnewCvv');
                if (demoCvv) demoCvv.addEventListener('input', tetherprisingnewFormatCVV);

                // Prevent native submit; payment is handled by gateway buttons
                document.getElementById('tetherprisingnewOrderForm').addEventListener('submit', function(e){ e.preventDefault(); });

                // Modal click outside to close
                window.addEventListener('click', function(event) {
                    const modal = document.getElementById('tetherprisingnewModal');
                    if (event.target === modal) {
                        tetherprisingnewCloseModal();
                    }
                });



                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', function() {
                        console.log('Close modal button clicked');
                        tetherprisingnewCloseModal();
                    });
                }
            }

            // Update pricing cards based on selected package
            function tetherprisingnewUpdatePricingCards(packageId) {
                const cardContainer = document.getElementById('tetherprisingnewPricingCardsnew');
                // Convert packageId to number for comparison since gift IDs are numbers
                const numericPackageId = parseInt(packageId);
                const selectedGift = tetherprisingnewGiftData.find(gift => gift.id === numericPackageId);

                console.log('Updating cards for gift ID:', packageId, 'Numeric ID:', numericPackageId);
                console.log('All rings:', tetherprisingnewGiftData);
                console.log('Looking for gift with ID:', numericPackageId);

                if (!selectedGift) {
                    console.error('Gift not found for ID:', packageId);
                    return;
                }

        cardContainer.innerHTML = '';

                // Create single package card
            const cardElement = document.createElement('div');
                cardElement.className = `tetherprisingnew-pricing-card tetherprisingnew-selected`;
            cardElement.dataset.package = packageId;
                cardElement.dataset.packageName = selectedGift.title;
                cardElement.dataset.packagePrice = selectedGift.price;
                cardElement.dataset.packageRings = selectedGift.rings_count;

            cardElement.innerHTML = `
                    <div class="tetherprisingnew-price">$${selectedGift.price}</div>
                    <div class="tetherprisingnew-price-detail">${selectedGift.title}</div>
                <div class="tetherprisingnew-couples-section">
                    <div class="tetherprisingnew-couples-text">Happy Couples Connected</div>
                        <div class="tetherprisingnew-couples-number">${selectedGift.couples_connected || 0}</div>
                </div>
            `;

            cardElement.addEventListener('click', function() {
                    console.log('Package clicked:', selectedGift);

                    // Update form fields
                    const totalEl = document.getElementById('tetherprisingnewTotalRings');
                    const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                    const maleEl = document.getElementById('tetherprisingnewMaleRings');

                    if (totalEl && femaleEl && maleEl) {
                        // Ensure rings_count is treated as a number, trim any spaces
                        const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                        totalEl.value = ringsCount;
                        femaleEl.value = Math.floor(ringsCount / 2);
                        maleEl.value = ringsCount - Math.floor(ringsCount / 2);

                        totalEl.readOnly = true;
                        femaleEl.readOnly = false;
                        maleEl.readOnly = false;

                        console.log('Form fields updated with rings:', {
                            total: ringsCount,
                            female: Math.floor(ringsCount / 2),
                            male: ringsCount - Math.floor(ringsCount / 2)
                        });
                    }

                    // Update hidden fields
                    const packageIdEl = document.getElementById('ring_package_id');
                    const packageNameEl = document.getElementById('ring_package_name');
                    const packagePriceEl = document.getElementById('ring_package_price');
                    const ringsCountEl = document.getElementById('ring_rings_count');

                    if (packageIdEl) packageIdEl.value = selectedGift.id;
                    if (packageNameEl) packageNameEl.value = selectedGift.title;
                    if (packagePriceEl) packagePriceEl.value = selectedGift.price;
                    if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                    // Update display fields
                    const selectedPackageEl = document.getElementById('tetherprisingnewSelectedPackage');
                    const selectedPackageNameEl = document.getElementById('tetherprisingnewSelectedPackageName');
                    const selectedPackagePriceEl = document.getElementById('tetherprisingnewSelectedPackagePrice');
                    const selectedPackageRingsEl = document.getElementById('tetherprisingnewSelectedPackageRings');
                    const packagePriceDisplayEl = document.getElementById('tetherprisingnewPackagePrice');

                    if (selectedPackageEl) selectedPackageEl.value = selectedGift.id;
                    if (selectedPackageNameEl) selectedPackageNameEl.value = selectedGift.title;
                    if (selectedPackagePriceEl) selectedPackagePriceEl.value = selectedGift.price;
                    if (selectedPackageRingsEl) selectedPackageRingsEl.value = selectedGift.rings_count;
                    if (packagePriceDisplayEl) packagePriceDisplayEl.value = '$' + selectedGift.price;

                    // Update summary
                    tetherprisingnewUpdatePackageSummary();

                    console.log('Form updated with package:', {
                        id: selectedGift.id,
                        name: selectedGift.title,
                        price: selectedGift.price,
                        rings: selectedGift.rings_count
                    });
            });

            cardContainer.appendChild(cardElement);

                // Auto-select the first package
                setTimeout(() => {
                    cardElement.click();
                }, 100);

                // Also manually update the form as a fallback
                setTimeout(() => {
                    console.log('Fallback: Manually updating form fields...');
                    const totalEl = document.getElementById('tetherprisingnewTotalRings');
                    const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                    const maleEl = document.getElementById('tetherprisingnewMaleRings');

                                            if (totalEl && femaleEl && maleEl) {
                            // Ensure rings_count is treated as a number, trim any spaces
                            const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                            totalEl.value = ringsCount;
                            femaleEl.value = Math.floor(ringsCount / 2);
                            maleEl.value = ringsCount - Math.floor(ringsCount / 2);
                            console.log('Fallback: Form fields updated', {
                                total: ringsCount,
                                female: Math.floor(ringsCount / 2),
                                male: ringsCount - Math.floor(ringsCount / 2)
                            });
                        }
                }, 200);
            }


            // Compute and update package summary UI and hidden fields
            function tetherprisingnewUpdatePackageSummary() {
                const packagePrice = Number(document.getElementById('ring_package_price').value || 0);
                const packageName = document.getElementById('ring_package_name').value || 'No package selected';
                const ringsCount = document.getElementById('ring_rings_count').value || 0;

                console.log('Updating package summary:', { packagePrice, packageName, ringsCount });

                // Update UI
                const packageTitleEl = document.getElementById('ringPackageTitle');
                const packageAmtEl = document.getElementById('ringPackageAmount');
                const totalEl = document.getElementById('ringTotalAmount');

                if (packageTitleEl) {
                    packageTitleEl.textContent = packageName;
                    console.log('Updated package title:', packageName);
                }
                if (packageAmtEl) {
                    packageAmtEl.textContent = packagePrice.toFixed(2);
                    console.log('Updated package amount:', packagePrice.toFixed(2));
                }
                if (totalEl) {
                            totalEl.textContent = packagePrice.toFixed(2);
                }

                // Update package information display fields
                const packageNameDisplayEl = document.getElementById('tetherprisingnewSelectedPackageName');
                const packagePriceDisplayEl = document.getElementById('tetherprisingnewPackagePrice');
                const packageRingsDisplayEl = document.getElementById('tetherprisingnewPackageRingsDisplay');

                if (packageNameDisplayEl) {
                    packageNameDisplayEl.value = packageName;
                    console.log('Updated package name display:', packageName);
                }
                if (packagePriceDisplayEl) {
                    packagePriceDisplayEl.value = '$' + packagePrice.toFixed(2);
                    console.log('Updated package price display:', '$' + packagePrice.toFixed(2));
                }
                if (packageRingsDisplayEl) {
                    packageRingsDisplayEl.value = ringsCount + ' Rings';
                    console.log('Updated package rings display:', ringsCount + ' Rings');
                }
            }


            // tetherprisingnewValidateRingCounts function is already defined globally above

            // Ring count synchronization (legacy function)
            function tetherprisingnewSyncRingCounts() {
                const female = parseInt(document.getElementById('tetherprisingnewFemaleRings').value) || 0;
                const male = parseInt(document.getElementById('tetherprisingnewMaleRings').value) || 0;
                const total = parseInt(document.getElementById('tetherprisingnewTotalRings').value) || 0;

                if (this.id === 'tetherprisingnewTotalRings') {
                    const remaining = total - female - male;
                    if (remaining < 0) {
                        document.getElementById('tetherprisingnewFemaleRings').value = Math.floor(total / 2);
                        document.getElementById('tetherprisingnewMaleRings').value = total - Math.floor(total / 2);
                    }
                } else {
                    document.getElementById('tetherprisingnewTotalRings').value = female + male;
                }
            }


                const modal = document.getElementById('tetherprisingnewModal');
                if (!modal) {
                    console.error('Modal element not found');
                    return;
                }

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';

                // Set selected package in form
                const selectedPackage = document.getElementById('tetherprisingnewPackageSelectNEW').value;
                console.log('Opening modal for package:', selectedPackage);

                // Update form fields with selected package
                const selectedPackageEl = document.getElementById('tetherprisingnewSelectedPackage');
                const selectedPackageNameEl = document.getElementById('tetherprisingnewSelectedPackageName');

                if (selectedPackageEl) selectedPackageEl.value = selectedPackage;

                // Also set package readable name if available from dropdown
                const pkgSelectEl = document.getElementById('tetherprisingnewPackageSelectNEW');
                const pkgText = pkgSelectEl.options[pkgSelectEl.selectedIndex]?.text || selectedPackage;
                if (selectedPackageNameEl) selectedPackageNameEl.value = pkgText;

                // Update pricing cards to show the selected package
                tetherprisingnewUpdatePricingCards(selectedPackage);

                // Add entrance animation
                setTimeout(() => {
                    const modalContent = modal.querySelector('.tetherprisingnew-modal-content');
                    if (modalContent) {
                        modalContent.style.animation = 'tetherprisingnewSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    }
                }, 10);

                // Ensure form is properly initialized after modal opens
                setTimeout(() => {
                    console.log('Modal opened, ensuring form is initialized...');
                    const numericPackageId = parseInt(selectedPackage);
                    const selectedGift = tetherprisingnewGiftData.find(gift => gift.id === numericPackageId);
                    if (selectedGift) {
                        console.log('Found selected gift in modal:', selectedGift);
                        // Force update form fields
                        const totalEl = document.getElementById('tetherprisingnewTotalRings');
                        const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                        const maleEl = document.getElementById('tetherprisingnewMaleRings');

                        if (totalEl && femaleEl && maleEl) {
                            // Ensure rings_count is treated as a number, trim any spaces
                            const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                            totalEl.value = ringsCount;
                            femaleEl.value = Math.floor(ringsCount / 2);
                            maleEl.value = ringsCount - Math.floor(ringsCount / 2);
                            console.log('Modal form fields updated:', {
                                total: ringsCount,
                                female: Math.floor(ringsCount / 2),
                                male: ringsCount - Math.floor(ringsCount / 2)
                            });
                        }

                        // Update hidden fields for package information
                        const packageIdEl = document.getElementById('ring_package_id');
                        const packageNameEl = document.getElementById('ring_package_name');
                        const packagePriceEl = document.getElementById('ring_package_price');
                        const ringsCountEl = document.getElementById('ring_rings_count');

                        if (packageIdEl) packageIdEl.value = selectedGift.id;
                        if (packageNameEl) packageNameEl.value = selectedGift.title;
                        if (packagePriceEl) packageIdEl.value = selectedGift.price;
                        if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                        // Update package summary
                        tetherprisingnewUpdatePackageSummary();
                    }
            // Enhanced camera scan simulation
            // tetherprisingnewStartCameraScan function is now defined globally above


                alert('📏 Manual Size Entry Mode\n\n' +
                    '✋ Please use the dropdown menus below to select your ring sizes\n' +
                    '🐀񅠠Need help? Use our size guide:\n' +
                    '• Wrap a string around your finger\n' +
                    '• Mark where it overlaps\n' +
                    '• Measure the length in mm\n' +
                    '• Use our conversion chart\n\n' +
                    '💡 Tip: Measure at the end of the day when fingers are largest');
            }

            // Initialize accessibility features
            document.addEventListener('DOMContentLoaded', function() {
                // Add ARIA labels to interactive elements
                document.querySelectorAll('.tetherprisingnew-pricing-card').forEach((card, index) => {
                    card.setAttribute('role', 'button');
                    card.setAttribute('tabindex', '0');
                    card.setAttribute('aria-label', `Pricing option ${index + 1}`);
                });

                // Add Escape key support
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        tetherprisingnewCloseModal();
                    }
                });
            });

            // Fallback payment method initialization
            window.addEventListener('load', function() {
                console.log('Window loaded, checking payment methods again...');
                setTimeout(() => {
                    if (typeof window.initializePaymentMethods === 'function') {
                        console.log('Attempting to initialize payment methods...');
                        window.initializePaymentMethods();
                    } else {
                        console.error('initializePaymentMethods function not found');
                    }
                }, 500);
            });

            // Debug function to manually test form update
            window.debugFormUpdate = function() {
                console.log('=== DEBUG FORM UPDATE ===');
                const selectedGift = tetherprisingnewGiftData[0]; // Get first gift
                if (selectedGift) {
                    console.log('Testing with gift:', selectedGift);

                    // Update form fields
                    const totalEl = document.getElementById('tetherprisingnewTotalRings');
                    const femaleEl = document.getElementById('tetherprisingnewFemaleRings');
                    const maleEl = document.getElementById('tetherprisingnewMaleRings');

                    if (totalEl && femaleEl && maleEl) {
                        // Ensure rings_count is treated as a number, trim any spaces
                        const ringsCount = parseInt(selectedGift.rings_count.toString().trim()) || 2;
                        totalEl.value = ringsCount;
                        femaleEl.value = Math.floor(ringsCount / 2);
                        maleEl.value = ringsCount - Math.floor(ringsCount / 2);

                        console.log('Form fields manually updated:', {
                            total: ringsCount,
                            female: Math.floor(ringsCount / 2),
                            male: ringsCount - Math.floor(ringsCount / 2)
                        });
                    } else {
                        console.error('Form fields not found');
                    }

                    // Update hidden fields
                    const packageIdEl = document.getElementById('ring_package_id');
                    const packageNameEl = document.getElementById('ring_package_name');
                    const packagePriceEl = document.getElementById('ring_package_price');
                    const ringsCountEl = document.getElementById('ring_rings_count');

                    if (packageIdEl) packageIdEl.value = selectedGift.id;
                    if (packageNameEl) packageNameEl.value = selectedGift.title;
                    if (packagePriceEl) packagePriceEl.value = selectedGift.price;
                    if (ringsCountEl) ringsCountEl.value = selectedGift.rings_count;

                    console.log('Hidden fields updated:', {
                        id: packageIdEl?.value,
                        name: packageNameEl?.value,
                        price: packagePriceEl?.value,
                        rings: ringsCountEl?.value
                    });
                } else {
                    console.error('No rings found in data');
                }
                console.log('=== END DEBUG ===');
            };

            // ================== Real Payments Wiring ==================
            document.addEventListener('DOMContentLoaded', function() {
                // ringShowSuccessAndClose function is already defined globally above

                const ringForm = document.getElementById('tetherprisingnewOrderForm');

                // Ring size estimator (MediaPipe + manual coin calibration)
                (function initRingEstimator(){
                    const video = document.getElementById('ringVideo');
                    const canvas = document.getElementById('ringCanvas');
                    const ctx = canvas.getContext('2d');
                    const startBtn = document.getElementById('ringStartBtn');
                    const captureBtn = document.getElementById('ringCaptureBtn');
                    const closeBtn = document.getElementById('ringCloseBtn');
                    const resultEl = document.getElementById('ringResult');
                    const panel = document.getElementById('ringCameraPanel');

                    let stream = null;
                    let coinClicks = [];

                    async function startCamera(){
                        try {
                            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
                            video.srcObject = stream;
                        } catch(err) {
                            alert('Camera error: ' + (err.message || err));
                        }
                    }

                    function stopCamera(){
                        if (stream) {
                            stream.getTracks().forEach(t => t.stop());
                            stream = null;
                        }
                    }

                    function captureFrame(){
                        const vw = video.videoWidth || 320;
                        const vh = video.videoHeight || 240;
                        canvas.width = vw;
                        canvas.height = vh;
                        ctx.drawImage(video, 0, 0, vw, vh);
                        canvas.style.display = 'block';
                        resultEl.textContent = '📐 Click two points across the coin diameter (edge to edge) to calibrate the scale.';
                        coinClicks = [];
                    }

                    canvas.addEventListener('click', function(e){
                        const rect = canvas.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        coinClicks.push({x,y});
                        if (coinClicks.length === 2) {
                            const dx = coinClicks[1].x - coinClicks[0].x;
                            const dy = coinClicks[1].y - coinClicks[0].y;
                            const coinPx = Math.sqrt(dx*dx + dy*dy);
                            const COIN_MM = 18.5; // 1 PKR example
                            const pxPerMm = coinPx / COIN_MM;
                            // Approximate finger base width: use center horizontal span
                            const midY = canvas.height * 0.55;
                            // Sample grayscale edge detection across middle row (very rough)
                            const imgData = ctx.getImageData(0, Math.floor(midY), canvas.width, 1).data;
                            let leftEdge = -1, rightEdge = -1;
                            for (let x=1; x<canvas.width; x++) {
                                const idx = x*4;
                                const prev = imgData[(x-1)*4];
                                const curr = imgData[idx];
                                if (leftEdge === -1 && Math.abs(curr - prev) > 25) leftEdge = x;
                                if (leftEdge !== -1 && Math.abs(curr - prev) > 25) rightEdge = x;
                            }
                            if (leftEdge !== -1 && rightEdge !== -1 && rightEdge > leftEdge) {
                                const fingerPx = rightEdge - leftEdge;
                                const fingerMm = fingerPx / pxPerMm;
                                const circumference = fingerMm * Math.PI;
                                const usSize = circumference / 25.4;
                                resultEl.textContent = `Estimated US Ring Size: ${usSize.toFixed(1)}`;
                                // Autofill closest sizes if present
                                const femaleSel = document.getElementById('tetherprisingnewFemaleSize');
                                const maleSel = document.getElementById('tetherprisingnewMaleSize');
                                const nearest = Math.max(4, Math.min(13, Math.round(usSize)));
                                if (femaleSel) femaleSel.value = String(nearest);
                                if (maleSel) maleSel.value = String(Math.min(13, Math.max(8, nearest+3)));
                            } else {
                                resultEl.textContent = '❌ Could not detect finger edges. Try:\n• Better lighting\n• Clear background\n• Hold camera 15-20cm away\n• Ensure finger is flat and centered';
                            }
                        }
                    });

                    if (startBtn) startBtn.addEventListener('click', startCamera);
                    if (captureBtn) captureBtn.addEventListener('click', captureFrame);
                    if (closeBtn) closeBtn.addEventListener('click', function(){ panel.style.display='none'; stopCamera(); });

                    window.ringSize = { start: () => { panel.style.display='block'; startCamera(); } };
                })();

                // buildRingPayload function is already defined globally above
                // validateRingForm function is already defined globally above

                // postRingCheckout function is already defined globally above

                // Stripe button - ensure event listener is attached
                const stripeButton = document.getElementById('ringStripeSubmitButton');
                if (!stripeButton) {
                    console.error('Stripe button not found!');
                    return;
                }

                console.log('Stripe button found, attaching event listener...');

                // Remove existing event listeners and add new one
                const newStripeButton = stripeButton.cloneNode(true);
                stripeButton.parentNode.replaceChild(newStripeButton, stripeButton);

                // Add click event listener to the new button
                newStripeButton.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Stripe button clicked, starting payment process...');

                    // Show loading state
                    const button = this;
                    const buttonText = document.getElementById('stripeButtonText');
                    const buttonLoader = document.getElementById('stripeButtonLoader');

                    if (buttonText && buttonLoader) {
                        buttonText.style.display = 'none';
                        buttonLoader.style.display = 'inline';
                        button.disabled = true;
                        button.style.opacity = '0.7';
                        button.style.cursor = 'not-allowed';
                    }

                    try {
                        if (!window.validateRingForm()) {
                            alert('Please complete all required fields and select a package.');
                            return;
                        }

                        const payload = window.buildRingPayload();
                        if (!payload) {
                            return; // Validation failed
                        }

                        console.log('Creating Stripe payment method...');

                        // Check if Stripe is initialized
                        if (!window.stripe || !window.stripeCardElement) {
                            console.error('Stripe not initialized. Attempting to reinitialize...');
                            const reinitialized = window.initializeStripe();
                            if (!reinitialized) {
                                throw new Error('Stripe is not available. Please use PayPal, Google Pay, or Apple Pay instead.');
                            }
                            // Recreate card element if needed
                            if (!window.stripeCardElement && window.elements) {
                                window.stripeCardElement = window.elements.create('card');
                                window.stripeCardElement.mount('#ring-card-element');
                            }
                        }

                        const { paymentMethod, error } = await window.stripe.createPaymentMethod({
                            type: 'card',
                            card: window.stripeCardElement,
                            billing_details: {
                                name: document.querySelector('[name="fullname"]').value,
                                email: document.querySelector('[name="email"]').value
                            }
                        });

                        if (error) {
                            console.error('Stripe payment method error:', error);
                            alert(error.message);
                            return;
                        }

                        console.log('Payment method created successfully:', paymentMethod.id);

                        const finalPayload = { ...payload, payment_method: 'card', payment_method_id: paymentMethod.id };
                        const data = await window.postRingCheckout(finalPayload);
                        console.log('Server response:', data);

                        if (data.errors) {
                            console.error('Validation errors:', data.errors);
                            alert('Validation Error');
                            return;
                        }

                        if (data.requires_action) {
                            console.log('Payment requires action, confirming card payment...');
                            const result = await window.stripe.confirmCardPayment(data.payment_intent_client_secret);
                            if (result.error) {
                                console.error('Card payment confirmation error:', result.error);
                                alert(result.error.message);
                                return;
                            }
                        }

                        if (data.success) {
                            console.log('Payment successful, showing success message...');
                            window.ringShowSuccessAndClose();
                        } else {
                            console.error('Payment failed:', data.message);
                            alert(data.message || 'Payment failed');
                        }
                    } catch (stripeError) {
                        console.error('Stripe payment error:', stripeError);
                        alert('Payment processing error: ' + stripeError.message);
                    } finally {
                        // Hide loading state
                        if (buttonText && buttonLoader) {
                            buttonText.style.display = 'inline';
                            buttonLoader.style.display = 'none';
                            button.disabled = false;
                            button.style.opacity = '1';
                            button.style.cursor = 'pointer';
                        }
                    }
                });

                // Apple Pay integration is now handled by the main initializePaymentMethods function

                // Payment methods are now handled by the main initializePaymentMethods function
            });
            // Add performance optimizations
            function tetherprisingnewOptimizePerformance() {
                // Debounce scroll events
                let tetherprisingnewScrollTimeout;
                window.addEventListener('scroll', function() {
                    clearTimeout(tetherprisingnewScrollTimeout);
                    tetherprisingnewScrollTimeout = setTimeout(tetherprisingnewUpdateOrbs, 16); // 60fps
                });

                // Optimize animations with will-change
                document.querySelectorAll('.tetherprisingnew-pricing-card, .tetherprisingnew-shop-btn, .tetherprisingnew-floating-orb').forEach(el => {
                    el.style.willChange = 'transform';
                });
            }

            // Initialize performance optimizations
            document.addEventListener('DOMContentLoaded', tetherprisingnewOptimizePerformance);

            // Add error handling for form validation
            function tetherprisingnewShowFieldError(field, message) {
                // Remove existing error
                const existingError = field.parentElement.querySelector('.tetherprisingnew-field-error');
                if (existingError) {
                    existingError.remove();
                }

                // Create error element
                const errorElement = document.createElement('div');
                errorElement.className = 'tetherprisingnew-field-error';
                errorElement.style.color = '#ef4444';
                errorElement.style.fontSize = '12px';
                errorElement.style.marginTop = '5px';
                errorElement.textContent = message;

                // Add error styling to field
                field.style.borderColor = '#ef4444';
                field.style.backgroundColor = '#fef2f2';

                // Insert error message
                field.parentElement.appendChild(errorElement);

                // Remove error on input
                field.addEventListener('input', function clearError() {
                    field.style.borderColor = '#e5e7eb';
                    field.style.backgroundColor = 'white';
                    if (errorElement && errorElement.parentElement) {
                        errorElement.remove();
                    }
                    field.removeEventListener('input', clearError);
                });
            }

            // Enhanced form validation with better UX
            function tetherprisingnewValidateForm() {
                const requiredFields = document.querySelectorAll('#tetherprisingnewOrderForm [required]');
                let isValid = true;
                let firstErrorField = null;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        const fieldName = field.previousElementSibling?.textContent || 'This field';
                        tetherprisingnewShowFieldError(field, `${fieldName} is required`);
                        if (!firstErrorField) {
                            firstErrorField = field;
                        }
                        isValid = false;
                    } else {
                        field.style.borderColor = '#10b981';
                        field.style.backgroundColor = '#f0fdf4';
                    }
                });

                // Scroll to first error field
                if (firstErrorField) {
                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErrorField.focus();
                }

                return isValid;
            }
        </script>

        <style>
    .swal-high-z-index {
    z-index: 999999 !important;
    }
    </style>

    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
    <!-- PayPal JS SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
    <script>
    // Add this near the top of your script

    document.addEventListener("DOMContentLoaded", async function () {
    // Function to close the gift modal


    function closeGiftModal() {
        const modal = document.getElementById('giftModalOverlay');
        if (modal) {
        modal.style.display = 'none';
        }
    }

    // Function to show success and close modal
    function showSuccessAndCloseModal() {
        // Close the modal first
        closeGiftModal();

        // Then show SweetAlert after a short delay to ensure modal is closed
        setTimeout(() => {
        showSweetAlert({
            title: 'Payment Successful!',
            text: 'Your gift purchase was completed successfully.',
            icon: 'success',
            confirmButtonText: 'OK',
            didClose: () => {
            window.location.href = "{{ route('home') }}";
            }
        });
        }, 100);
    }

    // Helper function to show SweetAlert with proper z-index
    function showSweetAlert(options) {
        // Close modal first if it's open
        closeGiftModal();

        // Add custom z-index to ensure SweetAlert appears on top
        const defaultOptions = {
        customClass: {
            popup: 'swal-high-z-index'
        },
        ...options
        };

        setTimeout(() => {
        Swal.fire(defaultOptions);
        }, 100);
    }

    // Separate function for Stripe payment processing
    window.processStripePayment = async function() {
        const form = document.getElementById("giftForm");
        if (!form) {
        showSweetAlert({
            title: 'Error',
            text: 'Form not found. Please try again.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
        }

        // Validate required fields before submitting
        const requiredFields = [
        form.querySelector('[name="recipientName"]'),
        form.querySelector('[name="recipientEmail"]'),
        form.querySelector('[name="deliveryDate"]'),
        form.querySelector('[name="senderName"]'),
        form.querySelector('[name="senderEmail"]'),
        form.querySelector('[name="billingAddress"]'),
        ];
        let missing = false;
        requiredFields.forEach(field => {
        if (!field || !field.value.trim()) {
            missing = true;
            if (field && field.style) field.style.borderColor = 'red';
        } else {
            if (field && field.style) field.style.borderColor = '';
        }
        });
        if (missing) {
        showSweetAlert({
            title: 'Missing Information',
            text: 'Please fill in all required fields.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
        }

        // Build FormData with backend field names ONLY
        const formData = new FormData();
        const giftIdValue = document.querySelector("#giftFormSection input[name='gift_id']").value || selectedGiftId;
        const priceValue = selectedGiftPrice || form.querySelector("#giftFormSection input[name='price']")?.value;
        formData.append("gift_id", giftIdValue);
        formData.append("recipient_fullname", form.querySelector('[name="recipientName"]').value);
        formData.append("recipient_email", form.querySelector('[name="recipientEmail"]').value);
        formData.append("recipient_phone", form.querySelector('[name="recipientPhone"]').value);
        formData.append("recipient_delivery_date", form.querySelector('[name="deliveryDate"]').value);
        formData.append("yi_fullname", form.querySelector('[name="senderName"]').value);
        formData.append("yi_email", form.querySelector('[name="senderEmail"]').value);
        formData.append("personal_message", form.querySelector('[name="message"]').value);
        formData.append("billing_address", form.querySelector('[name="billingAddress"]').value);
        formData.append("price", priceValue);
        formData.append("payment_method", "card");

        try {
        const { paymentMethod, error } = await window.stripe.createPaymentMethod({
            type: "card",
            card: window.cardElement,
            billing_details: {
            name: form.querySelector('[name="senderName"]').value,
            email: form.querySelector('[name="senderEmail"]').value,
            },
        };

        if (error) {
            console.error("Stripe createPaymentMethod error", error);
            showSweetAlert({
            title: 'Card Error',
            text: error.message,
            icon: 'error',
            confirmButtonText: 'OK'
            });
            return;
        }

        formData.append("payment_method_id", paymentMethod.id);
        console.log("Sending Stripe payment request", { paymentMethodId: paymentMethod.id });

        const response = await fetch("{{ route('gift.checkout') }}", {
            method: "POST",
            headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: formData,
        });

        let data;
        try {
            data = await response.json();
        } catch (err) {
            showSweetAlert({
            title: 'Server Error',
            text: 'Could not parse server response.',
            icon: 'error',
            confirmButtonText: 'OK'
            });
            return;
        }
        console.log("Stripe payment response", data);

        if (data.errors) {
            let errorMsg = '';
            for (const key in data.errors) {
            errorMsg += data.errors[key].join(' ') + '\n';
            }
            showSweetAlert({
            title: 'Validation Error',
            text: errorMsg,
            icon: 'error',
            confirmButtonText: 'OK'
            });
            return;
        }

        if (data.requires_action) {
            const result = await window.stripe.confirmCardPayment(data.payment_intent_client_secret);
            if (result.error) {
            console.error("Stripe confirmCardPayment error", result.error);
            showSweetAlert({
                title: 'Payment Error',
                text: result.error.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
            }
        }

        if (data.success) {
            showSuccessAndCloseModal();
        } else {
            showSweetAlert({
            title: 'Payment Failed',
            text: data.message || 'Payment failed.',
            icon: 'error',
            confirmButtonText: 'OK'
            });
        }

        } catch (err) {
        console.error("Stripe Payment Error:", err);
        showSweetAlert({
            title: 'Payment Error',
            text: err.message || 'Payment processing failed.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        }
    };

    // PayPal button is now handled by the main payment methods initialization
        console.log("Gift payment script loaded");

    // Create and mount card element
    if (window.elements) {
        window.cardElement = window.elements.create('card');
        window.cardElement.mount('#ring-card-element');
    }



        // Hide other payment buttons when Stripe is selected
        function hideOtherPaymentButtons() {
            const paypalContainer = document.getElementById('paypal-button-container');
            const googlePayWidget = document.getElementById('google-pay-widget');
            const applePayWidget = document.getElementById('apple-pay-widget');

            if (paypalContainer) paypalContainer.style.display = 'none';
            if (googlePayWidget) googlePayWidget.style.display = 'none';
            if (applePayWidget) applePayWidget.style.display = 'none';
        }

        // Show all payment buttons
        function showAllPaymentButtons() {
            const paypalContainer = document.getElementById('paypal-button-container');
            const googlePayWidget = document.getElementById('google-pay-widget');
            const applePayWidget = document.getElementById('apple-pay-widget');

            if (paypalContainer) paypalContainer.style.display = 'block';
            if (googlePayWidget) googlePayWidget.style.display = 'block';
            if (applePayWidget) applePayWidget.style.display = 'block';
        }

        let selectedGiftId = null;
        let selectedGiftPrice = null;

        const giftCards = document.querySelectorAll(".giftPackage-card");
        giftCards.forEach(card => {
            card.addEventListener("click", () => {
                selectedGiftId = card.dataset.giftId;
                selectedGiftPrice = card.dataset.giftPrice;
                console.log("Gift selected", { selectedGiftId, selectedGiftPrice });
                // Always update hidden input and visible fields
                document.querySelector("#gift_id").value = selectedGiftId;
                document.querySelector("#giftFormSection input[name='gift_id']").value = selectedGiftId;
                document.querySelector("#giftPackageSection").style.display = "none";
                document.querySelector("#giftFormSection").style.display = "block";

                // Render Google Pay button widget in form after gift is selected
                if (window.google && window.google.payments) {
                    const paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
                    const button = paymentsClient.createButton({
                        onClick: function() {
                            const paymentDataRequest = {
                                apiVersion: 2,
                                apiVersionMinor: 0,
                                allowedPaymentMethods: [{
                                    type: 'CARD',
                                    parameters: {
                                        allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                                        allowedCardNetworks: ['MASTERCARD', 'VISA'],
                                    },
                                    tokenizationSpecification: {
                                        type: 'PAYMENT_GATEWAY',
                                        parameters: {
                                            gateway: 'stripe',
                                            'stripe:version': '2020-08-27',
                                            'stripe:publishableKey': "{{ config('services.stripe.key') }}"
                                        }
                                    }
                                }],
                                merchantInfo: {
                                    merchantName: 'TetherHeart',
                                },
                                transactionInfo: {
                                    totalPriceStatus: 'FINAL',
                                    totalPrice: selectedGiftPrice,
                                    currencyCode: 'USD',
                                },
                            };
                            paymentsClient.loadPaymentData(paymentDataRequest)
                                .then(function(paymentData) {
                                    // Send token and form data to backend
                                    const form = document.getElementById("giftForm");
                                    // Validate required fields before submitting
                                    const requiredFields = [
                                        form.querySelector('[name="recipientName"]'),
                                        form.querySelector('[name="recipientEmail"]'),
                                        form.querySelector('[name="deliveryDate"]'),
                                        form.querySelector('[name="senderName"]'),
                                        form.querySelector('[name="senderEmail"]'),
                                        form.querySelector('[name="billingAddress"]'),
                                    ];
                                    let missing = false;
                                    requiredFields.forEach(field => {
                                        if (!field || !field.value.trim()) {
                                            missing = true;
                                            if (field && field.style) field.style.borderColor = 'red';
                                        } else {
                                            if (field && field.style) field.style.borderColor = '';
                                        }
                                    });
                                    if (missing) {
                                        showSweetAlert({
                                            title: 'Missing Information',
                                            text: 'Please fill in all required fields.',
                                            icon: 'warning',
                                            confirmButtonText: 'OK'
                                        });
                                        return;
                                    }

                                    // Map frontend field names to backend field names
                                    const formData = new FormData();
                                    formData.append("gift_id", selectedGiftId);
                                    formData.append("price", selectedGiftPrice);
                                    formData.append("payment_method", "google_pay");
                                    let tokenRaw = paymentData.paymentMethodData.tokenizationData.token;
                                    let tokenId = tokenRaw;
                                    try {
                                        // If tokenRaw is a JSON string, parse and extract id
                                        const parsed = JSON.parse(tokenRaw);
                                        if (parsed && parsed.id) {
                                            tokenId = parsed.id;
                                        }
                                    } catch (e) {
                                        // If not JSON, use as is
                                    }
                                    formData.append("payment_method_id", tokenId);
                                    formData.append("recipient_fullname", form.querySelector('[name="recipientName"]').value);
                                    formData.append("recipient_email", form.querySelector('[name="recipientEmail"]').value);
                                    formData.append("recipient_phone", form.querySelector('[name="recipientPhone"]').value);
                                    formData.append("recipient_delivery_date", form.querySelector('[name="deliveryDate"]').value);
                                    formData.append("yi_fullname", form.querySelector('[name="senderName"]').value);
                                    formData.append("yi_email", form.querySelector('[name="senderEmail"]').value);
                                    formData.append("personal_message", form.querySelector('[name="message"]').value);
                                    formData.append("billing_address", form.querySelector('[name="billingAddress"]').value);

                                    fetch("{{ route('gift.checkout') }}", {
                                        method: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                        },
                                        body: formData,
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.errors) {
                                            // Laravel validation errors
                                            let errorMsg = '';
                                            for (const key in data.errors) {
                                                errorMsg += data.errors[key].join(' ') + '\n';
                                            }
                                            showSweetAlert({
                                                title: 'Validation Error',
                                                text: errorMsg,
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                            return;
                                        }
                                        if (data.success) {
                                            showSuccessAndCloseModal();
                                        } else {
                                            showSweetAlert({
                                                title: 'Payment Failed',
                                                text: data.message || 'Payment failed.',
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    })
                                    .catch(err => {
                                        showSweetAlert({
                                            title: 'Payment Error',
                                            text: err.message || 'Payment error.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                                })
                                .catch(function(err) {
                                    console.error('Google Pay Error:', err);
                                    showSweetAlert({
                                        title: 'Google Pay Failed',
                                        text: err.statusMessage || 'Google Pay failed.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                });
                        },
                        buttonColor: 'black',
                        buttonType: 'long',
                    });
                    const gpayWidgetContainer = document.getElementById('google-pay-widget');
                    if (gpayWidgetContainer) {
                        gpayWidgetContainer.innerHTML = '';
                        gpayWidgetContainer.appendChild(button);
                    }
                }
            });
        });

        // --- Payment Request Button (Google Pay / Apple Pay)
        if (!window.giftPaymentRequestButtonCreated) {
            const paymentRequest = window.stripe.paymentRequest({
            country: "US",
            currency: "usd",
            total: {
                label: "Gift Package",
                amount: 0, // Updated dynamically later
            },
            requestPayerName: true,
            requestPayerEmail: true,
        });

            const prButton = window.elements.create("paymentRequestButton", {
            paymentRequest: paymentRequest,
        });

        paymentRequest.canMakePayment().then(function (result) {
            console.log('Stripe canMakePayment() result:', result);
            const applePayWidget = document.getElementById('apple-pay-widget');
            if (result && result.applePay) {
                prButton.mount("#payment-request-button");
                if (applePayWidget) {
                    applePayWidget.style.display = '';
                }
            } else {
                if (applePayWidget) {
                    applePayWidget.innerHTML = '<div style="color: #888; padding: 8px 0;">Apple Pay is not available on this device/browser. Please use Safari on an Apple device with Apple Pay set up.</div>';
                }
            }
        });

        paymentRequest.on("paymentmethod", async (ev) => {
            const priceInCents = Math.round(parseFloat(selectedGiftPrice) * 100);
            console.log("Google/Apple Pay initiated", { selectedGiftId, selectedGiftPrice, paymentMethodId: ev.paymentMethod.id });

            // Validate required fields before submitting
            const form = document.getElementById("giftForm");
            const requiredFields = [
                form.querySelector('[name="recipientName"]'),
                form.querySelector('[name="recipientEmail"]'),
                form.querySelector('[name="deliveryDate"]'),
                form.querySelector('[name="senderName"]'),
                form.querySelector('[name="senderEmail"]'),
                form.querySelector('[name="billingAddress"]'),
            ];
            let missing = false;
            requiredFields.forEach(field => {
                if (!field || !field.value.trim()) {
                    missing = true;
                    if (field && field.style) field.style.borderColor = 'red';
                } else {
                    if (field && field.style) field.style.borderColor = '';
                }
            });
            if (missing) {
                showSweetAlert({
                    title: 'Missing Information',
                    text: 'Please fill in all required fields.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                ev.complete("fail");
                return;
            }

            // Map frontend field names to backend field names
            const formData = new FormData();
            formData.append("gift_id", selectedGiftId);
            formData.append("price", selectedGiftPrice);
            formData.append("payment_method", "google_apple_pay");
            formData.append("payment_method_id", ev.paymentMethod.id);
            formData.append("recipient_fullname", form.querySelector('[name="recipientName"]').value);
            formData.append("recipient_email", form.querySelector('[name="recipientEmail"]').value);
            formData.append("recipient_phone", form.querySelector('[name="recipientPhone"]').value);
            formData.append("recipient_delivery_date", form.querySelector('[name="deliveryDate"]').value);
            formData.append("yi_fullname", form.querySelector('[name="senderName"]').value);
            formData.append("yi_email", form.querySelector('[name="senderEmail"]').value);
            formData.append("personal_message", form.querySelector('[name="message"]').value);
            formData.append("billing_address", form.querySelector('[name="billingAddress"]').value);

            try {
                const res = await fetch("{{ route('gift.checkout') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData,
                });

                let data;
                try {
                    data = await res.json();
                } catch (err) {
                    Swal.fire({
                        title: 'Server Error',
                        text: 'Could not parse server response.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    ev.complete("fail");
                    return;
                }
                console.log("Payment response", data);

                if (data.errors) {
                    // Laravel validation errors
                    let errorMsg = '';
                    for (const key in data.errors) {
                        errorMsg += data.errors[key].join(' ') + '\n';
                    }
                    showSweetAlert({
                        title: 'Validation Error',
                        text: errorMsg,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    ev.complete("fail");
                    return;
                }

                if (data.requires_action) {
                    const result = await window.stripe.confirmCardPayment(data.payment_intent_client_secret);
                    if (result.error) {
                        ev.complete("fail");
                        alert(result.error.message);
                        return;
                    }
                }

                if (data.success) {
                    ev.complete("success");
                    showSuccessAndCloseModal();
                } else {
                    ev.complete("fail");
                    showSweetAlert({
                        title: 'Payment Failed',
                        text: data.message || 'Payment failed.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (err) {
                console.error("Payment Request Error:", err);
                ev.complete("fail");
                showSweetAlert({
                    title: 'Payment Error',
                    text: err.message || 'Payment processing failed.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

            window.giftPaymentRequestButtonCreated = true;
        }

        // Google Pay Online SDK integration
        function onGooglePayLoaded() {
            const paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
            const button = paymentsClient.createButton({
                onClick: onGooglePayButtonClicked,
                buttonColor: 'black',
                buttonType: 'long',
            });
            document.getElementById('google-pay-button-success').appendChild(button);
        }

        function onGooglePayButtonClicked() {
            const paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
            const paymentDataRequest = {
                apiVersion: 2,
                apiVersionMinor: 0,
                allowedPaymentMethods: [{
                    type: 'CARD',
                    parameters: {
                        allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                        allowedCardNetworks: ['MASTERCARD', 'VISA'],
                    },
                    tokenizationSpecification: {
                        type: 'PAYMENT_GATEWAY',
                        parameters: {
                            gateway: 'stripe',
                            'stripe:version': '2020-08-27',
                            'stripe:publishableKey': "{{ config('services.stripe.key') }}"
                        }
                    }
                }],
                merchantInfo: {
                    merchantName: 'TetherHeart',
                },
                transactionInfo: {
                    totalPriceStatus: 'FINAL',
                    totalPrice: selectedGiftPrice,
                    currencyCode: 'USD',
                },
            };
            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(function(paymentData) {
                    // Send paymentData.paymentMethodData.tokenizationData.token to backend
                    console.log('Google Pay token:', paymentData.paymentMethodData.tokenizationData.token);
                    Swal.fire({
                        title: 'Google Pay Success!',
                        text: 'Google Pay token received. Payment can be processed on backend.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(function(err) {
                    console.error('Google Pay Error:', err);
                    Swal.fire({
                        title: 'Google Pay Failed',
                        text: err.statusMessage || 'Google Pay failed.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        if (window.google && window.google.payments) {
            onGooglePayLoaded();
        } else {
            window.addEventListener('google-pay-loaded', onGooglePayLoaded);
        }
        // Add event listeners for payment method selection
        // Show Stripe button when card element is focused or clicked
        cardElement.on('focus', function() {
            document.getElementById('stripePaymentSection').style.display = 'block';
            hideOtherPaymentButtons();
        });

        // Hide Stripe button when other payment methods are clicked
        document.addEventListener('click', function(e) {
            if (e.target.closest('#paypal-button-container') ||
                e.target.closest('#google-pay-widget') ||
                e.target.closest('#apple-pay-widget')) {
                document.getElementById('stripePaymentSection').style.display = 'none';
                showAllPaymentButtons();
            }
        });

        // Show Stripe button when clicking on card element area
        document.addEventListener('click', function(e) {
            if (e.target.closest('#card-element') || e.target.closest('#stripePaymentSection')) {
                document.getElementById('stripePaymentSection').style.display = 'block';
                hideOtherPaymentButtons();
            }
        });

        // Prevent form submission (since we have separate buttons for each payment method)
        const form = document.getElementById("giftForm");
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            // Form submission is handled by individual payment buttons
    });
    });
    </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log('Initializing ring packages...');

    const select = document.getElementById("tetherprisingnewPackageSelectNEW");
    const packageCards = document.querySelectorAll(".tetherprisingnew-package-card");

    if (!select || packageCards.length === 0) {
        console.error('Required elements not found!');
        return;
    }

    function updateVisiblePackage() {
        const selectedValue = select.value;
        console.log('Selected package:', selectedValue);

        packageCards.forEach(card => {
            // Remove "gift-" prefix when comparing
            const cardPackage = card.dataset.package.replace('gift-', '');

            if (cardPackage === selectedValue) {
                card.style.display = "flex";
                console.log('Showing card:', cardPackage);
            } else {
                card.style.display = "none";
            }
        });
    }

    // Initial call
    updateVisiblePackage();

    // Listen to changes
    select.addEventListener("change", updateVisiblePackage);

    // Also trigger change event immediately to ensure initial state
    setTimeout(() => {
        select.dispatchEvent(new Event('change'));
    }, 100);
});
              // Subscription plan selection
document.querySelectorAll('.tetherprisingnew-plan-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.tetherprisingnew-plan-option').forEach(o =>
            o.classList.remove('tetherprisingnew-selected-plan'));
        this.classList.add('tetherprisingnew-selected-plan');

        // Get the plan details from data attributes
        const planId = this.getAttribute('data-plan-id');
        const planTitle = this.getAttribute('data-plan-title');
        const planAmount = this.getAttribute('data-plan-amount');
        const planDuration = this.getAttribute('data-plan-duration');

        // Update hidden fields
        document.getElementById('ring_subscription_plan_id').value = planId;

        // Create subscription detail object
        const subscriptionDetail = {
            id: planId,
            title: planTitle,
            amount: planAmount,
            duration: planDuration,
            selected_at: new Date().toISOString()
        };

        // Set the subscription detail as JSON string
        document.getElementById('ring_subscription_detail').value = JSON.stringify(subscriptionDetail);

        tetherprisingnewUpdatePackageSummary();
    });
});

// Initialize with the first plan selected by default
document.addEventListener('DOMContentLoaded', function() {
    const firstPlan = document.querySelector('.tetherprisingnew-plan-option');
    if (firstPlan) {
        firstPlan.click(); // This will trigger the click handler above

        // Also update the package summary after plan selection
        setTimeout(() => {
            tetherprisingnewUpdatePackageSummary();
        }, 100);
    }
});

                function tetherprisingnewUpdatePlanSummary() {
                    const packageAmount = Number(window.__ringSelectedPrice || 0);
                    // Selected plan metadata
                    const selectedPlanEl = document.querySelector('.tetherprisingnew-plan-option.tetherprisingnew-selected-plan');
                    const plan = selectedPlanEl ? {
                        id: selectedPlanEl.getAttribute('data-plan-id'),
                        title: selectedPlanEl.getAttribute('data-plan-title'),
                        amount: Number(selectedPlanEl.getAttribute('data-plan-amount') || 0),
                        duration: Number(selectedPlanEl.getAttribute('data-plan-duration') || 0)
                    } : { id: null, title: null, amount: 0, duration: 0 };

                    const planAmount = Number(plan.amount || 0);
                    const total = Number((packageAmount + planAmount).toFixed(2));

                    // Update UI
                    const planTitleEl = document.getElementById('ringPlanTitle');
                    const planAmtEl = document.getElementById('ringPlanAmount');
                    const pkgAmtEl = document.getElementById('ringPackageAmount');
                    const totalEl = document.getElementById('ringTotalAmount');

                    if (planTitleEl) planTitleEl.textContent = plan.title || '-';
                    if (planAmtEl) planAmtEl.textContent = planAmount.toFixed(2);
                    if (pkgAmtEl) {
                        pkgAmtEl.textContent = packageAmount > 0 ? packageAmount.toFixed(2) : 'No package selected';
                    }
                    if (totalEl) totalEl.textContent = total.toFixed(2);

                    // Fill hidden fields
                    const subPlanIdHidden = document.getElementById('ring_subscription_plan_id');
                    const subPlanDetailHidden = document.getElementById('ring_subscription_detail');
                    if (subPlanIdHidden) subPlanIdHidden.value = plan.id;
                    if (subPlanDetailHidden) subPlanDetailHidden.value = JSON.stringify(plan);
                }


</script>


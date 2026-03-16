@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Ring Orders List</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">
                <svg class="stroke-icon">
                  <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
              </a>
            </li>
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">Ring Orders</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid list-product-view product-wrapper">
    <!-- Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="mb-0">{{ $ordersrings->total() }}</h4>
                <p class="mb-0">Total Orders</p>
              </div>
              <div class="align-self-center">
                <i class="fas fa-shopping-cart fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-success text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="mb-0">${{ number_format($ordersrings->sum('price'), 2) }}</h4>
                <p class="mb-0">Total Revenue</p>
              </div>
              <div class="align-self-center">
                <i class="fas fa-dollar-sign fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-info text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="mb-0">{{ $ordersrings->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                <p class="mb-0">Today's Orders</p>
              </div>
              <div class="align-self-center">
                <i class="fas fa-calendar-day fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-warning text-dark">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="mb-0">{{ $ordersrings->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                <p class="mb-0">This Month</p>
              </div>
              <div class="align-self-center">
                <i class="fas fa-calendar-alt fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h5 class="mb-0">Ring Orders Management</h5>
              </div>
              <div class="col-md-6 text-end">
                <div class="d-flex gap-2 justify-content-end">
                  <input type="text" id="searchOrders" class="form-control" placeholder="Search orders..." style="max-width: 250px;">
                  <select id="filterPayment" class="form-select" style="max-width: 150px;">
                    <option value="">All Payments</option>
                    <option value="stripe">Stripe</option>
                    <option value="paypal">PayPal</option>
                    <option value="google_pay">Google Pay</option>
                    <option value="apple_pay">Apple Pay</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0">
            <div class="list-product">
              <div class="recent-table table-responsive custom-scrollbar product-list-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>No.</th>
                      <th><span class="c-o-light f-w-600">Full Name</span></th>
                      <th><span class="c-o-light f-w-600">Email</span></th>
                      <th><span class="c-o-light f-w-600">Phone</span></th>
                      <th><span class="c-o-light f-w-600">Package</span></th>
                      <th><span class="c-o-light f-w-600">Rings</span></th>
                      <th><span class="c-o-light f-w-600">Subscription</span></th>
                      <th><span class="c-o-light f-w-600">Price</span></th>
                      <th><span class="c-o-light f-w-600">Payment</span></th>
                      <th><span class="c-o-light f-w-600">Date</span></th>
                      <th><span class="c-o-light f-w-600">Actions</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ordersrings as $order)
                      @php
                        $package = is_array($order->package_detail) ? $order->package_detail : json_decode($order->package_detail, true);
                        $subscription = is_array($order->subscription_plan) ? $order->subscription_plan : json_decode($order->subscription_plan, true);
                      @endphp
                      <tr class="product-removes">
                        <td></td>
                        <td>{{ $loop->iteration }}</td>
                        <td><p class="c-o-light">{{ $order->fullname }}</p></td>
                        <td><p class="c-o-light">{{ $order->email }}</p></td>
                        <td><p class="c-o-light">{{ $order->phone }}</p></td>
                        <td>
                          <span class="badge bg-primary text-white">
                            {{ $package['sub_package_name'] ?? 'N/A' }}
                          </span>
                        </td>
                        <td>
                          <span class="badge bg-info text-white">
                            {{ $order->female_rings }}F + {{ $order->male_rings }}M
                          </span>
                        </td>
                        <td>
                          <span class="badge bg-success text-white">
                            {{ $subscription['title'] ?? 'N/A' }}
                          </span>
                        </td>
                        <td><p class="c-o-light f-w-600">${{ number_format($order->price, 2) }}</p></td>
                        <td>
                          <span class="badge bg-warning text-dark">
                            {{ ucfirst($order->payment_method ?? 'N/A') }}
                          </span>
                        </td>
                        <td><p class="c-o-light">{{ $order->created_at->format('d M Y') }}</p></td>
                        <td>
                          <div class="product-action">
                            <button class="square-white" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                              <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#eye') }}"></use></svg>
                            </button>
                            <form action="{{ route('admin.ring.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
                                <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use></svg>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>

                      {{-- Modal --}}
                      <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Ring Order Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <h6 class="text-primary mb-3">Customer Information</h6>
                                  <p><strong>Full Name:</strong> {{ $order->fullname }}</p>
                                  <p><strong>Email:</strong> {{ $order->email }}</p>
                                  <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                  <p><strong>Partner Name:</strong> {{ $order->partner_name }}</p>
                                  <p><strong>Address:</strong> {{ $order->address }}</p>
                                </div>
                                <div class="col-md-6">
                                  <h6 class="text-success mb-3">Order Details</h6>
                                  <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                                  <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                  <p><strong>Total Price:</strong> <span class="badge bg-primary text-white">${{ number_format($order->price, 2) }}</span></p>
                                  <p><strong>Payment Method:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($order->payment_method ?? 'N/A') }}</span></p>
                                  <p><strong>Payment ID:</strong> <code>{{ $order->payment_id ?? 'N/A' }}</code></p>
                                </div>
                              </div>
                              
                              <hr>
                              
                              <div class="row">
                                <div class="col-md-6">
                                  <h6 class="text-info mb-3">Package Information</h6>
                                  <p><strong>Package Name:</strong> {{ $package['sub_package_name'] ?? 'N/A' }}</p>
                                  <p><strong>Package ID:</strong> {{ $package['package_id'] ?? 'N/A' }}</p>
                                  <p><strong>Package Price:</strong> ${{ number_format($package['sub_package_price'] ?? 0, 2) }}</p>
                                  <p><strong>Total Rings:</strong> {{ $package['sub_package_rings'] ?? 'N/A' }}</p>
                                  <p><strong>Couples:</strong> {{ $package['sub_package_couples'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                  <h6 class="text-warning mb-3">Ring Specifications</h6>
                                  <p><strong>Female Rings:</strong> <span class="badge bg-pink text-white">{{ $order->female_rings ?? 'Not specified' }}</span></p>
                                     <p><strong>Male Rings:</strong> <span class="badge bg-blue text-white">{{ $order->male_rings ?? 'Not specified'}}</span></p>
                                  <p><strong>Female Ring Size:</strong> {{ $order->female_ring_size ?? 'Not specified' }}</p>
                               
                                  <p><strong>Male Ring Size:</strong> {{ $order->male_ring_size ?? 'Not specified' }}</p>
                                </div>
                              </div>
                              
                              <hr>
                              
                              <div class="row">
                                <div class="col-12">
                                  <h6 class="text-success mb-3">Subscription Plan</h6>
                                  <p><strong>Plan Name:</strong> {{ $subscription['title'] ?? 'N/A' }}</p>
                                  <p><strong>Plan Amount:</strong> ${{ number_format($subscription['amount'] ?? 0, 2) }}</p>
                                  <p><strong>Duration:</strong> 
                                    @if(isset($subscription['duration']) && $subscription['duration'] > 0)
                                      {{ $subscription['duration'] }} months
                                    @else
                                      One-time payment
                                    @endif
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <form action="{{ route('admin.ring.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        @if ($ordersrings->hasPages())
          <nav aria-label="Page navigation example" style="margin-bottom:20px;">
            <ul class="pagination pagination-primary pagin-border-primary justify-content-center">
              {{-- Previous Page --}}
              @if ($ordersrings->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
              @else
                <li class="page-item"><a class="page-link" href="{{ $ordersrings->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Links --}}
              @foreach ($ordersrings->getUrlRange(1, $ordersrings->lastPage()) as $page => $url)
                @if ($page == $ordersrings->currentPage())
                  <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                  <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
              @endforeach

              {{-- Next Page --}}
              @if ($ordersrings->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $ordersrings->nextPageUrl() }}">Next</a></li>
              @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
              @endif
            </ul>
          </nav>
        @endif

      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<style>
    .badge.bg-pink {
        background-color: #e91e63 !important;
    }
    .badge.bg-blue {
        background-color: #2196f3 !important;
    }
    .badge.bg-primary {
        background-color: #007bff !important;
    }
    .badge.bg-success {
        background-color: #28a745 !important;
    }
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
    .badge.bg-warning {
        background-color: #ffc107 !important;
    }
    .badge.bg-danger {
        background-color: #dc3545 !important;
    }
    
    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    
    .product-action {
        display: flex;
        gap: 5px;
    }
    
    .square-white {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .square-white:hover {
        background: #f8f9fa;
        border-color: #007bff;
    }
    
    .trash-3:hover {
        color: #dc3545 !important;
    }
    
    .modal-body h6 {
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .modal-body p {
        margin-bottom: 8px;
    }
    
    .modal-body code {
        background: #f8f9fa;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 12px;
    }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchOrders');
    const filterSelect = document.getElementById('filterPayment');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterOrders() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = filterSelect.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const paymentMethod = row.querySelector('td:nth-child(10)')?.textContent.toLowerCase() || '';
            
            const matchesSearch = searchTerm === '' || text.includes(searchTerm);
            const matchesFilter = filterValue === '' || paymentMethod.includes(filterValue);
            
            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterOrders);
    filterSelect.addEventListener('change', filterOrders);
});
</script>
@endsection

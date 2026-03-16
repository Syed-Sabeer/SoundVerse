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
                  <h3>
                     Gift Orders List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Orders</li>
                    <li class="breadcrumb-item active">Gift Orders List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid list-product-view product-wrapper">
            <div class="row">

              <div class="col-12">
                <div class="card">
           
                  <div class="card-body px-0 pt-0">
                    <div class="list-product">
                      <div class="recent-table table-responsive custom-scrollbar product-list-table">
                        <table class="table" >
                          <thead>
                            <tr>
                              <th></th>
                              <th>No.</th>
                              <th> <span class="c-o-light f-w-600">Full Name</span></th>
                              <th> <span class="c-o-light f-w-600">Email</span></th>
                              <th> <span class="c-o-light f-w-600">Gift</span></th>
                             
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                        <tbody>
  @foreach ($ordersgifts as $ordersgift)
    <tr class="product-removes">
      <td></td>
      <td>{{ $loop->iteration }}</td>
      <td><p class="c-o-light">{{ $ordersgift->recipient_fullname }}</p></td>
      <td><p class="c-o-light">{{ $ordersgift->recipient_email }}</p></td>
     <td><p class="c-o-light">{{ $ordersgift->gift?->title }}</p></td>

      <td>
        <div class="product-action">
          <!-- View Button -->
          <button class="square-white" data-bs-toggle="modal" data-bs-target="#giftModal{{ $ordersgift->id }}">
            <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#eye') }}"></use></svg>
          </button>

          <!-- Delete Form -->
          <form action="{{ route('admin.gift.orders.destroy', $ordersgift->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this gift order?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
              <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use></svg>
            </button>
          </form>
        </div>
      </td>
    </tr>

    <!-- Modal for Gift Details -->
    <div class="modal fade" id="giftModal{{ $ordersgift->id }}" tabindex="-1" aria-labelledby="giftModalLabel{{ $ordersgift->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="giftModalLabel{{ $ordersgift->id }}">Gift Orders Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <p><strong>Receipt Fullname:</strong> {{ $ordersgift->recipient_fullname }}</p>
            <p><strong>Receipt Email:</strong> {{ $ordersgift->recipient_email }}</p>
            <p><strong>Receipt Phone:</strong> {{ $ordersgift->recipient_phone }}</p>
            <p><strong>Receipt Delivery Date:</strong> {{ $ordersgift->recipient_delivery_date }}</p>
<br>
            <p><strong>Customer Fullname:</strong> {{ $ordersgift->yi_fullname }}</p>
            <p><strong>Customer Email:</strong> {{ $ordersgift->yi_email }}</p>
            <p><strong>Personal Message:</strong> {{ $ordersgift->personal_message }}</p>
            <p><strong>Billing Address:</strong> {{ $ordersgift->billing_address }}</p>
<br>

        <p><strong>Price:</strong> {{ $ordersgift->price }}</p>
            <p><strong>Payment Method:</strong> {{ $ordersgift->payment_method }}</p>
            <p><strong>Payment Id:</strong> {{ $ordersgift->payment_id }}</p>

            <p><strong>Ordered At:</strong> {{ $ordersgift->created_at->format('d M Y, h:i A') }}</p>
          </div>
          <div class="modal-footer">
            <form action="{{ route('admin.gift.orders.destroy', $ordersgift->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this gift order?');">
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


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                        </table>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                </div>
              </div>
              @if ($ordersgifts->hasPages())
  <nav aria-label="Page navigation example" style="margin-bottom:20px;">
    <ul class="pagination pagination-primary pagin-border-primary justify-content-center">
      {{-- Previous Page Link --}}
      @if ($ordersgifts->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Previous</span></li>
      @else
        <li class="page-item"><a class="page-link" href="{{ $ordersgifts->previousPageUrl() }}">Previous</a></li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($ordersgifts->getUrlRange(1, $ordersgifts->lastPage()) as $page => $url)
        @if ($page == $ordersgifts->currentPage())
          <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($ordersgifts->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $ordersgifts->nextPageUrl() }}">Next</a></li>
      @else
        <li class="page-item disabled"><span class="page-link">Next</span></li>
      @endif
    </ul>
  </nav>
@endif

            </div>
          </div>

        </div>






        @endsection

@section('script')
@endsection


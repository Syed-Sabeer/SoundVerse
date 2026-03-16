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
                     Contacts List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Contacts List</li>
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
                             
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                        <tbody>
  @foreach ($contacts as $contact)
    <tr class="product-removes">
      <td></td>
      <td>{{ $loop->iteration }}</td>
      <td><p class="c-o-light">{{ $contact->firstname }} {{ $contact->lastname }}</p></td>
      <td><p class="c-o-light">{{ $contact->email }}</p></td>
      <td>
        <div class="product-action">
          <!-- View Button -->
          <button class="square-white" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">
            <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#eye') }}"></use></svg>
          </button>

          <!-- Delete Form -->
          <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
              <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use></svg>
            </button>
          </form>
        </div>
      </td>
    </tr>

    <!-- Modal for Contact Details -->
    <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">Contact Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
        
            <p><strong>Name:</strong> {{ $contact->firstname }} {{ $contact->lastname }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            
<br>
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
            <p><strong>Message:</strong> {{ $contact->message }}</p>
            <p><strong>Submitted At:</strong> {{ $contact->created_at->format('d M Y, h:i A') }}</p>
          </div>
          <div class="modal-footer">
            <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');">
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
            </div>
          </div>

        </div>






        @endsection

@section('script')
@endsection


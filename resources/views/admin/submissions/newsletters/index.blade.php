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
                     Newsletters List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Newsletters List</li>
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
                            
                              <th> <span class="c-o-light f-w-600">Email</span></th>
                             
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                        <tbody>
  @foreach ($newsletters as $newsletter)
    <tr class="product-removes">
      <td></td>
      <td>{{ $loop->iteration }}</td>
    
      <td><p class="c-o-light">{{ $newsletter->email }}</p></td>
      <td>
        <div class="product-action">

          <!-- Delete Form -->
          <form action="{{ route('admin.newsletterlist.destroy', $newsletter->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this newsletter?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
              <svg><use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use></svg>
            </button>
          </form>
        </div>
      </td>
    </tr>


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


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
                  <h3>Partner List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Partner List</li>
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
                  <div class="card-header card-no-border text-end">
                    <div class="card-header-right-icon"><a class="btn btn-primary f-w-500" href="{{route('admin.partner.add')}}"><i class="fa fa-plus pe-2"></i>Add Partner</a></div>
                  </div>
                  <div class="card-body px-0 pt-0">
                    <div class="list-product">
                      <div class="recent-table table-responsive custom-scrollbar product-list-table">
                        <table class="table" >
                          <thead>
                            <tr>
                              <th></th>
                              <th>No.</th>
                              <th> <span class="c-o-light f-w-600">Logo</span></th>
                              <th> <span class="c-o-light f-w-600">Title</span></th>
                              <th> <span class="c-o-light f-w-600">Visibility</span></th>
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                          <tbody>

                            @foreach ($partners as $partner)

                            <tr class="product-removes">
                                <td></td>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                @if($partner->logo)
                                  <img src="{{ asset('storage/' . $partner->logo) }}" alt="Partner Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                  <div style="width: 50px; height: 50px; background-color: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-image text-muted"></i>
                                  </div>
                                @endif
                              </td>
                              <td>
                                <p class="c-o-light">{{$partner->title}}</p>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                             
                                  <form method="POST" action="{{ route('admin.partner.toggleVisibility', $partner->id) }}" style="display:inline;" class="toggle-visibility-form">
                                      @csrf
                                      <div class="form-check form-switch form-check-inline">
                                          <input class="form-check-input switch-primary check-size" type="checkbox" role="switch" {{ $partner->visibility ? 'checked' : '' }} onchange="this.form.submit()">
                                      </div>
                                  </form>
                                </div>
                              </td>

                              <td>
                          <div class="product-action">

  <a class="square-white" href="{{ route('admin.partner.edit', $partner->id) }}">
    <svg>
      <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
    </svg>
  </a>


    <form action="{{ route('admin.partner.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this partner?');" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
      <svg>
        <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use>
      </svg>
    </button>
  </form>
</div>

                              </td>
                            </tr>

@endforeach
                          </tbody>
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

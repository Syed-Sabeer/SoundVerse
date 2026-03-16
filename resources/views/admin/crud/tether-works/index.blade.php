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
                  <h3>Tether Work List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Tether Work List</li>
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
                    <div class="card-header-right-icon"><a class="btn btn-primary f-w-500" href="{{route('admin.tether-work.add')}}"><i class="fa fa-plus pe-2"></i>Add Tether Work</a></div>
                  </div>
                  <div class="card-body px-0 pt-0">
                    <div class="list-product">
                      <div class="recent-table table-responsive custom-scrollbar product-list-table">
                        <table class="table" >
                          <thead>
                            <tr>
                              <th></th>
                              <th>No.</th>
                              <th> <span class="c-o-light f-w-600">Image</span></th>
                              <th> <span class="c-o-light f-w-600">Text</span></th>
                              <th> <span class="c-o-light f-w-600">Button Text</span></th>
                              <th> <span class="c-o-light f-w-600">Windows Link</span></th>
                              <th> <span class="c-o-light f-w-600">Apple Link</span></th>
                              <th> <span class="c-o-light f-w-600">Android Link</span></th>
                              <th> <span class="c-o-light f-w-600">Actions</span></th>

                            </tr>
                          </thead>
                          <tbody>

                            @foreach ($tetherWorks as $tetherWork)

                            <tr class="product-removes">
                                <td></td>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                @if($tetherWork->image)
                                  <img src="{{ asset('storage/' . $tetherWork->image) }}" alt="Tether Work Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                  <div style="width: 50px; height: 50px; background-color: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-image text-muted"></i>
                                  </div>
                                @endif
                              </td>
                              <td>
                                <p class="c-o-light">{{ $tetherWork->text ?? 'N/A' }}</p>
                              </td>
                              <td>
                                <p class="c-o-light">{{ $tetherWork->button_text ?? 'N/A' }}</p>
                              </td>
                              <td>
                                @if($tetherWork->windows_link)
                                  <a href="{{ $tetherWork->windows_link }}" target="_blank" class="text-primary">{{ \Illuminate\Support\Str::limit($tetherWork->windows_link, 30, '...') }}</a>
                                @else
                                  <p class="c-o-light">N/A</p>
                                @endif
                              </td>
                              <td>
                                @if($tetherWork->apple_link)
                                  <a href="{{ $tetherWork->apple_link }}" target="_blank" class="text-primary">{{ \Illuminate\Support\Str::limit($tetherWork->apple_link, 30, '...') }}</a>
                                @else
                                  <p class="c-o-light">N/A</p>
                                @endif
                              </td>
                              <td>
                                @if($tetherWork->android_link)
                                  <a href="{{ $tetherWork->android_link }}" target="_blank" class="text-primary">{{ \Illuminate\Support\Str::limit($tetherWork->android_link, 30, '...') }}</a>
                                @else
                                  <p class="c-o-light">N/A</p>
                                @endif
                              </td>

                              <td>
                          <div class="product-action">

  <a class="square-white" href="{{ route('admin.tether-work.edit', $tetherWork->id) }}">
    <svg>
      <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
    </svg>
  </a>


  <form action="{{ route('admin.tether-work.destroy', $tetherWork->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tether work?');" style="display:inline;">
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
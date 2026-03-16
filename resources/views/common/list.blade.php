@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
<style>

.room-card .card-body {
    padding-top: 2.2rem !important;
}
.room-card .badge {
    font-size: 0.82em;
    font-weight: 500;
    letter-spacing: 0.01em;
    padding: 0.35em 1em;
}
.room-card .card-title {
    font-size: 1.05rem;
    font-weight: 600;
}
</style>
@endsection

@section('content')
     

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Rooms</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item"> Jobs</li>
                    <li class="breadcrumb-item active">Rooms</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12"> 
                <div class="card p-3">
                  <div class="common-space project-tabs">
                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                    
                    </ul><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createRoom"><i class="fa-solid fa-plus"></i> Add Room</button>
                  </div>
                </div>
              </div>


<div class="modal fade" id="createRoom" tabindex="-1" role="dialog" aria-labelledby="createRoom" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-md" role="document">
   <div class="modal-content">
     <div class="modal-body"> 
         <div class="card">
                  <div class="card-header">
                    <h5>Create Room </h5>
                    
                  </div>
                  <div class="card-body">
                    <div class="card-wrapper border rounded-3">
                      <form class="row g-3 floating-wrapper" method="POST" action="{{ route('room.create') }}" enctype="multipart/form-data">
    @csrf
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input class="form-control"  type="text" placeholder="" name="title" required>
                            <label for="roomTitle">Title <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control"  type="text" placeholder="" name="subject">
                            <label for="roomSubject">Subject (Optional)</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control"  type="text" placeholder="" name="section">
                            <label for="roomSection">Section (Optional)</label>
                          </div>
                        </div>


                        <div class="col-12">
                          <div class="form-floating">
                            <textarea class="form-control" name="description"  type="text" placeholder=""></textarea>
                                
                            <label for="roomDescription">Description (Optional)</label>
                          </div>
                        </div>


                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" name="profile_image"  type="file" placeholder="">
                            <label for="roomProfile">Profile (Optional)</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" name="cover_image" type="file" placeholder="">
                            <label for="roomCover">Cover (Optional)</label>
                          </div>
                        </div>

                        <div class="col-12">
                          <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
     </div>
   </div>
 </div>
</div>

          <!-- Container-fluid starts-->
          <div class="container-fluid main-companies">
            <div class="row">
              
              
<div class="row">
    @if($rooms->count() > 0)
@foreach($rooms as $room)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm room-card overflow-hidden position-relative" style="min-height:240px;">
            <!-- Cover Image -->
            <div class="room-cover position-relative" style="height: 80px; background: #f0f2f5; background-size: cover; background-position: center; {{ $room->cover_image ? "background-image: url('".asset('storage/'.$room->cover_image)."');" : '' }}">
                <!-- Active/Inactive Badge -->
                <span class="badge position-absolute top-0 start-0 m-2 rounded-pill {{ true ? 'bg-info text-white' : 'bg-secondary text-white' }}" style="z-index:2;">
                    <i class="fa-solid fa-circle me-1"></i>Active
                </span>
                <!-- Profile Picture -->
                <div class="position-absolute start-50 translate-middle-x" style="bottom: -28px;">
                    @if($room->profile_image)
                        <img src="{{ asset('storage/' . $room->profile_image) }}" class="rounded-circle border border-2 border-white shadow" style="width:56px; height:56px; object-fit:cover;" alt="Profile">
                    @else
                        <div class="rounded-circle bg-white border border-2 border-white shadow d-flex align-items-center justify-content-center" style="width:56px; height:56px;">
                            <i class="fa-solid fa-user-graduate text-primary fa-lg"></i>
                        </div>
                    @endif
                </div>
                <!-- Action Dropdown -->
                <div class="position-absolute top-0 end-0 p-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-circle opacity-75 hover-opacity-100" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash-can me-2"></i>Delete</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-copy me-2"></i>Copy Code</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 text-center" style="padding-bottom: 0.5rem;">
                <a href="" style="color: black"><h6 class="card-title mb-1 fw-semibold text-truncate" title="{{ $room->title }}">{{ $room->title }}</h6></a>
                @if($room->section)
                    <div class="text-muted small mb-1 text-truncate" title="Section">{{ $room->section }}</div>
                @endif
                @if($room->subject)
                    <div class="text-primary small mb-2 text-truncate"  title="{{ $room->subject }}">
                        <i class="fa-solid fa-layer-group me-1"></i>{{ $room->subject }}
                    </div>
                @endif
                {{-- @if($room->description)
                    <div class="text-muted small mb-1 text-truncate" title="{{ $room->description }}">{{ Str::limit($room->description, 40) }}</div>
                @endif --}}
            </div>
            <div class="card-footer bg-transparent py-2">
                <div class="d-flex justify-content-between align-items-center small text-secondary">
                    <span title="Students"><i class="fa-solid fa-users me-1"></i>32</span>
                    <span title="Room ID"><i class="fa-solid fa-id-badge me-1"></i>{{ $room->room_id }}</span>
                </div>
                {{-- <small class="text-muted d-flex align-items-center justify-content-center mt-1">
                    <i class="fa-regular fa-clock me-1"></i>
                    {{ $room->created_at->diffForHumans() }}
                </small> --}}
            </div>
        </div>
    </div>
@endforeach


    @else
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fa-solid fa-info-circle me-2"></i>
                No rooms available. Click "Add Room" to create your first room.
            </div>
        </div>
    @endif
</div>
                {{-- </div> --}}
            </div>
          </div>
          <!-- Container-fluid Ends-->
        

     @endsection

@section('script')
@endsection
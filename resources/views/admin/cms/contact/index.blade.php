@extends('layouts.app.master')

@section('title', 'Contact Management')

@section('css')
@endsection

@section('content')

     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Contact Management</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Contact</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Update Contact Section</h5>
                  </div>
                  <div class="card-body add-post">
                    <form class="row g-3" method="POST" action="{{ route('admin.contact.update') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="debug_log" value="1">
                      
                      <!-- Contact Section -->
                      <div class="col-sm-12">
                        <h3>Contact Section</h3>
                        <div class="mb-3 mt-3">
                          <label for="contact_heading">Heading:</label>
                          <input class="form-control" id="contact_heading" name="contact_heading" type="text" value="{{ old('contact_heading', $contact->contact_heading ?? '') }}" placeholder="Contact Heading">
                        </div>
                        <div class="mb-3 mt-3">
                          <label for="contact_subheading">Subheading:</label>
                          <input class="form-control" id="contact_subheading" name="contact_subheading" type="text" value="{{ old('contact_subheading', $contact->contact_subheading ?? '') }}" placeholder="Contact Subheading">
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3 mt-3">
                              <label for="contact_email">Email:</label>
                              <input class="form-control" id="contact_email" name="contact_email" type="email" value="{{ old('contact_email', $contact->contact_email ?? '') }}" placeholder="Contact Email">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3 mt-3">
                              <label for="contact_call">Call:</label>
                              <input class="form-control" id="contact_call" name="contact_call" type="text" value="{{ old('contact_call', $contact->contact_call ?? '') }}" placeholder="Contact Call">
                            </div>
                          </div>
                        </div>
                        <div class="mb-3 mt-3">
                          <label for="contact_visit">Visit:</label>
                          <input class="form-control" id="contact_visit" name="contact_visit" type="text" value="{{ old('contact_visit', $contact->contact_visit ?? '') }}" placeholder="Contact Visit">
                        </div>
                        <div class="mb-3 mt-3">
                          <label for="contact_map_heading">Map Heading:</label>
                          <input class="form-control" id="contact_map_heading" name="contact_map_heading" type="text" value="{{ old('contact_map_heading', $contact->contact_map_heading ?? '') }}" placeholder="Map Heading">
                        </div>
                        <div class="mb-3 mt-3">
                          <label for="contact_map_link">Map Link:</label>
                          <input class="form-control" id="contact_map_link" name="contact_map_link" type="text" value="{{ old('contact_map_link', $contact->contact_map_link ?? '') }}" placeholder="Map Link">
                        </div>
                      </div>

                      <div class="common-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Update Contact Section</button>
                        <input class="btn btn-secondary" type="reset" value="Discard">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Any additional JavaScript for contact management can be added here
  });
</script>
@endsection 
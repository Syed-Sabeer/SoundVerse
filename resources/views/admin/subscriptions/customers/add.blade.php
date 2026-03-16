@extends('layouts.app.master')

@section('title', 'Add Subscription Plan')

@section('css')
@endsection

@section('content')

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Add Subscription Plan</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Subscriptions</li>
                    <li class="breadcrumb-item active">Add Subscription Plan</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Subscription Plan Form</h5>
                  </div>
                  <div class="card-body">
                    <div class="row g-xl-5 g-3">
                      <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                        <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                          <li class="nav-item"> <a class="nav-link active" id="detail-product-tab" data-bs-toggle="pill" href="#detail-product" role="tab" aria-controls="detail-product" aria-selected="false">
                              <div class="nav-rounded">
                                <div class="product-icons">
                                  <svg class="stroke-icon">
                                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#product-detail')}}"></use>
                                  </svg>
                                </div>
                              </div>
                              <div class="product-tab-content">
                                <h6>Add Subscription Details</h6>
                                <p>Add subscription plan details</p>
                              </div></a></li>

                        </ul>
                      </div>
                      <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                        <div class="tab-content custom-input" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                              <form class="row g-3 common-form" method="POST" action="{{ route('admin.subscription.store') }}">
                                @csrf
                                
                                <div class="col-md-6">
                                  <label class="form-label" for="title">Plan Title</label>
                                  <input class="form-control" name="title" id="title" type="text" placeholder="e.g., Premium Plan" value="{{ old('title') }}" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="price">Price</label>
                                  <input class="form-control" name="price" id="price" type="text" placeholder="e.g., 9.99" value="{{ old('price') }}" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="duration">Duration</label>
                                  <input class="form-control" name="duration" id="duration" type="text" placeholder="e.g., Monthly, Yearly" value="{{ old('duration') }}" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="duration_months">Duration (Months)</label>
                                  <input class="form-control" name="duration_months" id="duration_months" type="number" placeholder="e.g., 1 for monthly, 12 for yearly" value="{{ old('duration_months') }}" min="1" required>
                                </div>

                                <div class="col-12">
                                  <h6 class="mb-3">Plan Features</h6>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_unlimitedstreaming" id="is_unlimitedstreaming" value="1" {{ old('is_unlimitedstreaming') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_unlimitedstreaming">
                                      Unlimited Streaming
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_ads" id="is_ads" value="1" {{ old('is_ads') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_ads">
                                      No Ads
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_offline" id="is_offline" value="1" {{ old('is_offline') ? 'checked' : '' }} onchange="toggleOfflineFields()">
                                    <label class="form-check-label" for="is_offline">
                                      Offline Downloads
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6" id="offline_download_limit_field" style="display: {{ old('is_offline') ? 'block' : 'none' }};">
                                  <label class="form-label" for="offline_download_limit">Offline Download Limit</label>
                                  <input class="form-control" name="offline_download_limit" id="offline_download_limit" type="number" placeholder="e.g., 100 (leave blank for unlimited)" value="{{ old('offline_download_limit') }}" min="0">
                                  <small class="form-text text-muted">Leave blank for unlimited downloads</small>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_highquality" id="is_highquality" value="1" {{ old('is_highquality') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_highquality">
                                      High Quality Audio
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_unlimitedplaylist" id="is_unlimitedplaylist" value="1" {{ old('is_unlimitedplaylist') ? 'checked' : '' }} onchange="togglePlaylistFields()">
                                    <label class="form-check-label" for="is_unlimitedplaylist">
                                      Unlimited Playlists
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6" id="playlist_limit_field" style="display: {{ !old('is_unlimitedplaylist') ? 'block' : 'none' }};">
                                  <label class="form-label" for="playlist_limit">Playlist Limit</label>
                                  <input class="form-control" name="playlist_limit" id="playlist_limit" type="number" placeholder="e.g., 3" value="{{ old('playlist_limit') }}" min="0">
                                  <small class="form-text text-muted">Only applicable if unlimited playlists is unchecked</small>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_exclusivecontent" id="is_exclusivecontent" value="1" {{ old('is_exclusivecontent') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_exclusivecontent">
                                      Exclusive Content
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_prioritysupport" id="is_prioritysupport" value="1" {{ old('is_prioritysupport') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_prioritysupport">
                                      Priority Support
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_family" id="is_family" value="1" {{ old('is_family') ? 'checked' : '' }} onchange="toggleFamilyFields()">
                                    <label class="form-check-label" for="is_family">
                                      Family Plan
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6" id="family_limit_field" style="display: none;">
                                  <label class="form-label" for="family_limit">Family Member Limit</label>
                                  <input class="form-control" name="family_limit" id="family_limit" type="number" placeholder="e.g., 5" value="{{ old('family_limit') }}" min="1">
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_parentalcontrol" id="is_parentalcontrol" value="1" {{ old('is_parentalcontrol') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_parentalcontrol">
                                      Parental Control
                                    </label>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <hr>
                                  <h6 class="mb-3">Premium Features (Super Listener)</h6>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_tip_artists" id="is_tip_artists" value="1" {{ old('is_tip_artists') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_tip_artists">
                                      Tip Artists Directly
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_personalized_recommendations" id="is_personalized_recommendations" value="1" {{ old('is_personalized_recommendations') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_personalized_recommendations">
                                      Personalized Weekly Recommendations
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_supporter_badge" id="is_supporter_badge" value="1" {{ old('is_supporter_badge') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_supporter_badge">
                                      Supporter Badge on Profile
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_trending_access" id="is_trending_access" value="1" {{ old('is_trending_access', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_trending_access">
                                      Access to Trending & Featured Creators
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <button class="btn btn-primary f-w-500" type="submit">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
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
function toggleFamilyFields() {
    const isFamilyChecked = document.getElementById('is_family').checked;
    const familyLimitField = document.getElementById('family_limit_field');
    
    if (isFamilyChecked) {
        familyLimitField.style.display = 'block';
    } else {
        familyLimitField.style.display = 'none';
        document.getElementById('family_limit').value = '';
    }
}

function toggleOfflineFields() {
    const isOfflineChecked = document.getElementById('is_offline').checked;
    const offlineLimitField = document.getElementById('offline_download_limit_field');
    
    if (isOfflineChecked) {
        offlineLimitField.style.display = 'block';
    } else {
        offlineLimitField.style.display = 'none';
        document.getElementById('offline_download_limit').value = '';
    }
}

function togglePlaylistFields() {
    const isUnlimitedPlaylist = document.getElementById('is_unlimitedplaylist').checked;
    const playlistLimitField = document.getElementById('playlist_limit_field');
    
    if (isUnlimitedPlaylist) {
        playlistLimitField.style.display = 'none';
        document.getElementById('playlist_limit').value = '';
    } else {
        playlistLimitField.style.display = 'block';
    }
}

// Check on page load if fields need to be shown
document.addEventListener('DOMContentLoaded', function() {
    toggleFamilyFields();
    toggleOfflineFields();
    togglePlaylistFields();
});
</script>
@endsection

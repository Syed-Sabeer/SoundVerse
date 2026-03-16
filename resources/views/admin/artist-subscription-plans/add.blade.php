@extends('layouts.app.master')

@section('title', 'Add Artist Subscription Plan')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Add Artist Subscription Plan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Add Artist Subscription Plan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Artist Subscription Plan Form</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 common-form" method="POST" action="{{ route('admin.artist-subscription-plans.store') }}">
                            @csrf
                            
                            <div class="col-md-6">
                                <label class="form-label" for="plan_name">Plan Name *</label>
                                <input class="form-control" name="plan_name" id="plan_name" type="text" placeholder="e.g., Pro Artist" value="{{ old('plan_name') }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="monthly_fee">Monthly Fee (GBP) *</label>
                                <input class="form-control" name="monthly_fee" id="monthly_fee" type="number" step="0.01" min="0" placeholder="e.g., 9.99" value="{{ old('monthly_fee') }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="currency">Currency *</label>
                                <select class="form-control" name="currency" id="currency" required>
                                    <option value="GBP" {{ old('currency', 'GBP') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="ideal_for">Ideal For</label>
                                <input class="form-control" name="ideal_for" id="ideal_for" type="text" placeholder="e.g., Semi-professional creators seeking more exposure" value="{{ old('ideal_for') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="sort_order">Sort Order</label>
                                <input class="form-control" name="sort_order" id="sort_order" type="number" min="0" value="{{ old('sort_order', 0) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Plan description">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="mb-3">Upload Limits</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_unlimited_uploads" id="is_unlimited_uploads" value="1" {{ old('is_unlimited_uploads') ? 'checked' : '' }} onchange="toggleUploadLimits()">
                                    <label class="form-check-label" for="is_unlimited_uploads">
                                        Unlimited Uploads
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6" id="songs_per_month_field">
                                <label class="form-label" for="songs_per_month">Songs Per Month</label>
                                <input class="form-control" name="songs_per_month" id="songs_per_month" type="number" min="0" placeholder="e.g., 3" value="{{ old('songs_per_month') }}">
                                <small class="form-text text-muted">Leave blank or 0 for unlimited. Only applicable if unlimited uploads is unchecked.</small>
                            </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="mb-3">Basic Features</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_priority_search" id="is_priority_search" value="1" {{ old('is_priority_search') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_priority_search">
                                        Priority Placement in Search Results
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_custom_banner" id="is_custom_banner" value="1" {{ old('is_custom_banner') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_custom_banner">
                                        Custom Banner/Profile Cover
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_isrc_codes" id="is_isrc_codes" value="1" {{ old('is_isrc_codes') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_isrc_codes">
                                        ISRC Codes Assigned
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_early_access_insights" id="is_early_access_insights" value="1" {{ old('is_early_access_insights') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_early_access_insights">
                                        Early Access to Platform Insights
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured_rotation" id="is_featured_rotation" value="1" {{ old('is_featured_rotation') ? 'checked' : '' }} onchange="toggleFeaturedRotation()">
                                    <label class="form-check-label" for="is_featured_rotation">
                                        Featured on Front Page Rotation
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6" id="featured_rotation_weeks_field" style="display: none;">
                                <label class="form-label" for="featured_rotation_weeks">Featured Rotation Weeks Per Month</label>
                                <input class="form-control" name="featured_rotation_weeks" id="featured_rotation_weeks" type="number" min="0" max="4" placeholder="e.g., 1" value="{{ old('featured_rotation_weeks') }}">
                            </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="mb-3">Premium Features (Certified Creator)</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_certified_badge" id="is_certified_badge" value="1" {{ old('is_certified_badge') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_certified_badge">
                                        "Certified Creator" Badge
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_showcase_placement" id="is_showcase_placement" value="1" {{ old('is_showcase_placement') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_showcase_placement">
                                        Placement in Certified Creators Showcase
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_royalty_tracking" id="is_royalty_tracking" value="1" {{ old('is_royalty_tracking') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_royalty_tracking">
                                        Official Royalty Tracking with ISRC Integration
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_playlist_highlighted" id="is_playlist_highlighted" value="1" {{ old('is_playlist_highlighted') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_playlist_highlighted">
                                        Highlighted Inclusion in Curated Playlists
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_advanced_analytics" id="is_advanced_analytics" value="1" {{ old('is_advanced_analytics') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_advanced_analytics">
                                        Advanced Analytics (Listener Demographics, Regional Data)
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_showcase_invitations" id="is_showcase_invitations" value="1" {{ old('is_showcase_invitations') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_showcase_invitations">
                                        Invitations to Online Showcases & Collaborations
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="mb-3">Status</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Plan
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary f-w-500" type="submit">Submit</button>
                                <a href="{{ route('admin.artist-subscription-plans.index') }}" class="btn btn-secondary f-w-500">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function toggleUploadLimits() {
    const isUnlimited = document.getElementById('is_unlimited_uploads').checked;
    const songsPerMonthField = document.getElementById('songs_per_month_field');
    
    if (isUnlimited) {
        songsPerMonthField.style.display = 'none';
        document.getElementById('songs_per_month').value = '';
    } else {
        songsPerMonthField.style.display = 'block';
    }
}

function toggleFeaturedRotation() {
    const isFeatured = document.getElementById('is_featured_rotation').checked;
    const featuredWeeksField = document.getElementById('featured_rotation_weeks_field');
    
    if (isFeatured) {
        featuredWeeksField.style.display = 'block';
    } else {
        featuredWeeksField.style.display = 'none';
        document.getElementById('featured_rotation_weeks').value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleUploadLimits();
    toggleFeaturedRotation();
});
</script>
@endsection

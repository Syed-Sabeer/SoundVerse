@extends('layouts.frontend.master')

@section('content')
    @include('frontend.artist.auth-artist-portal')
@endsection

@section('script')
    {{-- Scripts are included in auth-artist-portal.blade.php --}}
@endsection

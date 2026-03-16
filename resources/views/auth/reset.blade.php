@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')

<div class="container">
    <h2>Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirm New Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Reset Password</button>
    </form>
</div>
@endsection

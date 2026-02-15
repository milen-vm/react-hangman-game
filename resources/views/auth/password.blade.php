@extends('auth.auth')

@section('auth')
<form method="POST" action="{{ route('auth.updatePassword') }}" class="col-md-4 mt-4">
    <div class="mb-3">
        <label for="password" class="form-label">Current Password</label>
        <input type="password"
               class="form-control @error('current_password')is-invalid @enderror"
               id="password"
               name="current_password">
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password"
               class="form-control @error('new_password')is-invalid @enderror"
               id="password"
               name="new_password">
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">New Password confirmation</label>
        <input type="password"
               class="form-control @error('new_password_confirmation')is-invalid @enderror"
               id="password_confirmation"
               name="new_password_confirmation">
        @error('password_confirmation')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
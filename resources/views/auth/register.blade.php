@extends('auth.auth')

@section('auth')
<form method="POST" action="{{ route('auth.register') }}" class="col-md-4 mt-4">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="text"
               class="form-control @error('email')is-invalid @enderror"
               id="email" 
               name="email" 
               value="{{ old('email') }}" 
               aria-describedby="emailHelp">
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    <div class="mb-3">
        <label for="name" class="form-label">User name</label>
        <input type="text"
               class="form-control @error('name')is-invalid @enderror"
               id="name" 
               name="name" 
               value="{{ old('name') }}" 
               aria-describedby="emailHelp">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password"
               class="form-control @error('password')is-invalid @enderror"
               id="password"
               name="password">
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password confirmation</label>
        <input type="password"
               class="form-control @error('password_confirmation')is-invalid @enderror"
               id="password_confirmation"
               name="password_confirmation">
        @error('password_confirmation')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
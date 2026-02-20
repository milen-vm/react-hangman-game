@extends('auth.auth')

@section('auth')
<form method="POST" action="{{ route('auth.login') }}" class="col-md-4 mt-4">
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
    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
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
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
        <a class="float-end" href="{{ route('auth.register') }}" title="Go to register form.">Register</a>
    </div>
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
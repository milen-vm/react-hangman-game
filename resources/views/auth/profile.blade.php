@extends('auth.auth')

@section('auth')

<div class="col-md-4 mt-4">
{{ dd($status) }}
    @if (isset($status))
        <div class="alert alert-success" role="alert">
            {{ $status }}
        </div>
    @endif
    <form method="POST" action="{{ route('auth.updateProfile') }}" >
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="text"
                class="form-control @error('email')is-invalid @enderror"
                id="email" 
                name="email" 
                value="{{ $user->email }}" 
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
                value="{{ $user->name }}" 
                aria-describedby="emailHelp">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>    
        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
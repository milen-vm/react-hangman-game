@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto">
            <h1 class="mt-5 text-center">Create Gallery</h1>
            <form class="mt-3" method="POST" action="{{ route('gallery.store') }}">
                @csrf()
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Site gallery</label>
                    <select class="form-select" name="site">
                        <option>--</option>
                        <option value="vipr" {{ old('site') === 'vipr' ? 'selected' : '' }}>Vipr</option>
                        <option value="imx" {{ old('site') === 'imx' ? 'selected' : '' }}>Imx</option>
                    </select>
                    @error('site')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="galleryUrl" class="form-label">Url address</label>
                    <input type="text" name="galleryUrl" value="{{ old('galleryUrl') }}" class="form-control" id="galleryUrl" aria-describedby="Web addres of the gallery">
                    <div id="galeryUrlHelp" class="form-text">Web addres of the gallery.</div>
                    @error('galleryUrl')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Gallery base name</label>
                    <input type="text" name="baseName" value="{{ old('baseName') }}" class="form-control" id="">
                    @error('baseName')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input name="isHtml" value="on" class="form-check-input" type="checkbox" id="isHtml">
                        <label class="form-check-label" for="isHtml">
                            Is Html
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea name="html" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('html') }}</textarea>
                    @error('html')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

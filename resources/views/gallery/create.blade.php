@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto">
            <h1 class="mt-5 text-center">Create Gallery</h1>
            <form class="mt-3" method="POST" action="{{ route('gallery.store') }}">
                @csrf()
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Gallery name</label>
                    <input type="text" name="baseName" value="{{ old('baseName') }}" class="form-control" id="">
                    @error('baseName')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Site gallery</label>
                    <select class="form-select" name="site">
                        <option>--</option>
                        <option value="vipr" {{ old('site') === 'vipr' ? 'selected' : '' }}>Vipr</option>
                        <option value="imx" {{ old('site') === 'imx' ? 'selected' : 'selected' }}>Imx</option>
                    </select>
                    @error('site')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input name="isHtml" value="on" class="form-check-input" type="checkbox" id="isHtml" {{ old('isHtml') === 'on' ? 'checked' : 'checked' }}>
                        <label class="form-check-label" for="isHtml">
                            Is Html
                        </label>
                    </div>
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
                    <label for="galleryHtml" class="form-label">Html area</label>
                    <textarea name="html" class="form-control" id="galleryHtml" rows="3">{{ old('html') }}</textarea>
                    @error('html')
                        <div id="galleryHtmlError" class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let isHtmlBox = $('#isHtml'),
            htmlError = $('#galleryHtmlError');

        function toggleFields(isChecked) {
            let galleryUrl = $('#galleryUrl'),
                galleryHtml = $('#galleryHtml');

            if (isChecked) {
                galleryUrl
                    .parent()
                        .hide()
                    .end()
                    .val('');

                galleryHtml
                    .parent()
                        .show();
            } else {
                galleryUrl
                    .parent()
                        .show();

                galleryHtml
                    .parent()
                        .hide()
                    .end()
                    .val('');
            }
        }

        isHtmlBox.on('change', function () {
            toggleFields(isHtmlBox.is(':checked'));
        });

        toggleFields(isHtmlBox.is(':checked'));

        if (htmlError) {
            htmlError.show();
        }
    });
</script>
@endsection

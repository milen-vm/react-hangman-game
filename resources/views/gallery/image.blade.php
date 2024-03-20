@extends('layout')

@section('content')
<div class="text-center position-relative image-container">
    <img class="img-fluid " src="{{ route('gallery.show.image', ['gallery' => $galleryId, 'index' => $index]) }}" alt="Gallery image"/>
    <div class="position-fixed top-50 translate-middle left-btn{{ $index === 0 ? ' d-none' : '' }}">
        <button type="button" class="btn btn-primary-outline">
		    <i class="bi bi-caret-left"></i>
		</button>
    </div>
    <div class="position-fixed top-50 translate-middle right-btn">
        <button type="button" class="btn btn-primary-outline">
		    <i class="bi bi-caret-right"></i>
		</button>
    </div>
</div>
@endsection
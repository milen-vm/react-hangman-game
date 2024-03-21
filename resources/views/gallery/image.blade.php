@extends('layout')

@section('content')
<div class="text-center position-relative image-container">
    <img class="img-fluid " src="{{ route('gallery.show.image', ['gallery' => $gallery->id, 'index' => $index]) }}" alt="Gallery image"/>

    @if($index > 0)
        <div class="position-fixed top-50 left-btn">
            <a href="{{ route('gallery.show', ['gallery' => $gallery->id, 'index' => $index - 1]) }}" class="btn btn-primary-outline">
                <i class="bi bi-caret-left"></i>
            </a>
        </div>
    @endif

    @if(($index + 1) < $gallery->count)
        <div class="position-fixed top-50 right-btn">
            <a href="{{ route('gallery.show', ['gallery' => $gallery->id, 'index' => $index +  1]) }}" class="btn btn-primary-outline">
                <i class="bi bi-caret-right"></i>
            </a>
        </div>
    @endif

    <div class="position-fixed top-95 left-btn">
        <a href="{{ route('gallery.show', ['gallery' => $gallery->id, 'index' => 0]) }}" class="btn btn-primary-outline">
            <i>{{ $gallery->name . ' - ' . ($index + 1) . '/' . $gallery->count }}</i>
        </a>
    </div>
</div>
@endsection
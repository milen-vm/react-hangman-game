<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryDownloadRequest;
use Illuminate\Http\Request;

class GalleryDownloadController extends Controller
{
    public function create()
    {
        return view('gallery.create');
    }

    public function store(GalleryDownloadRequest $request)
    {
        $gallery = $request->only('site', 'galleryUrl', 'baseName', 'isHtml', 'html');
        dd($gallery);
        return redirect()->back();
    }
}

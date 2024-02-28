<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryDownloadRequest;
use App\Http\Services\Contracts\GalleryServiceInterface;
use Illuminate\Support\Facades\Request;
use DtataTables;

class GalleryController extends Controller
{
    public function index(Request $request, GalleryServiceInterface $galeryService)
    {
        $galleries = $galeryService->getGalleriesList();
        return view('gallery.index');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function list(Request $request, GalleryServiceInterface $galeryService)
    {
        $galleries = $galeryService->getGalleriesList();

        return DtataTables::of($galleries)
                ->addIndexColumn()
                ->make(true);
    }

    public function store(GalleryDownloadRequest $request, GalleryServiceInterface $galeryService)
    {
        $gallery = $request->only('site', 'galleryUrl', 'baseName', 'html');

        $galeryService->download(
            str_ireplace(' ', '-', trim($gallery['baseName'])),
            $gallery['site'],
            data_get($gallery, 'galleryUrl'),
            data_get($gallery, 'html')
        );

        return redirect()->back();
    }
}

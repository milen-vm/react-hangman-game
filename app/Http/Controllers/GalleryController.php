<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryDownloadRequest;
use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Models\Gallery;
use DtataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Number;

class GalleryController extends Controller
{
    protected GalleryServiceInterface $galleryService;

    public function __construct(GalleryServiceInterface $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index(Request $request)
    {
        return view('gallery.index');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function list(Request $request)
    {
        $query = $this->galleryService->getGalleriesQuery();

        return DtataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('size', function ($row) {
                    return Number::fileSize($row->size);
                })
                ->editColumn('name', function ($row) {
                    return '<a href="' . route('gallery.show', ['gallery' => $row->id]) . '">' . $row->name . '</a>';
                })
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => $row->created_at->format('d M Y'),
                        'timestamp' => $row->created_at->timestamp,
                    ];
                })
                ->filterColumn('created_at', function($query, $search) {
                    $sql = "DATE_FORMAT(created_at, '%d %b %Y') like ?";
                    $query->whereRaw($sql, ["%{$search}%"]);
                })
                ->rawColumns(['name'])
                ->removeColumn('abs_path')
                ->removeColumn('updated_at')
                ->make(true);
    }

    public function store(GalleryDownloadRequest $request)
    {
        $gallery = $request->only('site', 'galleryUrl', 'baseName', 'html');

        $this->galleryService->download(
            str_ireplace(' ', '-', trim($gallery['baseName'])),
            $gallery['site'],
            data_get($gallery, 'galleryUrl'),
            data_get($gallery, 'html')
        );

        // TODO store record in db

        return redirect()->back();
    }

    public function show(Gallery $gallery, int $index = 0)
    {
        return view('gallery.image', [
            'galleryId' => $gallery,
            'index'=> $index,
        ]);
    }

    public function showImage(Gallery $gallery, int $index)
    {
        try {
            $fileInfo = $this->galleryService->getFileInfo($gallery, $index);
        } catch(\Exception $e) {
            abort(404);
        }

        $file = $this->galleryService->getFile($fileInfo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $fileInfo->getExtension());

        return $response;
    }
}

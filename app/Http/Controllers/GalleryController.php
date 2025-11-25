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
                    return '<a href="' . route('gallery.show', ['gallery' => $row->id,]) . '">' . $row->name . '</a>';
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
                ->addColumn('actions', function ($row) {
                    // return 5;
                    return '<a href="' . $row->id . '" title="Remove gallery">Delete</a>';
                })
                ->rawColumns(['name', 'actions'])
                ->removeColumn('abs_path')
                ->removeColumn('updated_at')
                ->make(true);
    }

    public function store(GalleryDownloadRequest $request)
    {
        $gallery = $request->only('site', 'galleryUrl', 'baseName', 'html');
        $name = trim($gallery['baseName']);
            // php artisan queue:work
            // php artisan queue:restart
            // php artisan queue:listen
        $this->galleryService->download(
            $name,
            $gallery['site'],
            data_get($gallery, 'galleryUrl') ?? data_get($gallery, 'html')
        );

        return redirect()->back();
    }

    public function show(Gallery $gallery, int $index = 0)
    {
        return view('gallery.image', [
            'gallery' => $gallery,
            'index'=> $index,
        ]);
    }

    public function showImage(Gallery $gallery, int $index)
    {
        try {
            $fileData = $this->galleryService->getFileData($gallery, $index);
        } catch(\Exception $e) {
            abort(404);
        }

        $file = $this->galleryService->getFile($fileData['path']);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $fileData['ext']);

        return $response;
    }

    public function deleteGallery(Gallery $gallery)
    {
        // TODO delete gallery from db and all images.
    }

    public function deleteImage($id)
    {
        // TODO delete image from gallery.
    }
}

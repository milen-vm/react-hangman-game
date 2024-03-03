<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryDownloadRequest;
use App\Http\Services\Contracts\GalleryServiceInterface;
use DtataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class GalleryController extends Controller
{
    public function index(Request $request, GalleryServiceInterface $galeryService)
    {
        return view('gallery.index');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function list(Request $request, GalleryServiceInterface $galeryService)
    {
        $query = $galeryService->getGalleriesQuery();

        return DtataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('size', function ($row) {
                    return Number::fileSize($row->size);
                })
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => $row->created_at->format('d M Y'),
                        'timestamp' => $row->created_at->timestamp,
                    ];
                })
                // ->order(function ($galleries) use ($request) {
                //     $order  = $request->get('order', []);
                //     $sortBy = [];

                //     foreach($order as $item) {
                //         $sortBy[] = [$item['name'], $item['dir']];
                //     }

                //     $coll = $galleries->collection;
                //     $galleries->collection = $coll->sortBy($sortBy);
                // })
                // ->filter(function (CollectionDataTable $galleries) use ($request) {
                //     dd($request->all());
                //     $search = $request->get('search', []);
                //     if (!isset($search['value'])) {
                //         return;
                //     }

                //     $coll = $galleries->original;
                //     $val = $search['value'];
                //     $galleries->original = $coll->filter(function (Gallery $item, $key) use ($val) {

                //         return $item->filterByProps($val);
                //     });
                // })
                // TODO cusom search for modified at column
                // ->addColumn('action', function ($row){
                //     $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->removeColumn('abs_path')
                ->removeColumn('updated_at')
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

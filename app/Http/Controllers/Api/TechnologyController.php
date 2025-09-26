<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TechnologyResource;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TechnologyResource::collection(Technology::all());
    }
    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return new TechnologyResource($technology);
    }
}

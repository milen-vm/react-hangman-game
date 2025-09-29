<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExperienceResource::collection(Experience::with('technologies')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        return new ExperienceResource($experience);
    }
}

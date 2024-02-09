<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Section;

class SectionController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $data = SectionResource::collection($sections);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        if(!empty($section)){
            $data = new SectionResource($section);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChildCategoryRequest;
use App\Http\Resources\ChildCategoryResource;

class ChildCategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childCategories = ChildCategory::all();
        return $this->customeResponse(ChildCategoryResource::collection($childCategories), 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChildCategoryRequest $request)
    {
        $Validation = $request->validated();
        $childCategory = ChildCategory::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
        ]);
        return $this->customeResponse(new ChildCategoryResource($childCategory), 'ChildCategory Created Successfuly', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(ChildCategory $childCategory)
    {
        if ($childCategory) {
            return $this->customeResponse(new ChildCategoryResource($childCategory), 'Done', 200);
        }
        return $this->customeResponse(null, 'ChildCategory not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryRequest $request, ChildCategory $childCategory)
    {
        if ($childCategory) {
            $childCategory->update([
                'name'        => $request->name,
                'category_id' => $request->category_id,
            ]);
            return $this->customeResponse(new ChildCategoryResource($childCategory), 'ChildCategory updated Successfuly', 200);
        }
        return $this->customeResponse(null, 'ChildCategory not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {
        if ($childCategory) {
            $childCategory->delete();
            return $this->customeResponse("", 'Done', 200);
        }
        return $this->customeResponse(null, 'ChildCategory not found', 404);
    }
}

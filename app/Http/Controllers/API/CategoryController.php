<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return $this->customeResponse(CategoryResource::collection($categories), 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $Validation = $request->validated();
        $category = Category::create([
            'name' => $request->name,
        ]);
        return $this->customeResponse(new CategoryResource($category), 'Category Created Successfuly', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if ($category) {
            return $this->customeResponse(new CategoryResource($category), 'Done', 200);
        }
        return $this->customeResponse(null, 'category not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($category) {
            $category->update([
                'name' => $request->name,
            ]);
            return $this->customeResponse(new CategoryResource($category), 'Category updated successfully', 200);
        }
        return $this->customeResponse(null, 'category not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category) {
            $category->delete();
            return $this->customeResponse("", 'Category deleted successfully', 200);
        }
        return $this->customeResponse(null, 'category not found', 404);

    }
}

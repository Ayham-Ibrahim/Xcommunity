<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\ArticleGroup;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\ArticleGroupRequest;
use App\Http\Resources\ArticleGroupResource;

class ArticleGroupController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = ArticleGroup::all();
        $data = ArticleGroupResource::collection($groups);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleGroupRequest $request)
    {
        $path = $this->UploadPhoto($request, 'article_groups', 'image', 'images');

        $article_group = ArticleGroup::create([
            'name' => $request->name,
            'group_ingo' => $request->group_ingo,
            'child_category_id' => $request->child_category_id,
            'image' => $path,
        ]);
        $data = new ArticleGroupResource($article_group);
        return $this->customeRespone($data, "Article Group Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleGroup $article_group)
    {
        if(!empty($article_group)){
            $user = Auth::user();
            $article_group->visit($user);
            $data = new ArticleGroupResource($article_group);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleGroupRequest $request, ArticleGroup $article_group)
    {
        if (!empty($request->image)) {

            $path = $this->UploadPhoto($request, 'article_groups', 'image', 'images');
        } else {
            $path = $article_group->image;
        }

        $article_group->update([
            'name' => $request->name,
            'group_ingo' => $request->group_ingo,
            'image' => $path,
        ]);

        $data = new ArticleGroupResource($article_group);


        return $this->customeRespone($data, "Article Group Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleGroup $article_group)
    {
        if (!empty($article_group)) {
            $article_group->delete();
            return $this->customeRespone(null , "Article Group deleted successfully" , 200);
        }

        return $this->customeRespone(null, "not found", 404);
    }

    public function intersteArticleGroups()
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $child_category_ids = ChildCategory::where('category_id', $user_interest_ids)->pluck('id')->toArray();
        $interest_article_groups = ArticleGroup::where('child_category_id', $child_category_ids)->get();
        $data = ArticleGroupResource::collection($interest_article_groups);

        return $this->customeResponse($data, 'Done!', 200);
    }

    public function followGroup(ArticleGroup $article_group){
        if ($article_group) {
            $user = Auth::user();
            $activity = activity()->causedBy($user)->log("You have followed a group of articles about  $article_group->name .");
            $article_group->followToggle($user);
        }
        return $this->customeRespone(null, "ArticleGroup not found", 404);
    }
}

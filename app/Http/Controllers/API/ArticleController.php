<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Article;
use App\Models\UserList;
use App\Models\ArticleGroup;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\UserListArchive;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ArticleResource;
use App\Http\Traits\UserListArchiveTrait;

class ArticleController extends Controller
{
    use ApiResponseTrait, UploadFileTrait, UserListArchiveTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        $data = ArticleResource::collection($articles);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $path = $this->UploadPhoto($request, 'articles', 'image', 'images');
        $article_group = ArticleGroup::find($request->article_group_id);
        $child_category_id = $article_group->childCategory()->id;

        $article = Article::create([
            'title'             => $request->title,
            'body'              => $request->body,
            'time_to_read'      => $request->time_to_read,
            'image'             => $path,
            'child_category_id' => $child_category_id,
            'article_group_id'  => $article_group->id,
            'section_id'        => 3
        ]);

        $data = new ArticleResource($article);

        return $this->customeResponse($data, "Article Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if (!empty($article)) {
            $user = Auth::user();
            $article->visit($user);
            $data = new ArticleResource($article);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if (!empty($request->image)) {

            $path = $this->UploadPhoto($request, 'articles', 'image', 'images');
        } else {
            $path = $article->image;
        }

        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'time_to_read' => $request->time_to_read,
            'image' => $path,
        ]);

        $data = new ArticleResource($article);


        return $this->customeResponse($data, "Article Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (!empty($article)) {
            $article->delete();
            return $this->customeResponse(null, "Article deleted successfully", 200);
        }

        return $this->customeResponse(null, "not found", 404);
    }

    public function intersteArticles()
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $child_category_ids = ChildCategory::where('category_id', $user_interest_ids)->pluck('id')->toArray();
        $interest_articles = Article::where('child_category_id', $child_category_ids)->get();
        $data = ArticleResource::collection($interest_articles);

        return $this->customeResponse($data, 'Done!', 200);
    }


    public function toggleLike(Article $article)
    {
        if ($article) {
            $user = Auth::user();
            return $article->toggleLike($user);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    public function saveToList(UserList $userList, Article $article)
    {
        if ($article) {
            if ($userList) {

                $user = Auth::user();

                if ($user->id == $userList->user_id) {
                    return $article->saveToList($userList);
                }

                return response()->json(['message' => 'You Do Not Have Authority To Do This'],403);

            }
            return $this->customeResponse(null, "userlist  not found", 404);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    public function savetoArchive(Article $article)
    {
        if (!empty($article)) {
            $user = Auth::user();
            return $article->saveToArchive($user);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}

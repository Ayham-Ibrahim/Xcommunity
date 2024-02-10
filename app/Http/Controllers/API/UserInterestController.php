<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInterestRequest;
use App\Http\Resources\UserInterestResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInterestController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_intersts = UserInterest::where('user_id' , $user->id)->get();
        $data = UserInterestResource::collection($user_intersts);

        return $this->customeResponse($data, 'Done!' , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createOrUpdate(UserInterestRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if ($request->has('category_ids')) {
            $user->categories()->detach();
            $user->categories()->attach($request->input('category_ids'));
        }

        $user_intersts = UserInterest::where('user_id' , $user->id)->get();
        $data = UserInterestResource::collection($user_intersts);
        return $this->customeResponse($data, 'Interests Added Successfully' , 201);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertismaentRequest;
use App\Http\Resources\AdvertismaentResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Advertismaent;
use App\Models\Article;
use App\Models\UserInterest;
use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertismaentController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertismaents = Advertismaent::all();
        $data = AdvertismaentResource::collection($advertismaents);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertismaentRequest $request)
    {
        $path = $this->UploadPhoto($request, 'advertismaents', 'image', 'images');

        $advertismaent = Article::create([
            'title' => $request->title,
            'discription' => $request->discription,
            'trainning_topics' => $request->trainning_topics,
            'details' => $request->details,
            'cost' => $request->cost,
            'trainning_outcomes' => $request->trainning_outcomes,
            'reservation' => $request->reservation,
            'image' => $path,
            'section_id' => 6
        ]);

        $data = new AdvertismaentResource($advertismaent);

        return $this->customeResponse($data, "Advertismaent Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertismaent $advertismaent)
    {
        if (!empty($advertismaent)) {
            $data = new AdvertismaentResource($advertismaent);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertismaentRequest $request, Advertismaent $advertismaent)
    {
        if (!empty($request->image)) {

            $path = $this->UploadPhoto($request, 'advertismaents', 'image', 'images');
        } else {
            $path = $advertismaent->image;
        }

        $advertismaent->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'trainning_topics' => $request->trainning_topics,
            'details' => $request->details,
            'cost' => $request->cost,
            'trainning_outcomes' => $request->trainning_outcomes,
            'reservation' => $request->reservation,
            'image' => $path
        ]);

        $data = new AdvertismaentResource($advertismaent);


        return $this->customeResponse($data, "Advertismaent Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertismaent $advertismaent)
    {
        if (!empty($advertismaent)) {
            $advertismaent->delete();
            return $this->customeResponse(null, "Advertismaent deleted successfully", 200);
        }

        return $this->customeResponse(null, "not found", 404);
    }

    public function savetoArchive(Advertismaent $Advertismaent)
    {
        if (!empty($Advertismaent)) {
            $user = Auth::user();
            return $Advertismaent->saveToArchive($user);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    public function saveToList(UserList $userList, Advertismaent $Advertismaent)
    {
        if ($Advertismaent) {

            if ($userList) {

                $user = Auth::user();

                if ($user->id == $userList->user_id) {
                    return $Advertismaent->saveToList($userList);
                }

                return response()->json(['message' => 'You Do Not Have Authority To Do This'], 403);
            }
            return $this->customeResponse(null, "userlist  not found", 404);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}

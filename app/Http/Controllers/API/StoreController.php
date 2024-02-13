<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Store;
use App\Models\UserList;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StoreResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\DownloadFileTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use ApiResponseTrait, UploadFileTrait ,DownloadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $stores = Store::where('type', $type)->get();
        $data = StoreResource::collection($stores);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $image_path = $this->UploadPhoto($request, 'Stores', 'image', 'images');
        $file_path = $this->UploadPhoto($request, 'Stores', 'file', 'files');

        $store = Store::create([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
            'type'        => $request->type,
            'category_id' => $request->category_id,
            'section_id'  => 4
        ]);

        $data = new StoreResource($store);

        return $this->customeResponse($data, $store->type ." Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        if(!empty($store)){
            $user = Auth::user();
            $store->visit($user);
            $data = new StoreResource($store);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        if (!empty($store->image)) {
            $image_path = $this->UploadPhoto($request, 'stores', 'image', 'images');
        } else {
            $image_path = $store->image;
        }

        if (!empty($store->file)) {
            $file_path = $this->UploadPhoto($request, 'stores', 'file', 'files');
        } else {
            $file_path = $store->file;
        }

        $store->update([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
        ]);

        $data = new StoreResource($store);


        return $this->customeResponse($data, $store->type ." Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        if (!empty($store)) {
            $store->delete();
            return $this->customeResponse(null , $store->type ." deleted Successfully" , 200);
        }

        return $this->customeResponse(null, "not found", 404);
    }

    public function intersteStores($type)
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $interest_stores = Store::where('category_id', $user_interest_ids)->where('type', $type)->get();
        $data = StoreResource::collection($interest_stores);

        return $this->customeResponse($data, 'Done!', 200);
    }

    public function download(Store $store)
    {
        if (!empty($store)) {
            $user_id = Auth::user()->id;
            $user = User::where('id',$user_id)->first();
            $activity = activity()->causedBy($user)->log('You have downloaded a '. $store->type . ' about '. $store->title);
            $store->downloadFile($user,$store->file);
            $path = storage_path('app\public\\'.$store->file);
            return response()->download($path);
        }else{
            return $this->customeResponse(null,'not found',404);
        }
    }

    public function storetRating (RatingRequest $request , Store $store)
    {
        if(!empty($store)){
            $user = Auth::user();
            $rate = $request->rate;
            $store->rateOnce($rate);
            $data = new StoreResource($store);
            $activity = activity()->causedBy($user)->log('You have rated a '. $store->type .' about'. $store->title);
            return $this->customeResponse($data, 'Done!', 200);
        }
        return $this->customeResponse(null,'not found',404);
    }

    public function saveToList(UserList $userList, Store $store)
    {
        if ($store) {
            if ($userList) {
                $user = Auth::user();
                if ($user->id == $userList->user_id) {
                    return $store->saveToList($userList);
                }
                return response()->json(['message' => 'You Do Not Have Authority To Do This'],403);
            }
            return $this->customeResponse(null, "userlist  not found", 404);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    public function savetoArchive(Store $store)
    {
        if (!empty($store)) {
            $user = Auth::user();
            return $store->saveToArchive($user);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}

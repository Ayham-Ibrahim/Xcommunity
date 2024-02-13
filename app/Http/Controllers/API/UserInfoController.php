<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfoRequest;
use App\Http\Resources\UserInfoResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_infos = UserInfo::all();
        $data = UserInfoResource::collection($user_infos);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInfoRequest $request)
    {
        $user_id = Auth::user()->id;
        $image_path = $this->UploadFile($request, 'images/UserInfos', 'photo', 'public');

        $user_info = UserInfo::create([
            'user_id'            =>$user_id,
            'phone_number'       => $request->phone_number,
            'phone_number_priv'  => $request->phone_number_priv,
            'photo'              => $image_path,
            'facebook'           => $request->facebook,
            'facebook_priv'      => $request->facebook_priv,
            'linkedin'           => $request->linkedin,
            'linkedin_priv'      => $request->linkedin_priv,
            'email_priv'         => $request->email_priv,
            'gender'             => $request->gender,
            'birth_date'         => $request->birth_date,
            'birth_date_priv'    => $request->birth_date_priv,
            'job'                => $request->job,
            'job_priv'           => $request->job_priv,
            'education'          => $request->education,
            'education_priv'     => $request->education_priv,
            'location'           => $request->location,
            'location_priv'      => $request->location_priv
        ]);

        $data = new UserInfoResource($user_info);

        return $this->customeResponse($data, "User Info Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInfo $user_info)
    {
        if(!empty($user_info)){
            $data = new UserInfoResource($user_info);
            return $this->customeResponse($data, "Done!", 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserInfoRequest $request, UserInfo $user_info)
    {
        if (!empty($user_info->photo)) {
            $image_path = $this->UploadFile($request, 'images/UserInfos', 'photo', 'public');
        } else {
            $image_path = $user_info->photo;
        }

        $user_info->update([
            'phone_number'       => $request->phone_number,
            'phone_number_priv'  => $request->phone_number_priv,
            'photo'              => $image_path,
            'facebook'           => $request->facebook,
            'facebook_priv'      => $request->facebook_priv,
            'linkedin'           => $request->linkedin,
            'linkedin_priv'      => $request->linkedin_priv,
            'email_priv'         => $request->email_priv,
            'gender'             => $request->gender,
            'birth_date'         => $request->birth_date,
            'birth_date_priv'    => $request->birth_date_priv,
            'job'                => $request->job,
            'job_priv'           => $request->job_priv,
            'education'          => $request->education,
            'education_priv'     => $request->education_priv,
            'location'           => $request->location,
            'location_priv'      => $request->location_priv
        ]);

        $data = new UserInfoResource($user_info);


        return $this->customeResponse($data, "User Info Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInfo $user_info)
    {
        if (!empty($user_info)) {
            $user_id = Auth::user()->id;
            if ($user_id === $user_info->user_id) {
                $user_info->delete();
                return $this->customeResponse(null , "User Info deleted Successfully" , 200);
            } else {
                return $this->customeResponse(null, 'You can only delete your own userList.', 403);
            }
        }
        return $this->customeResponse(null, "not found", 404);
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Models\UserList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserListRequest;
use App\Http\Resources\UserListResource;


class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLists = UserList::all();
        return $this->customeResponse(UserListResource::collection($userLists), 'Done!', 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserListRequest $request)
    {
        $Validation = $request->validated();
        $user_id = Auth::user()->id;
        $userList = UserList::create([
            'user_id'  => $user_id,
            'name'     => $request->name,
        ]);
        return $this->customeResponse(new UserListResource($userList), "userList Created Successfuly", 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(UserList $userList)
    {
        if ($userList) {
            return $this->customeResponse(new UserListResource($userList), 'Done', 200);
        }
        return $this->customeResponse(null, 'userList not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,UserList $userList)
    {
        if ($userList) {

            $user_id = Auth::user()->id;
            if ($user_id !== $userList->user_id) {
                return $this->customeResponse(null, 'You can only edit your own userList.', 403);
            } else {
                $Validation = $request->validated();
                $userList = UserList::create([
                    'user_id'  => $user_id,
                    'name'     => $request->name,
                ]);
                return $this->customeResponse(new UserListResource($userList), 'updated successfully', 200);
            }
        }
        return $this->customeResponse(null, 'userList not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserList $userList)
    {
        if ($userList) {
            return $this->customeResponse("", 'deleted successfully', 200);
        }
        return $this->customeResponse(null, 'userList not found', 404);
    }
}

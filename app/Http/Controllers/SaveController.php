<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserList;
use Illuminate\Http\Request;
use App\Models\UserListArchive;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\UserListArchiveRequest;
use App\Http\Resources\ArchiveResource;
use App\Http\Resources\UserListArchiveResource;
use App\Models\Archive;

class SaveController extends Controller
{
    use ApiResponseTrait;

    public function showUserListItem(UserList $userList)
    {

        $user_id = Auth::user()->id;
        if ($userList->user_id == $user_id) {
            $user_list_archives = UserListArchive::where('user_list_id', $userList->id)->all();
        } else {
            return $this->customeResponse(null, 'you can only show your list', 404);
        }
        return $this->customeResponse(UserListArchiveResource::collection($user_list_archives), 'done', 200);
    }


    // show saved item depend on section or item type
    public function showUserArchiveItem()
    {
        $user_id = Auth::user()->id;
        $user_archives = Archive::where('user_id', $user_id)->get();
        return $this->customeResponse(ArchiveResource::collection($user_archives), 'done', 200);
    }
}

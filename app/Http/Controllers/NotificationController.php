<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    public function index(){

        $notifications = Notification::latest()->get();
        return $this->customeResponse(NotificationResource::collection($notifications), "Done", 200);
    }

}





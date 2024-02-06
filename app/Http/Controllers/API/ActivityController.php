<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Traits\ApiResponseTrait;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    use ApiResponseTrait;

    public function yourActivity()
    {
        $user = Auth::user();
        $activity = Activity::where('causer', $user)->get();
        $data = ActivityResource::collection($activity);
        return $this->customeResponse($data, 'Done!', 200);
    }
}

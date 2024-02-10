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
        $activity = Activity::where('causer_id', $user->id)->get();
        $data = ActivityResource::collection($activity);
        return $this->customeResponse($data, 'Done!', 200);
    }

    public function destroyActivity(Activity $activity)
    {
        if(!empty($activity)){

        $user_id = Auth::user()->id;
        $user_activity_id = $activity->causer_id;

        if ($user_id == $user_activity_id) {
            $activity->delete();
            return $this->customeResponse(null, "Activity deleted successfully", 200);
        }
            return response()->json(['message' => 'You Do Not Have Authority To Do This'],403);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}

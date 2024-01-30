<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(StoreUserRequest $request){

        $user = $request->validated();

        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        // create code
        $code = sprintf("%06d", mt_rand(1, 999999));
        // prepare message
        $data['code'] = $code;
        $data['email'] = $user->email;
        $data['title'] = "Email verification";
        $data['body']  = "Welcom To X-community";
        // send mail to user
        Mail::send('email_interface',['data'=>$data],function($message) use ($data){
            $message->to($data['email'])->subject($data['title']);
        });

        //save the code for user to compare
        $user->remember_token = $code;
        $user->save();
        return $this->customeResponse(null,'Mail send successfuly',200);

    }


    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->apiResponse(new UserResource($user),$token,'successfully login,welcome!',200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


    public function emailVerification($code){
        $user = User::where('remember_token',$code)->first();
        if ($user) {
            $user->remember_token = null;
            $user->is_verified = 1;
            $user->email_verified_at = now();
            $token = $user->createToken('authToken')->plainTextToken;
            $user->save();
        }else{
            return $this->customeResponse(null,'not found',404);
        }
        return $this->apiResponse(new UserResource($user),$token,'verified Email and registered successfully',200);
    }

}


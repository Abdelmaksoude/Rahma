<?php

namespace Modules\AuthUser\app\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Explore;
use App\Models\UserKids;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use App\Models\ProfileHeaderValue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Home\app\Models\FilterUser;
use Modules\AuthUser\app\Transformers\ExploreResource;
use Modules\AuthUser\app\Http\Requests\StoreUserRequest;
use Modules\AuthUser\app\Transformers\ProfileHeaderValueResource;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => "Fail",
                'data' => [],
                'message' => "Invalid Email Or Password"
            ]);
        }
        $user_info = $user;
        $token = $user->createToken($user->name);
        return response()->json([
            'status' => "Success",
            'token' => $token->plainTextToken,
            'message' => "Login Successfully"
        ]);
    }

    public function registerMainInfo(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $have_kids = $request->have_kids ? $request->have_kids : 0;
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'height' => $request->height,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'gender' => $request->gender_person,
                'phone' => $request->phone,
                'marital_status' => $request->marital_status,
                'have_kids' => $have_kids,
                'birthday' => $request->birthday,
                'city_id' => $request->city,
            ]);
            $filter_user = FilterUser::create([
                'user_id' => $user->id,
                'less_height' => $request->height - 10,
                'high_height' => $request->height + 10,
                'marital_status' => $request->marital_status,
                'have_kids' => $have_kids,
                'less_age' => 20,
                'high_age' => 30,
                'city_id' => $request->city,
            ]);
            $token = $user->createToken($user->name);
            DB::commit();
            return response()->json([
                'status' => "Success",
                'token' => $token->plainTextToken,
                'message' => "Register Successfully"
            ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json($exception->getMessage());
        }
    }

    public function registerPhoto(Request $request)
    {
        $auth = $request->user();
        $user = User::findorFail($auth->id);
        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $image) {
                $imageName = $image->store('users');
                UserPhoto::create([
                    'user_id' => $user->id,
                    'image' => $imageName,
                ]);
            }
        }
        return response()->json([
            'status' => "Success",
            'code' => 200,
            'message' => "Images Added Successfully",
            'data' => [],
        ]);
    }

    public function registerKids(Request $request)
    {
        $auth = $request->user();
        $user = User::findorFail($auth->id);
        if($request->gender){
            foreach ($request->gender as $key => $gender) {
                UserKids::create([
                    'user_id' => $user->id,
                    'gender' => $gender,
                    'age' => $request->age[$key],
                ]);
            }
        }
        return response()->json([
            'status' => "Success",
            'code' => 200,
            'message' => "Kids Added Successfully",
            'data' => [],
        ]);
    }

    public function registerUserProfile(Request $request)
    {
        $auth = $request->user();
        $user = User::findorFail($auth->id);
        $user->profileHeaderValues()->attach($request->profile_header_value_id);
        return response()->json([
            'status' => "Success",
            'code' => 200,
            'message' => "Profile Header Value Added Successfully",
            'data' => [],
        ]);
    }

    public function ListProfileHeaderValue(Request $request)
    {
        $profile_header_value = ProfileHeaderValue::where('profile_header_id',$request->profile_header)->get();
        return response()->json([
            'status' => "Success",
            'code' => 200,
            'message' => "List Of The Profile Header Value Returned Successfully",
            'data' => ProfileHeaderValueResource::collection($profile_header_value),
        ]);
    }

    public function ListExplore()
    {
        $explores = Explore::all();
        return ExploreResource::collection($explores);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'status' => "Success",
            'data' => [],
            'message' => "Logout Successfully"
        ]);
    }
}

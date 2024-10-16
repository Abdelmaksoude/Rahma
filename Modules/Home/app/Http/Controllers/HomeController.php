<?php

namespace Modules\Home\app\Http\Controllers;

use App\Models\User;
use App\Models\UserExplore;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Home\app\Models\FilterUser;
use Modules\Home\app\Transformers\UserResource;
use Modules\Home\app\Transformers\UserExploreResource;

class HomeController extends Controller
{
    public function homeInformation(Request $request)
    {
        $user = $request->user();
        $filter_user = FilterUser::where('user_id',$user->id)->first();
        $user_profile_value_id = $user->profileHeaderValues()->pluck('user_profiles.profile_header_value_id');
        $user_explores_not_passed_for_this_user = UserExplore::where('from_id',$user->id)->where('explore_id','!=',4)->pluck('to_id')->toArray();
        $user_explores_passed_for_this_user = UserExplore::where('from_id',$user->id)->where('explore_id',4)->pluck('to_id')->toArray();
        $user_explores = UserExplore::where('from_id',$user->id)->pluck('to_id')->toArray();
        $minDate = now()->subYears($filter_user->less_age)->format('Y-m-d');
        $maxDate = now()->subYears($filter_user->high_age)->format('Y-m-d');
        $candidates1 = User::with('profileHeaderValues','gallary')
        ->where('id', '!=', $user->id)
        ->where('gender','!=',$user->gender)
        ->select('*', DB::raw("
            ( 6371 * acos( cos( radians($request->lat) ) * cos( radians( lat ) )
            * cos( radians( lng ) - radians($request->lng) ) + sin( radians($request->lat) )
            * sin( radians( lat ) ) ) ) AS distance
            "))
        ->whereHas('profileHeaderValues', function ($query) use ($user_profile_value_id) {
            $query->whereIn('profile_header_value_id', $user_profile_value_id);
        })
        ->whereNotIn('id',$user_explores)
        ->whereBetween('height', [$filter_user->less_height, $filter_user->high_height])
        ->whereBetween('birthday', [$maxDate, $minDate])
        ->where([
            'marital_status' => $filter_user->marital_status,
            'have_kids' => $filter_user->have_kids,
            'city_id' => $filter_user->city_id,
        ])
        ->orderBy('distance', 'asc')
        ->limit(5)
        ->get();
        if($candidates1->count() < 5)
        {
            $candidates2 = User::with('profileHeaderValues','gallary')
            ->where('id', '!=', $user->id)
            ->where('gender','!=',$user->gender)
            ->select('*', DB::raw("
            ( 6371 * acos( cos( radians($request->lat) ) * cos( radians( lat ) )
            * cos( radians( lng ) - radians($request->lng) ) + sin( radians($request->lat) )
            * sin( radians( lat ) ) ) ) AS distance
            "))
            ->whereHas('profileHeaderValues', function ($query) use ($user_profile_value_id) {
                $query->whereIn('profile_header_value_id', $user_profile_value_id);
            })
            // ->whereIn('id',$user_explores_passed_for_this_user)
            ->whereIn('id', $user_explores_passed_for_this_user)
            ->whereBetween('height', [$filter_user->less_height, $filter_user->high_height])
            ->whereBetween('birthday', [$maxDate, $minDate])
            ->where([
                'marital_status' => $filter_user->marital_status,
                'have_kids' => $filter_user->have_kids,
                'city_id' => $filter_user->city_id,
            ])
            ->orderBy('distance', 'asc')
            ->limit(5 - $candidates1->count())
            ->get();
            $candidates = $candidates1->merge($candidates2);
            return response()->json([
                'status' => "Success",
                'data' => UserResource::collection($candidates),
                'message' => "Candidates Users Returned Successfully"
            ]);
        }
        return response()->json([
            'status' => "Success",
            'data' => UserResource::collection($candidates1),
            'message' => "Candidates Users Returned Successfully"
        ]);
    }

    public function exploreUser(Request $request)
    {
        $user = $request->user();
        $user_explore = UserExplore::create([
            'from_id' => $user->id,
            'to_id' => $request->user_to_id,
            'explore_id' => $request->explore_id,
        ]);
        return response()->json([
            'status' => "Success",
            'token' => new UserExploreResource($user_explore),
            'message' => "Explore User Added Successfully"
        ]);
    }
}

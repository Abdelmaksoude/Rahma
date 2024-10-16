<?php

namespace Modules\Home\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Home\app\Models\FilterUser;
use Modules\Home\app\Http\Requests\FilterUserRequest;
use Modules\Home\app\Transformers\FilterUserResource;

class FilterUserController extends Controller
{
    public function FilterUser(FilterUserRequest $request)
    {
        $user = $request->user();
        $filter_user = FilterUser::where('user_id',$user->id)->first();
        $filter_user->update([
            'less_height' => $request->less_height,
            'high_height' => $request->high_height,
            'marital_status' => $request->marital_status,
            'have_kids' => $request->have_kids,
            'less_age' => $request->less_age,
            'high_age' => $request->high_age,
            'city_id' => $request->city_id,
        ]);
        return response()->json([
            'status' => "Success",
            'data' => new FilterUserResource($filter_user),
            'message' => "Filter User Added Successfully"
        ]);
    }
}

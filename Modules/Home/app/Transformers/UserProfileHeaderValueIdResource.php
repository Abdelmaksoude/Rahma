<?php

namespace Modules\Home\app\Transformers;

use Illuminate\Http\Request;
use App\Models\ProfileHeaderValue;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileHeaderValueIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $profile_header_value = ProfileHeaderValue::findorFail($this->pivot->profile_header_value_id);
        return [
            'profile_header' => $profile_header_value->profileHeader->type,
            'profile_header_value' => $profile_header_value->value_name,
        ];
    }
}

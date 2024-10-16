<?php

namespace Modules\Home\app\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Home\app\Transformers\UserGallaryResource;
use Modules\Home\app\Transformers\UserProfileHeaderValueIdResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'height' => $this->height,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'city_id' => $this->city_id,
            'distance' => $this->distance,
            'gallary' => UserGallaryResource::collection($this->whenLoaded('gallary')),
            'user_profile' => UserProfileHeaderValueIdResource::collection($this->whenLoaded('profileHeaderValues')),
        ];
    }
}

<?php

namespace Modules\Home\app\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'less_height' => $this->less_height,
            'high_height' => $this->high_height,
            'marital_status' => $this->marital_status,
            'have_kids' => $this->have_kids,
            'less_age' => $this->less_age,
            'high_age' => $this->high_age,
            'city_id' => $this->city_id,
        ];
    }
}

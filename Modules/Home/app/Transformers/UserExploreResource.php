<?php

namespace Modules\Home\app\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserExploreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from_id' => $this->from_id,
            'from_name' => $this->from->name,
            'to_id' => $this->to_id,
            'to_name' => $this->to->name,
            'explore_id' => $this->explore_id,
            'explore_name' => $this->explore->name,
        ];
    }
}

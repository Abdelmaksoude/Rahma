<?php

namespace Modules\AuthUser\app\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileHeaderValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'profile_header_name' => $this->profileHeader->type,
            'value_name_en' => $this->value_name,
            'value_name_ar' => $this->value_name_ar,
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function profileHeaderValue()
    {
        return $this->belongsTo(ProfileHeaderValue::class, 'profile_header_value_id');
    }
}

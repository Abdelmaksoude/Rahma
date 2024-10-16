<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileHeaderValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_profiles')->withPivot('user_id');
    }

    public function profileHeader()
    {
        return $this->belongsTo(ProfileHeader::class, 'profile_header_id');
    }
}

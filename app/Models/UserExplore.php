<?php

namespace App\Models;

use App\Models\User;
use App\Models\Explore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserExplore extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function explore()
    {
        return $this->belongsTo(Explore::class, 'explore_id');
    }
}

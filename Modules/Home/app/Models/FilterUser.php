<?php

namespace Modules\Home\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Home\Database\Factories\FilterUserFactory;

class FilterUser extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

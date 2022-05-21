<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function income_sides()
    {
        return $this->hasMany(income_side::class, 'income_side_id', 'id');
    }

    // public function user()
    // {
    //     return $this->hasMany(User::class, 'user_id', 'id');
    // }

    // public function income_sides()
    // {
    //     return $this->belongsTo(income_side::class, 'income_side_id', 'id');
    // }
}

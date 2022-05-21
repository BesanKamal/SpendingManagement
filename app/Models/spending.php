<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spending extends Model
{
    use HasFactory;

 public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function operation_names()
    {
        return $this->hasMany(operation_name::class, 'operation_names_id', 'id');
    }

}

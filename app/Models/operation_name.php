<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operation_name extends Model
{
    use HasFactory;

    public function spending()
    {
        return $this->belongsTo(spending::class, 'operation_name_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class income_side extends Model
{
    use HasFactory;

    public function income()
    {
        return $this->belongsTo(income::class, 'income_side_id', 'id');
    }


}

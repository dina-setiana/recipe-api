<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'making_time', 'serves', 'ingredients', 'instructions', 'cost'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}

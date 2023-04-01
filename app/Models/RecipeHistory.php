<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeHistory extends Model
{
    protected $fillable = [
        'recipe_id',
        'description',
        'version',
        'operation',
    ];
}

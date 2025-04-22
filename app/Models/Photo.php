<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'category_id', 'photo', 'access', 'description'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}

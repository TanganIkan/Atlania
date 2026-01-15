<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'user_id',
        'category_id',
        'likes_count',
        'comments_count',
        'save_count',
        'is_featured',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getImageAttribute($value)
    {
        // $value adalah nilai asli dari kolom 'image' di database
        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }
        return null;
    }
}

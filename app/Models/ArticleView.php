<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $fillable = ['article_id', 'session_id', 'view_date'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor Image
    public function getImageAttribute($value)
    {
        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }
        return asset('images/default-thumbnail.jpg');
    }

    /**
     * Scope untuk statistik grafik artikel dibuat
     */
    public function scopeGetStats($query, $period)
    {
        $query = match ($period) {
            'weekly' => $query->select(
                DB::raw("YEARWEEK(created_at) as label"),
                DB::raw("COUNT(*) as total")
            ),
            'monthly' => $query->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as label"),
                DB::raw("COUNT(*) as total")
            ),
            default => $query->select(
                DB::raw("DATE(created_at) as label"),
                DB::raw("COUNT(*) as total")
            ),
        };

        return $query->groupBy('label')->orderBy('label');
    }

    public static function getPopularByPeriod($period)
    {
        $query = self::select('articles.title', DB::raw('COUNT(article_views.id) as total'))
            ->join('article_views', 'articles.id', '=', 'article_views.article_id');

        match ($period) {
            'weekly' => $query->whereBetween('article_views.view_date', [now()->startOfWeek(), now()->endOfWeek()]),
            'monthly' => $query->whereMonth('article_views.view_date', now()->month),
            default => $query->whereDate('article_views.view_date', today()),
        };

        return $query->groupBy('articles.id', 'articles.title')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
    }

    public function views()
    {
        // Ini menghubungkan Article dengan tabel article_views
        return $this->hasMany(ArticleView::class);
    }
}
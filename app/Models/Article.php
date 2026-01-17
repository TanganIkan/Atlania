<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

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

    // =======================
    // RELATIONSHIPS
    // =======================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }

    // =======================
    // ACCESSOR
    // =======================

    public function getImageAttribute($value)
    {
        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }

        return asset('images/default-thumbnail.jpg');
    }

    /**
     * Statistik artikel dibuat (daily / weekly / monthly)
     */
    public function scopeGetStats($query, $period)
    {
        if ($period === 'weekly') {
            return $query
                ->selectRaw('
                    CONCAT(
                        DATE_FORMAT(
                            DATE_SUB(created_at, INTERVAL WEEKDAY(created_at) DAY),
                            "%d"
                        ),
                        "–",
                        DATE_FORMAT(
                            DATE_ADD(created_at, INTERVAL (6 - WEEKDAY(created_at)) DAY),
                            "%d %b %Y"
                        )
                    ) as label,
                    COUNT(*) as total
                ')
                ->groupBy('label')
                ->orderByRaw('MIN(created_at)');
        }

        if ($period === 'monthly') {
            return $query
                ->selectRaw('
                    DATE_FORMAT(created_at, "%b %Y") as label,
                    COUNT(*) as total
                ')
                ->groupBy('label')
                ->orderByRaw('MIN(created_at)');
        }

        // DAILY (default)
        return $query
            ->selectRaw('
                DATE(created_at) as label,
                COUNT(*) as total
            ')
            ->groupBy('label')
            ->orderBy('label');
    }

    /**
     * Artikel populer berdasarkan periode
     */
    public static function getPopularByPeriod($period)
    {
        $query = self::select(
            'articles.title',
            DB::raw('COUNT(article_views.id) as total')
        )
            ->join('article_views', 'articles.id', '=', 'article_views.article_id');

        match ($period) {
            'weekly' => $query->whereBetween('article_views.view_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]),
            'monthly' => $query->whereMonth('article_views.view_date', now()->month),
            default => $query->whereDate('article_views.view_date', today()),
        };

        return $query
            ->groupBy('articles.id', 'articles.title')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
    }
}

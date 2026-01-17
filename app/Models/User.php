<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    
    // Statistik user terdaftar (daily / weekly / monthly)
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
}

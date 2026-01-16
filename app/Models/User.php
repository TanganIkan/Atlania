<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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

    public function scopeGetStats($query, $period)
    {
        // Masukkan match ke dalam variabel $query agar bisa di-chaining
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
}
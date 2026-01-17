<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::create([
            'title' => 'Inovasi Teknologi Terkini di Tahun 2024',
            'slug' => Str::slug('Inovasi Teknologi Terkini di Tahun 2024'),
            'content' => 'Tahun 2024 membawa berbagai inovasi teknologi yang mengubah cara kita hidup dan bekerja. Dari kecerdasan buatan hingga teknologi hijau, mari kita jelajahi beberapa tren utama yang akan mendominasi tahun ini.',
            'image' => 'articles/image1.jpg',
            'user_id' => 1,
            'category_id' => 1,
            'likes_count' => 45,
            'comments_count' => 5,
            'save_count' => 10,
        ]);

        Article::create([
            'title' => 'Tips Menjaga Kesehatan di Era Digital',
            'slug' => Str::slug('Tips Menjaga Kesehatan di Era Digital'),
            'content' => 'Di era digital saat ini, menjaga kesehatan menjadi tantangan tersendiri. Berikut adalah beberapa tips untuk tetap sehat secara fisik dan mental di tengah kesibukan teknologi.',
            'image' => 'articles/image2.jpg',
            'user_id' => 2,
            'category_id' => 2,
            'likes_count' => 60,
            'comments_count' => 10,
            'save_count' => 15,
        ]);

        Article::create([
            'title' => 'Strategi Bisnis yang Efektif di Pasar Global',
            'slug' => Str::slug('Strategi Bisnis yang Efektif di Pasar Global'),
            'content' => 'Dalam menghadapi pasar global yang kompetitif, perusahaan perlu mengadopsi strategi bisnis yang efektif. Artikel ini membahas beberapa pendekatan yang dapat membantu bisnis Anda berkembang di tingkat internasional.',
            'image' => 'articles/image3.jpg',
            'user_id' => 1,
            'category_id' => 3,
            'likes_count' => 75,
            'comments_count' => 15,
            'save_count' => 20,
        ]);

        Article::create([
            'title' => 'Gaya Hidup Sehat untuk Produktivitas Maksimal',
            'slug' => Str::slug('Gaya Hidup Sehat untuk Produktivitas Maksimal'),
            'content' => 'Gaya hidup sehat tidak hanya penting untuk kesejahteraan fisik, tetapi juga berkontribusi pada produktivitas kerja. Temukan cara-cara sederhana untuk mengintegrasikan kebiasaan sehat ke dalam rutinitas harian Anda.',
            'image' => 'articles/image4.jpg',
            'user_id' => 2,
            'category_id' => 4,
            'likes_count' => 90,
            'comments_count' => 20,
            'save_count' => 25,
        ]);

        Article::create([
            'title' => 'Evolusi Web Development: Menjelajahi Framework Modern',
            'slug' => Str::slug('Evolusi Web Development Menjelajahi Framework Modern'),
            'content' => 'Dunia pengembangan web terus berubah dengan cepat. Dari munculnya pustaka reaktif hingga framework full-stack yang menjanjikan performa luar biasa, artikel ini akan membahas mana yang terbaik untuk proyek Anda di tahun 2026.',
            'image' => 'articles/image5.jpg',
            'user_id' => 1,
            'category_id' => 1,
            'likes_count' => 105,
            'comments_count' => 25,
            'save_count' => 30,
        ]);

        // Artikel random dari factory
        Article::factory()->count(50)->create();
    }
}

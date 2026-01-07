<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user', 'category')->latest()->get();
        dump($articles);
        return view('dashboard', compact('articles'));
    }

}

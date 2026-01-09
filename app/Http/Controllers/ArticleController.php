<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $articles = Article::with('category')->latest()->get();
        } else {
            $articles = Article::where('user_id', $user->id)
                ->with('category')
                ->latest()
                ->get();
        }

        return view('/dashboard', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {

        Article::create([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'content' => request('content'),
            'category_id' => request('category_id'),
            'user_id' => auth()->id(),
        ]);

        return redirect('/dashboard')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        if (auth()->user()->role === 'admin') {
            $articles = Article::with('category')->latest()->get();
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Article $article)
    {
        $article->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'content' => request('content'),
            'category_id' => request('category_id'),
        ]);

        return redirect('/dashboard')->with('success', 'Article diperbarui');
    }

    public function destroy(Article $article)
    {
        if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();

        return redirect('/dashboard')->with('success', 'Article dihapus');
    }


}
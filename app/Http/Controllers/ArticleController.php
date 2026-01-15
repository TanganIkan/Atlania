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
        $articles = Article::with('user', 'category')
            ->latest()
            ->get();
        return view('dashboard', compact('articles'));
    }

    public function adminIndex()
    {
        $articles = Article::with('user', 'category')->latest()->get();
        return view('admin.dashboard', compact('articles'));
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


        return redirect(route('dashboard'))->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'content' => request('content'),
            'category_id' => request('category_id'),
        ]);

        return redirect(route('dashboard'))->with('success', 'Article diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();
        return redirect(route('dashboard'))->with('success', 'Article dihapus');
    }

    public function show(Article $article)
    {
        $relatedArticles = Article::where('user_id', $article->user_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
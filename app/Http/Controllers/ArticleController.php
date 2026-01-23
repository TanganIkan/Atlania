<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $popularWeekly = Article::getPopularByPeriod('weekly');

        $heroArticle = null;
        $popularArticles = collect();

        if ($popularWeekly->isNotEmpty()) {
            $id = $popularWeekly->pluck('id');

            $articlesById = Article::with('user', 'category')
                ->whereIn('id', $id)
                ->get()
                ->keyBy('id');

            $heroArticle = $articlesById->get($popularWeekly->first()->id);

            $popularArticles = $popularWeekly
                ->take(6)
                ->map(fn($item) => $articlesById->get($item->id))
                ->filter();
        }

        if (!$heroArticle) {
            $fallback = Article::with('user', 'category')
                ->withCount('views')
                ->orderByDesc('views_count')
                ->take(7)
                ->get();

            $heroArticle = $fallback->first();
            $popularArticles = $fallback->take(6);
        }

        $articles = Article::with('user', 'category')
            ->latest()
            ->get();

        return view('dashboard', compact(
            'heroArticle',
            'popularArticles',
            'articles'
        ));
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
        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')) . '-' . Str::random(5),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        Article::create($data);

        return redirect()->route('articles.my')->with('success', 'Article created successfully!');
    }

    public function edit(Article $article)
    {
        if ($article->user_id != auth()->id() && Auth::user()->role != 'admin') {
            abort(403);
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id != auth()->id() && auth()->user()->role != 'admin') {
            abort(403);
        }

        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
        ];

        if ($request->hasFile('image')) {
            $oldImage = $article->image;

            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;

            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $article->update($data);

        return redirect(route('articles.my'))->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id != auth()->id() && auth()->user()->role != 'admin') {
            abort(403);
        }

        $article->delete();
        return redirect(route('articles.my'))->with('success', 'Article deleted');
    }
    public function show(Article $article)
    {
        $relatedArticles = Article::where('user_id', $article->user_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        ArticleView::firstOrCreate([
            'article_id' => $article->id,
            'session_id' => Session::getId(),
            'view_date' => now()->toDateString(),
        ]);

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function myArticles()
    {
        $articles = Article::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->paginate(6);

        return view('articles.my-articles', compact('articles'));
    }

    public function adminArticles()
    {
        $articles = Article::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.admin-articles', compact('articles'));
    }
}
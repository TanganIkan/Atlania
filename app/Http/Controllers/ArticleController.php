<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        return redirect(route('articles.my'))->with('success', 'Article diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();
        return redirect(route('articles.my'))->with('success', 'Article dihapus');
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
            'view_date'  => now()->toDateString(),
        ]);

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function myArticles()
    {
        $articles = Article::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('articles.my-articles', compact('articles'));
    }

    public function downloadPdf($id)
    {
        $article = Article::with('user', 'category')->findOrFail($id);

        $pdf = Pdf::loadView('articles.pdf', compact('article'))
            ->setPaper('A4', 'portrait')
            ->setOption([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]);

        return $pdf->download(str_replace(' ', '-', strtolower($article->title)) . '.pdf');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalArticles = Article::count();

        $popularWeekly = Article::getPopularByPeriod('weekly');

        $heroArticle = null;
        $popularArticles = collect();

        if ($popularWeekly->isNotEmpty()) {
            $ids = $popularWeekly->pluck('id');

            $articlesById = Article::with('user', 'category')
                ->whereIn('id', $ids)
                ->get()
                ->keyBy('id');

            $heroArticle = $articlesById->get($popularWeekly->first()->id);

            $popularArticles = $popularWeekly
                ->skip(1)
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
            $popularArticles = $fallback->skip(1);
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalArticles',
            'heroArticle',
            'popularArticles'
        ));
    }

    public function chartUsers(Request $request)
    {
        $data = User::getStats($request->get('period', 'daily'))->get();
        return response()->json($data);
    }

    public function chartArticles(Request $request)
    {
        $data = Article::getStats($request->get('period', 'daily'))->get();
        return response()->json($data);
    }

    public function chartPopularArticles(Request $request)
    {
        $data = Article::getPopularByPeriod($request->get('period', 'daily'));
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleView;
use Carbon\Carbon;
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
        $popularToday = Article::getPopularByPeriod('daily')->first();

        $popularArticle = $popularToday ?: Article::withCount('views')
            ->orderBy('views_count', 'desc')
            ->first();

        return view('admin.dashboard', compact('totalUsers', 'totalArticles', 'popularArticle'));
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

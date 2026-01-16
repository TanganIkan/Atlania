<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // ================= USER REGISTER CHART =================
    public function chartUsers(Request $request)
    {
        $period = $request->get('period', 'daily');

        $data = match ($period) {
            'weekly' => User::select(
                    DB::raw("YEARWEEK(created_at) as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),

            'monthly' => User::select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),

            default => User::select(
                    DB::raw("DATE(created_at) as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),
        };

        return response()->json($data);
    }

    // ================= ARTICLE CREATED CHART =================
    public function chartArticles(Request $request)
    {
        $period = $request->get('period', 'daily');

        $data = match ($period) {
            'weekly' => Article::select(
                    DB::raw("YEARWEEK(created_at) as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),

            'monthly' => Article::select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),

            default => Article::select(
                    DB::raw("DATE(created_at) as label"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get(),
        };

        return response()->json($data);
    }

    // ================= POPULAR ARTICLES =================
    public function chartPopularArticles(Request $request)
    {
        $period = $request->get('period', 'daily');

        $query = ArticleView::select(
                'articles.title',
                DB::raw('COUNT(article_views.id) as total')
            )
            ->join('articles', 'articles.id', '=', 'article_views.article_id');

        match ($period) {
            'weekly' => $query->whereBetween('view_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]),
            'monthly' => $query->whereMonth('view_date', Carbon::now()->month),
            default => $query->whereDate('view_date', Carbon::today()),
        };

        $data = $query
            ->groupBy('articles.title')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return response()->json($data);
    }
}

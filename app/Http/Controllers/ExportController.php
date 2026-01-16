<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\ArticleView;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
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

    public function downloadExcel($type)
    {
        $title = 'Export Data';
        $data = [];
        $period = request('period', 'daily'); // default harian

        if ($type === 'users') {

            $title = 'User Terdaftar';

            $query = DB::table('users');

            if ($period === 'daily') {
                $query->selectRaw('DATE(created_at) as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            if ($period === 'weekly') {
                $query->selectRaw('YEARWEEK(created_at) as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            if ($period === 'monthly') {
                $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            $rows = $query->get();

            $data[] = ['Periode', 'Jumlah User'];
            foreach ($rows as $row) {
                $data[] = [$row->label, $row->total];
            }

        } elseif ($type === 'articles') {

            $title = 'Artikel Dibuat';

            $query = DB::table('articles');

            if ($period === 'daily') {
                $query->selectRaw('DATE(created_at) as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            if ($period === 'weekly') {
                $query->selectRaw('YEARWEEK(created_at) as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            if ($period === 'monthly') {
                $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as total')
                      ->groupBy('label')
                      ->orderBy('label');
            }

            $rows = $query->get();

            $data[] = ['Periode', 'Jumlah Artikel'];
            foreach ($rows as $row) {
                $data[] = [$row->label, $row->total];
            }

        } elseif ($type === 'popular') {

            $title = 'Artikel Populer';

            $query = DB::table('article_views')
                ->join('articles', 'article_views.article_id', '=', 'articles.id')
                ->select(
                    'articles.title',
                    DB::raw('COUNT(article_views.id) as total_views')
                );

            if ($period === 'daily') {
                $query->whereDate('article_views.view_date', now());
            }

            if ($period === 'weekly') {
                $query->whereBetween('article_views.view_date', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            }

            if ($period === 'monthly') {
                $query->whereMonth('article_views.view_date', now()->month)
                      ->whereYear('article_views.view_date', now()->year);
            }

            $rows = $query
                ->groupBy('articles.id', 'articles.title')
                ->orderByDesc('total_views')
                ->limit(10)
                ->get();

            $data[] = ['Judul Artikel', 'Total Views'];
            foreach ($rows as $row) {
                $data[] = [$row->title, $row->total_views];
            }

        } else {
            abort(404);
        }

        // =========================
        // Generate Excel
        // =========================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($title);

        $rowNum = 1;
        foreach ($data as $rowData) {
            $col = 'A';
            foreach ($rowData as $cell) {
                $sheet->setCellValue($col . $rowNum, $cell);
                $col++;
            }
            $rowNum++;
        }

        // Auto-size kolom
        foreach (range('A', 'Z') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Download response
        $fileName = $title . '.xlsx';
        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName);
    }
}

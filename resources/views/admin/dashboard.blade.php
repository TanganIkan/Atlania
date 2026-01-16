@extends('layout.admin')

@section('content')

{{-- PAGE HEADER --}}
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-[#1a1c2e] tracking-tight">
        Dashboard
    </h2>
    <p class="text-sm text-gray-400 mt-1">
        Ringkasan performa website hari ini
    </p>
</div>

{{-- SUMMARY CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-white rounded-[32px] p-6 shadow-sm">
        <p class="text-xs uppercase tracking-widest text-gray-400">Total User</p>
        <h3 class="text-3xl font-bold text-[#1a1c2e] mt-2">
            {{ \App\Models\User::count() }}
        </h3>
    </div>

    <div class="bg-white rounded-[32px] p-6 shadow-sm">
        <p class="text-xs uppercase tracking-widest text-gray-400">Total Artikel</p>
        <h3 class="text-3xl font-bold text-[#1a1c2e] mt-2">
            {{ \App\Models\Article::count() }}
        </h3>
    </div>

    @php
        $popularToday = \App\Models\ArticleView::select('article_id')
            ->whereDate('view_date', now())
            ->groupBy('article_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $popularArticle = $popularToday
            ? \App\Models\Article::find($popularToday->article_id)
            : null;
    @endphp

    <div class="bg-white rounded-[32px] p-6 shadow-sm">
        <p class="text-xs uppercase tracking-widest text-gray-400">Artikel Terpopuler Hari Ini</p>
        <h3 class="text-base font-semibold text-[#1a1c2e] mt-2 leading-snug">
            {{ $popularArticle->title ?? 'Belum ada data' }}
        </h3>
    </div>
</div>

{{-- CHART GRID --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

    {{-- ================= USER CHART ================= --}}
    <div class="bg-white rounded-[36px] p-8 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Statistik</p>
                <h3 class="text-lg font-bold text-[#1a1c2e]">User Terdaftar</h3>
            </div>
            <div class="flex gap-1">
                <button data-chart="users" data-period="daily" class="chart-btn">Harian</button>
                <button data-chart="users" data-period="weekly" class="chart-btn">Mingguan</button>
                <button data-chart="users" data-period="monthly" class="chart-btn">Bulanan</button>
            </div>
        </div>
        <div class="h-[260px]">
            <canvas id="usersChart"></canvas>
        </div>
    </div>

    {{-- ================= ARTIKEL CHART ================= --}}
    <div class="bg-white rounded-[36px] p-8 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Statistik</p>
                <h3 class="text-lg font-bold text-[#1a1c2e]">Artikel Dibuat</h3>
            </div>
            <div class="flex gap-1">
                <button data-chart="articles" data-period="daily" class="chart-btn">Harian</button>
                <button data-chart="articles" data-period="weekly" class="chart-btn">Mingguan</button>
                <button data-chart="articles" data-period="monthly" class="chart-btn">Bulanan</button>
            </div>
        </div>
        <div class="h-[260px]">
            <canvas id="articlesChart"></canvas>
        </div>
    </div>

    {{-- ================= POPULAR CHART (FULL WIDTH) ================= --}}
    <div class="bg-white rounded-[36px] p-8 shadow-sm xl:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <div>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Statistik</p>
                <h3 class="text-lg font-bold text-[#1a1c2e]">Artikel Populer</h3>
            </div>
            <div class="flex gap-1">
                <button data-chart="popular" data-period="daily" class="chart-btn">Harian</button>
                <button data-chart="popular" data-period="weekly" class="chart-btn">Mingguan</button>
                <button data-chart="popular" data-period="monthly" class="chart-btn">Bulanan</button>
            </div>
        </div>
        <div class="h-[300px]">
            <canvas id="popularChart"></canvas>
        </div>
    </div>

</div>

{{-- ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const charts = {};
    const chartButtons = document.querySelectorAll('.chart-btn');

    chartButtons.forEach(btn => {
        btn.classList.add(
            'px-3','py-1.5','rounded-full','text-xs','font-semibold',
            'border','border-gray-200',
            'hover:bg-orange-50','hover:text-[#f15a24]',
            'transition'
        );

        btn.addEventListener('click', () => {
            const chart = btn.dataset.chart;
            const period = btn.dataset.period;

            document.querySelectorAll(`[data-chart="${chart}"]`)
                .forEach(b => b.classList.remove('bg-orange-50','text-[#f15a24]'));

            btn.classList.add('bg-orange-50','text-[#f15a24]');
            loadChart(chart, period);
        });
    });

    function loadChart(type, period) {
        let url = '';
        let ctx = null;
        let label = '';
        let chartType = 'line';

        if (type === 'users') {
            url = `{{ route('admin.chart.users') }}?period=${period}`;
            ctx = document.getElementById('usersChart').getContext('2d');
            label = 'User Terdaftar';
        }

        if (type === 'articles') {
            url = `{{ route('admin.chart.articles') }}?period=${period}`;
            ctx = document.getElementById('articlesChart').getContext('2d');
            label = 'Artikel Dibuat';
        }

        if (type === 'popular') {
            url = `{{ route('admin.chart.popular') }}?period=${period}`;
            ctx = document.getElementById('popularChart').getContext('2d');
            label = 'Artikel Populer';
            chartType = 'bar';
        }

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => item.label ?? item.title);
                const totals = data.map(item => item.total);

                if (charts[type]) charts[type].destroy();

                charts[type] = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels,
                        datasets: [{
                            label,
                            data: totals,
                            borderWidth: 3,
                            tension: 0.45,
                            pointRadius: 3,
                            fill: false,
                        }]
                    },
                   options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    stepSize: 1
                                }
                            }
                        }
                    }

                });
            });
    }

    // Default load
    loadChart('users', 'daily');
    loadChart('articles', 'daily');
    loadChart('popular', 'daily');
</script>

@endsection

@extends('layout.admin')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold text-[#1a1c2e] tracking-tight">Dashboard</h2>
        <p class="text-sm text-gray-400 mt-1">Ringkasan performa website hari ini</p>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        {{-- Card Total User --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-50">
            <p class="text-xs uppercase tracking-widest text-gray-400">Total User</p>
            <h3 class="text-3xl font-bold text-[#1a1c2e] mt-2">{{ $totalUsers }}</h3>
        </div>

        {{-- Card Total Artikel --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-50">
            <p class="text-xs uppercase tracking-widest text-gray-400">Total Artikel</p>
            <h3 class="text-3xl font-bold text-[#1a1c2e] mt-2">{{ $totalArticles }}</h3>
        </div>

        {{-- Card Artikel Terpopuler --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-50">
            <p class="text-xs uppercase tracking-widest text-gray-400">Terpopuler Hari Ini</p>
            <h3 class="text-base font-semibold text-[#1a1c2e] mt-2 leading-snug">
                {{ $popularArticle->title ?? 'Belum ada data' }}
            </h3>
        </div>
    </div>

    {{-- CHART GRID --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        {{-- Menggunakan reusable component/partial untuk chart --}}
        @include('admin.partials._chart_card', ['id' => 'users', 'title' => 'User Terdaftar'])
        @include('admin.partials._chart_card', ['id' => 'articles', 'title' => 'Artikel Dibuat'])

        <div class="xl:col-span-2">
            @include('admin.partials._chart_card', ['id' => 'popular', 'title' => 'Artikel Populer'])
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('admin.partials._dashboard_scripts')

@endsection
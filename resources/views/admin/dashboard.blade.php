@extends('layout.admin')

@section('content')

    <div class="mb-8 md:mb-10 px-2 md:px-0">
        <h2 class="text-2xl md:text-3xl font-extrabold text-[#1a1c2e] tracking-tight uppercase italic">Dashboard</h2>
        <p class="text-xs md:text-sm text-gray-400 mt-1 uppercase tracking-widest font-bold">Today's website performance
            summary</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12">

        <div
            class="bg-white rounded-[24px] md:rounded-[32px] p-6 shadow-sm border border-gray-50 transition-all hover:shadow-md">
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">Total Users</p>
            <h3 class="text-3xl md:text-4xl font-black text-[#1a1c2e] mt-2 tracking-tighter">{{ $totalUsers }}</h3>
        </div>

        <div
            class="bg-white rounded-[24px] md:rounded-[32px] p-6 shadow-sm border border-gray-50 transition-all hover:shadow-md">
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">Total Articles</p>
            <h3 class="text-3xl md:text-4xl font-black text-[#1a1c2e] mt-2 tracking-tighter">{{ $totalArticles }}</h3>
        </div>

        <div
            class="sm:col-span-2 md:col-span-1 bg-[#1a1c2e] rounded-[24px] md:rounded-[32px] p-6 shadow-xl shadow-gray-200 border border-[#1a1c2e]">
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">Popular Article</p>
            <h3 class="text-sm md:text-base font-bold text-white mt-2 leading-snug line-clamp-2 italic">
                {{ $heroArticle->title ?? 'Belum ada data' }}
            </h3>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 md:gap-8">
        <div class="w-full overflow-hidden">
            @include('admin.partials._chart_card', ['id' => 'users', 'title' => 'User Registrations'])
        </div>
        <div class="w-full overflow-hidden">
            @include('admin.partials._chart_card', ['id' => 'articles', 'title' => 'Articles Created'])
        </div>
        <div class="xl:col-span-2 w-full overflow-hidden">
            @include('admin.partials._chart_card', ['id' => 'popular', 'title' => 'Popular Articles'])
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('admin.partials._dashboard_scripts')

@endsection
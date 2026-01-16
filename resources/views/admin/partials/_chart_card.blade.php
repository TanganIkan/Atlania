<div class="bg-white rounded-[36px] p-8 shadow-sm border border-gray-50">
    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Statistik</p>
            <h3 class="text-lg font-bold text-[#1a1c2e]">{{ $title }}</h3>
        </div>
        <div class="flex gap-1">
            <button data-chart="{{ $id }}" data-period="daily" class="chart-btn">Harian</button>
            <button data-chart="{{ $id }}" data-period="weekly" class="chart-btn">Mingguan</button>
            <button data-chart="{{ $id }}" data-period="monthly" class="chart-btn">Bulanan</button>
        </div>
    </div>
    <div class="h-[260px]">
        <canvas id="{{ $id }}Chart"></canvas>
    </div>
</div>
<div class="bg-white rounded-[36px] p-8 shadow-sm border border-gray-50">
    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Statistik</p>
            <h3 class="text-lg font-bold text-[#1a1c2e]">{{ $title }}</h3>
        </div>

        <div class="flex gap-1">
            <button data-chart="{{ $id }}" data-period="daily" class="chart-btn">Daily</button>
            <button data-chart="{{ $id }}" data-period="weekly" class="chart-btn">Weekly</button>
            <button data-chart="{{ $id }}" data-period="monthly" class="chart-btn">Monthly</button>
        </div>
    </div>

    <div class="h-[260px]">
        <canvas id="{{ $id }}Chart"></canvas>
    </div>

    <div class="flex justify-end mt-4">
        <a href="{{ route('admin.export.chart', ['type' => $id]) }}?period=daily" class="export-btn inline-flex items-center px-3 py-1.5 text-sm font-medium
                   text-orange-600 border border-orange-300 rounded-lg
                   hover:bg-orange-50 transition" data-chart="{{ $id }}" data-period="daily">
            Export Excel
        </a>
    </div>
</div>
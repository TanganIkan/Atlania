<div
    class="bg-white rounded-[28px] md:rounded-[36px] p-6 md:p-8 shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 font-black">Statistik</p>
            <h3 class="text-base md:text-lg font-black text-[#1a1c2e] uppercase italic tracking-tighter">{{ $title }}
            </h3>
        </div>

        <div class="flex bg-gray-50 p-1 rounded-xl w-full sm:w-auto overflow-x-auto no-scrollbar">
            <button data-chart="{{ $id }}" data-period="daily"
                class="chart-btn whitespace-nowrap flex-1 sm:flex-none px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all">Daily</button>
            <button data-chart="{{ $id }}" data-period="weekly"
                class="chart-btn whitespace-nowrap flex-1 sm:flex-none px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all">Weekly</button>
            <button data-chart="{{ $id }}" data-period="monthly"
                class="chart-btn whitespace-nowrap flex-1 sm:flex-none px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all">Monthly</button>
        </div>
    </div>

    <div class="relative h-[220px] md:h-[260px] w-full">
        <canvas id="{{ $id }}Chart"></canvas>
    </div>

    <div class="flex justify-end mt-6 pt-4 border-t border-gray-50">
        <a href="{{ route('admin.export.chart', ['type' => $id]) }}?period=daily" class="export-btn w-full sm:w-auto text-center inline-flex items-center justify-center px-5 py-2.5 text-[10px] font-black uppercase tracking-[0.2em]
                   text-orange-600 border border-orange-200 rounded-xl
                   hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all duration-300"
            data-chart="{{ $id }}" data-period="daily">
            <i class="fas fa-file-excel mr-2"></i> Export Excel
        </a>
    </div>
</div>
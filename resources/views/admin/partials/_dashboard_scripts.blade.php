<script>
    const charts = {};

    function loadChart(type, period) {
        const routes = {
            users: `{{ route('admin.chart.users') }}`,
            articles: `{{ route('admin.chart.articles') }}`,
            popular: `{{ route('admin.chart.popular') }}`
        };

        fetch(`${routes[type]}?period=${period}`)
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById(`${type}Chart`).getContext('2d');

                const labels = data.map(item => item.label ?? item.title);
                const totals = data.map(item => item.total);

                if (charts[type]) charts[type].destroy();

                charts[type] = new Chart(ctx, {
                    type: type === 'popular' ? 'bar' : 'line',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Total',
                            data: totals,
                            borderColor: '#f15a24',
                            backgroundColor: 'rgba(241, 90, 36, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            });
    }

    document.querySelectorAll('.chart-btn').forEach(btn => {

        btn.classList.add(
            'px-3',
            'py-1.5',
            'rounded-full',
            'text-xs',
            'font-semibold',
            'border',
            'border-gray-200',
            'transition'
        );

        btn.addEventListener('click', () => {
            const chart  = btn.dataset.chart;
            const period = btn.dataset.period;

            // === STYLE ACTIVE BUTTON ===
            document
                .querySelectorAll(`.chart-btn[data-chart="${chart}"]`)
                .forEach(b => b.classList.remove('bg-orange-50', 'text-[#f15a24]'));

            btn.classList.add('bg-orange-50', 'text-[#f15a24]');

            // === LOAD CHART ===
            loadChart(chart, period);

            // ==============================
            // 🔥 SYNC EXPORT BUTTON PERIOD
            // ==============================
            const exportBtn = document.querySelector(
                `.export-btn[data-chart="${chart}"]`
            );

            if (exportBtn) {
                const baseUrl = exportBtn.getAttribute('href').split('?')[0];
                exportBtn.setAttribute('href', `${baseUrl}?period=${period}`);
                exportBtn.dataset.period = period;
            }
        });
    });

    // === LOAD DEFAULT (DAILY) ===
    ['users', 'articles', 'popular'].forEach(type => {
        loadChart(type, 'daily');
    });
</script>

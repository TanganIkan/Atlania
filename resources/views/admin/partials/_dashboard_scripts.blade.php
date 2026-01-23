<script>
    const charts = {};

    // Fungsi pembantu untuk membatasi panjang teks
    const truncateText = (text, limit = 15) => {
        if (!text) return '';
        return text.length > limit ? text.substring(0, limit) + '...' : text;
    };

    function loadChart(type, period) {
        const routes = {
            users: `{{ route('admin.chart.users') }}`,
            articles: `{{ route('admin.chart.articles') }}`,
            popular: `{{ route('admin.chart.popular') }}`
        };

        fetch(`${routes[type]}?period=${period}`)
            .then(res => res.json())
            .then(data => {
                const canvas = document.getElementById(`${type}Chart`);
                if (!canvas) return;

                const ctx = canvas.getContext('2d');
                const labels = data.map(item => truncateText(item.label ?? item.title, 18));
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
                            backgroundColor: type === 'popular' ? '#f15a24' : 'rgba(241, 90, 36, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    title: (context) => {
                                        const index = context[0].dataIndex;
                                        return data[index].label ?? data[index].title;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: { size: 10 },
                                    maxRotation: 45,
                                    minRotation: 0
                                },
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    font: { size: 10 }
                                },
                                grid: { color: '#f3f4f6' }
                            }
                        }
                    }
                });
            });
    }

    document.querySelectorAll('.chart-btn').forEach(btn => {
        // Style dasar tombol
        btn.classList.add(
            'px-3', 'py-1.5', 'rounded-full', 'text-xs',
            'font-semibold', 'border', 'border-gray-200', 'transition'
        );

        btn.addEventListener('click', () => {
            const chart = btn.dataset.chart;
            const period = btn.dataset.period;

            document
                .querySelectorAll(`.chart-btn[data-chart="${chart}"]`)
                .forEach(b => b.classList.remove('bg-orange-50', 'text-[#f15a24]', 'border-orange-200'));

            btn.classList.add('bg-orange-50', 'text-[#f15a24]', 'border-orange-200');

            loadChart(chart, period);

            const exportBtn = document.querySelector(`.export-btn[data-chart="${chart}"]`);
            if (exportBtn) {
                const baseUrl = exportBtn.getAttribute('href').split('?')[0];
                exportBtn.setAttribute('href', `${baseUrl}?period=${period}`);
                exportBtn.dataset.period = period;
            }
        });
    });

    // === LOAD DEFAULT (DAILY) ===
    document.addEventListener('DOMContentLoaded', () => {
        ['users', 'articles', 'popular'].forEach(type => {
            loadChart(type, 'daily');
        });
    });
</script>
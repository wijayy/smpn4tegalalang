<div class="p-4 bg-neutral-700 rounded-2xl shadow-md">
    <h2 class="text-lg font-semibold text-white mb-2">Grafik Prestasi 6 Bulan Terakhir</h2>
    <canvas id="prestasiChart"></canvas>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('prestasiChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Jumlah Prestasi',
                data: @json($totals),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.3,
                fill: true,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                pointRadius: 5,
                pointBackgroundColor: 'white',
                pointBorderColor: 'rgb(75, 192, 192)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ccc'
                    },
                    grid: {
                        color: '#333'
                    }
                },
                x: {
                    ticks: {
                        color: '#ccc'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

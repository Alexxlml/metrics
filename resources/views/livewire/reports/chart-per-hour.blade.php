<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte por hora') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <h3 class="dark:text-gray-200 text-sm sm:text-xl md:text-2xl">{{ $total_votes }} votos de {{
                        $total_registers }} registros</h3>
                </div>
                <canvas id="perHourChart"></canvas>
            </div>
        </div>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    const ctx = document.getElementById('perHourChart');
    const votes = $wire.votes;
    const labels = votes.map(item => item.hora);
    const values = votes.map(item => item.total);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '# de Votos',
                data: values,
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#f97316' // Cambia el color de la fuente de los labels de la leyenda a azul
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#f97316'
                    }
                },
                y: {
                    ticks: {
                        color: '#f97316'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endscript
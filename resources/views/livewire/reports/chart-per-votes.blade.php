<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte por votos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <h3 class="dark:text-gray-200 text-sm sm:text-xl md:text-2xl">{{ $total_votes }} votos de {{
                        $total_registers }} registros</h3>
                </div>
                <div class="h-80 xl:h-[600px] flex justify-center p-4">
                    <canvas id="perVotesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    const ctx = document.getElementById('perVotesChart');
    const votes = $wire.votes;
    const labels = votes.map(item => item.label);
    const values = votes.map(item => item.total);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Registros',
                data: values,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#f97316' // Cambia el color de la fuente de los labels de la leyenda a azul
                    }
                }
            }
        }
    });
</script>
@endscript
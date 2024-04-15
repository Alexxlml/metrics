<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte por votos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <h3 class="dark:text-gray-200 text-sm sm:text-xl md:text-2xl">{{ $total_votes }} votos de {{
                        $total_registers }} registros</h3>
                </div>
                <div class="h-[600px] flex justify-center p-4">
                    <canvas id="perSectionsChart"></canvas>
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
    const ctx = document.getElementById('perSectionsChart');
    const votes = $wire.votes;
    const labels = votes.map(item => item.label);
    const values = votes.map(item => item.total);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Votos',
                data: values,
                backgroundColor: [
                    'rgb(54, 162, 235)',    // Azul
                    'rgb(255, 99, 132)',    // Rojo
                    'rgb(255, 140, 0)',     // Naranja
                    'rgb(65, 105, 225)',    // Azul marino
                    'rgb(128, 128, 0)',     // Verde oliva
                    'rgb(255, 20, 147)',    // Rosa claro
                    'rgb(218, 165, 32)',    // Oro
                    'rgb(128, 0, 128)',     // Púrpura oscuro
                    'rgb(0, 128, 0)',       // Verde
                    'rgb(0, 0, 128)',       // Azul oscuro
                    'rgb(255, 0, 255)',     // Magenta
                    'rgb(0, 255, 255)',     // Cyan
                    'rgb(169, 169, 169)',   // Gris oscuro
                    'rgb(75, 0, 130)',      // Índigo
                    'rgb(186, 85, 211)',    // Orquídea
                    'rgb(154, 205, 50)',    // Verde amarillento
                    'rgb(220, 20, 60)',     // Carmesí
                    'rgb(0, 191, 255)',     // Azul acero claro
                    'rgb(0, 255, 0)',       // Verde brillante
                    'rgb(139, 0, 0)',       // Rojo oscuro
                    'rgb(255, 105, 180)',   // Rosa claro
                    'rgb(255, 215, 0)',     // Amarillo oscuro
                    'rgb(250, 128, 114)',   // Salmon claro
                    'rgb(0, 0, 255)',       // Azul puro
                    'rgb(255, 165, 0)',     // Naranja oscuro
                    'rgb(255, 192, 203)',   // Rosa claro
                    'rgb(218, 112, 214)',   // Orquídea
                    'rgb(135, 206, 235)',   // Azul cielo
                    'rgb(255, 182, 193)',   // Rosa pálido
                    'rgb(173, 255, 47)',    // Verde amarillento
                    'rgb(70, 130, 180)',    // Azul acero
                    'rgb(255, 69, 0)',      // Rojo oscuro
                    'rgb(25, 25, 112)',     // Azul medianoche
                    'rgb(255, 20, 147)',    // Rosa claro
                    'rgb(128, 128, 128)',   // Gris medio
                    'rgb(0, 128, 128)'      // Verde azulado
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
<x-app-layout>
    <div class="container">
        <div class="card my-6">
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">

                    </p>
                </figure>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            Highcharts.chart('container', {
                credits:false,
                chart: {
                    type: 'column'
  },
                title: {
                    text: 'fallas por mes año en curso'
                },

                subtitle: {
                    text: 'Source: Dep. Mantenimiento y Recursos Humanos'
                },

                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad de fallas'
                    }

                },

                xAxis: {
                    categories: ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
                    crosshair: true
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart:1,
                        crosshair: true
                    }
                },

                series: [
                    {
                        name: <?php echo json_encode($fallas_mes[0]['name']); ?>,
                        data: @json($fallas_mes)
                    },
                    {
                        name: <?php echo json_encode($fallas_mes_reparadas[0]['name']); ?>,
                        data: @json($fallas_mes_reparadas),
                        color: 'green'
                    },
                    {
                        name: <?php echo json_encode($fallas_mes_activas[0]['name']); ?>,
                        data: @json($fallas_mes_activas),
                        color: 'red'
                    },


                ],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
        </script>
    @endpush

</x-app-layout>

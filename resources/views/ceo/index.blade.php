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
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Listado de gastos año en curso'
                },

                subtitle: {
                    text: 'Source: Dep. Mantenimiento y Recursos Humanos'
                },

                yAxis: {
                    title: {
                        text: 'Gasto en unidad monetaria'
                    }
                },

                xAxis: {
                    categories: ['dic', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov',
                        'dic'
                    ],
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
                        pointStart: 0
                    }
                },

                series: [{
                        name: <?php echo json_encode($repuestos_mant[0]['name']); ?>,
                        data: @json($repuestos_mant)
                    },
                    {
                        name: <?php echo json_encode($insumos_mant[0]['name']); ?>,
                        data: @json($insumos_mant)
                    },
                    {
                        name: <?php echo json_encode($servicios_mant[0]['name']); ?>,
                        data: @json($servicios_mant)
                    },
                    {
                        name: <?php echo json_encode($personal_mant[0]['name']); ?>,
                        data: @json($personal_mant)
                    },
                    {
                        name: <?php echo json_encode($total_mant[0]['name']); ?>,
                        data: @json($total_mant)
                    },

                    {
                        name: <?php echo json_encode($repuestos_falla[0]['name']); ?>,
                        data: @json($repuestos_falla)
                    },
                    {
                        name: <?php echo json_encode($insumos_falla[0]['name']); ?>,
                        data: @json($insumos_falla)
                    },
                    {
                        name: <?php echo json_encode($servicios_falla[0]['name']); ?>,
                        data: @json($servicios_falla)
                    },
                    {
                        name: <?php echo json_encode($personal_falla[0]['name']); ?>,
                        data: @json($personal_falla)
                    },
                    {
                        name: <?php echo json_encode($total_falla[0]['name']); ?>,
                        data: @json($total_falla)
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

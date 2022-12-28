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
                    text: 'gastos de personal año en curso'
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
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{series.name} </span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{point.category}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} $</b></td></tr>',
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
                        name: <?php echo json_encode($gastos_personal[0]['name']); ?>,
                        data: @json($gastos_personal)
                    },
                    {
                        name: <?php echo json_encode($fallas_mes[0]['name']); ?>,
                        data: @json($fallas_mes)
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

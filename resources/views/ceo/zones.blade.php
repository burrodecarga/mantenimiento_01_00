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
                    text: 'fallas por zonas año en curso'
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
                    categories: ['','ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
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
                        pointStart:0,
                        crosshair: true
                    }
                },

                series: [

                    {
                        name: 'fallas por zona',
                        data: @json($data),
                        color: 'blue'
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

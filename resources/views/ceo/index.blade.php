<x-app-layout>
<div class="container">
    <div class="card my-6">
        <div class="card-body">
              <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
          Basic line chart showing trends in a dataset. This chart includes the
          <code>series-label</code> module, which adds a label to each line for
          enhanced readability.
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

    title: {
      text: 'U.S Solar Employment Growth by Job Category, 2010-2020'
    },

    subtitle: {
      text: 'Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>'
    },

    yAxis: {
      title: {
        text: 'Number of Employees'
      }
    },

    xAxis: {
        categories:['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'],
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

    series:[
          {data:@json($repuestos)},
          {data:@json($insumos)},
          {data:@json($servicios)},


    ]

    ,

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

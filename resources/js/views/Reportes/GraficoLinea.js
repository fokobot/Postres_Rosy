import { Line } from 'vue-chartjs'

export default {
  name: 'GraficoLinea',
  extends: Line,
  props: {
    data: {
      type: Object,
      required: true,
    }
  },
  mounted() {
    this.renderChart(this.data, this.options)
  },
  data() {
    return {
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              callback: function (value, index, values) {
                return '$ ' + value.toLocaleString('de');
              }
            },
            gridLines: {
              display: true
            },
          }],
          xAxes: [{
            gridLines: {
              display: false
            },
            scaleLabel: {
              display: true,
              labelString: 'Fecha'
            }
          }]
        },
        legend: {
          display: false
        },
        responsive: true,
        maintainAspectRatio: false,
      }
    }
  }
}

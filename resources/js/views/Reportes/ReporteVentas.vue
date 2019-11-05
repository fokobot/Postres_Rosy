<template>
  <div class="card shadow mb-2">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Resumen de Ventas</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <grafico-linea :data="data" v-if="!loading" />
      <div class="text-center" v-else>
        <b-spinner variant="primary" label="Cargando"></b-spinner>
      </div>
    </div>
  </div>
</template>

<script>
import GraficoLinea from "./GraficoLinea.js";

export default {
  name: 'ReporteVentas',
  components: { GraficoLinea },
  created() {
    axios.get('/api/reportes/ventas/diario').then(res => {
      Vue.set(this, 'labels', res.data.map(x => x.fecha))
      Vue.set(this.datasets[0], 'data', res.data.map(x => x.total))
      Vue.set(this, 'loading', false)
    })
  }, data() {
    return {
      loading: true,
      labels: ['A', 'B'],
      datasets: [
        {
          label: 'Ventas',
          backgroundColor: '#f87979',
          data: []
        },
      ]
    }
  }, computed: {
    data() {
      return {
        labels: this.labels,
        datasets: this.datasets
      }
    }
  }
}
</script>
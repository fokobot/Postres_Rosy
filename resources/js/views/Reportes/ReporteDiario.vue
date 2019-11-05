<template>
  <div class="col-xl-12 col-lg-12">
    <b-row>
      <b-col>
        <reporte-ventas />
      </b-col>
      <b-col>
        <reporte-gastos />
      </b-col>
    </b-row>
  </div>
</template>

<script>
import ReporteVentas from "./ReporteVentas";
import ReporteGastos from "./ReporteGastos";

export default {
  name: 'ReporteDiario',
  components: { ReporteVentas, ReporteGastos }
}
</script>
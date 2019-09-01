<template>
<div class="card">
  <div class="card-header">
    Nueva Venta
  </div>
  <div class="card-body">
    <form method="POST" @submit.prevent="registrarVenta">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Tipo de Documento</label>
                <select class="form-control" v-model="tipodedocumento">
                    <option v-for="tipo in tipos_de_documento" v-bind:value="tipo.id">{{tipo.abreviatura}} - {{tipo.nombre}}</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Documento</label>
                <input type="text" class="form-control" v-model="documento">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" v-model="nombre">
            </div>
            <div class="form-group col-md-6">
                <label>Apellidos</label>
                <input type="text" class="form-control" v-model="apellidos">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Direccion</label>
                <input type="text" class="form-control" v-model="direccion">
            </div>
            <div class="form-group col-md-6">
                <label>Ciudad</label>
                <input type="text" class="form-control" v-model="ciudad">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Teléfono</label>
                <input type="text" class="form-control" v-model="telefono">
            </div>
            <div class="form-group col-md-6">
                <label>Celular</label>
                <input type="text" class="form-control" v-model="celular">
            </div>
        </div>
      <form-detalleventa></form-detalleventa>
      <div class="row">
        <div class="col-md-6">
          <button type="submit" class="btn btn-block btn-success">Registrar Compra</button>
        </div>
      </div>
    </form>
  </div>
</div>
</template>

<script>
    export default {
        name: 'FormVenta',
        mounted() {
            axios
            .get('/api/tipos_de_documento/')
            .then(response => (this.tipos_de_documento = response.data))
        },
        data: () => { return {
            tipos_de_documento: [],
            tipodedocumento: 0,
            documento: '',
            nombre: '',
            apellidos: '',
            telefono: '',
            celular: '',
            direccion: "",
            ciudad: "",
        }},
        methods: {
            registrarVenta: function(){
                // validaciones :)
                let venta = {
                    tipo_de_documento: this.tipodedocumento,
                    documento: this.documento,
                    nombre: this.nombre,
                    apellidos: this.apellidos,
                    telefono: this.telefono,
                    celular: this.celular,
                    direccion: this.direccion,
                    ciudad: this.ciudad,
                }
                axios.post('/api/ventas', venta).then(res => {
                    console.log(res)
                }).catch(err => { 
                    console.log(err)
                });
            }
        }
    }
</script>

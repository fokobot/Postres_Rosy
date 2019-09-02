<template>
    <div class="invalid-feedback" v-if="errores[campo]">
        {{errores[campo][0]}}
    </div>
</template>

<script>
    export default {
        props: ['campo','errores']
    }
</script>

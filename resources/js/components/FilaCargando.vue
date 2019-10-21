<template>
    <tbody>
			 <tr>
          <td :colspan="cols" class="text-center">
            <b-spinner variant="primary" label="Cargando"></b-spinner>
          </td>
        </tr>
		</tbody>
</template>

<script>
	export default {
		name:	'FilaCargando',
		props: {
			cols: {
				default: 1,
				type: Number
			}
		}
	}
</script>

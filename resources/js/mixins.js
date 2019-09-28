let getErrors = {
    methods: {
        hasError(campo) {
            if (!this.sent) return null;
            return this.errores[campo] ? false : true;
        },
        error(campo) {
            if (!this.errores[campo]) return;
            return this.errores[campo][0]
        }
    }
}

export default getErrors;

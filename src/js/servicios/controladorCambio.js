export class ControladorCambio {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }
    /***
     * @return valida y comprueba las contraseñas
     */
    async cambiarPwd(pwdAntigua, pwdNueva, pwdNuevaC) {

        const resultadoValidacion = this.validar(pwdAntigua, pwdNueva, pwdNuevaC);
        if (resultadoValidacion !== true) {
            this.vista.mostrarError(resultadoValidacion);
            return;
        }

        try {
            const resultado = await this.modelo.cambiarPwd(pwdAntigua, pwdNueva);

            if (resultado.exito) {
                this.vista.mostrarModal('¡Contraseña cambiada correctamente!');
            } else {
                this.vista.mostrarError('Error al cambiar la contraseña');
            }
        } catch (error) {
            console.error('Error:', error);
            this.vista.mostrarError('Error de conexión');
        }
    }
    /**
     * 
     * @param {*} pwdAntigua Esta es la contraseña que tenia antes
     * @param {*} pwdNueva Esta es la contraseña nueva
     * @param {*} pwdNuevaC Esta es la confirmacion de la Nueva contraseña
     * @returns Devuelve verdadero o falso en funcion de si los datos son validos o no
     */
    validar(pwdAntigua, pwdNueva, pwdNuevaC) {
        if (!pwdAntigua || !pwdNueva || !pwdNuevaC) {
            return 'Todos los campos son obligatorios';
        }
        if (pwdNueva !== pwdNuevaC) {
            return 'Las contraseñas nuevas no coinciden';
        }
        if (!this.contieneMayuscula(pwdNueva)) {
            return 'La contraseña debe contener al menos una mayúscula';
        }
        if (!this.contieneNumero(pwdNueva)) {
            return 'La contraseña debe contener al menos un número';
        }
        if (!this.tamanioPerfecto(pwdNueva)) {
            return 'La contraseña debe tener entre 8 y 12 caracteres';
        }
        return true;
    }
    /**
     * @param {*} pwd 
     * @returns comprueba si tiene al menos una mayúscula
     */
    contieneMayuscula(pwd) {
        return /[A-Z]/.test(pwd);
    }
    /**
     * @param {*} pwd 
     * @returns comprueba si tiene al menos un número
     */
    contieneNumero(pwd) {
        return /\d/.test(pwd);
    }
    /**
     * @param {*} pwd 
     * @returns comprueba si la contraseña tiene entre 8 y 12 caracteres
     */
    tamanioPerfecto(pwd) {
        return pwd.length >= 8 && pwd.length <= 12;
    }
}
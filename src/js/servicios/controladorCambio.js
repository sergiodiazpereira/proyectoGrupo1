export class ControladorCambio{
    constructor(modelo,vista){
        this.modelo = modelo;
        this.vista = vista;
    }
    /***
     * @return valida y comprueba las contraseñas
     */
    async cambiarPwd(pwdAntigua, pwdNueva, pwdNuevaC){
        if(this.validar(pwdAntigua, pwdNueva, pwdNuevaC)){
            contrasenia=this.modelo.traerContrasenia();
            if(await bcrypt.compare(pwdNueva, pwdAntigua)){
                this.modelo.cambiarPwd(pwdNueva);
            }
        }
    }
    validar(){
        if(pwdNueva!=pwdNuevaC){
            return false;
        }
        if(!this.contieneMayuscula(pwdNueva) && !this.contieneMayuscula(pwdNuevaC)){
            return false;
        }
        if(!this.contieneNumero(pwdNueva) && !this.contieneNumero(pwdNuevaC)){
            return false;
        }
        if(!this.tamanioPerfecto(pwdNueva) && !this.tamanioPerfecto(pwdNuevaC)){
            return false;
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
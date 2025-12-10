export class VistaCambio{
    
    constructor(controlador){
        this.controlador=controlador;
        this.formulario = document.getElementById('formCambio');

        this.formulario.addEventListener('submit', function(event) {
    
        event.preventDefault();

        const datosFormulario = new FormData(this);
        
        const pwdAntigua = datosFormulario.get('contraActual');
        const pwdNueva = datosFormulario.get('contraNueva');
        const pwdNuevaC = datosFormulario.get('contraConfir');
        
        this.controlador.cambiarPwd(pwdAntigua, pwdNueva, pwdNuevaC);
        });
    }
}
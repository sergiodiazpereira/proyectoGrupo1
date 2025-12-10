export class ModeloCambio{
    async traerContrasenia(){
        const pwdGuardada = await fetch('index.php?c=Cambio&m=traerPwd');
        return pwdGuardada;
    }
    async cambiarPwd(pwdNueva){
        const realizado= await fetch('index.php?c=Cambio$m=modificarPwd');
    }
}
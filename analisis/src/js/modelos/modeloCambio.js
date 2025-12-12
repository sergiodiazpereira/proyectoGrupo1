export class ModeloCambio {
    async cambiarPwd(pwdAntigua, pwdNueva) {
        
        const datos = new FormData();
        datos.append('contraActual', pwdAntigua);
        datos.append('contraNueva', pwdNueva);

        const respuesta = await fetch('index.php?c=Cambio&m=modificarPwd', {
            method: 'POST',
            body: datos
        });

        return respuesta.json();
    }
}
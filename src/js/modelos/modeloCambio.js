export class ModeloCambio {
    /**
     * 
     * @param {*} pwdAntigua variable que recoje la password antigua
     * @param {*} pwdNueva variable que recoje la password nueva
     * @returns devuelve mensake de confirmacion o fallo
     */
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
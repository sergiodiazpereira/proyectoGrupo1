export class ModeloRegistro {

    async registro(nombre, correo, password) {

        const datos = new FormData();
        datos.append("nombre", nombre);
        datos.append("correo", correo);
        datos.append("pwd", password);

        const respuesta = await fetch("../../controladores/conRegistro.php", {
            method: "POST",
            body: datos
        });

        return respuesta.json();
    }
}
export class ModeloRegistro {

    /**
     * Método de registro
     * @param {*} nombre 
     * @param {*} correo 
     * @param {*} password 
     * @returns Retorna un objeto JSON
     */
    async registro(nombre, correo, password) {
        // Creamos un objeto FormData para enviar los datos del formulario
        const datos = new FormData();
        // Añadimos el nombre al FormData
        datos.append("nombre", nombre);
        // Añadimos el correo al FormData
        datos.append("correo", correo);
        // Añadimos la contraseña al FormData
        datos.append("pwd", password);

        // Realizamos la petición POST al servidor para el registro
        const respuesta = await fetch("../../controladores/conRegistro.php", {
            method: "POST",
            body: datos
        });

        // Convertimos la respuesta del servidor a formato JSON y la devolvemos
        return respuesta.json();
    }
}
export class ModeloLogin {

    /**
     * Método del login
     * @param {*} correo
     * @param {*} password
     * @returns Retorna un objeto JSON
     */
    async login(correo, password) {
        // Creamos un objeto FormData para enviar los datos del formulario
        const datos = new FormData();
        // Añadimos el correo al FormData
        datos.append("correo", correo);
        // Añadimos la contraseña al FormData
        datos.append("pwd", password);

        // Realizamos la petición POST al servidor para el login
        const respuesta = await fetch("../../controladores/conLogin.php", {
            method: "POST",
            body: datos
        });

        // Convertimos la respuesta del servidor a formato JSON y la devolvemos
        return respuesta.json();
    }
}
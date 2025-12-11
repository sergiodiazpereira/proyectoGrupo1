export class ModeloLogin {

    async login(correo, password) {

        const datos = new FormData();
        datos.append("correo", correo);
        datos.append("pwd", password);

        const respuesta = await fetch("../../controladores/conLogin.php", {
            method: "POST",
            body: datos
        });

        return respuesta.json();
    }
}
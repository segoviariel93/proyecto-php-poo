function MostrarMensajeError(mensaje) {
    Swal.fire({
        
        title: 'Mensajes del sistema',
        html: mensaje,
        footer: '<p>Revisar la información en caso de error.</p>'
    });
}
function MostrarMensajeExitoso(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 5000
    });
    console.log("envio mensaje de exito:"+mensaje);
}
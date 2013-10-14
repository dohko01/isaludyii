function fnCargarDatos() {
    id = $(this).attr('id');
    alert('Sea paciente, este proceso puede tardar varios minutos, depende de la cantidad de datos a cargar desde la fuente de datos y de la velocidad de conexión a internet. '+id);
    return false;
}
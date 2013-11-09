function fnCargarDatos() {
    id = $(this).attr('id');
    alert('Sea paciente, este proceso puede tardar varios minutos, depende de la cantidad de datos a cargar desde la fuente de datos y de la velocidad de conexión a internet. ');

    $.ajax({
        url: 'cargardatos',
        type: 'POST',
        dataType: 'json',
        data: 'YII_CSRF_TOKEN='+$('#YII_CSRF_TOKEN').val()+'&id_FuenteDatos='+id,
    }).done(function(response) {
        if(response.error) {
            alert('ERROR: La carga de datos no fue exitosa, revise el mensaje de error. \n\n'+response.msjerror);
        } else {
            alert('La carga de datos fue exitosa.');
        }
    }).fail(function() {
        alert('ERROR: No se pudo realizar la carga de datos, intentelo nuevamente o notifiquelo con el administrador del sistema.')
    });

    // Evitar el comportamiento normal del link
    return false;
}

function fnRecargarDatos() {
    id = $(this).attr('id');
    alert('Sea paciente, este proceso puede tardar varios minutos, depende de la cantidad de datos a cargar desde la fuente de datos y de la velocidad de conexión a internet. ');

    $.ajax({
        url: 'recargardatos',
        type: 'POST',
        dataType: 'json',
        data: 'YII_CSRF_TOKEN='+$('#YII_CSRF_TOKEN').val()+'&id_FuenteDatos='+id,
    }).done(function(response) {
        if(response.error) {
            alert('ERROR: La carga de datos no fue exitosa, revise el mensaje de error. \n\n'+response.msjerror);
        } else {
            alert('La carga de datos fue exitosa.');
        }
    }).fail(function() {
        alert('ERROR: No se pudo realizar la carga de datos, intentelo nuevamente o notifiquelo con el administrador del sistema.')
    });

    // Evitar el comportamiento normal del link
    return false;
}
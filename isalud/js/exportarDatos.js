function fnExportarDatos() {
    href = $(this).attr('href');
    showAdvertencia('Sea paciente, este proceso puede tardar varios minutos, depende de la cantidad de datos a procesar.');

    // Fuente: http://johnculviner.com/jquery-file-download-plugin-for-ajax-like-feature-rich-file-downloads/
    // Utiliza la coockie fileDownload para revisar la descarga del archivo
    $.fileDownload(href, {
        'prepareCallback': function(url){ $('body').prepend('<div class="loading"></div>'); },
        'successCallback': function(url){ $('body').children('.loading').remove(); },
        'failCallback': function(responseHtml, url){ showError('Error al intentar descargar el archivo. '+responseHtml); }
        });

    // Evitar el comportamiento normal del link
    return false;
}
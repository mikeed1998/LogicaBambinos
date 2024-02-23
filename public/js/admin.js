

$('.editar_text_seccion_global').change(function(e) {
    var id = $(this).attr("data-id");
    var tabla = $(this).attr("data-table");
    var campo = $(this).attr("data-campo");
    var valor = ($(this).val() === '') ? null : $(this).val();
    var tcsrf = $('meta[name="csrf-token"]').attr('content');
    var url = $(this).attr("data-url");

    console.log(id);
    console.log(tabla);
    console.log(campo);
    console.log(valor);
    console.log(tcsrf);
    console.log(url);

    $.ajax({
        // url: '/advanced/varios/editarajax',
        url: url,
        type: 'post',
        dataType: 'json',
        data: {
            "id": id,
            "_method": 'post',
            "_token": tcsrf,
            "tabla": tabla,
            "campo": campo,
            "valor": valor
        }
    })
    .done(function(msg) {
        if (msg.success) {
            toastr["success"]("Guardado Exitosamente");
        }else {
            toastr["error"]("Error al actualizar");
        }
    })
    .fail(function(msg) {
        console.log("error:");
        console.log(msg);
    });

});

$('.editarajax').change(function(e) {
    var id = $(this).attr("data-id");
    var tabla = $(this).attr("data-table");
    var campo = $(this).attr("data-campo");
    var valor = ($(this).val() === '') ? null : $(this).val();
    var tcsrf = $('meta[name="csrf-token"]').attr('content');

    console.log(id);
    console.log(tabla);
    console.log(campo);
    console.log(valor);
    console.log(tcsrf);

    $.ajax({
        // url: '/advanced/varios/editarajax',
         url: '/varios/editarajax',
        //url: 'https://proyectoswozial.com/PepeFester/varios/editarajax',
        type: 'post',
        dataType: 'json',
        data: {
            "id": id,
            "_method": 'post',
            "_token": tcsrf,
            "tabla": tabla,
            "campo": campo,
            "valor": valor
        }
    })
    .done(function(msg) {
        console.log(msg);
        // if (msg.success) {
        // 	toastr["success"]("Guardado Exitosamente");
        // }else {
        // 	toastr["error"]("Error al actualizar");
        // }
    })
    .fail(function(msg) {
        console.log("error:");
        console.log(msg);
    });
    // .always(function(msg) {
    // 	console.log("complete");
    // 	// console.log(msg);
    // });
});

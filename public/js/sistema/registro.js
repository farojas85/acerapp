$('.btn-nuevo').on("click",function(){
    $.ajax({
        url: 'registro/create',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text('ENTREGA DE RACIÓN')
            $('#modal-default').modal('show')
            $('#modal-default-body').html(response);
        }

    });
})

$('.btn-entregar').on("click",function(){
    var form = $('#form-registro'),
        url = form.attr('action'),
        method =form.attr('method');

    $.ajax({
        url: url,
        method:method,
        data:form.serialize(),
        success: function (respuesta) {
            console.log(respuesta)
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }

    });
})


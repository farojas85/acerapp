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


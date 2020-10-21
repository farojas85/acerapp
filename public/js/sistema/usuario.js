$('.btn-nuevo').on("click",function(){
    $.ajax({
        url: 'usuario/create',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text('NUEVO USUARIO')
            $('#modal-default').modal('show')
            $('#modal-default-body').html(response);
        }
    });
})

function editar(id)
{
    $.ajax({
        url: 'editar-usuario/'+id,
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text('EDITAR USUARIO')
            $('#modal-default').modal('show')
            $('#modal-default-body').html(response);
        }
    });
}

$('.destroy-usuario').on('click',function(event){
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Esta Seguro de Eliminar el Registro?',
        text: "No podrá revertirlo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    '_token':csrf_token,
                    '_method':'DELETE'
                },
                success:function(response){
                    if(response.ok==0)
                    {
                        Swal.fire({
                            icon:"warning",
                            title:'Usuarios',
                            text:response.mensaje
                        })
                    } else if(response.ok==1)
                    {
                        Swal.fire({
                            title: 'Usuarios',
                            text: "Registro de Usuario eliminado Satisfactoriamente",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href="usuario"
                            }
                        })
                    }
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Cobranzas',
                        text: xhr.responseText
                    });
                },
            });
        }
      })
})

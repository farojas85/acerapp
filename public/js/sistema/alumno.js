$('.btn-nuevo').on("click",function(){
    $.ajax({
        url: 'alumno/create',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text('NUEVO ALUMNO')
            $('#modal-default').modal('show')
            $('#modal-default-body').html(response);
        }
    });
})

function editar(COD_A)
{
    $.ajax({
        url: 'editar-alumno/'+COD_A,
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text('EDITAR ALUMNO')
            $('#modal-default').modal('show')
            $('#modal-default-body').html(response);
        }
    });
}

$('.destroy-alumno').on('click',function(event){
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
                            title:'Alumnos',
                            text:response.mensaje
                        })
                    } else if(response.ok==1)
                    {
                        Swal.fire({
                            title: 'Alumno',
                            text: "Registro de Alumno eliminado Satisfactoriamente",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href="alumno"
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

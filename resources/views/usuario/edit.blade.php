<form method="PUT" id="form-registro"  action="{{ route('usuario.update',$usuario->id) }}">
    @csrf
    <input type="hidden" name="id" value="{{$usuario->id}}" >
    <div class="form-group row">
        <label class="col-md-4 col-form-label">DNI Usuario</label>
        <div class="col-md-8" id="c_dni_user">
            <input type="text" class="form-control" placeholder="Ingrese DNI Usuario"
                   id="dni_user" name="dni_user" maxlength="8" value="{{ $usuario->dni_user }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Apellido Paterno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Apellido Paterno"
                    id="apellido_paterno" name="apellido_paterno" value="{{ $usuario->apellido_paterno }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Apellido Materno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Apellido Materno"
                   id="apellido_materno" name="apellido_materno" value="{{ $usuario->apellido_materno}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Nombres</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Nombres"
                    id="nombres" name="nombres" value="{{ $usuario->nombres}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Nombre Usuario</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Nombre Usuario"
                   id="name" name="name" value="{{ $usuario->name}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Correo Electr&oacute;nico</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Correo Electrónico"
                id="email" name="email" value="{{ $usuario->email}}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <label>
                <input type="checkbox" id="moto_user" @if($usuario->moto_user==1) checked @endif
                        id="moto_user" name="moto_user">
                Moto
            </label>
        </div>
    </div>
    <div class="form-group row text-center">
        <div class="col-6">
            <button type="button" class="btn btn-danger waves-effect btn-cerrar" data-dismiss="modal">
                <i class="fa fa-times"></i> CERRAR
            </button>

        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary waves-effect waves-light btn-guardar" >
                <i class="fa fa-save"></i> Actualizar
            </button>
        </div>
    </div>
</form>
<script>
    $('.btn-cerrar').on("click",function(){
        //window.location.href="registro"
    })
    $('.btn-guardar').on("click",function(event){
        //event.preventDefault();
        var form = $('#form-registro'),
            url = form.attr('action'),
            method =form.attr('method');

        $.ajax({
            url: url,
            method:method,
            data:form.serialize(),
            success: function (respuesta) {
               if(respuesta.ok == 1)
               {
                    limpiarValidar()
                    $('#modal-default').modal('hide')
                    Swal.fire({
                        title: 'Usuarios',
                        text: "Datos de Usuario Modificado Satisfactoriamente",
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
            error : function (xhr) {
                limpiarValidar()
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) === false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key)
                            .closest('.col-md-8')
                            .addClass('has-error')
                            .append('<span class="help-block text-danger" style="font-size:11px"><strong>' + value + '</strong></span>')

                        $('#' + key).addClass('is-invalid')
                    });
                }
            }

        });
    })

    function limpiarValidar()
    {
        $('#dni_user')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#dni_user').removeClass('is-invalid')

        $('#apellido_paterno')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#apellido_paterno').removeClass('is-invalid')
        $('#apellido_materno')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#apellido_materno').removeClass('is-invalid')
        $('#nombres')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#nombres').removeClass('is-invalid')
        $('#name')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#name').removeClass('is-invalid')
        $('#email')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#email').removeClass('is-invalid')
        $('#password')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#password').removeClass('is-invalid')
        $('#password_repeat')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#password_repeat').removeClass('is-invalid')

        $('.col-md-8').find('span').remove()
    }
</script>

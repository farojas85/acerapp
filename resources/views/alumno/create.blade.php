<form method="POST" id="form-registro" action="{{ route('alumno.store') }}" class="form">
    @csrf
    <div class="form-group row">
        <label class="col-md-4 col-form-label">C&oacute;digo Alumno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Código Alumno"
                   id="CODE_A" name="CODE_A" maxlength="10">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">DNI Alumno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Código Alumno"
                   id="DNI_A" name="DNI_A" maxlength="8">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Apellido Paterno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Apellido Paterno"
                    id="APP_A" name="APP_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Apellido Materno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Apellido Materno"
                   id="APM_A" name="APM_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Nombres</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Nombres"
                    id="NOM_A" name="NOM_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Nro. Celular</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Nro. Celular"
                   id="CEL_A" name="CEL_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">ESCUELA E.A.P.</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Escuela Académica Profesional"
                id="ESC_A" name="ESC_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Direcci&oacute;n</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Dirección"
                id="DIR_A" name="DIR_A">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Distrito Alumno</label>
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese Distrito"
                id="DIS_A" name="DIS_A">
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
                <i class="fa fa-save"></i> GUARDAR
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
                        title: 'ALUMNOS',
                        text: "Alumno Registrado Satisfactoriamente",
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
        $('#CODE_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#CODE_A').removeClass('is-invalid')
        $('#DNI_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#DNI_A').removeClass('is-invalid')

        $('#APP_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#APP_A').removeClass('is-invalid')
        $('#APM_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#APM_A').removeClass('is-invalid')
        $('#NOM_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#NOM_A').removeClass('is-invalid')
        $('#CEL_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#CEL_A').removeClass('is-invalid')
        $('#ESC_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#ESC_A').removeClass('is-invalid')
        $('#DIR_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#DIR_A').removeClass('is-invalid')
        $('#DIS_A')
            .closest('.col-md-8')
            .removeClass('has-error')
        $('#DIS_A').removeClass('is-invalid')

        $('.col-md-8').find('span').remove()
    }
</script>

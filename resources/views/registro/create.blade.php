<form method="POST" id="form-registro" action="{{ route('registro.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">REPARTIDOR</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $repartidor }}"
                        placeholder="Ingrese Nombres"  readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">CODIGO ESTUDIANTE</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="code_a" name="code_a"
                        placeholder="Ingrese Código de Estudiante" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">CONTRASE&Nacute;A</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="psw_a" name="psw_a"
                        placeholder="Ingrese Código de Estudiante" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-12 col-form-label">RACI&Oacute;N</label>
                <div class="col-6">
                    <label>
                        <input type="checkbox" id="racion" name="racion[]" value="sopa" >
                        Sopa
                    </label>
                </div>
                <div class="col-6">
                    <label>
                        <input type="checkbox" id="racion" name="racion[]" value="segundo">
                        Segundo
                    </label>
                </div>
                <div class="col-6">
                    <label>
                        <input type="checkbox" id="racion" name="racion[]" value="Fruta / Postre" >
                        Fruta/Postre
                    </label>
                </div>
                <div class="col-6">
                    <label>
                        <input type="checkbox" id="racion" name="racion[]" value="Víveres u Otros">
                        Víveres u Otros
                    </label>
                </div>
            </div>
            <div class="form-group row text-center">
                <div class="col-6">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        <i class="fa fa-times"></i> CERRAR
                    </button>

                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary waves-effect waves-light btn-entregar" >
                        <i class="fa fa-save"></i> ENTREGAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $('.btn-entregar').on("click",function(event){
        //event.preventDefault();
        var form = $('#form-registro'),
            url = form.attr('action'),
            method =form.attr('method');

        $.ajax({
            url: url,
            method:method,
            data:form.serialize(),
            success: function (respuesta) {
                alert('success');
            },
            error : function (xhr) {
                $('#code_a')
                    .closest('.form-group')
                    .removeClass('has-error')
                $('#psw_a')
                    .closest('.form-group')
                    .removeClass('has-error')
                $('#racion')
                    .closest('.form-group')
                    .removeClass('has-error')
                $('.form-group').find('span').remove()

                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) === false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key)
                            .closest('.form-group')
                            .addClass('has-error')
                            .append('<span class="help-block text-danger "><strong>' + value + '</strong></span>')

                    });
                }
            }

        });
    })
</script>

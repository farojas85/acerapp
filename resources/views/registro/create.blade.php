<form method="POST" id="form-registro" action="{{ route('registro.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">REPARTIDOR</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="{{ $repartidor }}"
                        placeholder="Ingrese Nombres"  readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">COD ALUMNO</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="code_a" name="code_a"
                        placeholder="Ingrese Código de Estudiante" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">CONTRASE&Ntilde;A</label>
                <div class="col-md-8">
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
                    <button type="button" class="btn btn-danger waves-effect btn-cerrar" data-dismiss="modal">
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
<div class="modal" tabindex="-1" role="dialog" id="modal-default">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-default-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-default-body">
          <p>Modal body text goes here.</p>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
</div>
<script>
    $('.btn-cerrar').on("click",function(){
        //window.location.href="registro"
    })
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
                if(respuesta.alumno || respuesta.registro)
                {
                    console.log(respuesta)
                    $('#modal-default').modal('hide')

                    let alumno = respuesta.alumno
                    let registro = respuesta.registro
                    $.ajax({
                        url: 'entrega-mostrar/'+alumno+'/'+registro,
                        type:"GET",
                        success: function (response) {
                            $('#modal-default').modal('show');
                            $('#modal-default-title').text('ACER - RACIÓN ENTREGADA');
                            $('#modal-default-body').html(response);
                        }

                    });
                }
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

<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-md-6 col-form-label">RACI&Oacute;N ENTREGADA A:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ $alumno->NOM_AL." ".$alumno->APP_A." ".$alumno->APM_A }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">FECHA:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($registro->FECHA_REG)->format('d/m/Y') }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">HORA:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($registro->HORA_REG)->format('H:i:s') }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">E. A. P.:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ $alumno->ESC_A }}" readonly>
            </div>
        </div>
        <div class="form-group row text-center">
            <div class="col-6">
                <button type="button" class="btn btn-danger waves-effect btn-salir-entrega">
                    <i class="fa fa-times"></i> SALIR
                </button>

            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-nueva-entrega" >
                    <i class="fa fa-save"></i> NUEVA ENTREGA
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-salir-entrega').on("click",function(){
        window.location.href="registro"
    })

    $('.btn-nueva-entrega').on("click",function(){
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
</script>

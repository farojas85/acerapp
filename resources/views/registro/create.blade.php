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
                    <input type="checkbox" id="racion[]" name="racion[]" value="sopa" >
                    Sopa
                </label>
            </div>
            <div class="col-6">
                <label>
                    <input type="checkbox" id="racion[]" name="racion[]" value="segundo" >
                    Segundo
                </label>
            </div>
            <div class="col-6">
                <label>
                    <input type="checkbox" id="racion[]" name="racion[]" value="Fruta / Postre" >
                    Fruta/Postre
                </label>
            </div>
            <div class="col-6">
                <label>
                    <input type="checkbox" id="racion[]" name="racion[]" value="Víveres u Otros" >
                    Víveres u Otros
                </label>
            </div>
        </div>
    </div>
    </div>
</div>

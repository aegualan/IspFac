<input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
<!--<div class="form-group">
    <label class="col-sm-2 control-label colorLabel" for="codPersona">
        Cédula/Ruc:
    </label>
    <div class="col-sm-10">
        <input class="form-control altoTxt" id="codPersona" maxlength="13" onkeyup="return identidad('codPersona');" type="text">
            <span class="help-block">
            </span>
        </input>
    </div>
</div>-->
<div class="form-group">
    <label for="codPersona" class="col-sm-2 control-label">Cédula/Ruc:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" id="codPersona" maxlength="13" onkeyup="return identidad('codPersona');">
        <span class="help-block"></span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="apePersona">
        Apellidos:
    </label>
    <div class="col-sm-10">
        <input class="form-control input-sm" id="apePersona" onkeyup="ConvertirMayusculas('apePersona'); return obligatorio('apePersona');" type="text">
        <span class="help-block">
        </span>
        </input>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="nomPersona">
        Nombres:
    </label>
    <div class="col-sm-10">
        <input class="form-control input-sm" id="nomPersona" onkeyup="ConvertirMayusculas('nomPersona'); return obligatorio('nomPersona');" type="text">
        <span class="help-block">
        </span>
        </input>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="telPersona">
        Teléfono:
    </label>
    <div class="col-sm-10">
        <input class="form-control input-sm" id="telPersona" onkeyup="return soloNumeros('telPersona')" type="text">
        <span class="help-block">
        </span>
        </input>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="celPersona">
        Celular:
    </label>
    <div class="col-sm-10">
        <input class="form-control input-sm" id="celPersona" onkeyup="return soloNumeros('celPersona')" type="text">
        <span class="help-block">
        </span>
        </input>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="emaPersona">
        Email:
    </label>
    <div class="col-sm-10">
        <input class="form-control input-sm" id="emaPersona" onkeyup="return email('emaPersona');" type="text">
        <span class="help-block">
        </span>
        </input>
    </div>
</div>

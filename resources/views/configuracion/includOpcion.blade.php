<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalOpcion">
    <div class="modal-dialog modal-sm">
        <div class="box box-primary">
            <div class="box-body">
                <form autocomplete="off" class="form-horizontal" id="formMenu">
                    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input id="codMenuOpcion" type="hidden"/>
                    <input id="codOpcion" type="hidden"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label colorLabel" for="nomOpcion">
                            Nombre:
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control altoTxt" id="nomOpcion" onkeyup="ConvertirMayusculas('nomOpcion'); return obligatorio('nomOpcion');" type="text">
                                <span class="help-block">
                                </span>
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label colorLabel" for="ordOpcion">
                            Orden:
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control altoTxt" id="ordOpcion" onkeyup="return soloNumeros('ordOpcion')" type="text">
                                <span class="help-block">
                                </span>
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label colorLabel" for="urlWeb">
                            Url Web:
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control altoTxt" id="urlWeb" onkeyup="ConvertirMayusculas('urlWeb'); return obligatorio('urlWeb');" type="text">
                                <span class="help-block">
                                </span>
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label colorLabel" for="urlAPP">
                            Url App:
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control altoTxt" id="urlAPP" onkeyup="ConvertirMayusculas('urlAPP');" type="text">
                                <span class="help-block">
                                </span>
                            </input>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-footer">
                <button class="btn btn-social btn-linkedin btn-sm pull-left" onclick="return grabarDatosOpcion();" type="button">
                    <i class="fa fa-save">
                    </i>
                    Grabar
                </button>
                <button class="btn btn-social btn-google btn-sm pull-right" onclick="cerrarModalOpcion();" type="button">
                    <i class="fa fa-times">
                    </i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalMenu">
    <div class="modal-dialog modal-sm">
        <div class="box box-primary">
            <div class="box-body">
                <form autocomplete="off" class="form-horizontal" id="formMenu">
                    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input id="codMenu" type="hidden">
                        <div class="form-group">
                            <label class="col-sm-2 control-label colorLabel" for="nomMenu">
                                Nombre:
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control altoTxt" id="nomMenu" onkeyup="ConvertirMayusculas('nomMenu'); return obligatorio('nomMenu');" type="text">
                                    <span class="help-block">
                                    </span>
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label colorLabel" for="ordMenu">
                                Orden:
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control altoTxt" id="ordMenu" onkeyup="return soloNumeros('ordMenu')" type="text">
                                    <span class="help-block">
                                    </span>
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label colorLabel" for="icoMenu">
                                Icono:
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control altoTxt" id="icoMenu" type="text">
                                    <span class="help-block">
                                    </span>
                                </input>
                            </div>
                        </div>
                    </input>
                </form>
            </div>
            <div class="box-footer">
                <button class="btn btn-social btn-linkedin btn-sm pull-left" onclick="return grabarDatosMenu();" type="button">
                    <i class="fa fa-save">
                    </i>
                    Grabar
                </button>
                <button class="btn btn-social btn-google btn-sm pull-right" onclick="cerrarModalMenu();" type="button">
                    <i class="fa fa-times">
                    </i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
@extends('layouts.app')
<!-- Bootstrap time Picker -->
@section('content')
<!-- Main content -->
<section class="content">
    <h4 class="box-title text-center">
        {{Utilitarios::titulo()}}
    </h4>
    <table class="display responsive table table-bordered table-bordered mGrid" id="tblFacPen" style="width:100%">
        <thead>
            <tr>
<!--                <th>
                    Nro. Factura
                </th>-->
                <th>
                    Cédula/Ruc
                </th>
                <th>
                    Cliente
                </th>
                <th>
                    Ip
                </th>
                <th>
                    Mes Servicio
                </th>
                <th>
                    Plan
                </th>
                <th>
                    Total Pagar
                </th>
                <th>
                    Estado Servicio
                </th>
                <th>
                    Observación
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
    </table>
    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalProPag">
        <div class="modal-dialog modal-sm">
            <div class="box box-primary">
                <div class="box-body">
                    <input id="codFactura" type="hidden"/>
                    <div class="form-group">
                        <label class="col-lg-6 col-md-5 col-sm-5 col-xs-5 control-label colorLabel" for="fecPago">
                            Promesa Hasta:
                        </label>
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
                            <input class="form-control altoTxt" id="fecPago" type="text">
                            <span class="help-block">
                            </span>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-social btn-linkedin btn-sm pull-left" onclick="grabarPromesa();" type="button">
                        <i class="fa fa-save">
                        </i>
                        Grabar
                    </button>
                    <button class="btn btn-social btn-google btn-sm pull-right" onclick="cerrarModal();" type="button">
                        <i class="fa fa-times">
                        </i>
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalPagFacPen">
        <div class="modal-dialog modal-sm">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="text-center">
                        <h5 class="colorLabel"><strong>Esta seguro de realizar este cobro?</strong></h5>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-social btn-tumblr btn-xs pull-left" onclick="registrarPago();" type="button">
                        <i class="fa fa-check-circle">
                        </i>
                        SI
                    </button>
                    <button class="btn btn-social btn-github btn-xs pull-right" onclick="cerrarModalPago();" type="button">
                        <i class="fa fa-remove">
                        </i>
                        NO
                    </button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalDetalleFac">
          <div class="modal-dialog">
              <div class="box box-primary" id="detalleFac">
  
              </div>
          </div>
      </div>-->
</section>
<!-- /.content -->
@endsection

@section('js')
<!-- bootstrap time picker -->
<script type="text/javascript">
    var tblFacPen = $('#tblFacPen').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/facturas-pendientes/create",
        "searching": true,
        "paging": true,
        "ordering": false,
        "info": false,
        "columns": [
//            {data: "codFactura", "width": "6%"},
            {data: "codPersona", "width": "10%"},
            {data: "nomCompletoPersona", "width": "20%"},
            {data: "codIp", "width": "6%"},
            {data: "mesServicio", "searchable": false, "width": "10%"},
            {data: "nomPlan", "searchable": false, "width": "10%"},
            {data: "totFactura", "searchable": false, "width": "4%"},
            {data: null, "width": "5%",
                render: function (data, type, row) {
                    var html = '';
                    switch (row.estFactura) {
                        case 'PEN':
                            html = '<span class="label label-success">ACTIVO</span>';
                            break;
                        case 'FAC':
                            html = '<span class="label label-info">FACTURADO</span>';
                            break;
                        case 'PRO':
                            html = ' <span class="label label-warning">PROMESA</span>';
                            break;
                        case 'SUS':
                            html = '<span class="label label-danger">SUSPENDIDO</span>';
                            break;
                    }
                    return html
                }
            },
            {data: "obsFactura", "searchable": false, "width": "20%"},
            //  {data: "direccion", "searchable": false, "width": "10%"},
            {
                "data": null, "width": "12%",
                render: function (data, type, row) {

                    return '<button type="button" value="' + row.codFactura + '" class="btn btn-xs btn-social-icon btn-linkedin" onclick="conFirmarPago(this);" title="Registrar Pago"><i class="fa fa-dollar"></i></button>\n\
                        <button type="button" value="' + row.codFactura + '" class="btn btn-xs btn-social-icon btn-linkedin" onclick="verPromesaPago(this);" title="Promesa de Pago"><i class="fa fa-calendar-check-o"></i></button>\n\
                        <button type="button" value="' + row.codFactura + '" class="btn btn-xs btn-social-icon btn-linkedin" onclick="verDetalleFactura(this);" title="Ver Detalle Factura"><i class="fa fa-list-alt"></i></button>\n\
                        <button type="button" value="' + row.codIp + '" class="btn btn-xs btn-social-icon btn-linkedin" onclick="descargarPDF(this);" title="Descargar PDF"><i class="fa fa-file-pdf-o"></i></button>'
                }
                // 
            },
        ],
    });




    function conFirmarPago(btn) {
        // console.log(btn.value);
        $('#codFactura').val(btn.value);
        $("#modalPagFacPen").modal();
    }
    function registrarPago() {
        SessionExpireAlert();
        registrarPagos($('#codFactura').val(), 'PAG', 0);
        cerrarModalPago();
    }

    function verDetalleFactura(btn) {
        $.ajax({
            url: '/detalleFacturas/' + btn.value,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function () {
                $("#modalBloquear").modal();
            },
            success: function () {
            },
            complete: function (res) {
                $("#modalBloquear").modal('hide');
                Lobibox.window({
                    title: 'Detalle Factura',
                    content: function () {
                        return $(res.responseJSON.detalle);
                    },
                });
                /*    $(".content").append(res.responseJSON.detalle);
                 $("#modalDetalleFac").modal();*/


            }
        });
    }
    function registrarPagoDesdeDetalle() {
        SessionExpireAlert();
        if (validarCheckPago() === true) {
            if (obligatorioSoloNumeros('totalFac') === true) {
                registrarPagos($('#codFacturaDetalle').val(), 'DIF', $('#totalFac').val());
            } else {
                return false;
            }
        } else {
            registrarPagos($('#codFacturaDetalle').val(), 'PAG', 0);
        }

    }


    var validarCheckPago = function () {
        var band = false;
        var checkbox = document.getElementById('chkDif');
        var valPagar = $("#valP");
        if (checkbox.checked) {
            valPagar.show();
            band = true;
        } else {
            valPagar.hide();
            band = false;
        }
        return band;
    }

    var registrarPagos = function (codFactura, tipoPago, totalFac) {
        var ruta = '/facturas-pendientes';
        var token = $("#token").val();
        $.ajax({
            url: ruta,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'JSON',
            data: {codFactura: codFactura, tipoPago: tipoPago, totalFac: totalFac},
            beforeSend: function () {
                $("#modalBloquear").modal();
            },
            success: function (res) {
                console.log(res);
            },
            complete: function (res) {
                console.log(res.responseJSON);
                tblFacPen.ajax.reload();
                $("#modalBloquear").modal('hide');
                alerta('Pago de factura registrado con exito');
            }
        });
    }

    function cerrarModalPago() {
        $("#modalPagFacPen").modal('hide');
    }

    function verPromesaPago(btn) {
        SessionExpireAlert();
        $('#codFactura').val(btn.value);
        $("#modalProPag").modal();

        //  console.log(btn.value);
    }



    function grabarPromesa() {
        SessionExpireAlert();
        if (obligatorio('fecPago') === true) {
            var url = '/facturas-pendientes/promesa-pago';
            var token = $("#token").val();
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'JSON',
                data: {codFactura: $('#codFactura').val(), fecPago: $('#fecPago').val()},
                beforeSend: function () {
                    $("#modalBloquear").modal();
                },
                success: function (res) {
                    // console.log(res);
                },
                complete: function () {
                    tblFacPen.ajax.reload();
                    cerrarModal();
                    $("#modalBloquear").modal('hide');
                    alerta('Promesa de pago registrado con exito');
                }
            });
        } else {
            return false;
        }

    }

    function cerrarModal() {
        $("#modalProPag").modal('hide');
        limpiarCampos();
    }
    var limpiarCampos = function () {
        SessionExpireAlert();
        $('#fecPago').val('');
        sinValores('fecPago');
    }

    $(function () {
        SessionExpireAlert();
        //Date picker
        $('#fecPago').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });

    var alerta = function (mensaje) {
        Lobibox.notify('success', {
            sound: false,
            msg: mensaje
        });
    }

    function descargarPDF(btn) {
        window.location.href  = '/facturas-pendientes/' + btn.value;
    }
</script>
@endsection

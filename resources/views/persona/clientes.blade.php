@extends('layouts.app')
@section('css')

@endsection
@section('content')
<section class="content">
    <h4 class="box-title text-center">
        {{Utilitarios::titulo()}}
    </h4>
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalClientes">
        <div class="modal-dialog">
            <div class="box box-primary">
                <div class="box-body">
                    <form autocomplete="off" class="form-horizontal" id="formCliente">
                        @include('persona.include')
                    </form>
                </div>
                <div class="box-footer">
                    <button class="btn btn-social btn-linkedin btn-sm pull-left" onclick="return grabarDatos();" type="button">
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
    <table class="display responsive table table-bordered table-bordered mGrid" id="clientes" style="width:100%">
        <thead>
            <tr>
                <th>
                    Cédula/Ruc
                </th>
                <th>
                    Apellidos
                </th>
                <th>
                    Nombres
                </th>
                <th>
                    Teléfono
                </th>
                <th>
                    Celular
                </th>
                <th>
                    Correo
                </th>
                <th>
                    Editar
                </th>
            </tr>
        </thead>
        <!--                <tbody id='tblDatos'></tbody>-->
    </table>
</section>
@endsection

@section('js')
<script>
    /* $(document).ready(function () {
     listarClientes();
     });*/
    var estado = 0;
//var listarClientes = function(){
    var tblClientes = $('#clientes').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/clientes/create",
        "searching": true,
        "paging": true,
        "ordering": false,
        "info": false,
        "columns": [
            {data: "codPersona", "width": "10%"},
            {data: "apePersona", "width": "20%"},
            {data: "nomPersona", "width": "20%"},
            {data: "telPersona", "searchable": false, "width": "10%"},
            {data: "celPersona", "searchable": false, "width": "10%"},
            {data: "emaPersona", "searchable": false, "width": "15%"},
            {
                "data": null, "width": "5%",
                render: function (data, type, row) {
                    //   console.log(data);
                    return '<button type="button" value="' + row.codPersona + '" class="btn btn-xs btn-social-icon btn-linkedin" onclick="mostrarEditar(this);"><i class="fa fa-pencil-square-o"></i></button>'
                }
                // 
            },
        ],

        order: [1, 'asc'],
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Nuevo Cliente',
                action: function (e, dt, node, config) {
                    estado = 0;
                    SessionExpireAlert();
                    $("#modalClientes").modal();
                }
            },
        ]


    });
    //return tblClientes;

    function  grabarDatos() {
        SessionExpireAlert();
        switch (estado) {
            case 0 : //crear nuevo registro
                // statements_1
                if (identidad('codPersona') === true && obligatorio('apePersona') === true && obligatorio('nomPersona') === true && email('emaPersona') === true && soloNumeros('celPersona') === true && soloNumeros('telPersona') === true) {

                    var codPersona = $('#codPersona').val();
                    var url = '/clientes/' + codPersona + '/edit';
                    $.get(url, function (res) {
                        if (res.codPersona != codPersona) {
                            enviarDatos();
                            limpiarCampos();
                        } else {
                            errores('codPersona', 'Cédula o ruc ya esta registrado en el sistema');
                            return false;
                        }
                    });


                } else {
                    return false;
                }
                break;
            case 1 : //actualiza
                if (obligatorio('apePersona') === true && obligatorio('nomPersona') === true && email('emaPersona') === true && soloNumeros('celPersona') === true && soloNumeros('telPersona') === true) {

                    enviarDatosActualizar();
                    limpiarCampos();
                    cerrarModal();
                } else {
                    return false;
                }
                break;
        }


    }

    var enviarDatos = function () {
        SessionExpireAlert();
        var ruta = '/clientes';
        var token = $("#token").val();
        $.ajax({
            url: ruta,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'JSON',
            data: cargarDatos('CLI'),
            beforeSend: function () {
                $("#modalBloquear").modal();
            },
            success: function () {
            },
            complete: function () {
                tblClientes.ajax.reload();
                $("#modalBloquear").modal('hide');
            }
        });

    }


    function mostrarEditar(btn) {
        SessionExpireAlert();
        $.ajax({
            url: '/clientes/' + btn.value + '/edit',
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function () {
                $("#modalBloquear").modal();
            },
            success: function () {
            },
            complete: function (res) {
                $("#modalBloquear").modal('hide');
                $('#codPersona').val(res.responseJSON.codPersona);
                $('#apePersona').val(res.responseJSON.apePersona);
                $('#nomPersona').val(res.responseJSON.nomPersona);
                $('#celPersona').val(res.responseJSON.celPersona);
                $('#telPersona').val(res.responseJSON.telPersona);
                $('#emaPersona').val(res.responseJSON.emaPersona);
                //abrir modal
                $("#modalClientes").modal();
                //bloquear campo cedula
                $('#codPersona').attr('readonly', true);
                estado = 1;
            }
        });
    }


    var enviarDatosActualizar = function () {
        SessionExpireAlert();
        var codPersona = $('#codPersona').val();
        var ruta = "/clientes/" + codPersona + "";
        var token = $("#token").val();
        $.ajax({
            url: ruta,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'JSON',
            data: cargarDatos('CLI'),
            beforeSend: function () {
                $("#modalBloquear").modal();
            },
            success: function () {
            },
            complete: function () {
                tblClientes.ajax.reload();
                $("#modalBloquear").modal('hide');
            }
        });

    }

    var cargarDatos = function (codRol) {
        SessionExpireAlert();
        return {
            codPersona: $('#codPersona').val(),
            apePersona: $('#apePersona').val(),
            nomPersona: $('#nomPersona').val(),
            celPersona: $('#celPersona').val(),
            telPersona: $('#telPersona').val(),
            emaPersona: $('#emaPersona').val(),
            codRol: codRol
        };
    }

    function cerrarModal() {
        $("#modalClientes").modal('hide');
        limpiarCampos();
    }
    var limpiarCampos = function () {
        SessionExpireAlert();
        $('#codPersona').val('');
        $('#apePersona').val('');
        $('#nomPersona').val('');
        $('#celPersona').val('');
        $('#telPersona').val('');
        $('#emaPersona').val('');
        sinValores('codPersona');
        sinValores('apePersona');
        sinValores('nomPersona');
        sinValores('celPersona');
        sinValores('telPersona');
        sinValores('emaPersona');
        $('#codPersona').attr('readonly', false);
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
@section('css')

@endsection
<section class="content">
    <div class="row">
        <div class="col-md-6">
            @include('configuracion.includMenu')
            <table class="display responsive table table-bordered table-bordered mGrid" id="tblMenus" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            Orden
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Icono
                        </th>
                        <th>
                            Edidar
                        </th>
                    </tr>
                </thead>
                <!--                <tbody id='tblDatos'></tbody>-->
            </table>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            @include('configuracion.includOpcion')
            <table class="display responsive table table-bordered table-bordered mGrid" id="tblOpciones" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            Orden
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Url Web
                        </th>
                        <th>
                            Url App
                        </th>
                        <th>
                            Edidar
                        </th>
                    </tr>
                </thead>
                <!--                <tbody id='tblDatos'></tbody>-->
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection
@section('js')
<script>
    var estadoMenu = 0;
    var estadoOpcion = 0;
    var tblMenus = $('#tblMenus').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/menus/create",
            "searching": false,
            "paging": false,
            "ordering": false,
            "info":     false,
       // select:         false,
              columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
            "columns": [
                {data: "ordMenu","width": "5%"},
                {data: "nomMenu","width": "30%"},
                {data: "icoMenu","width": "10%"},
                {
                    "data": null,"width": "5%",
                    render: function ( data, type, row ) {
                     //   console.log(data);
                        return '<button type="button" value="'+row.codMenu+'" class="btn btn-xs btn-social-icon btn-linkedin" onclick="mostrarEditarMenu(this);"><i class="fa fa-pencil-square-o"></i></button>'
                    }
                   // 
                }
            ],

            order: [1, 'asc'],
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Nuevo Menu',
                    action: function (e, dt, node, config) {
                       estadoMenu = 0;
                       $("#modalMenu").modal();              
                      }
                }
                    
            ],
        });

    function grabarDatosMenu(){
        switch (estadoMenu) {
            case 0:
            if(obligatorio('nomMenu')===true && soloNumeros('ordMenu')===true){
                 var ruta = '/menus';
                var token = $("#token").val();
                $.ajax({
                    url:ruta,
                    headers: {'X-CSRF-TOKEN':token},
                    type: 'POST',
                    dataType: 'JSON',
                    data:cargarDatosMenu(),
                    beforeSend: function() {
                        $("#modalBloquear").modal();
                    },
                    success:function(){

                    },
                    complete:function(){
                        limpiarCamposMenu();
                        tblMenus.ajax.reload();
                        $("#modalBloquear").modal('hide');
                    }
                });

            }else {
                return false;
            }
                // statements_1
                break;
            case 1:
              if(obligatorio('nomMenu')===true && soloNumeros('ordMenu')===true){
                 var ruta = "/menus/"+$('#codMenu').val()+"";
                var token = $("#token").val();
                $.ajax({
                    url:ruta,
                    headers: {'X-CSRF-TOKEN':token},
                    type: 'PUT',
                    dataType: 'JSON',
                    data:cargarDatosMenu(),
                    beforeSend: function() {
                        $("#modalBloquear").modal();
                    },
                    success:function(){

                    },
                    complete:function(){
                        cerrarModalMenu();
                        tblMenus.ajax.reload();
                        $("#modalBloquear").modal('hide');
                    }
                });

            }else {
                return false;
            }
                break;
        }

    }
   
    function mostrarEditarMenu(btn){
           var url = '/menus/'+btn.value+'/edit';
           $.get(url, function (res) {
             $("#codMenu").val(res.codMenu);
                 $('#nomMenu').val(res.nomMenu);
                $('#ordMenu').val(res.ordMenu);
                  $('#icoMenu').val(res.icoMenu);
                //abrir modal
              $("#modalMenu").modal();
                 estadoMenu = 1;
        });
    }


    var cargarDatosMenu = function(){
    return {
        nomMenu:$('#nomMenu').val(),
        ordMenu:$('#ordMenu').val(),
        icoMenu: $('#icoMenu').val()
    };
  }

    function cerrarModalMenu(){
    $("#modalMenu").modal('hide');
    limpiarCamposMenu();
  }

  var limpiarCamposMenu = function(){
       $("#codMenu").val("");
    $("#nomMenu").val("");
    $("#ordMenu").val("");
    $("#icoMenu").val("");
    sinValores('nomMenu');
    sinValores('ordMenu');
    sinValores('icoMenu');
  }


tblMenus.on('select', function (e, dt, type, indexes) {
//    console.log(dt);
   // var codMenuOp = "";
    var codMenuOp = dt.row({selected: true}).data().codMenu;
     $("#codMenuOpcion").val(codMenuOp);
     var tblOpciones = $('#tblOpciones').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/opciones/"+codMenuOp+"",
            "searching": false,
            "paging": false,
            "ordering": false,
            "info":     false,
        select:         true,
         destroy: true,
            "columns": [
                {data: "ordOpcion","width": "5%"},
                {data: "nomOpcion","width": "30%"},
                {data: "urlWeb","width": "10%"},
                {data: "urlAPP","width": "10%"},
                {
                    "data": null,"width": "5%",
                    render: function ( data, type, row ) {
                     //   console.log(data);
                        return '<button type="button" value="'+row.codOpcion+'" class="btn btn-xs btn-social-icon btn-linkedin" onclick="mostrarEditarOpcion(this);"><i class="fa fa-pencil-square-o"></i></button>'
                    }
                   // 
                }
            ],

            order: [1, 'asc'],
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Nuevo Opcion',
                    action: function (e, dt, node, config) {
                       estadoOpcion = 0;
                       $("#modalOpcion").modal();              
                      }
                }
                    
            ],

        });
     
});

 function grabarDatosOpcion(){
        switch (estadoOpcion) {
            case 0:
            if(obligatorio('nomOpcion')===true && soloNumeros('ordOpcion')===true && obligatorio('urlWeb')===true){
                 var ruta = '/opciones';
                var token = $("#token").val();
                $.ajax({
                    url:ruta,
                    headers: {'X-CSRF-TOKEN':token},
                    type: 'POST',
                    dataType: 'JSON',
                    data:cargarDatosOpcion(),
                    beforeSend: function() {
                        $("#modalBloquear").modal();
                    },
                    success:function(data){
console.log(data);
                    },
                    complete:function(){
                        limpiarCamposOpcion();
                        //tblOpciones.ajax.reload();
                        $("#modalBloquear").modal('hide');
                    }
                });

            }else {
                return false;
            }
                // statements_1
                break;
            case 1:
              if(obligatorio('nomOpcion')===true && soloNumeros('ordOpcion')===true && obligatorio('urlWeb')===true){
                 var ruta = "/opciones/"+$('#codOpcion').val()+"";
                var token = $("#token").val();
                $.ajax({
                    url:ruta,
                    headers: {'X-CSRF-TOKEN':token},
                    type: 'PUT',
                    dataType: 'JSON',
                    data:cargarDatosOpcion(),
                    beforeSend: function() {
                        $("#modalBloquear").modal();
                    },
                    success:function(data){
                      //  console.log(data)
                    },
                    complete:function(){
                        cerrarModalOpcion();
                      //  tblOpciones.ajax.reload();
                        $("#modalBloquear").modal('hide');
                    }
                });

            }else {
                return false;
            }
                break;
        }

    }


    function mostrarEditarOpcion(btn){
           var url = '/opciones/'+btn.value+'/edit';
           $.get(url, function (res) {
                $("#codOpcion").val(res.codOpcion);
                $("#codMenuOpcion").val(res.codMenu);
                $("#nomOpcion").val(res.nomOpcion);
                 $("#ordOpcion").val(res.ordOpcion);
                $("#urlWeb").val(res.urlWeb);
                $("#urlAPP").val(res.urlAPP);
                //abrir modal
              $("#modalOpcion").modal();
                 estadoOpcion = 1;
        });
    }

      var cargarDatosOpcion = function(){
    return {
        nomOpcion:$('#nomOpcion').val(),
        urlWeb: $('#urlWeb').val(),
        urlAPP: $('#urlAPP').val(),
         ordOpcion:$('#ordOpcion').val(),
        codMenu: $('#codMenuOpcion').val(),
    };
  }

   function cerrarModalOpcion(){
     $("#codMenuOpcion").val("");
    $("#modalOpcion").modal('hide');
    limpiarCamposOpcion();
  }

  var limpiarCamposOpcion = function(){
     $("#codOpcion").val("");
    $("#nomOpcion").val("");
    $("#ordOpcion").val("");
    $("#urlWeb").val("");
    $("#urlAPP").val("");
    sinValores('nomOpcion');
    sinValores('urlWeb');
    sinValores('urlAPP');
    sinValores('ordOpcion');
  }
</script>
@endsection

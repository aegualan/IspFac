@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <h4 class="box-title text-center">
        {{Utilitarios::titulo()}}
    </h4>
    <table class="display responsive table table-bordered table-bordered mGrid" id="tblFacPag" style="width:100%">
        <thead>
            <tr>
                <th>
                    Cédula/Ruc
                </th>
                <th>
                    Cliente
                </th>
                <th>
                    Nro. Comprobante
                </th>
                <th>
                    Fecha Pagado
                </th>
                <th>
                    Mes Servicio
                </th>
                <th>
                    Plan
                </th>
                <th>
                    Precio Plan
                </th>
                <th> Total</th>
                 <th>
                    Observacion
                </th>
            </tr>
        </thead>
        <!--                <tbody id='tblDatos'></tbody>-->
    </table>
</section>
<!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">
    var tblFacPag = $('#tblFacPag').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/facturas-cobradas/create",
            "searching": true,
            "paging": true,
            "ordering": false,
            "info":     false,
            "columns": [
                {data: "codPersona","width": "10%"},
                {data: "nomCompletoPersona","width": "20%"},
                {data: "codFactura","width": "8%"},
                {data: "fecPagFactura","searchable": false,"width": "8%"},
       
                {data: "mesServicio","searchable": false,"width": "10%"},
                {data: "nomPlan","searchable": false,"width": "10%"},
                {data: "prePlan","searchable": false,"width": "5%"},
                 {data: "totFactura","searchable": false,"width": "5%"},
                {data: "obsFactura","width": "15%"},
            ],
        

        });
</script>
@endsection

@extends('layouts.app')

@section('content')
@section('css')
@endsection
<section class="content">
  




    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            <li style="display: none" id="timeline"><a href="#timeline" data-toggle="tab">Timeline</a></li>
            <li style="display: none"><a href="#settings" data-toggle="tab">Settings</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <p>
                    1
                </p>
                <button class="btn btn-primary btn-sm">next</button>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <p>
                    2
                </p>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
                <p>
                    3
                </p>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</section>
@endsection
@section('js')


<script type="text/javascript">
    function activarTab(){
        
    }
</script>
<!--<script type="text/javascript">
    function prueba() {
        $("#lobipanel-constrain-size").show();
        var instance = $('#lobipanel-constrain-size').data('lobiPanel');
//call the methods
        instance.unpin();

        // console.log('hola');
    }
    $(function () {

        // $('.panel').lobiPanel();
        $('#lobipanel-constrain-size').lobiPanel({
            minWidth: 300,
            minHeight: 300,
            maxWidth: 600,
            maxHeight: 480,
            reload: false,
            close: false,
            editTitle: false,
            unpin: false
        });
    });
</script>-->
@endsection

<!DOCTYPE html>

<html>
    <head>
   
        <title>
            {{ config('app.name', 'Laravel') }}
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        <!-- Bootstrap 3.3.7 -->
        <link href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="assets/dist/css/AdminLTE.css" rel="stylesheet"/>
    </head>
    <body>
          @yield('content')
    </body>
</html>
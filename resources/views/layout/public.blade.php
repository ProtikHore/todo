<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/font-awesome.all.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style type="text/css">

        body {
            background-color: #FFFFFF;
            font-size: 0.9rem;
        }

        .color_default {
            color: #095ea8;
        }
        .background_color_default {
            background-color: #095ea8;
        }

        .btn_default {
            background-color: #095ea8;
            color: #ffffff;
        }

        #footer a {
            color: #e0a800;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <img src="{{ asset('storage/image/logo.gif') }}">
            </div>
        </div>
    </div>
    @yield('content')
    <div class="container-fluid fixed-bottom small background_color_default text-light" id="footer">
        <div class="row">
            <div class="col py-2">
                Copyright &copy; {{ date('Y') }} Protik. All Rights Reserved.
            </div>
            <div class="col py-2 text-right">
                Designed & Developed by <a href="https://protikit.com" target="_blank">Protik Hore</a>
            </div>
        </div>
    </div>
</body>
</html>

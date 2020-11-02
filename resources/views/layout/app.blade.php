<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/font-awesome.all.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>


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

        .scroll {
            max-height: 250px;
            overflow-y: auto;
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col fixed-top" style="height: 60px; background-color: #F5F5F5;">
            <div class="row" style="padding-top: 5px;">
                <div class="col">
                    <img src="{{ asset('storage') }}/{{ session('company_logo') }}" width="150" height="50" alt="">
                </div>
                <div class="col text-right">
                    <a href="#" id="user_icon" data-toggle="popover" data-trigger="focus" onclick="return false;"><img src="{{ asset('image/photo.png') }}" class="rounded-circle" style="width: 50px; height: 50px;"></a>
                </div>
            </div>
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
<script language="JavaScript">

    $(document).ready(function () {

        $('#user_icon').popover({
            html: true,
            placement: 'bottom',
            content: "<ul><li><a href='#' id='user_profile'>Profile</a></li><li><a href='#' id='change_password'>Change Password</li><li><a href='{{ url('logout') }}'>Log out</a></li></ul>",
            title: '<div id="user_title" style="font-weight: bold;">{{ session('user_type') . ' ' . session('name') }}</div><div class="text-left" style="font-size:70%;"></div>'
        });

    });

</script>

</body>
</html>

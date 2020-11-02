@extends('layout.public')

@section('content')

    <div style="height: 50px;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
                <h5 class="text-center">Log in to Todo</h5>
                <div id="form_message" class="text-danger text-center"></div>
                <form id="login_form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn_default btn-sm">Log in</button>
                        <button type="button" onclick="location.href='{{ url('registration') }}'" class="btn btn_default btn-sm">Registration</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script language="JavaScript">
        $(document).on('submit', '#login_form', function() {
            $('#form_message').empty();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('login') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result.message === 'Authorized User') {
                        location = '{{ url('todo') }}/' + result.id;
                    } else {
                        $('#form_message').text(result);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.responseJSON.hasOwnProperty('errors')) {
                        if (xhr.responseJSON.errors.hasOwnProperty('email') || xhr.responseJSON.errors.hasOwnProperty('password')) {
                            $('#form_message').text('Unauthorized Access!');
                        }
                    }
                }
            });
            return false;
        });
    </script>
@endsection

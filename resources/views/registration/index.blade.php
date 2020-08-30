@extends('layout.public')

@section('content')

    <div style="height: 50px;"></div>
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
                <h5 class="text-center">Registration to Todo</h5>
                <div id="form_message" class="text-danger text-center"></div>
                <form id="form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact no</label>
                        <input name="contact_no" type="text" class="form-control" id="contact_no" placeholder="Contact No">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn_default btn-sm">Submit</button>
                        <button type="button" onclick="location.href='{{ url('/') }}'" class="btn btn_default btn-sm">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script language="JavaScript">
        $(document).on('submit', '#form', function() {
            $('#form_message').empty();
            $('#form').find('.text-danger').removeClass('text-danger');
            $('#form').find('.is-invalid').removeClass('is-invalid');
            $('#form').find('span').remove();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('registration') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    location = '{{ url('/') }}';
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.hasOwnProperty('responseJSON')) {
                        if (xhr.responseJSON.hasOwnProperty('errors')) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                if (key !== 'id') {
                                    $('#' + key).after('<span></span>');
                                    $('#' + key).parent().find('label').addClass('text-danger');
                                    $('#' + key).addClass('is-invalid');
                                    $.each(value, function (k, v) {
                                        $('#' + key).parent().find('span').addClass('text-danger').append('<p>' + v + '</p>');
                                    });
                                } else {
                                    $.each(value, function (k, v) {
                                        $('#form_message').append('<p>' + v + '</p>');
                                    });
                                }
                            });
                        }
                    }
                }
            });
            return false;
        });
    </script>
@endsection

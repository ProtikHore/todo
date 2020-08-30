@extends('layout.app')

@section('content')

    <div style="height: 50px;"></div>
    <div class="container-fluid">
        <div class="row mt-5 mb-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-8 col-xl-8 mx-auto">
                <div class="text-center" style="font-size: 40px; color: #1d68a7">
                    Todo List of {{ session('name') }}
                </div>
                <div class="card">
                    <div class="card-body" >
                        <div class="row">
                            <div class="col border-bottom p-2">
                                <form id="form">
                                    <input type="text" name="todo" id="todo" class="form-control" placeholder="Todo">
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2 scroll">
                            <div class="col" id="todo_data">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="show_data" data-id="all">All</a>
                            </div>
                            <div class="col">
                                <a href="#" class="show_data" data-id="Active">Active</a>
                            </div>
                            <div class="col">
                                <a href="#" class="show_data" data-id="Completed">Completed</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script language="JavaScript">
        function showData(todoData) {
            $('#todo_data').empty();
            let completedData;
            let checked;
            let margin;
            $.each(todoData, function (key, data) {
                if (data.status === 'Completed') {
                    margin = 'mt-0';
                    checked = '<input type="checkbox" class="check" value="' + data.id + '"checked>';
                    completedData = '<del> '+ ' ' + data.todo +' </del>';
                } else {
                    margin = 'mt-2';
                    checked = '<input type="checkbox" class="check" value="' + data.id + '">';
                    completedData = '<form class="form_update"><input type="hidden" name="id" value="'+ data.id +'" "><input type="text" class="form-control edit" name="todo" value="'+ data.todo +'" " readonly></form>';
                }
                $('#todo_data').append(
                    '<div class="row">' +
                    '<div class="col-1 ' + margin + '">' +
                    ''+ checked +'' +
                    '</div>' +
                    '<div class="col-11 text-left">' +
                    ''+ completedData +'' +
                    '</div>' +
                    '</div>' +
                    '<br>'
                );
            });
        }


        $(document).ready(function () {
            let todoData = JSON.parse('{!! $todoData !!}');
            showData(todoData);
            console.log(todoData);
        });

        $(document).on('submit', '#form', function (){
            $('#form_message').empty();
            $('#form').find('.text-danger').removeClass('text-danger');
            $('#form').find('.is-invalid').removeClass('is-invalid');
            $('#form').find('span').remove();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('todo/add') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $('#todo').val('');
                    console.log(result);
                    showData(result);
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

        $(document).on('click', '.show_data', function (){
            let status = $(this).data('id');
            $.ajax({
                method: 'get',
                url: '{{ url('todo/show/data') }}',
                data: {
                    'status': status
                },
                cache: false,
                success: function (result) {
                    console.log(result);
                    showData(result);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return false
        });

        $(document).on('click', '.check', function (){
            let checkStatus;
            let formData = new FormData();
            let checkValue = $(this).val();
            if ($(this).prop('checked') === true) {
                checkStatus = 'Completed';
            } else {
                checkStatus = 'Active';
            }
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('id', checkValue);
            formData.append('status', checkStatus);
            $.ajax({
                method: 'post',
                url: '{{ url('todo/update') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    showData(result);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return false;
        });

        $(document).on('dblclick', '.edit', function (){
           $(this).attr("readonly", false);
        });

        $(document).on('submit', '.form_update', function (){
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('todo/add') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    showData(result);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return false;
        });

    </script>
@endsection

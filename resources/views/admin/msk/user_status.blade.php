@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h3>İstifadəçi statusları</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success btn-sm addUserStatusBtn" style="float: right;margin-right: 2px;width: 80px;">
                        <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table mb-0 user_status_table">
                        <thead class="bg-teal bg-lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>Rəngi</th>
                            <th>Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="template/underscore" id="user_status_template">
        <tr data-cat-id="<%- id %>">
            <td></td>
            <td><%- name %></td>
            <td><span style="background-color:<%- color %>;padding: 4px;"><%- color %></span></td>
            <td>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="editUserStatus(this)">
                        <i class="icon-pencil"></i>
                    </button>
                    <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                        <i class="icon-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/html" id="user_status_row">
        <td></td>
        <td><input type="text" class="form-control" name="name"></td>
        <td><input type="color" class="form-control" name="color"></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-success btn-sm" onclick="saveUserStatus(this)">
                    <i class="icon-save"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm cancelUserStatusBtn">
                    <i class="icon-close"></i>
                </button>
            </div>
        </td>
    </script>
@endsection

@section('js')
    <script>
        var statuses = {!! json_encode($statuses) !!};

        alphaTemplate($('#user_status_template'), $('.user_status_table tbody'), statuses,true);
        orderTable('.user_status_table');

        $('.addUserStatusBtn').on('click', function () {
            let tbody = $('.user_status_table tbody');
            tbody.prepend("<tr data-cat-id='0'>"+$('#user_status_row').html()+"</tr>");
            orderTable('.user_status_table');
            $('.cancelUserStatusBtn').on('click', function () {
                $(this).parents('tr:eq(0)').remove();
                orderTable('.user_status_table');
            });
        });

        function editUserStatus(element){
            let tr = $(element).parents('tr:eq(0)'),
                name = tr.find('td:eq(1)').text(),
                color = tr.find('td:eq(2)').find('span').text(),
                delete_url=tr.find('.deleteAction').attr('url'),
                data_cat_id = tr.attr('data-cat-id');
            tr.html($('#user_status_row').html());
            tr.attr('data-cat-id',data_cat_id);
            tr.find('input[name="name"]').val(name);
            tr.find('input[name="color"]').val(color);
            orderTable('.user_status_table');
            $('.cancelUserStatusBtn').on('click', function () {
                alphaTemplate($('#user_status_template'), tr, {
                    id : data_cat_id,
                    name : name,
                    color : color,
                    delete_url : delete_url
                },false);
                $(this).parents('tr:eq(0)').remove();
                orderTable('.user_status_table');
            });
        }

        function saveUserStatus(element){
            let tr = $(element).parents('tr:eq(0)'),
                id = tr.attr('data-cat-id'),
                name = tr.find('input[name="name"]').val(),
                color = tr.find('input[name="color"]').val();

            $.post('{{ route('admin.user_status.add_edit') }}',{ id : id ,name : name,color : color , _token : _token},function (response) {
                if (response.status == "ok"){
                    alphaTemplate($('#user_status_template'), tr, response.userStatus,false);
                    tr.remove();
                    orderTable('.user_status_table');
                }
                else{

                }
            });
        }
    </script>
@endsection
@section('css')

@endsection

@section('title') Hərrac statusları @endsection


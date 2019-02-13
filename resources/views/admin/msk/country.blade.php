@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-6" id="country_div">
            <div class="row">
                <div class="col-md-6">
                    <h3>Ölkələr</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success btn-sm addCountryBtn" style="float: right;margin-right: 2px;width: 80px;">
                        <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table mb-0 country_table">
                        <thead class="bg-teal bg-lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="city_div">

        </div>
    </div>
    <script type="template/underscore" id="country_template">
        <tr data-cat-id="<%- id %>">
            <td></td>
            <td><%- name %></td>
            <td>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="editCountry(this)">
                        <i class="icon-pencil"></i>
                    </button>
                    <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                        <i class="icon-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/html" id="country_row">
        <td></td>
        <td><input type="text" class="form-control" name="name"></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-success btn-sm" onclick="saveCountry(this)">
                    <i class="icon-save"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm cancelCountryBtn">
                    <i class="icon-close"></i>
                </button>
            </div>
        </td>
    </script>
@endsection

@section('js')
    <script>
        var countries = {!! json_encode($countries) !!};

        alphaTemplate($('#country_template'), $('.country_table tbody'), countries,true);
        orderTable('.country_table');

        $('.addCountryBtn').on('click', function () {
            let tbody = $('.country_table tbody');
            tbody.prepend("<tr data-cat-id='0'>"+$('#country_row').html()+"</tr>");
            orderTable('.country_table');
            $('.cancelCountryBtn').on('click', function () {
                $(this).parents('tr:eq(0)').remove();
                orderTable('.country_table');
            });
        });

        function editCountry(element){
            let tr = $(element).parents('tr:eq(0)'),
                name = tr.find('td:eq(1)').text(),
                data_cat_id = tr.attr('data-cat-id');
            tr.html($('#country_row').html());
            tr.attr('data-cat-id',data_cat_id);
            tr.find('input[name="name"]').val(name);
            orderTable('.country_table');
            $('.cancelCountryBtn').on('click', function () {
                alphaTemplate($('#country_template'), tr, {
                    id : data_cat_id,
                    name : name,
                    icon : icon
                },false);
                $(this).parents('tr:eq(0)').remove();
                orderTable('.country_table');
            });
        }

        function saveCountry(element){
            let tr = $(element).parents('tr:eq(0)'),
                id = tr.attr('data-cat-id'),
                name = tr.find('input[name="name"]').val();

            $.post('{{ route('admin.country.add_edit') }}',{ id : id ,name : name, _token : _token},function (response) {
                if (response.status == "ok"){
                    alphaTemplate($('#country_template'), tr, response.country,false);
                    tr.remove();
                    orderTable('.country_table');
                }
                else{

                }
            });
        }

        $('.country_table').on('click','tbody tr td',function(){
            if($(this).prevAll().length < 3){
                if($(this).find('input').length === 0 && !$(this).parents('tr:eq(0)').hasClass('activeCountry')) {
                    $('.activeCountry').removeClass('activeCountry');
                    $(this).parents('tr:eq(0)').addClass('activeCountry');
                    $(this).css('cursor', 'pointer');
                    loadPage('#city_div', '{{ route('admin.country.load_page') }}', {cat_id: $(this).parents('tr:eq(0)').attr('data-cat-id')});
                }
            }
        });
    </script>
@endsection
@section('css')
    <style>
        .activeCountry{
            background-color: bisque;
            border: 1px solid #373a3c;
        }
    </style>
@endsection

@section('title') Ölkələr @endsection


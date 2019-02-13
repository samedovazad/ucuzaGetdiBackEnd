@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-4" id="category_div">
            <div class="row">
                <div class="col-md-6">
                    <h3>Kateqoriyalar</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success btn-sm addCategoryBtn" style="float: right;margin-right: 2px;width: 80px;">
                        <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table mb-0 category_table">
                        <thead class="bg-teal bg-lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>İkonu</th>
                            <th>Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="sub_category_div">

        </div>
        <div class="col-md-4" id="sub_sub_category_div">

        </div>
    </div>
    <script type="template/underscore" id="category_template">
        <tr data-cat-id="<%- id %>">
            <td></td>
            <td><%- name %></td>
            <td><i class="<%- icon %>" style="font-size: 30px;"></i></td>
            <td>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-primary btn-sm editCategoryBtn" onclick="editCategory(this)">
                        <i class="icon-pencil"></i>
                    </button>
                    <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                        <i class="icon-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/html" id="category_row">
        <td></td>
        <td><input type="text" class="form-control" name="name"></td>
        <td><input type="text" class="form-control" name="icon"></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-success btn-sm saveCategoryBtn" onclick="saveCategory(this)">
                    <i class="icon-save"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm cancelCategoryBtn">
                    <i class="icon-close"></i>
                </button>
            </div>
        </td>
    </script>
@endsection

@section('js')
    <script>
        var categories = {!! json_encode($categories) !!};

        alphaTemplate($('#category_template'), $('.category_table tbody'), categories,true);
        orderTable('.category_table');

        $('.addCategoryBtn').on('click', function () {
            let tbody = $('.category_table tbody');
            tbody.prepend("<tr data-cat-id='0'>"+$('#category_row').html()+"</tr>");
            orderTable('.category_table');
            $('.cancelCategoryBtn').on('click', function () {
                $(this).parents('tr:eq(0)').remove();
                orderTable('.category_table');
            });
        });

        function editCategory(element){
            let tr = $(element).parents('tr:eq(0)'),
                name = tr.find('td:eq(1)').text(),
                icon = tr.find('td:eq(2)').find('i').attr('class'),
                delete_url=tr.find('.deleteAction').attr('url'),
                data_cat_id = tr.attr('data-cat-id');
            tr.html($('#category_row').html());
            tr.attr('data-cat-id',data_cat_id);
            tr.find('input[name="name"]').val(name);
            tr.find('input[name="icon"]').val(icon);
            orderTable('.category_table');
            $('.cancelCategoryBtn').on('click', function () {
                alphaTemplate($('#category_template'), tr, {
                    id : data_cat_id,
                    name : name,
                    icon : icon,
                    delete_url: delete_url,
                },false);
                $(this).parents('tr:eq(0)').remove();
                orderTable('.category_table');
            });
        }

        function saveCategory(element){
            let tr = $(element).parents('tr:eq(0)'),
                id = tr.attr('data-cat-id'),
                name = tr.find('input[name="name"]').val(),
                icon = tr.find('input[name="icon"]').val();

            $.post('{{ route('admin.category.add_edit') }}',{ id : id ,name : name,icon : icon , _token : _token},function (response) {
                if (response.status == "ok"){
                    alphaTemplate($('#category_template'), tr, response.category,false);
                    tr.remove();
                    orderTable('.category_table');
                }
                else{

                }
            });
        }

        $('.category_table').on('click','tbody tr td',function(){
            if($(this).prevAll().length < 3){
                if($(this).find('input').length === 0 && !$(this).parents('tr:eq(0)').hasClass('activeCategory')){
                    $('.activeCategory').removeClass('activeCategory');
                    $(this).parents('tr:eq(0)').addClass('activeCategory');
                    $(this).css('cursor','pointer');
                    loadPage('#sub_category_div','{{ route('admin.category.load_page') }}',{ cat_id : $(this).parents('tr:eq(0)').attr('data-cat-id')});
                    $('.sub_sub_category_table tbody').remove();
                }
            }
        });
    </script>
@endsection
@section('css')
    <style>
        .activeCategory{
            background-color: bisque;
            border: 1px solid #373a3c;
        }

        .subactiveCategory
        {
            background-color: bisque;
            border: 1px solid #373a3c;
        }
    </style>
@endsection

@section('title') Kateqoriyalar @endsection


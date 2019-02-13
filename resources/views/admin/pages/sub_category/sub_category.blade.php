<div class="row">
    <div class="col-md-6">
        <h4>Alt kateqoriyalar</h4>
    </div>
    <div class="col-md-6">
        <a class="btn btn-success btn-sm addSubCategoryBtn" style="float: right;margin-right: 2px;width: 80px;">
            <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
        </a>
    </div>
</div>
<div class="table-responsive">
    <div class="table-responsive">
        <table class="table mb-0 sub_category_table">
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

<script type="template/underscore" id="sub_category_template">
    <tr data-sub-cat-id="<%- id %>" data-cat-id="{{ $category_id }}">
        <td></td>
        <td><%- name %></td>
        <td><i class="<%- icon %>" style="font-size: 30px;"></i></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-primary btn-sm editSubCategoryBtn" onclick="editSubCategory(this)">
                    <i class="icon-pencil"></i>
                </button>
                <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                    <i class="icon-trash"></i>
                </button>
            </div>
        </td>
    </tr>
</script>


<script type="text/html" id="sub_category_row">
    <td></td>
    <td><input type="text" class="form-control" name="name"></td>
    <td><input type="text" class="form-control" name="icon"></td>
    <td>
        <div class="form-actions center">
            <button type="submit" class="btn btn-success btn-sm saveCategoryBtn" onclick="saveSubCategory(this)">
                <i class="icon-save"></i>
            </button>
            <button type="button" class="btn btn-warning btn-sm cancelSubCategoryBtn">
                <i class="icon-close"></i>
            </button>
        </div>
    </td>
</script>


<script>
    var subcategories = {!! json_encode($sub_categories) !!};
    alphaTemplate($('#sub_category_template'), $('.sub_category_table tbody'), subcategories,true);
    orderTable('.sub_category_table');

    $('.addSubCategoryBtn').on('click', function () {
        let tbody = $('.sub_category_table tbody');
        tbody.prepend("<tr data-cat-id='{{ $category_id }}' data-sub-cat-id='0'>"+$('#sub_category_row').html()+"</tr>");
        orderTable('.sub_category_table');
        $('.cancelSubCategoryBtn').on('click', function () {
            $(this).parents('tr:eq(0)').remove();
            orderTable('.sub_category_table');
        });
    });

    function editSubCategory(element){
        let tr = $(element).parents('tr:eq(0)'),
            name = tr.find('td:eq(1)').text(),
            icon = tr.find('td:eq(2)').find('i').attr('class'),
            delete_url=tr.find('.deleteAction').attr('url'),
            data_sub_cat_id = tr.attr('data-sub-cat-id');
        tr.html($('#sub_category_row').html());
        tr.attr('data-sub-cat-id',data_sub_cat_id);
        tr.find('input[name="name"]').val(name);
        tr.find('input[name="icon"]').val(icon);
        orderTable('.sub_category_table');
        $('.cancelSubCategoryBtn').on('click', function () {
            alphaTemplate($('#sub_category_template'), tr, {
                id : data_sub_cat_id,
                name : name,
                icon : icon,
                delete_url: delete_url,
            },false);
            $(this).parents('tr:eq(0)').remove();
            orderTable('.sub_category_table');
        });
    }

    function saveSubCategory(element){
        let tr = $(element).parents('tr:eq(0)'),
            id = tr.attr('data-sub-cat-id'),
            name = tr.find('input[name="name"]').val(),
            icon = tr.find('input[name="icon"]').val();

        $.post('{{ route('admin.sub_category.add_edit') }}',{ id : id ,cat_id : '{{ $category_id }}',name : name,icon : icon , _token : _token},function (response) {
            if (response.status == "ok"){
                alphaTemplate($('#sub_category_template'), tr, response.category,false);
                tr.remove();
                orderTable('.sub_category_table');
            }
            else{

            }
        });
    }

    $('.sub_category_table').on('click','tbody tr td',function(){
        if($(this).prevAll().length < 3){
            if($(this).find('input').length === 0 && !$(this).parents('tr:eq(0)').hasClass('subactiveCategory')){
                $('.subactiveCategory').removeClass('subactiveCategory');
                $(this).parents('tr:eq(0)').addClass('subactiveCategory');
                $(this).css('cursor','pointer');
                loadPage('#sub_sub_category_div','{{ route('admin.category.sub_load_page') }}',{ cat_id : $(this).parents('tr:eq(0)').attr('data-sub-cat-id')});
            }
        }
    });

</script>

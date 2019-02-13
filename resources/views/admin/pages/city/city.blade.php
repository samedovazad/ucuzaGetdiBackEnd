<div class="row">
    <div class="col-md-6">
        <h3>Şəhərlər</h3>
    </div>
    <div class="col-md-6">
        <a class="btn btn-success btn-sm addCityBtn" style="float: right;margin-right: 2px;width: 80px;">
            <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
        </a>
    </div>
</div>
<div class="table-responsive">
    <div class="table-responsive">
        <table class="table mb-0 city_table">
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

<script type="template/underscore" id="city_template">
    <tr data-city-id="<%- id %>" data-cat-id="{{ $country_id }}">
        <td></td>
        <td><%- name %></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-primary btn-sm" onclick="editCity(this)">
                    <i class="icon-pencil"></i>
                </button>
                <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                    <i class="icon-trash"></i>
                </button>
            </div>
        </td>
    </tr>
</script>


<script type="text/html" id="city_row">
    <td></td>
    <td><input type="text" class="form-control" name="name"></td>
    <td>
        <div class="form-actions center">
            <button type="submit" class="btn btn-success btn-sm" onclick="saveCity(this)">
                <i class="icon-save"></i>
            </button>
            <button type="button" class="btn btn-warning btn-sm cancelCityBtn">
                <i class="icon-close"></i>
            </button>
        </div>
    </td>
</script>


<script>
    var cities = {!! json_encode($cities) !!};
    alphaTemplate($('#city_template'), $('.city_table tbody'), cities,true);
    orderTable('.city_table');

    $('.addCityBtn').on('click', function () {
        let tbody = $('.city_table tbody');
        tbody.prepend("<tr data-cat-id='{{ $country_id }}' data-city-id='0'>"+$('#city_row').html()+"</tr>");
        orderTable('.city_table');
        $('.cancelCityBtn').on('click', function () {
            $(this).parents('tr:eq(0)').remove();
            orderTable('.city_table');
        });
    });

    function editCity(element){
        let tr = $(element).parents('tr:eq(0)'),
            name = tr.find('td:eq(1)').text(),
            data_city_id = tr.attr('data-city-id');
        tr.html($('#city_row').html());
        tr.attr('data-city-id',data_city_id);
        tr.find('input[name="name"]').val(name);
        orderTable('.city_table');
        $('.cancelCityBtn').on('click', function () {
            alphaTemplate($('#city_template'), tr, {
                id : data_city_id,
                name : name,
            },false);
            $(this).parents('tr:eq(0)').remove();
            orderTable('.city_table');
        });
    }

    function saveCity(element){
        let tr = $(element).parents('tr:eq(0)'),
            id = tr.attr('data-city-id'),
            name = tr.find('input[name="name"]').val();

        $.post('{{ route('admin.city.add_edit') }}',{ id : id ,cat_id : '{{ $country_id }}',name : name , _token : _token},function (response) {
            if (response.status == "ok"){
                alphaTemplate($('#city_template'), tr, response.city,false);
                tr.remove();
                orderTable('.city_table');
            }
            else{

            }
        });
    }

    $('.city_table').on('click','tbody tr td',function(){
        $('.city_table').find('tbody tr').removeClass('activeCountry');
        $(this).parents('tr:eq(0)').addClass('activeCountry');
        $(this).css('cursor','pointer');
    });

</script>
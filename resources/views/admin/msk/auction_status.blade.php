@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h3>Hərrac statusları</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success btn-sm addAuctionStatusBtn" style="float: right;margin-right: 2px;width: 80px;">
                        <i class="icon-android-add" style="font-size: 20px;color:white;"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table mb-0 auction_status_table">
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
    <script type="template/underscore" id="auction_status_template">
        <tr data-cat-id="<%- id %>">
            <td></td>
            <td><%- name %></td>
            <td><span style="background-color:<%- color %>;padding: 4px;"><%- color %></span></td>
            <td>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="editAuctionStatus(this)">
                        <i class="icon-pencil"></i>
                    </button>
                    <% if(id == {{ \App\Helper\Standarts::AuctionStatuses['APPROVED'] }} ||
                            id == {{ \App\Helper\Standarts::AuctionStatuses['NONAPPROVED'] }} ||
                            id == {{ \App\Helper\Standarts::AuctionStatuses['REJECTED'] }}) {
                    %>
                    <% } else { %>
                        <button type="button" url="<%- delete_url %>" class="btn btn-danger btn-sm deleteAction">
                            <i class="icon-trash"></i>
                        </button>
                    <% } %>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/html" id="auction_status_row">
        <td></td>
        <td><input type="text" class="form-control" name="name"></td>
        <td><input type="color" class="form-control" name="color"></td>
        <td>
            <div class="form-actions center">
                <button type="submit" class="btn btn-success btn-sm" onclick="saveAuctionStatus(this)">
                    <i class="icon-save"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm cancelAuctionStatusBtn">
                    <i class="icon-close"></i>
                </button>
            </div>
        </td>
    </script>
@endsection

@section('js')
    <script>
        var statuses = {!! json_encode($statuses) !!};

        alphaTemplate($('#auction_status_template'), $('.auction_status_table tbody'), statuses,true);
        orderTable('.auction_status_table');

        $('.addAuctionStatusBtn').on('click', function () {
            let tbody = $('.auction_status_table tbody');
            tbody.prepend("<tr data-cat-id='0'>"+$('#auction_status_row').html()+"</tr>");
            orderTable('.auction_status_table');
            $('.cancelAuctionStatusBtn').on('click', function () {
                $(this).parents('tr:eq(0)').remove();
                orderTable('.auction_status_table');
            });
        });

        function editAuctionStatus(element){
            let tr = $(element).parents('tr:eq(0)'),
                name = tr.find('td:eq(1)').text(),
                color = tr.find('td:eq(2)').find('span').text(),
                delete_url=tr.find('.deleteAction').attr('url'),
                data_cat_id = tr.attr('data-cat-id');
            tr.html($('#auction_status_row').html());
            tr.attr('data-cat-id',data_cat_id);
            tr.find('input[name="name"]').val(name);
            tr.find('input[name="color"]').val(color);
            orderTable('.auction_status_table');
            $('.cancelAuctionStatusBtn').on('click', function () {
                alphaTemplate($('#auction_status_template'), tr, {
                    id : data_cat_id,
                    name : name,
                    color : color,
                    delete_url:delete_url
                },false);
                $(this).parents('tr:eq(0)').remove();
                orderTable('.auction_status_table');
            });
        }

        function saveAuctionStatus(element){
            let tr = $(element).parents('tr:eq(0)'),
                id = tr.attr('data-cat-id'),
                name = tr.find('input[name="name"]').val(),
                color = tr.find('input[name="color"]').val();

            $.post('{{ route('admin.auction_status.add_edit') }}',{ id : id ,name : name,color : color , _token : _token},function (response) {
                if (response.status == "ok"){
                    alphaTemplate($('#auction_status_template'), tr, response.auctionStatus,false);
                    tr.remove();
                    orderTable('.auction_status_table');
                }
                else{

                }
            });
        }

        $('.auction_status_table').on('click','tbody tr td',function(){
            $('.auction_status_table').find('tbody tr').removeClass('activeStatus');
            $(this).parents('tr:eq(0)').addClass('activeStatus');
            $(this).css('cursor','pointer');
        });

    </script>
@endsection
@section('css')
    <style>
        .activeStatus{
            background-color: bisque;
            border: 1px solid #373a3c;
        }
    </style>
@endsection

@section('title') Hərrac statusları @endsection


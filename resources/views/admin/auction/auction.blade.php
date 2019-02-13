@extends('admin.layouts.base')
@section('title', 'Auction')
@section('content')
    <div class="row">
        <div>
            <h3>Auction</h3>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-outline-secondary tum-filter"
                           href="javascript:loadModal('{{ route('admin.auction.filter') }}',{},'modal-lg')">
                            <i class="icon-filter"></i>
                            Tüm Filterler
                        </a>
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <a class="btn btn-success"
                           style="float: right; width : 80px; height : 40px; margin-bottom: 12px;"
                           href="javascript:loadModal('{{ route('admin.auction.add_edit',['id' => 0]) }}',{},'modal-lg')">
                            <i class="icon-android-add" style="font-size: 22px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table user_priv_table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Kategoriya</th>
                            <th>Əlavə eden user</th>
                            <th>Əlavə olunan vaxt</th>
                            <th>Biten vaxt</th>
                            <th>Minimal satiş qiymeti</th>
                            <th>Ölkə</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auctions as $key => $auction)
                            <tr auction_id="{{ $auction->id }}">
                                <td>{{ ++$key }}</td>
                                <td>
                                    {{ $auction->category->name }} <br>
                                    {{ $auction->sub_category->name . ',' }}
                                    {{ $auction->sub_sub_category->name ?? ''}}
                                </td>
                                <td>{{ $auction->user_name->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($auction->created_at)->format('Y-m-d h:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($auction->end_date)->format('Y-m-d h:i') }}</td>
                                <td>{{ $auction->reserve_price_currency() }}</td>
                                <td>
                                    {{ $auction->countries->name }} <br> {{ $auction->city->name }}
                                </td>
                                <td>
                                        <span style="background-color:{{ $auction->auction_status->color }};"
                                              class="status">
                                            {{ $auction->auction_status->name }}
                                        </span>
                                </td>
                                <td>
                                    <div class="form-actions center">
                                        <a class="btn btn-green btn-sm"
                                           data-toggle="tooltip" data-placement="top" data-original-title="Ətraflı"
                                           href="javascript:loadModal('{{ route('admin.auction.show',['id' => $auction->id ]) }}',{},'modal-lg')">
                                            <i class="icon-eye6"></i>
                                        </a>
                                        <a class="btn btn-blue btn-sm"
                                           data-toggle="tooltip" data-placement="top" data-original-title="Düzəliş et"
                                           href="#">
                                            <i class="icon-pencil"></i>
                                        </a>

                                        @if($auction->status != \App\Helper\Standarts::AuctionStatuses['REJECTED'])
                                            <a class="btn btn-black btn-sm reject"
                                               href="#"
                                               data-toggle="tooltip" data-placement="top" data-original-title="Rədd et">
                                                <i class="icon-hand-stop-o"></i>
                                            </a>
                                        @endif

                                        @if($auction->status == \App\Helper\Standarts::AuctionStatuses['REJECTED'])
                                            <a class="btn btn-secondary btn-sm redd_et_sebeb"
                                               data-text="{{ $auction->auction_reject->description }}"
                                               href="#"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="Rədd etmə səbəbi">
                                                <i class="icon-info"></i>
                                            </a>
                                        @elseif($auction->status == \App\Helper\Standarts::AuctionStatuses['NONAPPROVED'])
                                            <a class="btn btn-success btn-sm testiq"
                                               href="#"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="Təstiq et">
                                                <i class="icon-checkmark2"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $auctions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/photoswipe-ui-default.min.js') }}"></script>

    <script>
        $('.reject').click(function () {
            var auction_id = $(this).parents('tr').attr('auction_id');

            $.confirm({
                title: 'Rədd et',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Rədd edilmə səbəbi</label>' +
                '<input type="text" placeholder="Rədd edilmə səbəbi" class="name form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            if (!name) {
                                $.alert('Rədd edilmə səbəbi vacibdi');
                                return false;
                            }

                            $.post('{{ route('admin.auction.reject') }}', {
                                auction_id: auction_id,
                                name: name,
                                _token: _token
                            }, function (res) {
                                location.reload();
                            })
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click');
                    });
                }
            });
        });
        $('.testiq').click(function () {
            var auction_id = $(this).parents('tr').attr('auction_id');
            $.confirm({
                title: 'Təstiq et',
                content: 'Hərrac təstiq et',
                buttons: {
                    somethingElse: {
                        text: 'Təstiq',
                        btnClass: 'btn-success',
                        action: function () {
                            $.post('{{ route('admin.auction.confirm') }}', {
                                auction_id: auction_id,
                                _token: _token
                            }, function (res) {
                                location.reload();
                            });
                        }
                    },
                    cancel: function () {
                    }
                }
            });
        });

        $('.redd_et_sebeb').click(function () {
            var text = $(this).data('text');
            $.alert({
                title: 'Rədd etmə səbəbi',
                content: text,
            });
        });

        $('.user_priv_table').on('click','tbody tr td',function(){
            $('.user_priv_table').find('tbody tr').removeClass('activeAuction');
            $(this).parents('tr:eq(0)').addClass('activeAuction');
        });

    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/default-skin/default-skin.css') }}">
    <style>

        .activeAuction{
            background-color: #2b4b562b;
        }

        .btn-circle.btn-xl {
            width: 40px;
            height: 40px;
            padding: 4px 4px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }

        .card-block {
            padding: 0.5rem !important;
        }

        .tum-filter {
            float: right;
            width: 140px;
            height: 40px;
            margin-bottom: 12px;
            font-size: 17px
        }

        .pagination {
            float: right;
        }

        .status {
            padding: 2px 10px 4px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            color: #ffffff;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 4px;
        }

        .user_priv_table
        {
            cursor: pointer;
        }

    </style>
@endsection
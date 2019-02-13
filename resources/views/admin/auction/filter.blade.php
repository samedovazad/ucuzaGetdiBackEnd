<style>
    button, input, select, textarea {
        font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    }

    .label {
        color: #333;
        vertical-align: top;
        font-weight: 600;
        padding: 15px 21px 9px 0px;
        margin-right: 5px;
        white-space: normal;
    }

    .bt_search {
        margin-top: -13px;
    }

    input[name=reserve_price] {
        width: 110px;
    }
</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">AUCTION SEARCH</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div class="row" id="errors">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: auto;">
                            <div class="card-body collapse in">
                                <form action="" method="GET">
                                    <input type="hidden" name="users">
                                    <input type="hidden" name="auction_status">
                                    <div class="card-block">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label" for="user">Butun Userler</label>
                                                        <select data-placeholder="User sec" class="full-width"
                                                                id="users" multiple>
                                                            @foreach(\App\User::all() as $user)
                                                                <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label" for="status">Status</label>
                                                        <select id="auction_status" class="full-width" multiple placeholder="Auction status sec">
                                                            @foreach(\App\Models\Admin\AuctionStatus::all() as $status)
                                                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-item">
                                                            <label class="label" for="start_price">Baş. qiyməti</label>
                                                            <input type="text" class="form-control" name="start_price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-item">
                                                            <label class="label" for="reserve_price">Min. qiyməti</label>
                                                            <input type="text" class="form-control" name="reserve_price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label" for="category">Kateqoriya</label>
                                                        <input type="text" class="full-width" name="category">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-item required">
                                                        <label class="label" for="sub_category">Alt Kateqoriya</label>
                                                        <input type="text" class="full-width" name="sub_category">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group form-item required">
                                                        <label class="label" for="sub_sub_category">Alt
                                                            Kateqoriya</label>
                                                        <input type="text" class="full-width" name="sub_sub_category">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="label" for="choose_day">Günü sec</label>
                                                    <select id="choose_day" name="choose_day" class="form-control"
                                                            style="cursor:pointer;">
                                                        <option value="today">Today</option>
                                                        <option value="yesterday">Yesterday</option>
                                                        <option value="current_week">Current Week</option>
                                                        <option value="previous_week">Previous Week</option>
                                                        <option value="current_month">Current Month</option>
                                                        <option value="previous_month">Previous Month</option>
                                                        <option value="last_30">Last 30 Days</option>
                                                        <option value="last_60">Last 60 Days</option>
                                                        <option value="last_90">Last 90 Days</option>
                                                        <option value="custom">Custom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item">
                                                    <label class="label" for="city">Ölkələr seçin</label>
                                                    <input type="text" class="full-width" name="region">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item">
                                                    <label class="label" for="city">Şəhər seçin</label>
                                                    <input type="text" class="full-width" name="city">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row date" style="display: none;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="label" for="start_date">Start Date</label>
                                                    <input type="text" class="form-control" name="start_date">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="label" for="end_date">End Date</label>
                                                    <input type="text" class="form-control" name="end_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10 bt_search">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                        </button>
                        <button type="submit"
                                class="btn btn-success searchBtn">Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#users').select2();
    $('#auction_status').select2();

    $('input[name="category"]').select2({
        allowClear: true,
        placeholder: 'Kateqoriya seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'category',
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    }).on('change', function () {
        $('input[name="sub_category"]').select2('val', null);
    });

    $('input[name="sub_category"]').select2({
        allowClear: true,
        placeholder: 'Alt Kateqoriya seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'sub_category',
                    category_id: $('input[name="category"]').val(),
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    });

    $('input[name="sub_sub_category"]').select2({
        allowClear: true,
        placeholder: 'Alt Kateqoriya seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'sub_sub_category',
                    sub_category_id: $('input[name="sub_category"]').val(),
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    });

    $('input[name="region"]').select2({
        allowClear: true,
        placeholder: 'Ölkə seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'regions',
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    }).on('change', function () {
        $('input[name="city"]').select2('val', null);
    });

    $('input[name="city"]').select2({
        allowClear: true,
        placeholder: 'Şəhər seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'cities',
                    region_id: $('input[name="region"]').val(),
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    });

    $('[name="choose_day"]').change(function () {
        var val = $(this).val();
        if (val == 'custom') $('.date').show();
        else $('.date').hide();
    });

    $('.searchBtn').on('click', function (e) {
        $('[name="users"]').val($('#users').val());
        $('[name="auction_status"]').val($('#auction_status').val());
        $('form').submit();
    });

    $('[name="start_date"], [name="end_date"]').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    if (!_.isEmpty({!! json_encode($filters) !!})) {
        let filters = JSON.parse('{!! json_encode($filters) !!}');
        $('[name="start_price"]').val(filters.start_price);
        $('[name="reserve_price"]').val(filters.reserve_price);
        $('#users').select2('val', filters.users);
        $('#auction_status').select2('val', filters.auction_status);
        $('input[name="category"]').select2('data', filters.category);
        $('input[name="sub_category"]').select2('data', filters.sub_category);
        $('input[name="sub_sub_category"]').select2('data', filters.sub_sub_category);
        $('input[name="region"]').select2('data', filters.region);
        $('input[name="city"]').select2('data', filters.city);
        $('[name="choose_day"]').val(filters.choose_day).trigger('change');
        $('input[name="start_date"]').val(filters.start_date);
        $('input[name="end_date"]').val(filters.end_date);
    }

</script>
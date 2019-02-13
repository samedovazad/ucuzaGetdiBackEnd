<style>
    button, input, select, textarea {
        font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    }

    .form-item .label {
        /*width: 180px;*/
        color: #333;
        vertical-align: top;
        /*text-align: right;*/
        font-weight: 600;
        padding: 15px 21px 9px 0px;
        margin-right: 5px;
        white-space: normal;
    }

    .form-item {
        margin-bottom: 23px;
        position: relative;
    }

    input,
    textarea {
        border: 0;
        overflow: auto;
        background: white no-repeat;
        background-image: linear-gradient(to bottom, #1abc9c, #1abc9c), linear-gradient(to bottom, silver, silver);
        background-size: 0 2px, 100% 1px;
        background-position: 50% 100%, 50% 100%;
        transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
    }

    textarea {
        width: 60%;
        padding: 10px 5px;
    }

    input:focus,
    textarea:focus {
        background-size: 100% 2px, 100% 1px;
        outline: none;
    }

    .form-item.required > .label:after {
        content: "*";
        color: #1abc9c;
        display: inline-block;
        width: 8px;
        font-size: 14px;
        font-weight: 400;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        margin-right: -8px;
    }

    input {
        width: 300px;
    }

    .form-control {
        display: inline-block;
        width: 9%;
    }

    /*.full-width {*/
        /*width: 300px !important;*/
    /*}*/

    .currency
    {
        width: 73px;
    }

    .text
    {
        margin-left: 11px;
    }

</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">Elan yaradın</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="height: auto;">
                                <div class="card-body collapse in">
                                    <div id="errors">
                                    </div>
                                    <div class="card-block">
                                            <div class="form-body">
                                                <div class="row">
                                                    <form id="folder-image-upload" action="/upload" method="post" class="dropzone" enctype="multipart/form-data">

                                                    </form>
                                                    <br>

                                                    <div class="form-item required text">
                                                        <label class="label" for="title">Başlıq</label>
                                                        <input type="text" class="ad-change-observe" name="title">
                                                    </div>

                                                    <div class="form-item required text">
                                                        <label class="label" for="description">Təsvir</label>
                                                        <textarea id="description" class="ad-change-observe description"
                                                                  name="description" maxlength="10000"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-item required">
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
                                                            <label class="label" for="sub_sub_category">Alt Kateqoriya</label>
                                                            <input type="text" class="full-width" name="sub_sub_category">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-item required">
                                                            <label class="label" for="start_price">Başlanma qiyməti</label>
                                                            <input name="start_price" class="ad-change-observe" type="text"
                                                                   value="" placeholder="Başlanma qiyməti" style="width: 120px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-item required">
                                                            <label class="label" for="reserve_price">Minimal satiş qiyməti</label>
                                                            <input name="reserve_price" class="ad-change-observe" type="text"
                                                                   value="" placeholder="Minimal satiş qiyməti" style="width: 130px;">
                                                            <select class="form-control currency" name="currency">
                                                                <option value="AZN">AZN</option>
                                                                <option value="USD">$</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-item required">
                                                            <label class="label" for="addPrice">Artim qiyməti</label>
                                                            <input name="increment_price" class="ad-change-observe" type="number"
                                                                   value="" placeholder="Artim qiyməti" style="width: 150px;" min="1" step="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-item required">
                                                            <label class="label" for="city">Ölkələr seçin</label>
                                                            <input type="text" class="full-width" name="region">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-item required">
                                                            <label class="label" for="city">Şəhər seçin</label>
                                                            <input type="text" class="full-width" name="city">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-item required">
                                                            <label class="label" for="endDay">Bitmə tarixi</label>
                                                            <input type="text" class="full-width" placeholder="Doğum tarixi" name="endDay">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 m-t-10 sm-m-t-10">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="submit"
                                    class="btn btn-success addEditBtn">Save
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>

    Dropzone.autoDiscover = false;

    var dz = new Dropzone("#folder-image-upload", {
        url: $('#folder-image-upload').attr('action'),
        maxFilesize: 500, // MB
        maxFiles: 20,
        addRemoveLinks: true,
        dictDefaultMessage: 'Yükləmək istədiyiniz faylları buraya sürükləyin',
        dictRemoveFile: 'Faylı silin',
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        autoProcessQueue: false
    });

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

    $(".phoneNumber").mask("(999) 999-99-99");

    $(".phoneNumber").on("blur", function () {
        var last = $(this).val().substr($(this).val().indexOf("-") + 1);

        if (last.length == 3) {
            var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
            var lastfour = move + last;
            var first = $(this).val().substr(0, 9);

            $(this).val(first + '-' + lastfour);
        }
    });


    $('.addEditBtn').on('click', function () {
       var form     = $('#folder-image-upload'),
           files    = form.get(0).dropzone.getAcceptedFiles(),
           title    = $('[name=title]').val(),
           tesvir   = $('#description').val(),
           category = $('[name=category]').val(),
           sub_category   = $('[name=sub_category]').val(),
           sub_sub_category = $('[name=sub_sub_category]').val(),
           start_price    = $('[name=start_price]').val(),
           reserve_price  = $('[name=reserve_price]').val(),
           currency       = $('[name=currency]').val(),
           increment_price = $('[name=increment_price]').val(),
           region   = $('[name=region]').val(),
           city     = $('[name=city]').val(),
           endDay   = $('[name=endDay]').val(),
           formData = new FormData();

        formData.append('_token', _token);
        formData.append('title', title);
        formData.append('tesvir', tesvir);
        formData.append('category', category);
        formData.append('sub_category', sub_category);
        formData.append('sub_sub_category', sub_sub_category);
        formData.append('start_price', start_price);
        formData.append('reserve_price', reserve_price);
        formData.append('currency', currency);
        formData.append('increment_price', increment_price);
        formData.append('region', region);
        formData.append('city', city);
        formData.append('endDay', endDay);

        Array.prototype.forEach.call(files, function (file) {
            formData.append('files[]', file);
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.auction.add_edit_auction', ['id' => 0]) }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 'error')
                {
                    $("#errors").html(response['errors']);
                }

                if(response.status == 'ok')
                {
                    location.reload();
                }
            },
            error: function (response) {

            }
        });

    });

    $('[name="endDay"]').datepicker({
        autoclose : true,
        format : 'dd-mm-yyyy'
    });

</script>
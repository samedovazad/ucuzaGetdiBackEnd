<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">İstifadəçi
                {{ $id == 0 ? ' yarat' : 'yə düzəliş et' }}</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="modalAddUser" role="form" autocomplete="off" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="height: auto;">
                                <div class="card-body collapse in">
                                    <div class="card-block">
                                        <form class="form">
                                            <div class="form-body">
                                                <div id="errors">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img id="avatar_img" style="cursor : pointer ; width: 180px; height: 180px" src="{{ $id == 0 ? asset('assets/admin/images/avatars/user.png') : $user->avatar() }}"  />
                                                        <div class="form-group">
                                                            <label style="margin-top: 20px;font-size: 13px;color: #4798ff;">
                                                                * Şəkil seçmək üçün üzərinə klikləyin
                                                            </label>
                                                            <label id="avatar_file" class="file center-block" style="visibility: hidden;">
                                                                <input type='file' name="avatar_file" onchange="readURL(this);" accept="image/*" />
                                                                <span class="file-custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="email">E-mail</label>
                                                            <input type="text" id="email" class="form-control" placeholder="E-mail" name="email" value="{{ $user['email'] }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username">İstifadəçi adı</label>
                                                            <input autocomplete="off" type="text" id="username" class="form-control" placeholder="İstifadəçi adı" name="username" value="{{ $user['username'] }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Parol</label>
                                                            <input autocomplete="false" type="password" id="password" class="form-control" placeholder="Parol" name="password">
                                                        </div>
                                                        <label class="display-inline-block custom-control custom-radio" style="float:right">
                                                            <input type="checkbox" onclick="passwordSee()" name="password_see"  class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description ml-0">Parolu göstər</span>
                                                        </label>

                                                    </div>
                                                </div>
                                                <h4 class="form-section"><i class="icon-head"></i> Ümumi istifadəçi tənzimləmələri</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">İstifadəçi tipi</label>
                                                            <select id="user_type" name="user_type" class="form-control" style="cursor:pointer;">
                                                                <option value="0" selected="" disabled="">Tip seçin</option>
                                                                <option value="{{ \App\Helper\Standarts::user_types['USER'] }}" {{ $user['user_type'] == \App\Helper\Standarts::user_types['USER'] ? 'selected' : '' }}>Normal istifadəçi</option>
                                                                <option value="{{ \App\Helper\Standarts::user_types['ADMIN'] }}" {{ $user['user_type'] == \App\Helper\Standarts::user_types['ADMIN'] ? 'selected' : '' }}>Admin istifadəçi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 group_type_div" style="display: none">
                                                        <div class="form-group">
                                                            <label for="gender">Admin Qrup tipi</label>
                                                            <select id="group_type" name="group_type" class="form-control" style="cursor:pointer;">
                                                                <option value="0" selected="" disabled="">Tip seçin</option>
                                                                @foreach(\App\Models\Admin\Group::all() as $group)
                                                                <option value="{{ $group->id }}" {{ $user['group_id'] == $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="form-section"><i class="icon-head"></i> Şəxsi məlumat</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Ad</label>
                                                            <input type="text" id="name" class="form-control" placeholder="Ad" name="name" value="{{ $user['name'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="surname">Soyad</label>
                                                            <input type="text" id="surname" class="form-control" placeholder="Soyad" name="surname" value="{{ $user['surname'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">Cinsi</label>
                                                            <select id="gender" name="gender" class="form-control">
                                                                <option value="0" selected="" disabled="">Cinsi</option>
                                                                <option value="k" {{ $user['gender'] == 'k' ? 'selected' : '' }}>Kişi</option>
                                                                <option value="q" {{ $user['gender'] == 'q' ? 'selected' : '' }}>Qadın</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="birthday">Doğum tarixi</label>
                                                            <input type="text" id="birthday" class="form-control" placeholder="Doğum tarixi" name="birthday" value="{{ $id > 0 ? Carbon\Carbon::parse($user['birthday'])->format('d-m-Y') : '' }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="icon-clipboard4"></i> Əlaqə məlumatları</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="region">Ölkə</label>
                                                            <input type="text" class="full-width" name="region">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="city">Şəhər</label>
                                                            <input type="text" name="city" class="full-width">
                                                            {{--<select id="city" name="city" class="form-control">--}}
                                                                {{--<option value="0" selected="" disabled="">Şəhər seçin</option>--}}
                                                                {{--<option value="1">Baku</option>--}}
                                                                {{--<option value="2">Şəki</option>--}}
                                                                {{--<option value="3">Qax</option>--}}
                                                            {{--</select>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fphone">Telefon nömrəsi</label>
                                                            <input type="text" id="fphone" class="form-control phoneNumber" placeholder="Telefon nömrəsi" name="fphone" value="{{ $user['first_phone'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sphone">Telefon nömrəsi (2)</label>
                                                            <input type="text" id="sphone" class="form-control phoneNumber" placeholder="Telefon nömrəsi (2)" name="sphone" value="{{ $user['second_phone'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Adres</label>
                                                    <textarea id="address" rows="5" class="form-control" name="address" placeholder="Address">{{ $user->address }}</textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 m-t-10 sm-m-t-10">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="submit"
                                    class="btn btn-{{ $id == 0 ? 'success' : 'primary' }} addEditBtn">{{ $id == 0 ? 'Save' : 'Edit' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>


    $('#modalAddUser').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
            formData.append('_token', _token);
            //returned_data = alphaFormSubmit("{{ route('admin.users.add_edit_action',$id) }}",formData);
            //returned_data = alphaFormSubmit("{{ route('admin.users.add_edit_action',$id) }}",'POST',formData);


        $.ajax({
            url: "{{ route('admin.users.add_edit_action',$id) }}",
            type: 'POST',
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
            error : function(response){
                return response;
            }
        });
        {{--if(alphaFormSubmit("{{ route('admin.users.add_edit_action',$id) }}",'POST',formData) == "ok"){--}}
            {{--location.reload();--}}
        {{--}--}}
    });


    $('[name="user_type"]').on('change',function(){
        if($(this).val() === '{{ \App\Helper\Standarts::user_types['ADMIN'] }}'){
            $('.group_type_div').show();
        }
        else{
            $('.group_type_div').hide();
        }
    });

    $('#avatar_img').on('click',function () {
        $('#avatar_file input').click();
    });


    $('input[name="region"]').select2({
        allowClear:true,
        placeholder : 'Ölkə seçin',
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
    }).on('change',function(){
        $('input[name="city"]').select2('val',null);
    });

    $('input[name="city"]').select2({
        allowClear:true,
        placeholder : 'Şəhər seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    param: 'cities',
                    region_id : $('input[name="region"]').val(),
                    q: word,
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    });

    $('input[name="region"]').select2('data',{!! json_encode($select2Data['regions']) !!});
    $('input[name="city"]').select2('data',{!! json_encode($select2Data['cities']) !!});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar_img')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#avatar_img').on('click',function () {
       $('input[name="avatar"]').click();
    });

    function passwordSee() {
        var x = $('input[name="password"]'),
            type = x.attr('type');
        if (type === "password") {
            $('.custom-control-description').text('Parolu gizlət');
            x.attr('type','text');
        } else {
            x.attr('type','password');
            $('.custom-control-description').text('Parolu göstər');
        }
    }

    $(".phoneNumber").mask("(999) 999-99-99");

    $(".phoneNumber").on("blur", function() {
        var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

        if( last.length == 3 ) {
            var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
            var lastfour = move + last;
            var first = $(this).val().substr( 0, 9 );

            $(this).val( first + '-' + lastfour );
        }
    });

    $('[name="birthday"]').datepicker({
        autoclose : true,
        format : 'dd-mm-yyyy'
    });

    $('input[name="region"]').select2({
        allowClear:true,
        placeholder : 'Ölkə seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    'param' : 'regions',
                    'q' : word
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    }).on('change',function () {
        $('input[name="city"]').select2('val',null);
    });

    $('input[name="city"]').select2({
        allowClear:true,
        placeholder : 'Şəhər seçin',
        ajax: {
            url: '{{ route('admin.select2') }}',
            dataType: 'json',
            data: function (word, page) {
                return {
                    'param' : 'cities',
                    'q' : word,
                    'region_id' : $('input[name="region"]').val()
                };
            },
            results: function (data, page) {
                return data;
            },
            cache: true
        },
    });

</script>

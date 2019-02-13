<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">İstifadəçi
                hüququ{{ $id == 0 ? ' yarat' : 'na düzəliş et' }}</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div class="row" id="errors">

                </div>
                <form id="modalAddPriv" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group form-group-default required" aria-required="true">
                                <label>Grup adı</label>
                                <input type="text" class="form-control" value="{{ $group->group_name }}" name="group_name" maxlength="50" required=""
                                       aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Modullar</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            @foreach (\App\Helper\Standarts::$adminModules as $typeK => $type)
                                @if( isset($type['child']) )
                                    <div class="col-md-12">
                                        <label class="col-md-7"><i class="{{ $type['icon'] }}"></i> {{ $type['name'] }}:</label>
                                        @foreach ($type['child'] as $K => $t)
                                            <div class="col-md-12" style="padding-left: 50px">
                                                <label class="col-md-5"><i class="{{ $t['icon'] }}"></i> {{ $t['name'] }}:</label>
                                                <div class="col-md-7 radio radio-success">
                                                    <label class="display-inline-block custom-control custom-radio">
                                                        <input type="radio" id="{{ $t['route'] }}1"
                                                               name="available_modules[{{ $t['route'] }}]"
                                                               checked class="custom-control-input" value="1">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Görmür</span>
                                                    </label>
                                                    <label class="display-inline-block custom-control custom-radio">
                                                        <input type="radio" id="{{ $t['route'] }}2"
                                                               name="available_modules[{{ $t['route'] }}]"
                                                               {{ $id >0 && $group->getModulePriv($t['route']) == 2 ? 'checked' : '' }}
                                                               class="custom-control-input" value="2">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Görür</span>
                                                    </label>
                                                    <label class="display-inline-block custom-control custom-radio">
                                                        <input type="radio" id="{{ $t['route'] }}2"
                                                               name="available_modules[{{ $t['route'] }}]"
                                                               {{ $id >0 && $group->getModulePriv($t['route']) == 3 ? 'checked' : '' }}
                                                               class="custom-control-input" value="3">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Əlavə edir</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <label class="col-md-5"><i class="{{ $type['icon'] }}"></i> {{ $type['name'] }}:</label>
                                        <div class="col-md-7 radio radio-success">
                                            <label class="display-inline-block custom-control custom-radio">
                                                <input type="radio" id="{{ $type['route'] }}1"
                                                       name="available_modules[{{ $type['route'] }}]"
                                                       checked class="custom-control-input" value="1">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Görmür</span>
                                            </label>
                                            <label class="display-inline-block custom-control custom-radio">
                                                <input type="radio" id="{{ $type['route'] }}2"
                                                       name="available_modules[{{ $type['route'] }}]"
                                                       {{ $id >0 && $group->getModulePriv($type['route']) == 2 ? 'checked' : '' }}
                                                       class="custom-control-input" value="2">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Görür</span>
                                            </label>
                                            <label class="display-inline-block custom-control custom-radio">
                                                <input type="radio" id="{{ $type['route'] }}2"
                                                       name="available_modules[{{ $type['route'] }}]"
                                                       {{ $id >0 && $group->getModulePriv($type['route']) == 3 ? 'checked' : '' }}
                                                       class="custom-control-input" value="3">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Əlavə edir</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4 m-t-10 sm-m-t-10">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="button"
                                    class="btn btn-{{ $id == 0 ? 'success' : 'primary' }} addEditBtn">{{ $id == 0 ? 'Save' : 'Edit' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $("#myModal #modalAddPriv .addEditBtn").click(function(e){
       e.preventDefault();
        let data = new FormData($("#myModal #modalAddPriv")[0]);
        data.append('_token', _token);
        $.ajax({
            url: "{{ route('admin.priv.add_edit_action',['user' => $id]) }}",
            type: "POST",
            data: data,
            async: false,
            success: function (response) {
                if (response['status'] == 'ok') location.reload();
                else $("#myModal #errors").html(response['errors']);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>

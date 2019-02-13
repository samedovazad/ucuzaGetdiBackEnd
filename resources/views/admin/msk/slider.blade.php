@extends('admin.layouts.base')
@section('title', 'Documentation')
@section('content')
    <div class="row">
        <div>
            <h3>Sliders</h3>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-warning"
                           style="float: right; width : 80px; height : 40px; margin-bottom: 12px;"
                           href="javascript:loadModal('{{ route('admin.slider.slider_add_edit',['id' => 0]) }}',{},'modal-lg')">
                            <i class="icon-android-add" style="font-size: 22px;"></i>
                        </a>
                    </div>
                </div>
            </div>


            @foreach($sliders as $slider)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card" style="height: 440px;">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" style="width: 330px; height: 220px" src="{{ $slider->slidersFile() }}" alt="Card image cap">
                            <div class="card-block" id="{{ $slider->id }}">
                                <h4 class="card-title">{{ $slider->title }}</h4>
                                <p class="card-text">{{ $slider->description }}</p>
                                <a class="btn btn-danger btn-sm emeliyyat sil"
                                   data-toggle="tooltip" data-placement="top" data-original-title="Sil"
                                   href="#">
                                    <i class="icon-trash"></i>
                                </a>

                                <a class="btn btn-blue btn-sm emeliyyat"
                                   data-toggle="tooltip" data-placement="top" data-original-title="Düzəliş et"
                                   href="javascript:loadModal('{{ route('admin.slider.slider_add_edit',['id' => $slider->id]) }}',{},'modal-lg')">
                                    <i class="icon-pencil"></i>
                                </a>

                                <label class="display-inline-block custom-control custom-radio">
                                    <input type="checkbox" name="checkbox" class="custom-control-input"
                                            {{ $slider->is_checked ? 'checked' : '' }}>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description ml-0">Göstər</span>
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $sliders->links() }}
@endsection
@section('css')
    <style>
        .pagination
        {
            float: right;
            margin-right: 14px;
        }

        .emeliyyat
        {
            margin-top: 80px;
            float: right;
            padding: 7px;
            width: 45px;
            margin-left: 10px;
        }
    </style>
@endsection
@section('js')
    <script>

        $('.sil').click(function () {
            var id = $(this).closest('div').attr('id');

            $.confirm({
                title: 'Sil',
                content: 'Sliders silməğə əminsiniz',
                buttons: {
                    somethingElse: {
                        text: 'Sil',
                        btnClass: 'btn-success',
                        action: function () {
                            $.post('{{ route('admin.slider.delete') }}', {
                                id: id,
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

        $('[type=checkbox]').on('input', function () {
            let formData = new FormData();
            formData.append('_token', _token);
            formData.append('is_checked', $(this).is(':checked') ? 1 : 0);
            formData.append('id', $(this).parents('div').eq(0).attr('id'));

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.slider.checked') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                },
                error: function (response) {
                }
            });
        });

    </script>
@endsection
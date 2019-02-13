@extends('admin.layouts.base')
@section('title', 'Documentation')
@section('content')
    <div class="row">
        <div>
            <h3>{{ __('messages.documentation') }}</h3>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-warning"
                           style="float: right; width : 80px; height : 40px; margin-bottom: 12px;"
                           href="javascript:loadModal('{{ route('admin.doc.add_edit',['id' => 0]) }}',{},'modal-lg')">
                            <i class="icon-android-add" style="font-size: 22px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            @foreach($docs as $doc)
                <div class="col-md-12">
                    <div class="card" style="height: 200px;">
                        <div class="card-header" id="{{ $doc->id }}">
                            <h4 class="card-title">
                                <code>{{ $doc->title }}</code>

                                <a class="btn btn-danger btn-sm emeliyyat sil"
                                   data-toggle="tooltip" data-placement="top" data-original-title="Sil"
                                   href="#">
                                    <i class="icon-trash"></i>
                                </a>

                                <a class="btn btn-blue btn-sm emeliyyat"
                                   data-toggle="tooltip" data-placement="top" data-original-title="Düzəliş et"
                                   href="javascript:loadModal('{{ route('admin.doc.add_edit',['id' => $doc->id]) }}',{},'modal-lg')">
                                    <i class="icon-pencil"></i>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <h5>{{ $doc->description }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $docs->links() }}
        </div>
    </div>
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
            float: right;
            padding: 6px;
            width: 45px;
            margin-left: 10px;
        }

    </style>
@endsection
@section('js')
    <script>
        $('.sil').click(function () {
            var docID = $(this).closest('div').attr('id');

            $.confirm({
                title: 'Sil',
                content: 'Documentation silməğə əminsiniz',
                buttons: {
                    somethingElse: {
                        text: 'Sil',
                        btnClass: 'btn-success',
                        action: function () {
                            $.post('{{ route('admin.doc.delete') }}', {
                                docID: docID,
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
    </script>
@endsection
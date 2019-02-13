@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div class="btn-group">
            <a class="btn btn-success"
               href="javascript:loadModal('{{ route('admin.priv.add_edit',['id' => 0]) }}',{},'modal-lg')">
                <i class="icon-android-add" style="font-size: 20px;"></i>
            </a>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table user_priv_table">
                    <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Qrup adı</th>
                        <th>Əməliyyat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td scope="row"></td>
                            <td>{{ $group->group_name }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="javascript:loadModal('{{ route('admin.priv.add_edit',['id' => $group->id]) }}',{},'modal-lg')">
                                    <i class="icon-pencil3"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger deleteAction">
                                    <i class="icon-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        orderTable('.user_priv_table');
    </script>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('title') İstifadəçi hüquqları @endsection


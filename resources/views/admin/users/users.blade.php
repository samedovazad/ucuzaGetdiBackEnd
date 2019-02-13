@extends('admin.layouts.base')

@section('content')
    <div class="row">
        <div>
            <h3>İstifadəçilər</h3>
            <div class="row">
                <div class="col-md-11">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" id="active-tab" data-toggle="tab" href="#mesul_shexsler"
                               aria-controls="active" aria-expanded="true">Məsul şəxslər</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link-tab" data-toggle="tab" href="#istifadechiler" style="color: #6ab8b1;"
                               aria-controls="link" aria-expanded="false">İstifadəçilər</a>
                        </li>

                    </ul>
                </div>
                <div class="col-md-1">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-success" style="float: right;width : 80px;height : 40px;"
                               href="javascript:loadModal('{{ route('admin.users.ad_edit',['id' => 0]) }}',{},'modal-lg')">
                                <i class="icon-person-add" style="font-size: 20px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content px-1 pt-1">
                <div role="tabpanel" class="tab-pane fade active in" id="mesul_shexsler" aria-labelledby="active-tab"
                     aria-expanded="true">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>Ad Soyad</th>
                                <th>Email</th>
                                <th>Telefon nömrəsi</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $user->fullname()}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->first_phone}}</td>
                                    <td>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-gray btn-sm"
                                                    data-toggle="tooltip" data-placement="top" data-original-title="Ətraflı">
                                                <i class="icon-info"></i>
                                            </button>
                                            <a class="btn btn-blue btn-sm"
                                               data-toggle="tooltip" data-placement="top" data-original-title="Düzəliş et"
                                               href="javascript:loadModal('{{ route('admin.users.ad_edit',['id' => $user->id]) }}',{},'modal-lg')">
                                                <i class="icon-pencil"></i>
                                            </a>
                                            @if ($user->is_active == 1)
                                                <a class="btn btn-warning btn-sm"
                                                        href="#"
                                                        data-toggle="tooltip" data-placement="top" data-original-title="Aktiv et">
                                                    <i class="icon-pushpin"></i>
                                                </a>
                                            @endif
                                            {{--@if ($user->isIgnore() != 1)--}}
                                                <a class="btn btn-black btn-sm"
                                                   href="#"
                                                   data-toggle="tooltip" data-placement="top" data-original-title="Ban et">
                                                    <i class="icon-hand-stop-o"></i>
                                                </a>
                                            {{--@endif--}}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    data-toggle="tooltip" data-placement="top" data-original-title="Sil">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="istifadechiler" aria-labelledby="active-tab"
                     aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="bg-teal bg-lighten-4">
                            <tr>
                                <th>#</th>
                                <th>Ad Soyad</th>
                                <th>Email</th>
                                <th>Telefon nömrəsi</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $admin->name }}</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="icon-info"></i> Info
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm">
                                                <i class="icon-cross2"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="icon-check2"></i> Save
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css\bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select2/select2.css') }}">

@endsection

@section('title') İstifadəçilər @endsection


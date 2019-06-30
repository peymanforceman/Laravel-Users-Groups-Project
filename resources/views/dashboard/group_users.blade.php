@extends('layouts.dashboard')

@section('head')
    <link rel="stylesheet"
          href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{URL::asset('css/chosen.css') }}">
@endsection
@section('content')
    <section class="content">
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if (session('status'))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @if($users->first() != null)
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@lang('admin.Users List') :</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="group_table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.User Name')</th>
                                    <th>@lang('admin.Member of')</th>
                                    <th>@lang('admin.Actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>@if(!$user->groups->isEmpty()) @foreach($user->groups as $group)
                                                @if(!$loop->first) , @endif {{ $group->name }}
                                            @endforeach @else {{ __('Nothing') }} @endif</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('edit_user',['id'=>$user->id]) }}"
                                                   class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                <button type="button" data-toggle="modal"
                                                        data-target="#remove_cat_{{ $user->id }}"

                                                        class="btn btn-default btn-flat"><i class="fa fa-trash"></i>
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
            @else
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-body">
                                <h3>{{ __('admin.This group has no member') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @foreach($users as $user)
            <div class="modal modal-danger fade" id="remove_cat_{{ $user->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('admin.Warning',['group_name'=>$user->name])</h4>
                        </div>
                        <div class="modal-body">
                            <p>@lang('admin.Warning message remove user',['username'=>$user->name])</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">@lang('admin.Close')</button>
                            <a href="{{ route('remove_user',['id'=>$user->id]) }}"
                               class="btn btn-outline">@lang('admin.Remove User')</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    </div>
@endsection

@section('footer')
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{URL::asset('js/chosen.jquery.min.js') }}"></script>
    <script>
        $(function () {
            $('#group_table').DataTable();
            $(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});
        })
    </script>
@endsection

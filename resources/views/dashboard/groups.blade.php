@extends('layouts.dashboard')

@section('head')
    <link rel="stylesheet"
          href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
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
        @if($groups->first() != null)
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.Groups List') :</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="group_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.Group Name')</th>
                                <th>@lang('admin.Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('edit_group',['id'=>$group->id]) }}"
                                               class="btn btn-default"><i class="fa fa-edit"></i></a>
                                            <button type="button" data-toggle="modal"
                                                    data-target="#remove_cat_{{ $group->id }}"

                                                    class="btn btn-default btn-flat"><i class="fa fa-trash"></i>
                                            </button>
                                            <a href="{{ route('group_users',['id'=>$group->id]) }}"
                                               class="btn btn-default btn-flat">@lang('admin.Show Users')</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.Add A New Group') :</h3>
                </div>
                <form method="post" action="{{ route('add_group') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">@lang('admin.Group Name') :</label>
                            <input type="text" class="form-control" name="group_name"
                                   placeholder="@lang('admin.Group Name')">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-lg btn-primary">@lang('admin.Add Group')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach($groups as $group)
        <div class="modal modal-danger fade" id="remove_cat_{{ $group->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('admin.Warning',['group_name'=>$group->name])</h4>
                    </div>
                    <div class="modal-body">
                        <p>@lang('admin.Warning message remove group',['group_name'=>$group->name])</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('admin.Close')</button>
                        <a href="{{ route('remove_group',['id'=>$group->id]) }}" class="btn btn-outline">@lang('admin.Remove Group')</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('footer')
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#group_table').DataTable();
        })
    </script>
@endsection
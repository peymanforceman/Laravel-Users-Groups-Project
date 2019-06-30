@extends('layouts.dashboard')
@section('head')
    <link rel="stylesheet"
          href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{URL::asset('css/chosen.css') }}">
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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.Edit User') :</h3>
                </div>
                <form method="post" action="{{ route('edit_user',['id'=>$user->id]) }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">@lang('admin.User Name') :</label>
                            <input type="text" class="form-control" name="user_name" value="{{ $user->name }}"
                                   placeholder="@lang('admin.User Name')">
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('admin.Groups Membership') :</label>
                            <select name="groups[]" data-placeholder="@lang('admin.Groups Membership')" multiple
                                    class="chosen-select" tabindex="8">
                                @foreacH($groups as $group)
                                    <option  @if($user->groups->where('id', $group->id)->first()) selected="selected"
                                             @endif value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-lg btn-primary">@lang('admin.Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{URL::asset('js/chosen.jquery.min.js') }}"></script>
    <script>
        $(function () {
            $(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});
        })
    </script>
@endsection
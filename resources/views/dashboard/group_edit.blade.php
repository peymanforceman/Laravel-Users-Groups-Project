@extends('layouts.dashboard')

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
                    <h3 class="box-title">@lang('admin.Edit Group') :</h3>
                </div>
                <form method="post" action="{{ route('edit_group',['id'=>$group->id]) }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">@lang('admin.Group Name') :</label>
                            <input type="text" class="form-control" name="group_name" value="{{ $group->name }}"
                                   placeholder="@lang('admin.Group Name')">
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
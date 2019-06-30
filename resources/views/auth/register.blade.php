@extends('layouts.login_register')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <p>@lang('admin.welcome_msg')</p>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">@lang('admin.reg_admin')</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group @error('name') has-error @enderror">
                <label class="control-label" for="inputError">{{ __('Name') }}</label>
                <input placeholder="{{ __('Name') }}" id="name" type="text"
                       class="form-control" name="name" value="{{ old('name') }}"
                       required autocomplete="name" autofocus>

                <span class="help-block">
                    @error('name')
                        <strong>{{ $message }}</strong>
                    @enderror
                </span>
            </div>

            <div class="form-group @error('email') has-error @enderror">
                <label class="control-label" for="inputError">{{ __('E-Mail Address') }}</label>
                <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
                       class="form-control " name="email" value="{{ old('email') }}"
                       required autocomplete="email">
                <span class="help-block">
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </span>
            </div>

            <div class="form-group @error('password') has-error @enderror">
                <label class="control-label" for="inputError">{{ __('Password') }}</label>
                <input placeholder="{{ __('Password') }}" id="password" type="password"
                       class="form-control" name="password" required
                       autocomplete="new-password">
                <span class="help-block">
                    @error('password')
                        <strong>{{ $message }}</strong>
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputError">{{ __('Confirm Password') }}</label>
                <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="row">
                <div class="col-xs-8">

                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
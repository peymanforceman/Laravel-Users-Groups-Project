@extends('layouts.login_register')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <p>@lang('admin.welcome_msg')</p>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">@lang('admin.reg_admin')</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group @error('password') has-error @enderror">
                    <label class="control-label" for="inputError">{{ __('E-Mail Address') }}</label>
                    <input placeholder="Email" id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <span class="help-block">
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </span>
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <label class="control-label" for="inputError">{{ __('Password') }}</label>
                    <input placeholder="Password" id="password" type="password" class="form-control" name="password"
                           required autocomplete="current-password">
                    <span class="help-block">
                    @error('password')
                        <strong>{{ $message }}</strong>
                    @enderror
                </span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ __('Login') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
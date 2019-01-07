@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="page-wrapper-fluid background-light">
                    <div class="conversi-container-small text-center">
                    <div class="forgot-password-wrapper">
                        <div class="conversi-container-tiny">
                            <h4 class="login-signup-header">Reset your password?</h4>
                            <p class="forgot-password-descp">
                                Please enter your new password.
                            </p>
                                <form class="" method="POST" action="{{ route('resetpassword.change') }}">
                                @csrf
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="form-group">
                                        <input id="password" placeholder="Enter your new password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input id="login_password" type="password" class="form-control"  placeholder="Retype your new password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                <button type="submit" class="btn btn-secondary fluid-width">Reset</button>
                            </form>
                            <div class="m-t-medium">
                                Or <a href="#logInModal" class="link-primary" data-toggle="modal">login</a> instead
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
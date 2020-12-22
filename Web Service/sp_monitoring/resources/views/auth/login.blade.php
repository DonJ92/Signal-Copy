@extends('layouts.withoutmenu')

@section('content')
    <div class="login-container">
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="panel panel-body login-form">
                            <div>
                                <form method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <fieldset>
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}" autofocus>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <button type="submit" class="btn btn-lg btn-success btn-block">@lang('common.login')</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

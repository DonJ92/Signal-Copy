@extends('layouts.withmenu')
@section('title', trans('setting.title'))
@section('page_title', trans('setting.title'))
@section('page_title_ico', trans('setting.title_ico'))

@section('content')
    <div class="content">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" id="success_div">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            @if ($errors->has('failed'))
                <div class="alert alert-danger" id="failed_div">
                    <strong>{{ $errors->first('failed') }}</strong>
                </div>
            @endif
            <div class="col-lg-4">
                <form method="post" action="{{ route('setting.updatepwd') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label">{{ trans('setting.current_pwd') }}</label>
                        <div class="{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <input class="form-control" type="password" id="current_password" name="current_password" value="{{ old('current_password') }}">
                        @if ($errors->has('current_password'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">{{ trans('setting.new_pwd') }}</label>
                        <div class="{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <input class="form-control" type="password" id="new_password" name="new_password">
                        @if ($errors->has('new_password'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                        <label class="control-label">{{ trans('setting.confirm_pwd') }}</label>
                        <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation">
                        @if ($errors->has('new_password_confirmation'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">{{ trans('button.update_btn') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function() {
            $('#setting').addClass('active');
            getaccountdetailList();
        });
    </script>
@endsection
@extends('layouts.withmenu')
@section('title', trans('accountlist.register.title'))
@section('page_title', trans('accountlist.register.title'))
@section('page_title_ico', trans('accountlist.register.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('accountlist.registeraction') }}">
            {{ csrf_field() }}
            <p> {{trans('accountlist.register.desc')}} </p>
            <br>
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
            
            @if ($errors->has('customer_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('customer_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('customer_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('accountlist.register.customer_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="customer_id" name="customer_id" value="{{ old('customer_id') }}">
                </div>
            </div>

			@if ($errors->has('account_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('account_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('account_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('accountlist.register.account_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="account_id" name="account_id" value="{{ old('account_id') }}">
                </div>
            </div>

            @if ($errors->has('broker_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('broker_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('broker_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('accountlist.register.broker_name') }}</label>
                <div class="col-lg-10">
                    <select class="form-control" id="broker_id" name="broker_id">
                        @foreach ($brokers as $broker)
                            <option value="{{ $broker->id }}" @if(old('broker_id') == $broker->id) selected @endif>{{ $broker->alias_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row form-group text-center">
                <button type="submit" class="btn bg-teal">{{ trans('button.register_btn') }}</button>
                <a href="{{ route('accountlist') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            $('#account_list').addClass('active');
        });
    </script>
@endsection
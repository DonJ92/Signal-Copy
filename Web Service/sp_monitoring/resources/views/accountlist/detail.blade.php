@extends('layouts.withmenu')
@section('title', trans('accountlist.detail.title'))
@section('page_title', trans('accountlist.detail.title'))
@section('page_title_ico', trans('accountlist.detail.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('accountlist.updateaction') }}">
            {{ csrf_field() }}
            <p> {{trans('accountlist.detail.desc')}} </p>
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

            <input class="form-control" type="hidden" id="id" name="id" value="{{$id}}">
            
            @if ($errors->has('customer_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('customer_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('customer_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('accountlist.detail.customer_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="customer_id" name="customer_id" value="{{ is_null(old('customer_id')) ? $customer_id : old('customer_id') }}">
                </div>
            </div>

			@if ($errors->has('account_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('account_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('account_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('accountlist.detail.account_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="account_id" name="account_id" value="{{ is_null(old('account_id')) ? $account_id : old('account_id') }}">
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
                        @foreach ($brokers as $broker_info)
                            <option value="{{ $broker_info->id }}" {{ !is_null(old('broker_id')) ? (old('broker_id') == $broker_info->id ? 'selected' : '') : ($broker['id'] == $broker_info->id  ? 'selected' : '') }}>{{ $broker_info->alias_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row form-group text-center">
                <button type="submit" class="btn bg-teal">{{ trans('button.update_btn') }}</button>
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

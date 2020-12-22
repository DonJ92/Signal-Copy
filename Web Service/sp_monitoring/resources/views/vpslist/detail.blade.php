@extends('layouts.withmenu')
@section('title', trans('vpslist.detail.title'))
@section('page_title', trans('vpslist.detail.title'))
@section('page_title_ico', trans('vpslist.detail.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('vpslist.updateaction') }}">
            {{ csrf_field() }}
            <p> {{trans('vpslist.detail.desc')}} </p>
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
            
            @if ($errors->has('vps_name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('vps_name') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('vps_name')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('vpslist.detail.vps_name') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="vps_name" name="vps_name" value="{{ is_null(old('vps_name')) ? $vps_name : old('vps_name') }}">
                </div>
            </div>

            @if ($errors->has('customer_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('customer_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('customer_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('vpslist.detail.customer_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="customer_id" name="customer_id" value="{{ is_null(old('customer_id')) ? $customer_id : old('customer_id') }}">
                </div>
            </div>
            
            @if ($errors->has('vps_ip'))
                <span class="text-danger">
                    <strong>{{ $errors->first('vps_ip') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('vps_ip')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('vpslist.detail.vps_ip') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="vps_ip" name="vps_ip" value="{{ is_null(old('vps_ip')) ? $vps_ip : old('vps_ip') }}">
                </div>
            </div>
            
            <div class="row form-group text-center">
                <button type="submit" class="btn bg-teal">{{ trans('button.update_btn') }}</button>
                <a href="{{ route('vpslist') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            $('#vps_list').addClass('active');
        });
    </script>
@endsection

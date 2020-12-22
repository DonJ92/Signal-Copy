@extends('layouts.withmenu')
@section('title', trans('broker.detail.title'))
@section('page_title', trans('broker.detail.title'))
@section('page_title_ico', trans('broker.detail.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('broker.updateaction') }}">
            {{ csrf_field() }}
            <p> {{trans('broker.detail.desc')}} </p>
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

            <input class="form-control" type="hidden" id="id" name="id" value="{{ $broker->id }}">
            
            @if ($errors->has('alias_name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('alias_name') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('alias_name')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('broker.register.alias_name') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="alias_name" name="alias_name" value="{{ old('alias_name') ?: $broker->alias_name }}">
                </div>
            </div>
            
            @if ($errors->has('name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('name')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('broker.register.name') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') ?: $broker->name }}">
                </div>
            </div>
            
            <div class="row form-group text-center">
                <button type="submit" class="btn bg-teal">{{ trans('button.update_btn') }}</button>
                <a href="{{ route('broker') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            $('#broker_list').addClass('active');
        });
    </script>
@endsection

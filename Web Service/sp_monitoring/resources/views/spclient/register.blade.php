@extends('layouts.withmenu')
@section('title', trans('spclient.register.title'))
@section('page_title', trans('spclient.register.title'))
@section('page_title_ico', trans('spclient.register.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('spclient.registeraction') }}">
            {{ csrf_field() }}
            <p> {{trans('spclient.register.desc')}} </p>
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
            
            @if ($errors->has('client_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('client_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('client_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.client_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" id="client_id" name="client_id" value="{{ old('client_id') }}">
                </div>
            </div>

            @if ($errors->has('account_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('account_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('account_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.account_id') }}</label>
                <div class="col-lg-10">
                    <select class="form-control" id="account_id" name="account_id">
                        <option value=""></option>
                        @foreach ($account_list as $account_info)
                            <option value="{{ $account_info['id'] }}" @if( old('account_id') == $account_info['id'] ) selected @endif>{{ $account_info['account_id'] . ' (' . $account_info['customer_id'] . ', ' . $account_info['broker']['alias_name'] . ' )' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($errors->has('vps_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('vps_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('vps_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.vps_id') }}</label>
                <div class="col-lg-10">
                    <select class="form-control" id="vps_id" name="vps_id">
                        <option value=""></option>
                        @foreach ($vps_list as $vps_info)
                            <option value="{{ $vps_info['id'] }}" @if( old('vps_id') == $vps_info['id'] ) selected @endif>{{ $vps_info['vps_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($errors->has('signal_type'))
                <span class="text-danger">
                    <strong>{{ $errors->first('signal_type') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('signal_type')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.signal_type') }}</label>
                <div class="col-lg-10">
                    <select class="form-control" id="signal_type" name="signal_type">
                        <option value="">-- {{ trans('spclient.list.signal_type') }} --</option>
                        <option value="{{ SIGNAL_PROVIDER }}" @if( old('signal_type') == SIGNAL_PROVIDER) selected @endif>{{ trans('common.spclient.singal_provider') }}</option>
                        <option value="{{ SIGNAL_COPIER }}" @if( old('signal_type') == SIGNAL_COPIER) selected @endif>{{ trans('common.spclient.signal_copier') }}</option>
                    </select>
                </div>
            </div>
            
			@if ($errors->has('signalmaster_id'))
                <span class="text-danger">
                    <strong>{{ $errors->first('signalmaster_id') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('signalmaster_id')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.signalmaster_id') }}</label>
                <div class="col-lg-10">
                    <select class="form-control" id="signalmaster_id" name="signalmaster_id">
                        <option value="">-- {{ trans('spclient.list.signalmaster_id') }} --</option>
						@foreach ($master_list as $master)
							<option value="{{ $master['id'] }}" {{ old('signalmaster_id') == $master['id'] ? 'selected' : '' }}> {{ $master['client_id'] }}</option>
						@endforeach
                    </select>
                </div>
            </div>
            
            @if ($errors->has('token'))
                <span class="text-danger">
                    <strong>{{ $errors->first('token') }}</strong>
                </span>
            @endif
            <div class="row form-group @if($errors->has('token')) has-error @endif">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('spclient.register.token') }}</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input class="form-control" type="text" id="token" name="token" value="{{ old('token') }}">
                        <span class="input-group-btn">
                            <button id="gen_token" class="btn bg-blue">{{ trans('button.generate_btn') }}</button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row form-group text-center">
                <button type="submit" class="btn bg-teal">{{ trans('button.register_btn') }}</button>
                <a href="{{ route('spclient') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            $('#spclient_list').addClass('active');
        });

		$(document).ready(function() {
			$('select[name=signal_type]').change(function() {
				if ($(this).val() == "{{ SIGNAL_PROVIDER }}") {
					$('select[name=signalmaster_id]').val('');
					$('select[name=signalmaster_id]').prop('disabled', true);
				}
				else if ($(this).val() == "{{ SIGNAL_COPIER }}") {
					$('select[name=signalmaster_id]').prop('disabled', false);
				}
			});
            $('select[name=signal_type]').change();
            
            $('#gen_token').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('spclient.getnewtoken') }}",
                    type: 'GET',
                    success: function (response) {
                        $('#token').val(response);
                    }
                });
            });
		});
    </script>
@endsection
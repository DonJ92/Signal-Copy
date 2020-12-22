@extends('layouts.withmenu')
@section('title', trans('paramstate.detail.title'))
@section('page_title', trans('paramstate.detail.title'))
@section('page_title_ico', trans('paramstate.detail.title_ico'))

@section('content')
    <div class="content">
        <form class="form-horizontal col-lg-6" method="POST" enctype="multipart/form-data" action="#">
            {{ csrf_field() }}
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

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.client_id') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="client_id" name="client_id" value="{{ $client_id }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.symbol_name') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="symbol_name" name="symbol_name" value="{{ $symbol_name }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_auto_open') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_auto_open" name="b_auto_open" value="{{ $b_auto_open }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_auto_fill_lots') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_auto_fill_lots" name="b_auto_fill_lots" value="{{ $b_auto_fill_lots }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_auto_close') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_auto_close" name="b_auto_close" value="{{ $b_auto_close }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_price_min') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_price_min" name="b_price_min" value="{{ $b_price_min }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_price_max') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_price_max" name="b_price_max" value="{{ $b_price_max }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_delta_pt') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_delta_pt" name="b_delta_pt" value="{{ $b_delta_pt }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_target_pt') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_target_pt" name="b_target_pt" value="{{ $b_target_pt }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_auto_open') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_auto_open" name="s_auto_open" value="{{ $s_auto_open }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_auto_fill_lots') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_auto_fill_lots" name="s_auto_fill_lots" value="{{ $s_auto_fill_lots }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_auto_close') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_auto_close" name="s_auto_close" value="{{ $s_auto_close }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_price_min') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_price_min" name="s_price_min" value="{{ $s_price_min }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_price_max') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_price_max" name="s_price_max" value="{{ $s_price_max }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_delta_pt') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_delta_pt" name="s_delta_pt" value="{{ $s_delta_pt }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_target_pt') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_target_pt" name="s_target_pt" value="{{ $s_target_pt }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.b_lots') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="b_lots" name="b_lots" value="{{ $b_lots }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.s_lots') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="s_lots" name="s_lots" value="{{ $s_lots }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.balance') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="balance" name="balance" value="{{ $balance }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.equity') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="equity" name="equity" value="{{ $equity }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.margin') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="margin" name="margin" value="{{ $margin }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.free_margin') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="free_margin" name="free_margin" value="{{ $free_margin }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.margin_level') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="margin_level" name="margin_level" value="{{ $margin_level }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.daily_profit') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="daily_profit" name="daily_profit" value="{{ $daily_profit }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.position_profit') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="position_profit" name="position_profit" value="{{ $position_profit }}">
                </div>
            </div>

            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.point_value') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="point_value" name="point_value" value="{{ $point_value }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.register_date') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="register_date" name="register_date" value="{{ $register_date }}">
                </div>
            </div>
            
            <div class="row form-group">
                <label class="control-label col-lg-2 text-nowrap text-right">{{ trans('paramstate.detail.update_date') }}</label>
                <div class="col-lg-10">
                    <input class="form-control" readonly type="text" id="update_date" name="update_date" value="{{ $update_date }}">
                </div>
            </div>
            
            <div class="row form-group text-center">
                <a href="{{ route('paramstate') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function() {
            $('#paramstate').addClass('active');
        });
    </script>
@endsection

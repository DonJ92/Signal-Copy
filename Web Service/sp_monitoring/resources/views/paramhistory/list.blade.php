@extends('layouts.withmenu')
@section('title', trans('paramhistory.list.title'))
@section('page_title', trans('paramhistory.list.title'))
@section('page_title_ico', trans('paramhistory.list.title_ico'))

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

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="client_id" name="client_id" placeholder="{{ trans('paramhistory.list.client_id') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getParamHistory()">{{ trans('button.search_btn') }}</button>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="paramhistory_tbl">
                    <thead>
                    <tr>
                        <th>{{ trans('paramhistory.list.id') }}</th>
                        <th>{{ trans('paramhistory.list.client_id') }}</th>
                        <th>{{ trans('paramhistory.list.symbol_name') }}</th>
                        <th>{{ trans('paramhistory.list.register_date') }}</th>
                        <th>{{ trans('paramhistory.list.b_auto_open') }}</th>
                        <th>{{ trans('paramhistory.list.b_auto_fill_lots') }}</th>
                        <th>{{ trans('paramhistory.list.b_auto_close') }}</th>
                        <th>{{ trans('paramhistory.list.b_price_min') }}</th>
                        <th>{{ trans('paramhistory.list.b_price_max') }}</th>
                        <th>{{ trans('paramhistory.list.b_delta_pt') }}</th>
                        <th>{{ trans('paramhistory.list.b_target_pt') }}</th>
                        <th>{{ trans('paramhistory.list.s_auto_open') }}</th>
                        <th>{{ trans('paramhistory.list.s_auto_fill_lots') }}</th>
                        <th>{{ trans('paramhistory.list.s_auto_close') }}</th>
                        <th>{{ trans('paramhistory.list.s_price_min') }}</th>
                        <th>{{ trans('paramhistory.list.s_price_max') }}</th>
                        <th>{{ trans('paramhistory.list.s_delta_pt') }}</th>
                        <th>{{ trans('paramhistory.list.s_target_pt') }}</th>
                        <th>{{ trans('paramhistory.list.b_lots') }}</th>
                        <th>{{ trans('paramhistory.list.s_lots') }}</th>
                        <th>{{ trans('paramhistory.list.balance') }}</th>
                        <th>{{ trans('paramhistory.list.equity') }}</th>
                        <th>{{ trans('paramhistory.list.margin') }}</th>
                        <th>{{ trans('paramhistory.list.free_margin') }}</th>
                        <th>{{ trans('paramhistory.list.margin_level') }}</th>
                        <th>{{ trans('paramhistory.list.daily_profit') }}</th>
                        <th>{{ trans('paramhistory.list.position_profit') }}</th>
                        <th>{{ trans('paramhistory.list.point_value') }}</th>
                    </tr>
                    
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getParamHistory()
        {
            var token = $("input[name=_token]").val();
            var client_id = $('#client_id').val();

            $.ajax({
                url: '{{ route('getparamhistory') }}',
                type: 'POST',
                data: {_token: token, client_id: client_id},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#paramhistory_tbl' ) ) {
                        var accountlist_tbl = $('#paramhistory_tbl').DataTable();
                        accountlist_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            datas.push([
                                response[i].id,
                                response[i].client_id,
                                response[i].symbol_name,
                                response[i].register_date,
                                response[i].b_auto_open,
                                response[i].b_auto_fill_lots,
                                response[i].b_auto_close,
                                response[i].b_price_min,
                                response[i].b_price_max,
                                response[i].b_delta_pt,
                                response[i].b_target_pt,
                                response[i].s_auto_open,
                                response[i].s_auto_fill_lots,
                                response[i].s_auto_close,
                                response[i].s_price_min,
                                response[i].s_price_max,
                                response[i].s_delta_pt,
                                response[i].s_target_pt,
                                response[i].b_lots,
                                response[i].s_lots,
                                response[i].balance,
                                response[i].equity,
                                response[i].margin,
                                response[i].free_margin,
                                response[i].margin_level,
                                response[i].daily_profit,
                                response[i].position_profit,
                                response[i].point_value,
                            ]);
                        }
                    }

                    $('#paramhistory_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]],
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#paramhistory').addClass('active');
            getParamHistory();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getParamHistory();
            }
        });
    </script>
@endsection
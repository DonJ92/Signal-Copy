@extends('layouts.withmenu')
@section('title', trans('paramstate.list.title'))
@section('page_title', trans('paramstate.list.title'))
@section('page_title_ico', trans('paramstate.list.title_ico'))

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
                        <input class="form-control" type="text" id="client_id" name="client_id" placeholder="{{ trans('paramstate.list.client_id') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getParamStateList()">{{ trans('button.search_btn') }}</button>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="paramstate_tbl">
                    <thead>
                    <tr>
                        <th>{{ trans('paramstate.list.id') }}</th>
                        <th>{{ trans('paramstate.list.client_id') }}</th>
                        <th>{{ trans('paramstate.list.symbol_name') }}</th>
                        <th>{{ trans('paramstate.list.balance') }}</th>
                        <th>{{ trans('paramstate.list.equity') }}</th>
                        <th>{{ trans('paramstate.list.margin') }}</th>
                        <th>{{ trans('paramstate.list.free_margin') }}</th>
                        <th>{{ trans('paramstate.list.margin_level') }}</th>
                        <th>{{ trans('paramstate.list.daily_profit') }}</th>
                        <th>{{ trans('paramstate.list.position_profit') }}</th>
                        <th>{{ trans('paramstate.list.update_date') }}</th>
                        <th>{{ trans('paramstate.list.detail') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getParamStateList()
        {
            var token = $("input[name=_token]").val();
            var client_id = $('#client_id').val();

            $.ajax({
                url: '{{ route('getparamstatelist') }}',
                type: 'POST',
                data: {_token: token, client_id: client_id},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#paramstate_tbl' ) ) {
                        var paramstate_tbl = $('#paramstate_tbl').DataTable();
                        paramstate_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var detail = '<a href="{{ url('paramstate/detail') }}/'+ response[i].id +'">{{ trans('common.detail') }}</a>';

                            datas.push([
                                response[i].id,
                                response[i].client_id,
                                response[i].symbol_name,
                                response[i].balance,
                                response[i].equity,
                                response[i].margin,
                                response[i].free_margin,
                                response[i].margin_level,
                                response[i].daily_profit,
                                response[i].position_profit,
                                response[i].update_date,
                                detail,
                            ]);
                        }
                    }

                    $('#paramstate_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]],
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#paramstate').addClass('active');
            getParamStateList();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getParamStateList();
            }
        });
        
        setInterval(getParamStateList, 5000);
    </script>
@endsection
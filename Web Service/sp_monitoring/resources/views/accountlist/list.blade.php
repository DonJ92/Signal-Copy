@extends('layouts.withmenu')
@section('title', trans('accountlist.list.title'))
@section('page_title', trans('accountlist.list.title'))
@section('page_title_ico', trans('accountlist.list.title_ico'))

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
                        <input class="form-control" type="text" id="customer_id" name="customer_id" placeholder="{{ trans('accountlist.list.customer_id') }}">
                    </div>
					<div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="account_id" name="account_id" placeholder="{{ trans('accountlist.list.account_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="broker_name" name="broker_name" placeholder="{{ trans('accountlist.list.broker_name') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getAccountList()">{{ trans('button.search_btn') }}</button>
                        <a class="btn bg-primary" href="{{ route('accountlist.register') }}">{{ trans('button.add_btn') }}</a>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="accountlist_tbl">
                    <thead>
						<tr>
							<th>{{ trans('accountlist.list.id') }}</th>
							<th>{{ trans('accountlist.list.customer_id') }}</th>
							<th>{{ trans('accountlist.list.account_id') }}</th>
							<th>{{ trans('accountlist.list.broker_name') }}</th>
							<th>{{ trans('accountlist.list.register_date') }}</th>
							<th>{{ trans('accountlist.list.detail') }}</th>
						</tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getAccountList()
        {
            var token = $("input[name=_token]").val();
            var broker_name = $('#broker_name').val();
            var customer_id = $('#customer_id').val();

            $.ajax({
                url: '{{ route('getaccountlist') }}',
                type: 'POST',
                data: {_token: token, broker_name: broker_name, customer_id: customer_id},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#accountlist_tbl' ) ) {
                        var accountlist_tbl = $('#accountlist_tbl').DataTable();
                        accountlist_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var detail = '<a href="{{ url('accountlist/detail') }}/'+ response[i].id +'">{{ trans('common.detail') }}</a>' + ' | ' +
                                            '<a href="{{ url('accountlist/delete') }}/'+ response[i].id +'">{{ trans('common.delete') }}</a>';

                            datas.push([
                                response[i].id,
                                response[i].customer_id,
                                response[i].account_id,
                                response[i].broker.alias_name,
                                response[i].register_date,
                                detail,
                            ]);
                        }
                    }

                    $('#accountlist_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]]
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#account_list').addClass('active');
            getAccountList();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getAccountList();
            }
        });
    </script>
@endsection
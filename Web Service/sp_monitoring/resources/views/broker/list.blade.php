@extends('layouts.withmenu')
@section('title', trans('broker.list.title'))
@section('page_title', trans('broker.list.title'))
@section('page_title_ico', trans('broker.list.title_ico'))

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
                        <input class="form-control" type="text" id="alias_name" name="alias_name" placeholder="{{ trans('broker.list.alias_name') }}">
                    </div>
					<div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="name" name="name" placeholder="{{ trans('broker.list.name') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getBrokerList()">{{ trans('button.search_btn') }}</button>
                        <a class="btn bg-primary" href="{{ route('broker.register') }}">{{ trans('button.add_btn') }}</a>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="broker_tbl">
                    <thead>
						<tr>
							<th>{{ trans('broker.list.id') }}</th>
							<th>{{ trans('broker.list.alias_name') }}</th>
                            <th>{{ trans('broker.list.name') }}</th>
                            <th>{{ trans('broker.list.register_date') }}</th>
                            <th>{{ trans('broker.list.detail') }}</th>
						</tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getBrokerList()
        {
            var token = $("input[name=_token]").val();
            var alias_name = $('#alias_name').val();
            var name = $('#name').val();

            $.ajax({
                url: "{{ route('getbrokerlist') }}",
                type: 'POST',
                data: {_token: token, alias_name: alias_name, name: name},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#broker_tbl' ) ) {
                        var broker_tbl = $('#broker_tbl').DataTable();
                        broker_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var detail = "<a href=\"{{ route('broker.detail', ['id' => '']) }}/"+ response[i].id +"\">{{ trans('common.detail') }}</a>" + ' | ' +
                                            "<a href=\"{{ route('broker.deleteaction', ['id' => '']) }}/"+ response[i].id +"\">{{ trans('common.delete') }}</a>";

                            datas.push([
                                response[i].id,
                                response[i].alias_name,
                                response[i].name,
                                response[i].created_at,
                                detail,
                            ]);
                        }
                    }

                    $('#broker_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]]
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#broker_tbl').addClass('active');
            getBrokerList();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getBrokerList();
            }
        });

        $(window).on('load', function() {
            $('#broker_list').addClass('active');
        });
    </script>
@endsection
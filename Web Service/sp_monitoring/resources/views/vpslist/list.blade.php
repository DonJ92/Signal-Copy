@extends('layouts.withmenu')
@section('title', trans('vpslist.list.title'))
@section('page_title', trans('vpslist.list.title'))
@section('page_title_ico', trans('vpslist.list.title_ico'))

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
                        <input class="form-control" type="text" id="vps_name" name="vps_name" placeholder="{{ trans('vpslist.list.vps_name') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="customer_id" name="customer_id" placeholder="{{ trans('vpslist.list.customer_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="vps_ip" name="vps_ip" placeholder="{{ trans('vpslist.list.vps_ip') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getVPSList()">{{ trans('button.search_btn') }}</button>
                        <a class="btn bg-primary" href="{{ route('vpslist.register') }}">{{ trans('button.add_btn') }}</a>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="vpslist_tbl">
                    <thead>
                    <tr>
                        <th>{{ trans('vpslist.list.id') }}</th>
                        <th>{{ trans('vpslist.list.vps_name') }}</th>
                        <th>{{ trans('vpslist.list.customer_id') }}</th>
                        <th>{{ trans('vpslist.list.vps_ip') }}</th>
                        <th>{{ trans('vpslist.list.register_date') }}</th>
                        <th>{{ trans('vpslist.list.detail') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getVPSList()
        {
            var token = $("input[name=_token]").val();
            var vps_name = $('#vps_name').val();
            var customer_id = $('#customer_id').val();
            var vps_ip = $('#vps_ip').val();

            $.ajax({
                url: '{{ route('getvpslist') }}',
                type: 'POST',
                data: {_token: token, vps_name: vps_name, customer_id: customer_id, vps_ip: vps_ip},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#vpslist_tbl' ) ) {
                        var vpslist_tbl = $('#vpslist_tbl').DataTable();
                        vpslist_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var detail = '<a href="{{ url('vpslist/detail') }}/'+ response[i].id +'">{{ trans('common.detail') }}</a>' + ' | ' +
                                            '<a href="{{ url('vpslist/delete') }}/'+ response[i].id +'">{{ trans('common.delete') }}</a>';

                            datas.push([
                                response[i].id,
                                response[i].vps_name,
                                response[i].customer_id,
                                response[i].vps_ip,
                                response[i].register_date,
                                detail,
                            ]);
                        }
                    }

                    $('#vpslist_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]]
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#vps_list').addClass('active');
            getVPSList();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getVPSList();
            }
        });
    </script>
@endsection
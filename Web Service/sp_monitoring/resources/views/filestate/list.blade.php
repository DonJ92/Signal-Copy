@extends('layouts.withmenu')
@section('title', trans('filestate.list.title'))
@section('page_title', trans('filestate.list.title'))
@section('page_title_ico', trans('filestate.list.title_ico'))

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
                <table class="table table-striped table-hover" id="filestate_tbl">
                    <thead>
                    <tr>
                        <th>{{ trans('filestate.list.file_name') }}</th>
                        <th>{{ trans('filestate.list.previous_datetime') }}</th>
                        <th>{{ trans('filestate.list.current_datetime') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getFileStateHistory()
        {
            var token = $("input[name=_token]").val();
            var client_id = $('#client_id').val();

            $.ajax({
                url: '{{ route('getfilestate') }}',
                type: 'POST',
                data: {_token: token, client_id: client_id},
                dataType: 'JSON',
                success: function (response) {
                    if ( $.fn.DataTable.isDataTable( '#filestate_tbl' ) ) {
                        var filestate_tbl = $('#filestate_tbl').DataTable();
                        filestate_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {
                            datas.push([
                                response[i].file_name,
                                response[i].previous_datetime,
                                response[i].current_datetime,
                            ]);
                        }
                    }

                    $('#filestate_tbl').dataTable({
                        data: datas,
                        "pageLength": 20,
                        "order": [[ 0, "desc" ]],
                    });
                    console.log(response);
                }
            });
        }

        $(window).on('load', function() {
            $('#filestate_tbl').addClass('active');
            getFileStateHistory();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getFileStateHistory();
            }
        });
    </script>
@endsection
@extends('layouts.withmenu')
@section('title', trans('spclient.list.title'))
@section('page_title', trans('spclient.list.title'))
@section('page_title_ico', trans('spclient.list.title_ico'))

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
                        <input class="form-control" type="text" id="client_id" name="client_id" placeholder="{{ trans('spclient.list.client_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="customer_id" name="customer_id" placeholder="{{ trans('spclient.list.customer_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="vps_name" name="vps_name" placeholder="{{ trans('spclient.list.vps_name') }}">
                    </div>

                    <div class="col-lg-2 form-group">
                        <select class="form-control" id="signal_type" name="signal_type">
                            <option value="">-- {{ trans('spclient.list.signal_type') }} --</option>
                            <option value="{{ SIGNAL_PROVIDER }}">{{ trans('common.spclient.singal_provider') }}</option>
                            <option value="{{ SIGNAL_COPIER }}">{{ trans('common.spclient.signal_copier') }}</option>
                        </select>
                    </div>

                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getSPClient()">{{ trans('button.search_btn') }}</button>
                        <a class="btn bg-primary" href="{{ route('spclient.register') }}">{{ trans('button.add_btn') }}</a>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="spclientlist_tbl">
                    <thead>
                    <tr>
                        <th>{{ trans('spclient.list.id') }}</th>
                        <th>{{ trans('spclient.list.client_id') }}</th>
                        <th>{{ trans('spclient.list.customer_id') }}</th>
                        <th>{{ trans('spclient.list.account_id') }}</th>
                        <th>{{ trans('spclient.list.vps_name') }}</th>
                        <th>{{ trans('spclient.list.signal_type') }}</th>
                        <th>{{ trans('spclient.list.subclient_count') }}</th>
                        <th>{{ trans('spclient.list.register_date') }}</th>
                        <th>{{ trans('spclient.list.detail') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getSPClient()
        {
            var token = $("input[name=_token]").val();
            var client_id = $('#client_id').val();
            var customer_id = $('#customer_id').val();
            var vps_name = $('#vps_name').val();
            var signal_type = $('#signal_type').val();
            
            $.ajax({
                url: '{{ route('getspclientlist') }}',
                type: 'POST',
                data: {_token: token, client_id: client_id, customer_id: customer_id, vps_name: vps_name, signal_type: signal_type},
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    
                    if ( $.fn.DataTable.isDataTable( '#spclientlist_tbl' ) ) {
                        var spclientlist_tbl = $('#spclientlist_tbl').DataTable();
                        spclientlist_tbl.destroy();
                    }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {

                    } else {
                        for (var i = 0; i < response.length; i++) {
                            var detail = '<a href="{{ url('spclient/detail') }}/'+ response[i].id +'">{{ trans('common.detail') }}</a>' + ' | ' +
                                            '<a href="{{ url('spclient/delete') }}/'+ response[i].id +'">{{ trans('common.delete') }}</a>';
                            
                            var signal_type = '';
                            if (response[i].signal_type == '{{ SIGNAL_PROVIDER }}')
                                signal_type = "{{ trans('common.spclient.singal_provider') }}";
                            else
                                signal_type = "{{ trans('common.spclient.signal_copier') }}";
                            
                            datas.push([
                                response[i].id,
                                response[i].client_id,
                                response[i].customer_id,
                                response[i].account_info,
                                response[i].vps_name,
                                signal_type,
                                response[i].subclients,
                                response[i].register_date,
                                detail,
                            ]);
                        }
                    }

                    var dt = $('#spclientlist_tbl').DataTable({
                        data: datas,
                        "columnDefs": [ 
                            {
                                "targets": 0,
                                "class":          "details-control",
                                "orderable":      true,
                                "render": function ( data, type, row) {
									/*if (row[6].length == 0)
									{
										return data;
									}
                                    return "<i class='fa fa-plus-square-o'></i> " + data;*/
                                    return data;
                                },
                                "defaultContent": "<i class='fa fa-plus-square-o'></i>"
                            },
                            {
                                "targets": 6,
                                "render": function ( data, type, row ) {
                                    if (data.length == 0)
                                        return "-";

                                    return data.length;
                                }
                            }
                        ],
                        "pageLength": 20,
                        "order": [[ 0, "asc" ]]
                    });
                    
                    // Array to track the ids of the details displayed rows
                    var detailRows = [];
                
                    /*$('#spclientlist_tbl tbody').on( 'click', 'tr td.details-control', function () {
                        var tr = $(this).closest('tr');
                        var row = dt.row( tr );
                        var idx = $.inArray( tr.attr('id'), detailRows );

                        if ( row.child.isShown() ) {
                            tr.find('i').removeClass('fa-minus-square-o')
                                        .addClass('fa-plus-square-o');

                            tr.removeClass( 'details' );
                            row.child.hide();

                            // Remove from the 'open' array
                            detailRows.splice( idx, 1 );
                        }
                        else {
                            tr.find('i').removeClass('fa-plus-square-o')
                                        .addClass('fa-minus-square-o');
                            
                            tr.addClass( 'details' );
                            row.child( format( row.data() ) ).show();

                            // Add to the 'open' array
                            if ( idx === -1 ) {
                                detailRows.push( tr.attr('id') );
                            }
                        }
                    } );*/

                    // On each draw, loop over the `detailRows` array and show any child rows
                    dt.on( 'draw', function () {
                        $.each( detailRows, function ( i, id ) {
                            $('#'+id+' td.details-control').trigger( 'click' );
                        } );
                    } );
                }
            });
        }

        $(window).on('load', function() {
            $('#spclient_list').addClass('active');
            getSPClient();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getSPClient();
            }
        });
        
        /* Formatting function for row details - modify as you need */
        function format ( d ) {
//            console.log(d);
            if(d[6].length ==0)
                return null;
  
            // `d` is the original data object for the row
            var html = '';

            d[6].forEach(function(e, i) {
                //console.log(e);
                html += '<tr class="text-info">'+
                            '<td>'+e.id+'</td>'+
                            '<td>'+e.client_id+'</td>'+
							'<td>'+e.customer_id+'</td>'+
                            '<td></td>'+
							'<td>'+e.vps_name+'</td>'+
                            '<td>'+(e.signal_type == '{{ SIGNAL_PROVIDER }}' ? "{{ trans('common.spclient.singal_provider') }}" : "{{ trans('common.spclient.signal_copier') }}")+'</td>'+                            
							'<td>'+"-"+'</td>'+
                            '<td>'+e.register_date+'</td>'+
                            '<td class="text-left">'+'<a href="{{ url('spclient/detail') }}/'+ e.id +'">{{ trans('common.detail') }}</a>'+'</td>'+
                        '</tr>';
            });

            return $(html);
        }
    </script>
@endsection
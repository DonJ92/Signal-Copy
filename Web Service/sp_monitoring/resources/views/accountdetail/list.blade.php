@extends('layouts.withmenu')
@section('title', trans('accountdetail.list.title'))
@section('page_title', trans('accountdetail.list.title'))
@section('page_title_ico', trans('accountdetail.list.title_ico'))

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
                        <input class="form-control" type="text" id="client_id" name="client_id" placeholder="{{ trans('accountdetail.list.client_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="customer_id" name="client_id" placeholder="{{ trans('accountdetail.list.customer_id') }}">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input class="form-control" type="text" id="account_id" name="client_id" placeholder="{{ trans('accountdetail.list.account_id') }}">
                    </div>
                    <div class="col-lg-2 form-group text-right">
                        <button class="btn bg-teal" onclick="getaccountdetailList()">{{ trans('button.search_btn') }}</button>
                    </div>
                    <div class="col-lg-4 form-group text-right">
                        <a class="btn btn-warning toggle-vis acc_column" data-column="3">{{ trans('button.toggle_account') }}</a>
                    </div>
                </div>
                <table class="table" id="accountdetail_tbl">
                    <thead>
                    <tr>
                        <th class="common-col">{{ trans('accountdetail.list.id') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.client_id') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.vps_name') }}</th>
                        <th class="wide-xl-col">{{ trans('accountdetail.list.account_id') }}</th>
                        <th class="narrow-col">{{ trans('accountdetail.list.clients') }}</th>
                        <th class="narrow-col">{{ trans('accountdetail.list.currency') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.balance') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.equity') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.margin') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.free_margin') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.margin_level') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.units') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.unit_lots') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.position_profit') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.daily_profit') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.daily_trades') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.deposit_withdrawal') }}</th>
                        <th class="common-col">{{ trans('accountdetail.list.update_date') }}</th>
                        <th class="wide-col">{{ trans('accountdetail.list.operation') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getaccountdetailList()
        {
            // localStorage.setItem('acc_column_visible', false);
            
            var token = $("input[name=_token]").val();
            var client_id = $('#client_id').val();
            var customer_id = $('#customer_id').val();
            var account_id = $('#account_id').val();

            $.ajax({
                url: '{{ route("accdetail.ajax.post") }}',
                type: 'POST',
                data: {_token: token, client_id: client_id, customer_id: customer_id, account_id: account_id},
                dataType: 'JSON',
                success: function (response) {
                    // if ( $.fn.DataTable.isDataTable( '#accountdetail_tbl' ) ) {
                    //     var accountdetail_tbl = $('#accountdetail_tbl').DataTable();
                    //     accountdetail_tbl.destroy();
                    // }

                    datas = new Array();
                    if (response == undefined || response.length == 0) {
                    } else {
                        for (var i = 0; i < response.length; i++) {                            
                            var actionText = "";

                            // if (response[i].active) {
                            //     actionText = "<a href={{ route('accdetail.action.deactive') }}/"+ response[i].id +">{{ trans('common.stop') }}</a> | ";                                        
                            // } else {
                            //     actionText = "<a href={{ route('accdetail.action.active') }}/"+ response[i].id +" class='disabled'>{{ trans('common.start') }}</a> | ";
                            // }

                            actionText += /*"<a href={{ route('accdetail.action.closeall') }}/"+ response[i].id +" class='"+(response[i].pos_cnt > 0 ? '' : 'disabled')+"'>{{ trans('common.close_all') }}</a> | " +*/
                                            "<a href={{ route('accdetail.detail') }}/"+ response[i].id +">{{ trans('common.detail') }}</a>";

                            datas.push([
                                [response[i].id, response[i].is_real],
                                response[i].client_id,
                                response[i].vps_name,
                                response[i].customer_id + ", " + response[i].account_info + (response[i].is_real ? " @Real" : " @Demo"),
                                response[i].subclients,
                                response[i].currency,
                                response[i].balance,
                                response[i].equity,
                                response[i].margin,
                                response[i].free_margin,
                                response[i].margin_level,
                                response[i].trade_info,
                                response[i].unit_lots,
                                response[i].pos_profit,
                                response[i].daily_profit,
                                response[i].daily_trades,
                                response[i].deposit,
                                [response[i].updated_at, response[i].timediff_for_updated_at],
                                actionText,
                            ]);
                        }
                    }

                    var dt = $('#accountdetail_tbl').DataTable({
                        destroy: true,
                        data: datas,
                        createdRow: function( row, data, dataIndex ) {
                            // Set the data-status attribute, and add a class
                            $( row ).addClass('master');
                        },
                        "columnDefs": [
                            {
                                "targets": 0,
                                "visible": false
                            },
                            {                                
                                "targets":      1,
                                "class":        "details-control",
                                "orderable":    true,
                                "render": function ( data, type, row) {
									if (row[4].length == 0)
									{
										return data;
									}
                                    return "<i class='fa fa-plus-square-o'></i> " + data;
                                },
                                "defaultContent": "<i class='fa fa-plus-square-o'></i>",
                            },
                            {
                                targets: 3,
                                visible: (localStorage.getItem('acc_column_visible') === 'true')
                            },
                            {
                                "targets": 4,
                                "class": 'text-center',
                                "orderable": false,
                                "render": function ( data, type, row ) {
                                    if (data.length == 0)
                                        return "-";

                                    return '<span class="badge badge-warning">'+data.length+'</span>';
                                }
                            },
                            { 
                                targets: [5,6,7,8,9,10,11,12,13,14,15,16,18], 
                                class: 'text-right',
                                sorting: false,
                                defaultContent: '-'
                            },
                            {
                                targets: [6,7,8,9,10,12,13,14],
                                render: function (data, type, row) {
                                    if (isNaN(data))    
                                        return data;

                                    return number_format(data, 2);
                                }
                            },
                            {
                                targets: 11,
                                render: function ( data, type, row) {
                                    return (data.pos_cnt ? data.pos_cnt : '-') + ",&nbsp;&nbsp;" + (data.lmt_cnt ? data.lmt_cnt : '-') + ",&nbsp;&nbsp;" + (data.stp_cnt ? data.stp_cnt : '-');
                                },
                                defaultContent: "-"
                            },
                            {
                                "targets": 16,
                                "render": function ( data, type, row) {
									if (data > 0)
                                        return "<span class='text-info'>" + number_format(data, 2) + "</span>";
                                    else if (data < 0)
                                        return "<span class='text-danger'>" + number_format(data, 2) + "</span>";
                                    
                                    return "-";
                                },
                                "defaultContent": "-",
                            },
                            {
                                "targets": 17,
                                "render": function ( data, type, row) {
									if (data[1] > 11)
									{
                                        return "<span class='text-danger'>" + data[0] + "</span>";
                                    }
                                    
                                    return data[0];
                                },
                                "defaultContent": "<i class='fa fa-plus-square-o'></i>",
                            },
                        ],
                        "pageLength": 20,
                        "order": [ 0, "asc" ],
                        "scrollX": true,
                        "responsive": false
                    });
                    
                    // Array to track the ids of the details displayed rows
                    var detailRows = [];
                
                    $('#accountdetail_tbl tbody').off('click', 'tr td.details-control').on( 'click', 'tr td.details-control', function () {
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
                        // console.log(detailRows);
                    });

                    // On each draw, loop over the `detailRows` array and show any child rows
                    dt.off('draw').on( 'draw', function () {
                        // console.log(detailRows);
                        // $.each( detailRows, function ( i, id ) {
                        //     $('#'+id+' td.details-control').trigger( 'click' );
                        // });

                        // // Get the column API object
                        // var column = dt.column( $('a.toggle-vis.acc_column').attr('data-column') );
                        
                
                        // // Toggle the visibility                        
                        // var visiblity = (localStorage.getItem('acc_column_visible') === 'true');
                        // column.visible(visiblity);
                        // $('tr.slave td:nth-child(' + $('a.toggle-vis.acc_column').attr('data-column') +')').toggle(visiblity);
                    });

                    $('#accountdetail_tbl td.details-control').trigger( 'click' );

                    // $('#accountdetail_tbl td.details-control').trigger( 'click' );

                    $('a.toggle-vis.acc_column').off('click').on( 'click', function (e) {
                        e.preventDefault();
                
                        // Get the column API object
                        var column = dt.column( $(this).attr('data-column') );
                
                        // Toggle the visibility
                        column.visible( ! column.visible() );

                        // console.log($('tr.slave td:nth-child(' + $('a.toggle-vis.acc_column').attr('data-column') +')'));
                        $('tr.slave td:nth-child(' + $(this).attr('data-column') +')').toggle(column.visible());
                        $('tr.summary td:first-child').attr('colspan', column.visible() ? 4 : 3);

                        localStorage.setItem('acc_column_visible', column.visible());
                        // console.log(localStorage.getItem('acc_column_visible'));
                    });
                }
            });
        }

        /* Formatting function for row details - modify as you need */
        function format ( d ) {  
            // `d` is the original data object for the row
            // var html = '<table class="table table-striped text-info">';
            var accinfoVisibility = (localStorage.getItem('acc_column_visible') === 'true');                

            var html ='';
            var balance_sum = 0;
            var unit_lots_sum = 0;
            var pos_profit_sum = 0;
            var daily_profit_sum = 0;

            d[4].forEach(function(e, i) {
                var posCntClassText = ((d[11].pos_cnt === e.trade_info.pos_cnt) && (d[11].lmt_cnt === e.trade_info.lmt_cnt) && (d[11].stp_cnt === e.trade_info.stp_cnt)) ? "text-center" : "text-center text-danger";
                var posCntText=(e.trade_info.pos_cnt ? e.trade_info.pos_cnt : '-') + ',&nbsp;&nbsp;' + (e.trade_info.lmt_cnt ? e.trade_info.lmt_cnt : '-') + ',&nbsp;&nbsp;' + (e.trade_info.stp_cnt ? e.trade_info.stp_cnt : '-');

                var updatedAtClassText=e.accdetail ? (e.accdetail.timediff_for_updated_at > 10 ? 'text-danger' : '') : '';
                
                var actionText = "<td class='text-right'>";
                
                if (e.active) {
                    actionText += "<a href={{ route('accdetail.action.deactive') }}/"+ e.id +" class='text-danger'>{{ trans('common.stop') }}</a> | ";                                        
                } else {
                    actionText += "<a href={{ route('accdetail.action.active') }}/"+ e.id +">{{ trans('common.start') }}</a> | ";
                }

                actionText += "<a href={{ route('accdetail.action.closeall') }}/"+ e.id +" class='"+(e.trade_info.pos_cnt > 0 ? '' : 'disabled')+"'>{{ trans('common.close_all') }}</a> | ";
                actionText += "<a href={{ route('accdetail.detail') }}/"+ e.id +">{{ trans('common.detail') }}</a>";

                actionText += "</td>";
                
                html += '<tr class="slave '+(e.active ? '' : 'inactive')+'">'+
                            // '<td style="min-width: 50px; max-width: 50px">'+e.id+'</td>'+
                            '<td>'+e.client_id+'</td>'+
                            '<td>'+e.vps_name+'</td>'+
							'<td style="' + (accinfoVisibility ? "" : "display:none;") + '">'+e.customer_id+', '+e.account_info+(e.accdetail? (e.accdetail.is_real ? ' @Real': ' @Demo') : '')+'</td>'+
                            '<td></td>'+
							'<td class="text-right">'+(e.accdetail ? (e.accdetail.currency ? e.accdetail.currency : '-') : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.balance, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.equity, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.margin, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.free_margin, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.margin_level, 2) : '-')+'</td>'+
							'<td class="text-right"><span class="'+posCntClassText+'">' + posCntText + '</span></td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.unit_lots, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.pos_profit, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.daily_profit, 2) : '-')+'</td>'+
                            '<td class="text-right">'+(e.accdetail ? number_format(e.accdetail.daily_trades, 0) : '-')+'</td>'+
                            '<td class="text-right '+(e.accdetail.deposit==0?'':(e.accdetail.deposit>0?'text-info':'text-danger'))+'">'+(e.accdetail ? (e.accdetail.deposit==0 ? '-' : number_format(e.accdetail.deposit, 2)) : '-')+'</td>'+
                            '<td><span class="'+updatedAtClassText+'">'+(e.accdetail ? e.accdetail.updated_at : '-')+'</span></td>'+
                            actionText+
                        '</tr>';

                balance_sum += e.accdetail ? (e.accdetail.balance / (e.accdetail.currency == 'JPY' ? 110 : 1)) : 0;
                unit_lots_sum += e.accdetail ? e.accdetail.unit_lots : 0;
                pos_profit_sum += e.accdetail ? (e.accdetail.pos_profit / (e.accdetail.currency == 'JPY' ? 110 : 1)) : 0;
                daily_profit_sum += e.accdetail ? (e.accdetail.daily_profit / (e.accdetail.currency == 'JPY' ? 110 : 1)) : 0;
            });

            html += '<tr class="summary">'+
                        '<td colspan="'+(accinfoVisibility ? 4 : 3)+'" class="text-left">'+"{{ trans('accountdetail.list.summary') }}"+'</td>'+
                        '<td class="text-right">USD</td>'+
                        '<td class="text-right">'+number_format(balance_sum, 2)+'</td>'+
                        '<td class="text-right"></td>'+
                        '<td class="text-right"></td>'+                        
                        '<td class="text-right"></td>'+
                        '<td class="text-right"></td>'+
                        '<td class="text-right"></td>'+
                        '<td class="text-right">'+number_format(unit_lots_sum, 2)+'</td>'+
                        '<td class="text-right">'+number_format(pos_profit_sum, 2)+'</td>'+
                        '<td class="text-right">'+number_format(daily_profit_sum, 2)+'</td>'+
                        '<td class="text-right"></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                    '</tr>';
            //html += '</table>';
            return $(html);
        }

        $(window).on('load', function() {
            $('#accdetail_list').addClass('active');
            getaccountdetailList();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                getaccountdetailList();
            }
        });

        setInterval(getaccountdetailList, 5000);

        function number_format(val, decimals){
            //Parse the value as a float value
            val = parseFloat(val);
            //Format the value w/ the specified number
            //of decimal places and return it.
            return val.toFixed(decimals);
        }
    </script>
@endsection
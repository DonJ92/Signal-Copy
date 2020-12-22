@extends('layouts.withmenu')
@section('title', trans('accountdetail.detail.title'))
@section('page_title', trans('accountdetail.detail.title'))
@section('page_title_ico', trans('accountdetail.detail.title_ico'))

@section('content')
    <div class="content">
        <div class="row" style="display: flex; justify-content: left; margin-bottom: 15px">
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.client_id') }}:&nbsp; {{ $spclient->client_id }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.customer_id') }}:&nbsp; {{ $spclient->customer_id }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.account_id') }}:&nbsp; {{ $spclient->account->account_id }}, {{ $spclient->account->broker_name }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.currency') }}:&nbsp; {{ $spclient->account->accountdetail->currency }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.balance') }}:&nbsp; {{ $spclient->account->accountdetail->balance }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.equity') }}:&nbsp; {{ $spclient->account->accountdetail->equity }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.margin') }}:&nbsp; {{ $spclient->account->accountdetail->margin }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.free_margin') }}:&nbsp; {{ $spclient->account->accountdetail->free_margin }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.margin_level') }}:&nbsp; {{ $spclient->account->accountdetail->margin_level }} %</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.position_profit') }}:&nbsp; {{ $spclient->account->accountdetail->pos_profit }}</span>
            <span style="padding: 10px 20px;">{{ trans('accountdetail.detail.daily_profit') }}:&nbsp; {{ $spclient->account->accountdetail->daily_profit }}</span>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            @foreach ($spclient->account->tradedetail as $tradedetail)
                <div class="col-md-3">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td rowspan="6">{{ $tradedetail->symbol }}</td>
                            <td rowspan="2" style="background: aliceblue;">POS</td>
                            <td class="{{ $tradedetail->pos_cnt_s > 0 ? 'text-danger' : '' }}">S: {{ $tradedetail->pos_cnt_s }}</td>
                            <td class="{{ $tradedetail->pos_lots_s > 0 ? 'text-danger' : '' }}">{{ $tradedetail->pos_lots_s }} Lots</td>
                        </tr>
                        <tr>
                            <td class="{{ $tradedetail->pos_cnt_b > 0 ? 'text-blue' : '' }}">B: {{ $tradedetail->pos_cnt_b }}</td>
                            <td class="{{ $tradedetail->pos_lots_b > 0 ? 'text-blue' : '' }}">{{ $tradedetail->pos_lots_b }} Lots</td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="background: aliceblue;">LMT</td>
                            <td class="{{ $tradedetail->lmt_cnt_s > 0 ? 'text-danger' : '' }}">S: {{ $tradedetail->lmt_cnt_s }}</td>
                            <td class="{{ $tradedetail->lmt_lots_s > 0 ? 'text-danger' : '' }}">{{ $tradedetail->lmt_lots_s }} Lots</td>
                        </tr>
                        <tr>
                            <td class="{{ $tradedetail->lmt_cnt_b > 0 ? 'text-blue' : '' }}">B: {{ $tradedetail->lmt_cnt_b }}</td>
                            <td class="{{ $tradedetail->lmt_lots_b > 0 ? 'text-blue' : '' }}">{{ $tradedetail->lmt_lots_b }} Lots</td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="background: aliceblue;">STP</td>
                            <td class="{{ $tradedetail->stp_cnt_s > 0 ? 'text-danger' : '' }}">S: {{ $tradedetail->stp_cnt_s }}</td>
                            <td class="{{ $tradedetail->stp_lots_s > 0 ? 'text-danger' : '' }}">{{ $tradedetail->stp_lots_s }} Lots</td>
                        </tr>
                        <tr>
                            <td class="{{ $tradedetail->stp_cnt_b > 0 ? 'text-blue' : '' }}">B: {{ $tradedetail->stp_cnt_b }}</td>
                            <td class="{{ $tradedetail->stp_lots_b > 0 ? 'text-blue' : '' }}">{{ $tradedetail->stp_lots_b }} Lots</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
        <div class="row text-center">
            <a href="{{ route('accdetail') }}" class="btn btn-default">{{ trans('button.back_btn') }}</a>
        </div>
    </div>

    <script>
        $(window).on('load', function() {
            $('#accdetail_list').addClass('active');
        });

        setInterval(function(){ location.reload(); }, 5000);
    </script>
@endsection

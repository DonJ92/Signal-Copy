<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;


use App\AccountList;
use App\VPSList;
use App\SPClient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class AccountDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accountdetail.list');
    }

    public function getAccountDetailList(Request $request)
    {
        $client_id = $request->input('client_id');
        $customer_id = $request->input('customer_id');
        $account_id = $request->input('account_id');

        $spclient_list = array();
        try {
            $query = SPClient::leftjoin('tbl_account_list', 'tbl_spclient.account_id', '=', 'tbl_account_list.id')
                ->leftjoin('tbl_account_details', 'tbl_spclient.account_id', '=', 'tbl_account_details.account_id')
                ->leftjoin('tbl_brokers', 'tbl_account_list.broker_id', '=', 'tbl_brokers.id')
                ->select('tbl_spclient.*', 'tbl_account_list.customer_id as customer_id',
                    \DB::raw('CONCAT(tbl_account_list.account_id, ", ", tbl_brokers.alias_name) as account_info'),
                    //\DB::raw('(tbl_trade_details.pos_cnt_s + tbl_trade_details.pos_cnt_b) as pos_cnt'),
                    'tbl_account_details.is_real', 'tbl_account_details.currency', 'tbl_account_details.unit_lots', 'tbl_account_details.deposit', 'tbl_account_details.balance', 'tbl_account_details.equity', 'tbl_account_details.margin', 'tbl_account_details.free_margin', 'tbl_account_details.margin_level', 'tbl_account_details.pos_profit', 'tbl_account_details.daily_profit', 'tbl_account_details.daily_trades', 'tbl_account_details.updated_at')
                ->where('tbl_spclient.signal_type', 1)
                ->orderBy('tbl_spclient.account_id', 'asc');
            
            if (!empty($client_id))
                $query->where('tbl_spclient.client_id', 'like', '%'.$client_id.'%');
            if (!empty($customer_id))
                $query->where('tbl_account_list.customer_id', 'like', '%'.$customer_id.'%');

            $spclient_list = $query->get()->toArray();

            foreach ($spclient_list as &$spclient) {
                $spclient_obj = \App\SPClient::find($spclient['id']);

                $tradedetails = $spclient_obj->account->tradedetail;

                $spclient['trade_info'] = [
                    'pos_cnt' => 0,
                    'lmt_cnt' => 0,
                    'stp_cnt' => 0
                ];                
                
                foreach ($tradedetails as $tradedetail) {
                    $spclient['trade_info']['pos_cnt'] += $tradedetail->pos_cnt_b + $tradedetail->pos_cnt_s;
                    $spclient['trade_info']['lmt_cnt'] += $tradedetail->lmt_cnt_b + $tradedetail->lmt_cnt_s;
                    $spclient['trade_info']['stp_cnt'] += $tradedetail->stp_cnt_b + $tradedetail->stp_cnt_s;
                }
                $spclient['updated_at'] = $this->convertToLocal($spclient['updated_at']);
                $spclient['timediff_for_updated_at'] = $this->elapsedTimeSeconds($spclient['updated_at']);

                $subclients = $spclient_obj->children->toArray(); 

                foreach($subclients as &$subclient) {
                    $subclient_obj = \App\SPClient::find($subclient['id']);
                    // dd($subclient['id']);
                    // dd(\App\SPClient::find((int)$subclient['id'])->account->accountdetail);
                    $subclient['accdetail'] = $subclient_obj->account->accountdetail->toArray();
                    $subclient['accdetail']['updated_at'] = $this->convertToLocal($subclient['accdetail']['updated_at']);
                    $subclient['accdetail']['timediff_for_updated_at'] = $this->elapsedTimeSeconds($subclient['accdetail']['updated_at']);
                    $subclient['account_info'] = $subclient_obj->account->account_id.', '.$subclient_obj->account->broker->alias_name;
                    
                    $subclient['trade_info'] = [
                        'pos_cnt' => 0,
                        'lmt_cnt' => 0,
                        'stp_cnt' => 0
                    ];

                    $tradedetails = $subclient_obj->account->tradedetail;
                    foreach ($tradedetails as $tradedetail) {
                        $subclient['trade_info']['pos_cnt'] += $tradedetail->pos_cnt_s + $tradedetail->pos_cnt_b;
                        $subclient['trade_info']['lmt_cnt'] += $tradedetail->lmt_cnt_s + $tradedetail->lmt_cnt_b;
                        $subclient['trade_info']['stp_cnt'] += $tradedetail->stp_cnt_s + $tradedetail->stp_cnt_b;
                    }
                }
                $spclient['subclients'] = $subclients;
            }            
            // dd($spclient_list);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
        
        return $spclient_list;
    }

	public function detail($id)
    {
        if (empty($id))
            return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.no_info')]);

        $spclient = SPClient::where('id', $id)->first();
        
        if (!$spclient || !$spclient->account->accountdetail)
            return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.no_info')]);            
        
        return view('accountdetail.detail', ['spclient' => $spclient]);
    }

    public function actionActivateClient($id)
    {
        $spclient = SPClient::where('id', $id)->first();
        
        if (!$spclient || !$spclient->account->accountdetail)
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountdetail.action.failed')]);
            
        $spclient->active = true;
        $spclient->save();

        return redirect()->route('accdetail')->with('success', trans('accountdetail.action.success')." #{ __('accountdetail.list.client_id') }: ".$spclient->client_id);
    }

    public function actionDeactivateClient($id) 
    {
        $spclient = SPClient::where('id', $id)->first();
        
        if (!$spclient || !$spclient->account->accountdetail)
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountdetail.action.failed')]);
            
        $spclient->active = false;
        $spclient->save();        
        
        return redirect()->route('accdetail')->with('success', trans('accountdetail.action.success')." #{ __('accountdetail.list.client_id') }: ".$spclient->client_id);
    }

    public function actionCloseAllClient($id)
    {
        $spclient = SPClient::where('id', $id)->first();
        
        if (!$spclient || !$spclient->account->accountdetail)
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountdetail.action.failed')]);
        
        $timestamp = round(microtime(true) * 1000);            
        $filename = $spclient->file_name;
        
        if (file_exists($filename)) {
            $signals = json_decode(file_get_contents($filename), true);
            if ($signals !== null) {
                foreach ($signals as $key => $signal) {
                    if ($timestamp - $signal['timestamp'] > 200 * 1000) {
                        unset($signals[$key]);
                    }
                }
            }
        }

        $data['cmd'] = "CloseAll";
        $data['op_type'] = -1;
        $data['symbol'] = "";
        $data['price'] = 0;
        $data['units'] = 0;
        $data['new_price'] = 0;
        $data['timestamp'] = $timestamp;

        // $data['cmd'] = "NewOrder";
        // $data['op_type'] = -1;
        // $data['symbol'] = "";
        // $data['price'] = 0;
        // $data['units'] = 0;
        // $data['timestamp'] = $timestamp;

        $signals[] = $data;
        $json_data = json_encode(array_values($signals));

        // echo($json_data);

        $fp = fopen($filename, "w");
        fwrite($fp, $json_data);
        fclose($fp);
        
        return redirect()->route('accdetail')->with('success', trans('accountdetail.action.success').' '.__('accountdetail.list.client_id').' #: '.$spclient->client_id);        
    }

    public function convertToLocal(string $date, $format = 'Y-m-d H:i:s'): string
    {
        $datetime = Carbon::parse($date);
        return $datetime->setTimezone(auth()->user()->timezone ?? config('app.timezone'))->format($format);
    }

    public function elapsedTimeSeconds(string $fromdate, $format = 'Y-m-d H:i:s'): int
    {
        $datetime = Carbon::parse($fromdate);
        return $datetime->diffInSeconds();
    }
}
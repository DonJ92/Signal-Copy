<?php


namespace App\Http\Controllers\API;

use App\ParamHistory;
use App\ParamState;
use App\FileState;
use App\AccountList;
use App\AccountDetail;
use App\TradeDetail;

use App\Http\Controllers\AccountDetailController;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Validator;

class SPApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function param_upload(Request $request, ParamState $param_state, ParamHistory $param_history)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'acct_id' => 'required',
            'symbol' => 'required',
            'balance' => 'required',
            'equity' => 'required',
            'margin' => 'required',
            'free_margin' => 'required',
            'margin_level' => 'required',
            'daily_profit' => 'required',
            'pos_profit' => 'required',
            'auto_open_s' => 'required',
            'auto_fill_lots_s' => 'required',
            'auto_close_s' => 'required',
            'p_range_min_s' => 'required',
            'p_range_max_s' => 'required',
            'lots_s' => 'required',
            'delta_pt_s' => 'required',
            'target_pt_s' => 'required',
            'auto_open_b' => 'required',
            'auto_fill_lots_b' => 'required',
            'auto_close_b' => 'required',
            'p_range_min_b' => 'required',
            'p_range_max_b' => 'required',
            'lots_b' => 'required',
            'delta_pt_b' => 'required',
            'target_pt_b' => 'required',
            'pt_val' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $param_state->updateOrCreate(
            ['client_id' => $input['acct_id']],
            [
                'client_id' => $input['acct_id'],
                'symbol_name' => $input['symbol'],
                'balance' => $input['balance'],
                'equity' => $input['equity'],
                'margin' => $input['margin'],
                'free_margin' => $input['free_margin'],
                'margin_level' => $input['margin_level'],
                'daily_profit' => $input['daily_profit'],
                'position_profit' => $input['pos_profit'],
                'b_auto_open' => $input['auto_open_b'],
                'b_auto_fill_lots' => $input['auto_fill_lots_b'],
                'b_auto_close' => $input['auto_close_b'],
                'b_price_min' => $input['p_range_min_b'],
                'b_price_max' => $input['p_range_max_b'],
                'b_lots' => $input['lots_b'],
                'b_delta_pt' => $input['delta_pt_b'],
                'b_target_pt' => $input['target_pt_b'],
                's_auto_open' => $input['auto_open_s'],
                's_auto_fill_lots' => $input['auto_fill_lots_s'],
                's_auto_close' => $input['auto_close_s'],
                's_price_min' => $input['p_range_min_s'],
                's_price_max' => $input['p_range_max_s'],
                's_lots' => $input['lots_s'],
                's_delta_pt' => $input['delta_pt_s'],
                's_target_pt' => $input['target_pt_s'],
                'point_value' => $input['pt_val'],
            ]
        );
        if (isset($input['updated'])) {
            $param_history->Create(
                [
                    'client_id' => $input['acct_id'],
                    'symbol_name' => $input['symbol'],
                    'balance' => $input['balance'],
                    'equity' => $input['equity'],
                    'margin' => $input['margin'],
                    'free_margin' => $input['free_margin'],
                    'margin_level' => $input['margin_level'],
                    'daily_profit' => $input['daily_profit'],
                    'position_profit' => $input['pos_profit'],
                    'b_auto_open' => $input['auto_open_b'],
                    'b_auto_fill_lots' => $input['auto_fill_lots_b'],
                    'b_auto_close' => $input['auto_close_b'],
                    'b_price_min' => $input['p_range_min_b'],
                    'b_price_max' => $input['p_range_max_b'],
                    'b_lots' => $input['lots_b'],
                    'b_delta_pt' => $input['delta_pt_b'],
                    'b_target_pt' => $input['target_pt_b'],
                    's_auto_open' => $input['auto_open_s'],
                    's_auto_fill_lots' => $input['auto_fill_lots_s'],
                    's_auto_close' => $input['auto_close_s'],
                    's_price_min' => $input['p_range_min_s'],
                    's_price_max' => $input['p_range_max_s'],
                    's_lots' => $input['lots_s'],
                    's_delta_pt' => $input['delta_pt_s'],
                    's_target_pt' => $input['target_pt_s'],
                    'point_value' => $input['pt_val'],
                ]
            );
        }
        return $this->sendResponse($input, 'Param is updated&inserted successfully.');
    }

    public function file_state_upload(Request $request, FileState $file_state)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'file_name' => 'required',
            'current_datetime' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $query = FileState::select('*')->where('file_name', 'like', $input['file_name'])->first();
        if ($query == null) {
            $file_state->updateOrCreate(
                ['file_name' => $input['file_name']],
                [
                'file_name' => $input['file_name'],
                'previous_datetime' => $input['current_datetime'],
                'current_datetime' => $input['current_datetime'],
            ]
            );

            return $this->sendResponse($input, 'File state is created successfully.');
        } else {
            $file_state->updateOrCreate(
                ['file_name' => $input['file_name']],
                [
                'file_name' => $input['file_name'],
                'previous_datetime' => $query->toArray()['current_datetime'],
                'current_datetime' => $input['current_datetime'],
            ]);

            return $this->sendResponse($input, 'File state is updated successfully.');
        }
    }

    public function uploadAccountDetail(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'broker_name' => 'required',
            'account_id' => 'required',
            // 'account_id' => "required|existsBrokerAccId:{$request->broker_name}",
            'unit_lots' => 'required|numeric',
            'currency' => 'required|string',
            'is_real' => 'required|int',
            'balance' => 'required|numeric',
            'equity' => 'required|numeric',
            'margin' => 'required|numeric',
            'free_margin' => 'required|numeric',
            'margin_level' => 'required|numeric',
            'pos_profit' => 'required|numeric',
            'daily_profit' => 'required|numeric',
            'daily_trades' => 'required|int',
            'daily_deposit' => 'required|numeric',
            'smb_cnt' => 'required|numeric',
            'symbols' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_pnl_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_pnl_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_cnt_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_cnt_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_lots_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'pos_lots_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'lmt_cnt_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'lmt_cnt_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'lmt_lots_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'lmt_lots_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'stp_cnt_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'stp_cnt_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'stp_lots_s' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
            'stp_lots_b' => "required_unless:smb_cnt,0|size:{$request->smb_cnt}",
        ], ['exists_broker_acc_id' => 'Invalid account!']);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $account = AccountList::where('account_id', $request->account_id)
            ->hasBroker($request->broker_name)->first();
        
        if (!$account) {
            return [
                'result' => false,
                'message' => 'Invalid account!'
            ];
        }

        // if ($account->spclient->vps->vps_ip != $request->ip())
        // {
        //     return ['ip' => 'Invalid IP ('.$request->ip().')'];
        // }

        $account_detail = AccountDetail::firstOrNew([
            'account_id' => $account->id
        ]);

        \DB::transaction(function () use ($data, $account, $account_detail) {
            $account_detail->is_real = $data['is_real'];
            $account_detail->currency = $data['currency'];
            $account_detail->unit_lots = $data['unit_lots'];
            $account_detail->balance = $data['balance'];
            $account_detail->equity = $data['equity'];
            $account_detail->margin = $data['margin'];
            $account_detail->margin_level = $data['margin_level'];
            $account_detail->free_margin = $data['free_margin'];
            $account_detail->pos_profit = $data['pos_profit'];
            $account_detail->daily_profit = $data['daily_profit'];
            $account_detail->daily_trades = $data['daily_trades'];
            $account_detail->deposit = $data['daily_deposit'];

            $account_detail->save();

            TradeDetail::where([
                'account_id' => $account->id
            ])->delete();
            
            if ($data['smb_cnt']) {
                foreach ($data['symbols'] as $key => $symbol) {
                    $tradedetail = TradeDetail::firstOrNew([
                        'account_id' => $account->id,
                        'symbol' => $symbol
                    ]);

                    $tradedetail->pos_profit_s = $data['pos_pnl_s'][$key];
                    $tradedetail->pos_profit_b = $data['pos_pnl_b'][$key];
                    $tradedetail->pos_cnt_s = $data['pos_cnt_s'][$key];
                    $tradedetail->pos_cnt_b = $data['pos_cnt_b'][$key];
                    $tradedetail->pos_lots_s = $data['pos_lots_s'][$key];
                    $tradedetail->pos_lots_b = $data['pos_lots_b'][$key];

                    $tradedetail->lmt_cnt_s = $data['lmt_cnt_s'][$key];
                    $tradedetail->lmt_cnt_b = $data['lmt_cnt_b'][$key];
                    $tradedetail->lmt_lots_s = $data['lmt_lots_s'][$key];
                    $tradedetail->lmt_lots_b = $data['lmt_lots_b'][$key];

                    $tradedetail->stp_cnt_s = $data['stp_cnt_s'][$key];
                    $tradedetail->stp_cnt_b = $data['stp_cnt_b'][$key];
                    $tradedetail->stp_lots_s = $data['stp_lots_s'][$key];
                    $tradedetail->stp_lots_b = $data['stp_lots_b'][$key];

                    $tradedetail->save();
                }
            }
        }, 5);
        
        return array('result' => true);
    }

    public function downloadSignal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'broker_name' => 'required',
            'account_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $account = AccountList::where('account_id', $request->account_id)
            ->hasBroker($request->broker_name)->first();
        
        if (!$account || !$account->spclient) {
            return [
                'result' => false,
                'message' => 'Invalid account!'
            ];
        }
        
        // if ($account->spclient->vps->vps_ip != $request->ip())
        // {
        //     return ['ip' => 'Invalid IP'];
        // }

        if ($account->spclient->token != $request->token)
        {
            return [
                'result' => false,
                'message' => 'Invalid Token!'
            ];
        }

        $signals = [];
        $signals_itself = [];
        
        $filename = $account->spclient->file_name;
        if (file_exists($filename)) {
            $signals_itself = json_decode(file_get_contents($filename), true);
        }
        
        if ($account->spclient->active) {
            $filename = $account->spclient->parent_file_name;
            if (file_exists($filename)) {
                $signals = json_decode(file_get_contents($filename), true);
            }
        }
        
        $signals = array_merge($signals, $signals_itself);

        echo(json_encode(array_values($signals)));
    }

    public function uploadSignal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_id' => 'required|string',
            'broker_name' => 'required|string',
            'ticket' => 'required|int',
            'cmd' => 'required|string',
            'op_type' => 'required|int',
            'symbol' => 'required|string',
            'price' => 'required|numeric',
            'new_price' => 'required|numeric',
            'units' => 'required|numeric',
            'spread' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return $validator->errors();
        }

        $account = AccountList::where('account_id', $request->account_id)
            ->hasBroker($request->broker_name)->first();
        
        if (!$account || !$account->spclient) {
            return [
                'result' => false,
                'message' => 'Invalid account!'
            ];
        }

        // if ($account->spclient->vps->vps_ip != $request->ip())
        // {
        //     return ['ip' => 'Invalid IP'];
        // }

        if ($account->spclient->token != $request->token)
        {
            return [
                'result' => false,
                'message' => 'Invalid Token!'
            ];
        }
        
        $timestamp = round(microtime(true) * 1000);
        
        $data['cmd'] = $request->cmd;
        $data['ticket'] = (int)$request->ticket;
        $data['op_type'] = (int)$request->op_type;
        $data['symbol'] = $request->symbol;
        $data['price'] = (double)$request->price;
        $data['new_price'] = (double)$request->new_price;
        $data['units'] = (double)$request->units;
        $data['spread'] = (double)$request->spread;
        $data['timestamp'] = $timestamp;
        
        $filename = $account->spclient->file_name;
        
        if (file_exists($filename)) {
            $signals = json_decode(file_get_contents($filename), true);
            if ($signals !== null) {
                foreach ($signals as $key => $signal) {
                    if ($timestamp - $signal['timestamp'] > 100 * 1000) {
                        unset($signals[$key]);
                    }
                }
            }
        }

        $signals[] = $data;
        $json_data = json_encode(array_values($signals));

        $fp = fopen($filename, "w");
        fwrite($fp, $json_data);
        fclose($fp);

        return array('result' => true);
    }

    public function getGMTOffset()
    {
    //target time zone
        $target_time_zone = new \DateTimeZone(config('app.timezone'));

        //find kolkata time 
        $datetime = new \DateTime('now', $target_time_zone);

        //get the exact GMT format
        echo $target_time_zone->getOffset($datetime) / 3600;
    }
}

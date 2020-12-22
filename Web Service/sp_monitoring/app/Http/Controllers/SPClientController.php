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

class SPClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('spclient.list');
    }

    public function getSPClientList(Request $request)
    {
        $client_id = $request->input('client_id');
        $customer_id = $request->input('customer_id');
        $vps_name = $request->input('vps_name');
        $signal_type = $request->input('signal_type');

        $spclient_list = array();
        try {
            $query = SPClient::leftjoin('tbl_account_list', 'tbl_spclient.account_id', '=', 'tbl_account_list.id')
                ->leftjoin('tbl_vps_list', 'tbl_spclient.vps_id', '=', 'tbl_vps_list.id')
                ->leftjoin('tbl_brokers', 'tbl_account_list.broker_id', '=', 'tbl_brokers.id')
                ->select('tbl_spclient.*', 'tbl_account_list.customer_id as customer_id', \DB::raw('CONCAT(tbl_account_list.account_id, ", ", tbl_brokers.alias_name) as account_info'), 'tbl_vps_list.vps_name as vps_name')
                ->orderBy('tbl_spclient.account_id', 'asc');
            
            if (!empty($client_id))
                $query->where('tbl_spclient.client_id', 'like', '%'.$client_id.'%');
            if (!empty($customer_id))
                $query->where('tbl_account_list.customer_id', 'like', '%'.$customer_id.'%');
            if (!empty($vps_name))
                $query->where('tbl_vps_list.vps_name', 'like', '%'.$vps_name.'%');
            if (isset($signal_type) && is_numeric($signal_type))
                $query->where('tbl_spclient.signal_type', '=', $signal_type);

            $spclient_list = $query->get()->toArray();

            foreach ($spclient_list as &$spclient) {
                if ($spclient['signal_type'])
                    $spclient['subclients'] = \App\SPClient::find($spclient['id'])->children()->get()->toArray(); 
                else
                    $spclient['subclients'] = [];
            }

			//print_r($spclient_list);exit;
        } catch (QueryException $e) {
            print_r($e->getMessage());
            // die();
            // return $spclient_list;
        }
        
        return $spclient_list;
    }

    public function getNewToken()
    {
        return SPClient::generate_app_code(1);
    }

    public function register()
    {
        $account_list = array();
        $vps_list = array();
        $spmaster_list = array();
        
        try
        {
            $account_list = AccountList::with('broker')->select('id', 'customer_id', 'broker_id', 'account_id')->orderby('customer_id', 'asc')->get()->toArray();
            $vps_list = VPSList::select('id', 'vps_name')->orderby('vps_name', 'asc')->get()->toArray();
			$spmaster_list = SPClient::where('signal_type', 1)->get()->toArray();
        } catch (QueryException $e)
        {
            print_r($e->getMessage());
            die();
        }

        $data['account_list'] = $account_list;
        $data['vps_list'] = $vps_list;
		$data['master_list'] = $spmaster_list;

        return view('spclient.register', $data);
    }

    public function registerAction(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'client_id' => 'required|unique:tbl_spclient|max:128',
            'account_id' => 'required|max:128|unique:tbl_spclient,account_id',
            'vps_id' => 'required|max:128',
            'signal_type' => 'required|max:128',
			'signalmaster_id' => 'required_if:signal_type,0|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $res = SPClient::create([
            'client_id' => $data['client_id'],
            'account_id' => $data['account_id'],
            'vps_id' => $data['vps_id'],
            'signal_type' => $data['signal_type'],
            'parent_id' => isset($data['signalmaster_id']) ? $data['signalmaster_id'] : 0,
            'token' => $data['token']
        ]);

        return redirect()->route('spclient')->with('success', trans('spclient.register.success'));
    }

    public function detail($id)
    {
        if (empty($id))
            return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.no_info')]);

        try {
            $spclient = SPClient::where('id', $id)->first();

            if (is_null($spclient))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.no_info')]);

            $account_list = AccountList::with('broker')->get()->toArray();
            
            $vps_list = VPSList::select('id', 'vps_name')->orderby('vps_name', 'asc')->get()->toArray();

            $spmaster_info = SPClient::where('signal_type', 1)->get()->toArray();

            $data = $spclient->toArray();
        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.no_info')]);
        }

        $data['account_list'] = $account_list;
        $data['vps_list'] = $vps_list;
		$data['master_list'] = $spmaster_info;
		$data['signal_token'] = '';

        return view('spclient.detail', $data);
    }

    public function updateAction(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'client_id' => 'required|unique:tbl_spclient,client_id,'.$data['id'].'|max:128',
            'account_id' => 'required|max:128|unique:tbl_spclient,account_id,'.$data['id'],
            'vps_id' => 'required|max:128',
            'signal_type' => 'required|max:128',
			'signalmaster_id' => 'required_if:signal_type,0|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try {
            $spclient = SPClient::where('id', $data['id'])->first();
            if (is_null($spclient))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.failed')]);
            
            $spclient->client_id = $data['client_id'];
            $spclient->account_id = $data['account_id'];
            $spclient->vps_id = $data['vps_id'];
            $spclient->signal_type = $data['signal_type'];
            $spclient->token = $data['token'];

			if(!$spclient->signal_type)
				$spclient->parent_id = $data['signalmaster_id'];
			else
				$spclient->parent_id = 0;

            $spclient->save();
        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('spclient.detail.failed')]);
        }

        return redirect()->route('spclient')->with('success', trans('spclient.detail.success'));
    }

    public function deleteAction(Request $request, $id)
    {
        SPClient::findOrFail($id)->delete();

        return redirect()->route('spclient')->with('success', trans('spclient.detail.success'));
    }
}
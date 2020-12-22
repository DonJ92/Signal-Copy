<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\AccountList;
use App\AccountDetail;
use App\Broker;

class AccountListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accountlist.list');
    }

    public function getAccountList(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $account_id = $request->input('account_id');
        $broker_name = $request->input('broker_name');

        $accounts = AccountList::with('broker')
            ->where(function($query) use($customer_id, $account_id, $broker_name) {            
                if (!empty($customer_id))
                    $query->where('customer_id', 'like', '%'.$customer_id.'%');            
                    
                if (!empty($account_id))
                    $query->where('account_id', 'like', '%'.$account_id.'%');
                    
                if (!empty($broker_name)) {
                    $query->whereHas('broker', function ($q) use ($broker_name) {
                        $q->where('alias_name', 'like', '%'.$broker_name.'%');
                    });
                }
            })->get()->toArray();

        return $accounts;
    }

    public function register()
    {
        return view('accountlist.register')
            ->withBrokers(Broker::all());
    }

    public function registerAction(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'customer_id' => 'required|max:128',
            'broker_id' => 'required|integer',
            'account_id' => "required|max:128|uniqueBrokerAccId:{$request->broker_id}"
        ], ['unique_broker_acc_id' => 'This broker account already exists']);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        \DB::transaction(function() use($data) {
            $account_info = AccountList::create([
                'customer_id' => $data['customer_id'],
                'account_id' => $data['account_id'],
                'broker_id' => $data['broker_id'],
            ]);
            
            AccountDetail::firstOrCreate(['account_id' => $account_info->id]);
        });

        return redirect()->route('accountlist')->with('success', trans('accountlist.register.success'));
    }

    public function detail($id)
    {
        if (empty($id))
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountlist.detail.no_info')]);


        $account = AccountList::with('broker')->where('id', $id)->first();
        if (!$account)
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountlist.detail.no_info')]);

        return view('accountlist.detail', $account->toArray())
            ->withBrokers(Broker::all());
    }

    public function updateAction(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id' => 'required|numeric',
            'customer_id' => 'required|max:128',
            'account_id' => "required|max:128|uniqueBrokerAccId:{$request->broker_id},{$request->id}",
            'broker_id' => 'required|integer',
        ], ['unique_broker_acc_id' => 'This broker account already exists']);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try {
            $account_info = AccountList::where('id', $data['id'])->first();
            if (is_null($account_info))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('accountlist.detail.failed')]);

            $account_info->customer_id = $data['customer_id'];
            $account_info->account_id = $data['account_id'];
            $account_info->broker_id = $data['broker_id'];
           
            $account_info->save();

            AccountDetail::firstOrCreate(['account_id' => $account_info->id]);

        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('accountlist.detail.failed')]);
        }

        return redirect()->route('accountlist')->with('success', trans('accountlist.detail.success'));
    }

    public function deleteAction(Request $request, $id)
    {
        AccountList::findOrFail($id)->delete();

        return redirect()->route('accountlist')->with('success', trans('accountlist.detail.success'));
    }
}
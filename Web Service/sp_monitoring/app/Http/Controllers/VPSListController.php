<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;


use App\VPSList;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VPSListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('vpslist.list');
    }

    public function getVPSList(Request $request)
    {
        $vps_name = $request->input('vps_name');
        $customer_id = $request->input('customer_id');
        $vps_ip = $request->input('vps_ip');

        $vps_list = array();
        try {
            $query = VPSList::select('tbl_vps_list.*')
                ->orderBy('tbl_vps_list.customer_id', 'asc');

            if (!empty($vps_name))
                $query->where('tbl_vps_list.vps_name', 'like', '%'.$vps_name.'%');
            if (!empty($customer_id))
                $query->where('tbl_vps_list.customer_id', 'like', '%'.$customer_id.'%');
            if (!empty($vps_ip))
                $query->where('tbl_vps_list.vps_ip', 'like', '%'.$vps_ip.'%');
           
            $vps_list = $query->get()->toArray();
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            return $vps_list;
        }

        return $vps_list;
    }

    public function register()
    {
        return view('vpslist.register');
    }

    public function registerAction(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'vps_name' => 'required|max:128',
            'customer_id' => 'required|max:128',
            'vps_ip' => 'required|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try{
            $res = VPSList::insert([
                'vps_name' => $data['vps_name'],
                'customer_id' => $data['customer_id'],
                'vps_ip' => $data['vps_ip'],
            ]);

            if ($res === null)
                return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.register.failed')]);
        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.register.failed')]);
        }

        return redirect()->route('vpslist')->with('success', trans('vpslist.register.success'));
    }

    public function detail($id)
    {
        if (empty($id))
            return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.detail.no_info')]);

        try {
            $vps_info = VPSList::where('id', $id)->first();
            if (is_null($vps_info))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.detail.no_info')]);

            $data = $vps_info->toArray();
        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.detail.no_info')]);
        }

        return view('vpslist.detail', $data);
    }

    public function updateAction(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'vps_name' => 'required|max:128',
            'customer_id' => 'required|max:128',
            'vps_ip' => 'required|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try {
            $vps_info = VPSList::where('id', $data['id'])->first();
            if (is_null($vps_info))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.detail.failed')]);
            
            $vps_info->vps_name = $data['vps_name'];
            $vps_info->customer_id = $data['customer_id'];
            $vps_info->vps_ip = $data['vps_ip'];
           
            $vps_info->save();

        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('vpslist.detail.failed')]);
        }

        return redirect()->route('vpslist')->with('success', trans('vpslist.detail.success'));
    }

    public function deleteAction(Request $request, $id)
    {
        VPSList::findOrFail($id)->delete();

        return redirect()->route('vpslist')->with('success', trans('vpslist.detail.success'));
    }
}
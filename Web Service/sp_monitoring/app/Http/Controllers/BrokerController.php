<?php

namespace App\Http\Controllers;

use App\Broker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrokerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('broker.list');
    }

    public function getBrokerList(Request $request)
    {
        $alias_name = $request->input('alias_name');
        $name = $request->input('name');

        $brokers = Broker::where(function($query) use($alias_name, $name) {            
            if (!empty($alias_name))
                $query->where('alias_name', 'like', '%'.$alias_name.'%');            
            if (!empty($name))
                $query->where('name', 'like', '%'.$name.'%');    
        })->get()->toArray();

        return $brokers;
    }

    public function register()
    {
        return view('broker.register');
    }

    public function registerAction(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'alias_name' => 'required|max:128|unique:tbl_brokers',
            'name' => 'required|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        Broker::create([
            'alias_name' => $data['alias_name'],
            'name' => $data['name']
        ]);

        return redirect()->route('broker')->with('success', trans('broker.register.success'));
    }

    public function detail($id)
    {
        return view('broker.detail')
            ->withBroker(Broker::findOrFail($id));
    }

    public function updateAction(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'id' => 'required|numeric',
            'alias_name' => 'required|max:128|unique:tbl_brokers,alias_name,'.$request->id,
            'name' => 'required|max:128',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        Broker::findOrFail($request->id)->update([
            'alias_name' => $data['alias_name'],
            'name' => $data['name']
        ]);

        return redirect()->route('broker')->with('success', trans('broker.detail.success'));
    }

    public function deleteAction(Request $request, $id)
    {
        Broker::findOrFail($id)->delete();

        return redirect()->back()->with('success', trans('broker.delete.success'));
    }
}

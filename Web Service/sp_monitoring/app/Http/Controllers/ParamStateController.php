<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;


use App\ParamState;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParamStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('paramstate.list');
    }

    public function getParamStateList(Request $request)
    {
        $client_id = $request->input('client_id');

        $param_state = array();
        try {
            $query = ParamState::select('*')
                ->orderBy('client_id', 'asc');

            if (!empty($client_id))
                $query->where('client_id', 'like', '%'.$client_id.'%');
                
            $param_state = $query->get()->toArray();
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            return $param_state;
        }

        return $param_state;
    }

    public function detail($id)
    {
        if (empty($id))
            return redirect()->back()->withInput()->withErrors(['failed' => trans('paramstate.detail.no_info')]);

        try {
            $param_state = ParamState::where('id', $id)->first();
            if (is_null($param_state))
                return redirect()->back()->withInput()->withErrors(['failed' => trans('paramstate.detail.no_info')]);

            $data = $param_state->toArray();
        } catch (QueryException $e) {
            return ($e->getMessage());
            die();
            return redirect()->back()->withInput()->withErrors(['failed' => trans('paramstate.detail.no_info')]);
        }

        return view('paramstate.detail', $data);
    }

}
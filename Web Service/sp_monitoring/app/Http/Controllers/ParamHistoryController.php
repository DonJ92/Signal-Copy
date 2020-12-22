<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;


use App\ParamHistory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParamHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('paramhistory.list');
    }

    public function getParamHistory(Request $request)
    {
        $client_id = $request->input('client_id');

        $param_history = array();
        try {
            $query = ParamHistory::select('*')
                ->orderBy('register_date', 'desc');

            if (!empty($client_id))
                $query->where('client_id', 'like', '%'.$client_id.'%');

            $param_history = $query->get()->toArray();
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            return $param_history;
        }

        return $param_history;
    }

}
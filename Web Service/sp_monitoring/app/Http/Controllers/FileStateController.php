<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 9/20/2019
 * Time: 5:56 PM
 */

namespace App\Http\Controllers;


use App\FileState;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('filestate.list');
    }

    public function getFileStateHistory(Request $request)
    {
        $client_id = $request->input('client_id');

        $file_state_history = array();
        try {
            $query = FileState::select('*')
                ->orderBy('file_name', 'asc');

            $file_state_history = $query->get()->toArray();
        } catch (QueryException $e) {
            print_r($e->getMessage());
            die();
            return $file_state_history;
        }

        return $file_state_history;
    }

}
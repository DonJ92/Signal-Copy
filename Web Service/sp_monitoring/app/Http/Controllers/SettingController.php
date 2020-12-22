<?php
namespace App\Http\Controllers;


use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('setting');
    }

    public function updatePwd(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($data['current_password'], $user->password))
            $validator->errors()->add('current_password', trans('setting.invalid_cur_pwd'));

        $errors = $validator->errors();
        if (!$errors->isEmpty())
            return redirect()->back()->withInput()->withErrors($errors);

        try {
            $user->password = bcrypt($data['new_password']);
            $user->save();
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('setting.pwd_update_failed')]);
        }

        return redirect()->route('setting')->with('success', trans('setting.pwd_update_succeed'));
    }
}
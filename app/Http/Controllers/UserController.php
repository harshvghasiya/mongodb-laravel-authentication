<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function create()
    {
    	return view('addedit');
    } 

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
    	if (isset($request->id) && $request->id != null) {
    		$res = User::find(\Crypt::decryptString($request->id));
    	}else{
    		$res = new User;
    	}

    		$res->first_name = $request->first_name;
    		$res->password = \Hash::make($request->password);
    		$res->save();

    		$url = route('admin.login');
    		$msg = "User register successfully";
    		flashMessage('success',$msg);
            return response()->json(['msg' => $msg, 'status' => true, 'url' => $url]);

    }

    public function index()
    {
    	$users = User::all();
    	return view('index',compact('users'));
    }

    public function edit(Request $request, $id)
    {
        $encryptedId = $id;
        
        $user = User::where('_id',\Crypt::decryptString($id))->first();
        return view('addedit',compact('encryptedId','user'));
    }

    public function destroy($id)
    {
        User::where('_id',\Crypt::decryptString($id))->delete();
        return response()->json(['success' => 1, 'msg' => 'User Deleted successfully']);

    }

    public function postLogin(Request $request)
    {
        if (\Auth::attempt(['first_name' => $request->get('first_name'), 'password' => $request->get('password')])) {
            flashMessage('success','Login done successfully');
            $url=route('admin.user.index');
           return response()->json(['msg'=>'Login Success','url'=>$url,'status'=>false]);
            
        } else {
           flashMessage('error','Invalid Username or password');
           $error='Invalid Username or password';
           $url=route('admin.login');
           return response()->json(['error'=>$error,'url'=>$url,'status'=>false]);
        }
    }

    public function logout()
    {
        \Auth::logout();
        flashMessage('success','Logout successfully done');
        return redirect(route('admin.login'));
    }


}

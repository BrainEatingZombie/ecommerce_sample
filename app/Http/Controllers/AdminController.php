<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class AdminController extends Controller
{
    public function login(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->input();
    		if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])) {
    			// echo "Success"; die;
                /* Session
                Session::put('adminSession',$data['email']);              
                 */
                return redirect('admin/dashboard');
    		}
    		else{
    			// echo "Failed"; die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
    		}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard(){
        /* Session        
        if (Session::has('adminSession')) {
            # Perfrom all dashboard tasks
        }
        else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }*/
        return view('admin.dashboard');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }
}

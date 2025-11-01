<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AccessController extends Controller
{
    public function adminLogin(Request $request)
    {
    	try
        {
            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Check login credentials is admin user
            $isAdmin = User::where('email', $request->email)->where('role', 'admin')->first();
            if (!$isAdmin) {
                $notification = array(
                    'messege' => 'Access denied. Not an admin user.',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

        	$data = $request->all();


		    	if(Auth::attempt(['email'=> $data['email'], 'password'=>$data['password']])){

		    		$notification=array(
		                     'messege'=>'Successfully Logged In',
		                     'alert-type'=>'success'
		                    );

		           return redirect('/dashboard')->with($notification);
		    	}else{
		    		$notification=array(
		                     'messege'=>'Email or Password Invalid ',
		                     'alert-type'=>'error'
		                    );

		          return Redirect()->back()->with($notification);
	    	}
	   }catch(Exception $e){

                $message = $e->getMessage();

                $code = $e->getCode();

                $string = $e->__toString();
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function adminLogout()
    {
    	try
    	{
    		Auth::logout();
    		return redirect('/admin/login');
    	}catch(Exception $e){

                $message = $e->getMessage();

                $code = $e->getCode();

                $string = $e->__toString();
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}

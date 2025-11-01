<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserAuthController extends Controller
{
    public function loginRegister()
    {
    	return view('fronts.login_register');
    }

    public function userSignup(Request $request)
    {
    	try
    	{
    		$countEmail = User::where('email',$request->email_1)->count();
    		$countPhone = User::where('phone',$request->phone_1)->count();

    		if(!$request->has('email_1') && !$request->has('phone_1')){
    			return response()->json(['status'=>false, 'message'=>'Please give email or phone']);
    		}



    		if($countEmail > 0 && $countPhone > 0){
    			return response()->json(['status'=>false, 'message'=>'The Email Address and Phone Number Already Exist']);
    		}elseif($countEmail > 0){
    			return response()->json(['status'=>false, 'message'=>'The Email Address Already Exist']);
    		}elseif($countPhone > 0){
    			return response()->json(['status'=>false, 'message'=>'The Phone Number Already Exist']);
    		}



    		if($request->password_1 != $request->password_2){
    			return response()->json(['status'=>false, 'message'=>'Password and Confirm password must same']);
    		}

    		$user = new User();
    		$user->name = $request->name_1;
    		$user->role = 'user';
    		$user->email = $request->email_1;
    		$user->phone = $request->phone_1;
    		$user->password = bcrypt($request->password_1);
    		$user->status = 'Active';
    		$user->save();

    		Auth::login($user);

    		return response()->json(['status'=>true, 'user_id'=>intval($user->id), 'message'=>'Successfully singnup']);

    	}catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function userSignin(Request $request)
    {
    	try
    	{
    		$data = $request->all();

			$loginField = filter_var($data['email_or_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

			if (Auth::attempt([$loginField => $data['email_or_phone'], 'password' => $data['password']])) {
			    return response()->json(['status'=>true, 'message'=>'Successfully signin']); 
			} else {
			    return response()->json(['status'=>false, 'message'=>'Email/Phone or Password Invalid']); 
			}

    	}catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function userLogout()
    {
    	try
    	{
    		if(Auth::check()){
    			if(Auth::user()->role == 'user'){
    				Auth::logout();
    				$notification=array(
		                'messege'=>"Successfully Logged Out",
		                'alert-type'=>"success",
		            );

		            return redirect('/')->with($notification);
    			}

    			$notification=array(
		                'messege'=>"Something Went Wrong",
		                'alert-type'=>"error",
		            );

		        return redirect('/')->with($notification);
    		}

    		$notification=array(
                'messege'=>"Something Went Wrong",
                'alert-type'=>"error",
		    );

		    return redirect('/')->with($notification);
    		 
    	}catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}

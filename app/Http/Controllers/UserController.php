<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function passwordChange()
    {
        return view('admin.settings.change_password');
    }
    public function changePassword(Request $request)
    {
        try
        {
            $user = User::findorfail(Auth::user()->id);

            if (!Hash::check($request->current_password, $user->password)) {

                $notification=array(
                    'messege' => 'The current password is not matched',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

            if ($request->new_password !== $request->confirm_password) {

                $notification=array(
                    'messege' => 'The new & confirm password are not matched',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

            $user->password = Hash::make($request->new_password);
            $user->update();


            $notification=array(
                'messege' => 'Successfully your has been changed',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard')->with($notification);

        } catch(Exception $e) {
            // Log the error
            Log::error('Error in changePassword: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $notification=array(
                'messege' => 'Something went wrong!!!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}

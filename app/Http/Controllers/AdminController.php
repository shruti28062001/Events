<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\News;
use App\Models\Clients;
use App\Models\Event;
use App\Models\Expo;
use Auth;
use Image;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class AdminController extends Controller
{
    public function getLogin(){
        
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();
            
            // dd($adminCount);
            if(Auth::attempt(['email' => $data['email'],'password'=>md5($data['password'])])){
                return redirect()->route('adminDashboard')->with('flash_message_error','You are Logged in sucessfully.');
            }
            else{
                return back()->with('flash_message_error','Invalid Email or Password');
            }
        }
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $adminCount = Admin::where(['email' => $data['email'],'password'=>md5($data['password'])])->count();
            if($adminCount > 0){
                Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin-login')->with('flash_message_error','Invalid Email or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function logout(){
        Session::flush();
        return view('admin.admin_login')->with('flash_message_success','Logged Out Successfully');
    }

    public function setting(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $adminCount = Admin::where(['email' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            if($adminCount == 1){
                $password = md5($data['new_pwd']);
                $email = $data['email'];
                $confirm_password = md5($data['confirm_pwd']);
                if($password == $confirm_password)
                {
                    Admin::where('email',Session::get('adminSession'))->update(['password'=>$password]);
                    return redirect('/admin/admin-setting')->with('flash_message_success','Password Updated Successfully!');
                }else{
                    return redirect('/admin/admin-setting')->with('flash_message_error','New password and confirm password must be same!');
                }
            }else{
                return redirect('/admin/admin-setting')->with('flash_message_error','Incorrect Current Password!');
            }
        }
        $admin = Admin::first();
        return view('admin.admin_setting')->with(compact('admin'));
    }

    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $adminCount = Admin::where(['email' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            if (Hash::check($data['password'], $adminCount->password)) {
                Admin::where('email',Auth::Admin()->email)->update(['password'=>bcrypt($data['new_password'])]);
                return redirect()->back()->with('flash_message_success','Password updated successfully');
            }else{
                return redirect()->back()->with('flash_message_error','Incorrect current password');
            }
        }
        $meta_title = 'Change Password | Kirtane & Pandit';
        return view('users.changePassword')->with(compact('meta_title'));   
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Admin::where('email',$data['email'])->first();
            if($user && !empty($user->google_id)){
                Alert::toast('<p style="color:black">Your account is register with google </p>','warning');    
                return redirect()->back();
            }
            $user = Admin::where('email',$data['email'])->first();
            if(empty($user)){
                return redirect()->back()->with('flash_message_error','We can not find a user with that Email address.');
            }

            //generate otp
            $otp = random_int(100000, 999999);
            Session::put('resetPassOTP',$otp);

            //send forgot email password email code
            $email = $data['email'];            
            $messageData = [
                'name'=>$user->name,                
                'otp'=>$otp
            ];
            Mail::send('emails.forgotpassword_otp',$messageData,function($message) use($email){
                $message->to($email)->subject('New Password - Kirtane & Pandit.');
            });

            return redirect('reset-password')->with('flash_message_success','OTP sent on email to reset password');
        }
        return view('forgotpassword');
    }

    public function resetPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);

            $user = Admin::where('email',$data['email'])->first();
            if(empty($user)){
                return redirect()->back()->with('flash_message_error','We can not find a user with that Email address.');
            }
            
            if($data['otp'] != Session::get('resetPassOTP')){
                return redirect()->back()->with('flash_message_error','Incorrect OTP. Please enter again.');
            }else{
                //update pwd
                Admin::where('email',$data['email'])->update(['password'=>md5($data['password'])]);
                Session::forget('resetPassOTP');
            }
            return redirect('/admin-login')->with('flash_message_success','Password has been reset successfully. Please login');
            // Alert::toast('<p style="color:black">Password has been reset successfully. Please login</p>','success');
            // return redirect('loginpage');
        }
        return view('users.reset_password');
    } 

    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::Admin()->id;
        $check_password = Admin::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $old_pwd = Admin::where('id',Auth::Admin()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                // Update password
                $new_pwd = bcrypt($data['new_pwd']);
                Admin::where('id',Auth::Admin()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password updated successfully!');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect!');
            }
        }
    }    

    public function viewDashboard(Request $request){
        $events= DB::table('events')->count();
        $ratings = DB::table('ratings')-> count();
        
        
        return view('admin.dashboard')->with(compact('events','ratings'));
         
    }

}

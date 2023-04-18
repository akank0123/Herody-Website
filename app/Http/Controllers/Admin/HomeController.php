<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Gig;
use App\PendingGig;
use App\User;
use App\Withdraw;
use App\WithdrawRequest;
use Carbon\Carbon;
use App\Bform;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }
    
    public function bformv(){
         $bforms = Bform::latest()->paginate(10);
        return view("admin.bforms")->with([
            "bforms"=>$bforms,
        ]);
    }
    public function delete(Request $request){
        $this->validate($request,[
            "id"=>"required"
        ]);
        $bform = Bform::find($request->id);
        if($bform===NULL){
            abort(404);
        }
        else{
         $bform->delete();
         $request->session()->flash('success', "Response successfully deleted");
        return redirect()->back();
            
        }
    }
    public function login(Request $request)
    {
        //validation
        $this->validate($request, [
            'userName' => 'required',
            'password' => 'required|min:5'
        ]);

        if (Auth::guard('admin')->attempt(['userName' => $request->userName, 'password' => $request->password], $request->get('remember'))) {

            //redirect
            Session()->flash('success', 'You are successfully logged in !');
            return redirect()->route('admin.dashboard');
        } else {
            //redirect
            Session()->flash('warning', 'Please enter correct email and password!');
            return redirect()->route('admin.login');
        }
    }

    //logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin');
    }

    //change password
    public function changePassword()
    {

        return view('admin.auth.changeAdminPassword');
    }

    //password update
    public function PasswordUpdate(Request $request)
    {
        //validation
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);


        $AdminPassword = Auth::guard('admin')->user()->password;

        if (password_verify($request->current_password, $AdminPassword)) {

            //update query
            $userId = Auth::guard('admin')->id();

            $admin = Admin::find($userId);

            $admin->password = Hash::make($request->password);
            $admin->save();

            //redirect
            Session()->flash('success', 'Password Change successful!');
            return redirect()->back();
        } else {
            //redirect
            Session()->flash('warning', 'Please enter correct password!');
            return redirect()->back();

        }
    }
}

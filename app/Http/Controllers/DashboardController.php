<?php

namespace App\Http\Controllers;
use App\Models\EmployeeAttendance; 
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index(){
      

        if(Auth::user()->type=='admin' || Auth::user()->type==1){
       
            // return view('admin.dashboard');
            return redirect()->route('users');
         
        }else{
   
            $attendance_status = EmployeeAttendance::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
            return view('user.dashboard',compact('attendance_status'));
        } 
    }
}

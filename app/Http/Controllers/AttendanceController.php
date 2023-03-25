<?php

namespace App\Http\Controllers;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function punch_in(){
        $attendance_status = EmployeeAttendance::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
        if(isset($attendance_status) && $attendance_status->leave_time ==null){ 

            $attendance_status->update(['leave_time'=>new \DateTime('now', new \DateTimezone('Asia/Dhaka'))]); 
            return response()->json([
                'status' => "success",
                'message' => "Punch Out Success",
                'text' =>"Push In"
            ]);

        }else{

            EmployeeAttendance::create([
                "user_id"=>auth()->user()->id,
                'attend_time' => new \DateTime('now', new \DateTimezone('Asia/Dhaka')),
            ]);
    
            return response()->json([
                'status' => "success",
                'message' => "Punch In Success",
                'text' =>"Push Out"
            ]);
 
        }
       
    }

    public function report(Request $request){
        if ($request->ajax()) { 
            $data = EmployeeAttendance::where('user_id',Auth::user()->id)->latest()->select('*');
      
            return Datatables::of($data)
                    
                ->addColumn('date', function($row){
                    return date('dS M-Y',strtotime($row->created_at));
                })
                ->addColumn('in_time', function($row){
                    return date('H:mA',strtotime($row->attend_time)); 
                })

                ->addColumn('out_time', function($row){

                    if($row->leave_time==null){
                        return ' ';
                    }else{
                        return date('H:mA',strtotime($row->leave_time)); 
                    } 

                    
                })

              ->addColumn('worked', function($row){ 
                  if($row->leave_time==null){
                     return '';
                  }else{
                    return date('H:G:i', date('now') - strtotime($row->attend_time));
                  } 
                
                })

                ->filter(function ($instance) use ($request) {

                  
                    if (!empty($request->get('user'))) {
                        $instance->where('user_id', $request->get('user'));
                    } 

                }) 
 
                    ->rawColumns(['id','date','in_time','out_time','worked'])
                    ->make(true);
        }

        $users = User::get();
        return view('admin.report',compact('users'));
    }
}



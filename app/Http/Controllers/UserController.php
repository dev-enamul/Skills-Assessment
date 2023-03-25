<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeContact;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Image;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
class UserController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = User::where('type',0)->select('*')->latest();
           
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         if($row->status){
                            return '<span onclick=update_status('.$row->id.') class="badge badge-primary">Active</span>';
                         }else{
                            return '<span onclick=update_status('.$row->id.') class="badge badge-danger">Deactive</span>';
                         }
                    })

                    ->addColumn('action', function($row){
                        return '<a href="'.url('edit/user/'.$row->id).'"> <span class="material-symbols-outlined btn btn-success btn-sm"> edit </span></a>
                        <a href="'.url('view/user/'.$row->id).'"><span class="material-symbols-outlined btn btn-info btn-sm"> visibility </span></a>
                        <span onclick=delete_data('.$row->id.') class="material-symbols-outlined btn btn-danger btn-sm"> delete </span>';
                   })


                    ->filter(function ($instance) use ($request) {

                        if ($request->get('status') == '0' || $request->get('status') == '1') {
                            $instance->where('status','=', $request->get('status'));
                        }

                        if (!empty($request->get('name'))) {
                            $instance->where('name','like','%'. $request->get('name').'%');
                        }

                        if (!empty($request->get('email'))) {
                            $instance->where('email','like','%'. $request->get('email').'%');
                        }

                        if (!empty($request->get('phone'))) {
                            $instance->where('phone','like','%'. $request->get('phone').'%');
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                    return true;
                                }else if (Str::contains(Str::lower($row['phone']), Str::lower($request->get('search')))) {
                                    return true;
                                }
   
                                return false;
                            });
                        }
  
   
                    }) 

                    ->rawColumns(['status','action'])
                    ->make(true);
        }

         return  view('admin.users');
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'email|required|max:255|unique:users',
            'password'=>'required|max:255',
            'ip_address' =>'nullable|max:45',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => "fail",
                'message' => $validator->errors()->first()
            ]);
          
        }
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

   
        if(isset($input['ip_address'])){
            $input['user_id'] = $user->id;
            EmployeeDetail::create($input);
        } 

        return response()->json([
            'status' => "success",
            'message' => "Employee Ceated"
        ]);



 
    }


    public function status($id){
        try{
            $user = User::find($id);
            if($user->status==1){
                $user->status=0;
            }else{
                $user->status =1;
            }
            $user->save();
            return response()->json([
                'status' => "success",
                'message' => "Status Updated"
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' => "Something Wrong"
            ]);
        }
    }

    public function delete($id){
        try{
            $user = User::find($id)->delete();
             
            return response()->json([
                'status' => "success",
                'message' => "User Deleted"
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' => "Something Wrong"
            ]);
        }
    } 
    public function profile(){
        $user = User::find(Auth::user()->id);
        return view('user.profile',compact('user'));
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'email|required|max:255|unique:users',
            'password'=>'required|max:255',
            'ip_address' =>'nullable|max:45',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);  

        $input = $request->all(); 
        try{ 
            if($request->hasfile('photo'))
            { 
                $imageName = time().'.'.$request->photo->extension();   
                $request->photo->move(public_path('images/profile/'), $imageName); 
                $input["photo"] = $imageName;
            } 
            
    
            if(isset($request->id)){
                $user = User::find($request->id);
            }else{
                $user = User::find(Auth::user()->id);
            }
            
            $input['user_id'] = $user->id;
            $details = EmployeeDetail::where('user_id', Auth::user()->id)->first();
            $contact = EmployeeContact::where('user_id', Auth::user()->id)->first();
    
            $user->update($input);
            if($details!=null){
                $details->update($input);
            }else{
                EmployeeDetail::create($input);
            }
    
    
            if($contact != null){
                $contact->update($input);
            }else{
                EmployeeContact::create($input);
            }

            return response()->json([
                'status' => "success",
                'message' => "Updated Success "
            ]);
            
        }catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' => "Something Wrong"
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
                        return '';
                    }else{
                        return date('H:mA',strtotime($row->leave_time)); 
                    }
                   
                })

              ->addColumn('worked', function($row){ 
                if($row->leave_time==null){
                    return '';
                }else{
                    return date('H:G:i', strtotime($row->leave_time) - strtotime($row->attend_time));
                }
                
                
                })

                ->filter(function ($instance) use ($request) {

                  
                    if (!empty($request->get('month'))) {
                        $instance->whereMonth('created_at', date('m',strtotime($request->get('month'))));
                    } 

                }) 

  
                     

                    ->rawColumns(['id','date','in_time','out_time','worked'])
                    ->make(true);
        }

        return view('user.report');
    }

    public function edit($id){
        try{
            $user = User::find($id);
            return view('admin.user_edit',compact('user'));
        }catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' => "Something Wrong"
            ]);
        }
    }

    public function view($id){

        try{
            $user = User::find($id);
            return view('admin.view_user',compact('user'));
        }catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' => "Something Wrong"
            ]);
        }
 
    }

    
}

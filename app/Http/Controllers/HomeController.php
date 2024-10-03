<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as BaseController;

use App\Models\User;
use App\Models\Userroles;
use Illuminate\Http\Request;
use File;
class HomeController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {

        $data['allRoles'] = Userroles::orderBy('role', 'ASC')->get();
        ;
        return view('users', compact('data'));
    }

    public function userlist(Request $request){
        if($request->ajax()){
            $draw = $request->get('draw');

            //dd($request->columns);
            $terms=[];
            if (isset($request->search) && (!empty($request->search['value']))) {
                $terms = array_filter(explode(' ', $request->search['value']));
            }
            $OrderBy = ['id','DESC'];
            
             $where=[];
             

            $QueryRecords = User::with('getrole')->where($where);
            if (isset($request->search) && (!empty($request->search['value']))) {
                $terms = array_filter(explode(' ', $request->search['value']));
                foreach ($terms as $term) {
                    $QueryRecords->orWhere('name','LIKE',"'%".$term."%'");
                    $QueryRecords->orWhere('email','LIKE',"'%".$term."%'");
                    $QueryRecords->orWhere('mobile','LIKE',"'%".$term."%'");
                }
            }


            if ((isset($request->order)) && (!empty($request->order))) {
                foreach ($request->order as $ord) {
                    $QueryRecords->orderBy($request->columns[$ord['column']]['name'],$ord['dir']);
                }
            }else{
                $QueryRecords->orderBy('id','DESC');
            }
            ///Excute queruy
            $totalCountRecords=$QueryRecords->count(); 
            $QueryRecords = $QueryRecords->skip($request->start)->take($request->length)->get();
            $totalCounts=$QueryRecords->count(); 
            //  dd($QueryRecords);
            $data_arr = array();
            if(!empty($QueryRecords)){
                foreach($QueryRecords as $qR){
                    $data = array();                    
                     
    
                    $data[]='<div class="icon">
                            <a href="javascript:edituser('.$qR->id.')"><svg fill="#000000" width="15px" height="15px" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)" stroke="#000000" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"> <path d="M30.133 1.552c-1.090-1.044-2.291-1.573-3.574-1.573-2.006 0-3.47 1.296-3.87 1.693-0.564 0.558-19.786 19.788-19.786 19.788-0.126 0.126-0.217 0.284-0.264 0.456-0.433 1.602-2.605 8.71-2.627 8.782-0.112 0.364-0.012 0.761 0.256 1.029 0.193 0.192 0.45 0.295 0.713 0.295 0.104 0 0.208-0.016 0.31-0.049 0.073-0.024 7.41-2.395 8.618-2.756 0.159-0.048 0.305-0.134 0.423-0.251 0.763-0.754 18.691-18.483 19.881-19.712 1.231-1.268 1.843-2.59 1.819-3.925-0.025-1.319-0.664-2.589-1.901-3.776zM22.37 4.87c0.509 0.123 1.711 0.527 2.938 1.765 1.24 1.251 1.575 2.681 1.638 3.007-3.932 3.912-12.983 12.867-16.551 16.396-0.329-0.767-0.862-1.692-1.719-2.555-1.046-1.054-2.111-1.649-2.932-1.984 3.531-3.532 12.753-12.757 16.625-16.628zM4.387 23.186c0.55 0.146 1.691 0.57 2.854 1.742 0.896 0.904 1.319 1.9 1.509 2.508-1.39 0.447-4.434 1.497-6.367 2.121 0.573-1.886 1.541-4.822 2.004-6.371zM28.763 7.824c-0.041 0.042-0.109 0.11-0.19 0.192-0.316-0.814-0.87-1.86-1.831-2.828-0.981-0.989-1.976-1.572-2.773-1.917 0.068-0.067 0.12-0.12 0.141-0.14 0.114-0.113 1.153-1.106 2.447-1.106 0.745 0 1.477 0.34 2.175 1.010 0.828 0.795 1.256 1.579 1.27 2.331 0.014 0.768-0.404 1.595-1.24 2.458z"></path> </g></svg></a></div>';
                    $data[] = (!empty($qR->profile_photo)) ? '<img src="'.url('/').'/uploads/users/'.$qR->profile_photo.'" class="img-thumbnail" width="50">' :'';  
                    $data[] = ucwords($qR->name);  
                    $data[] = ($qR->email);  
                    $data[] = ($qR->mobile);  
                    $data[] = (!empty($qR->getrole->role)) ? ucwords($qR->getrole->role) :''; 
                    
                    $data_arr[] = $data;
                }
            }
            
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalCountRecords,
                "iTotalDisplayRecords" => $totalCountRecords,
                "aaData" => $data_arr
            );
            unset($data_arr,$draw,$request,$totalCountRecords,$totalCounts,$data,$qR,$table,$OrderBy,$start,$length,$SearchCond);
            return response()->json($response, 200);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {  
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'mobile' => 'required||regex:/[0-9]{10}/|unique:users,email,'.$request->id,
                'role_id' => 'required',
            ],[
                'role_id.required' => 'Please choose user role',
                'email.required' => 'Email is required',
                'email.email' => 'Invalid email format',
                'email.unique' => 'Email already exists',
                'mobile.required' => 'Mobile number is required',
                'mobile.unique' => 'Mobile number already exists',
                'mobile.regex' => 'Mobile number format is not correct',
            ]);
            // dd($request->all());
            if (!$validator->fails()) {
                //File uploading
                $photo ='';
                if($request->file('photo')){
                    //Folder creation if not existing
                    $path = public_path().'/uploads/users/'; 
                    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                    //file upload
                    $file = $request->file('photo');
                    // dd($file);
                    //File Name
                    $file->getClientOriginalName();
                    //Display File Extension
                    $file->getClientOriginalExtension();
                    //Display File Real Path
                    $file->getRealPath();
                    //Display File Size
                    $file->getSize();
                    //Display File Mime Type
                    $file->getMimeType();
                    $fileName = strtolower(time().'-user') . '.' . $file->extension();
                    $file->move($path, $fileName);
                    unset($file, $params);
                    $photo = $fileName;
                }





                if(empty($request->id)){
                    $userData = new User();
                    $msg  ="User created successfully";
                }else{
                    $userData = User::find($request->id);
                    $msg  ="User saved successfully";
                }     
                $userData->name = $request->name;
                $userData->email = $request->email;
                $userData->mobile = $request->mobile;
                $userData->role_id = $request->role_id;
                $userData->description = $request->desc;
                $userData->profile_photo = $photo;
                $userData->save();
                return response()->json([
                    'success' => true,
                    'msg' => $msg,
                ]);
            } else {
                $msg = $this->validateerrortoarray($validator->errors());
            }
            
        } else {
            $msg = "You're are not allowed to access this module";
        }
        return response()->json([
            'error' => true,
            'msg' => $msg
        ]);

    }


    public function getuserdetail(Request $request){
        if($request->ajax()){
            $id = $request->id;

            //get user details
            $userData = User::find($id);
            if($userData){
                return response()->json([
                    'success' => true,
                    'data' => $userData,
                ]);
            } else {
               $msg = 'User not found';
            }
        }else{
            $msg = "You're are not allowed to access this module";
        }

        return response()->json([
            'error' => true,
           'msg' => $msg
        ]);
    }



    /***************Staff Roles */
    public function staffroles(){
        $data['page_title'] = "Staff Roles";
        return view('roles.list',compact('data'));
    }
    public function staffrolelist(Request $request){
        if($request->ajax()){
            $draw = $request->get('draw');


            $where=[];
           
            //dd($request->columns);
            $terms=[];
            if (isset($request->search) && (!empty($request->search['value']))) {
                $terms = array_filter(explode(' ', $request->search['value']));
            }
            $OrderBy = ['id','DESC'];
                       
            $QueryRecords = Userroles::select('id','role');
            if (isset($request->search) && (!empty($request->search['value']))) {
                $terms = array_filter(explode(' ', $request->search['value']));
                foreach ($terms as $term) {
                    $QueryRecords->orWhere('role','LIKE',"'%".$term."%'");
                }
            }

            if ((isset($request->order)) && (!empty($request->order))) {
                foreach ($request->order as $ord) {
                    $QueryRecords->orderBy($request->columns[$ord['column']]['name'],$ord['dir']);
                }
            }else{
                $QueryRecords->orderBy('id','DESC');
            }
            ///Excute queruy
            $totalCountRecords=$QueryRecords->count(); 
            $QueryRecords = $QueryRecords->skip($request->start)->take($request->length)->get();
            $totalCounts=$QueryRecords->count(); 
             
            $data_arr = array();
            if(!empty($QueryRecords)){
                foreach($QueryRecords as $qR){
                    $data = array();                    
                   
    
                    
                    $data[] = ucwords($qR->role);  
                    $data[]='
                    <div class="icon">
                            <a href="javascript:editrole('.$qR->id.')"><svg fill="#000000" width="15px" height="15px" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)" stroke="#000000" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"> <path d="M30.133 1.552c-1.090-1.044-2.291-1.573-3.574-1.573-2.006 0-3.47 1.296-3.87 1.693-0.564 0.558-19.786 19.788-19.786 19.788-0.126 0.126-0.217 0.284-0.264 0.456-0.433 1.602-2.605 8.71-2.627 8.782-0.112 0.364-0.012 0.761 0.256 1.029 0.193 0.192 0.45 0.295 0.713 0.295 0.104 0 0.208-0.016 0.31-0.049 0.073-0.024 7.41-2.395 8.618-2.756 0.159-0.048 0.305-0.134 0.423-0.251 0.763-0.754 18.691-18.483 19.881-19.712 1.231-1.268 1.843-2.59 1.819-3.925-0.025-1.319-0.664-2.589-1.901-3.776zM22.37 4.87c0.509 0.123 1.711 0.527 2.938 1.765 1.24 1.251 1.575 2.681 1.638 3.007-3.932 3.912-12.983 12.867-16.551 16.396-0.329-0.767-0.862-1.692-1.719-2.555-1.046-1.054-2.111-1.649-2.932-1.984 3.531-3.532 12.753-12.757 16.625-16.628zM4.387 23.186c0.55 0.146 1.691 0.57 2.854 1.742 0.896 0.904 1.319 1.9 1.509 2.508-1.39 0.447-4.434 1.497-6.367 2.121 0.573-1.886 1.541-4.822 2.004-6.371zM28.763 7.824c-0.041 0.042-0.109 0.11-0.19 0.192-0.316-0.814-0.87-1.86-1.831-2.828-0.981-0.989-1.976-1.572-2.773-1.917 0.068-0.067 0.12-0.12 0.141-0.14 0.114-0.113 1.153-1.106 2.447-1.106 0.745 0 1.477 0.34 2.175 1.010 0.828 0.795 1.256 1.579 1.27 2.331 0.014 0.768-0.404 1.595-1.24 2.458z"></path> </g></svg></a>
                            
                            
                            
                    </div>';
                    $data_arr[] = $data;
                }
            }
            
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalCounts,
                "iTotalDisplayRecords" => $totalCountRecords,
                "aaData" => $data_arr
            );
            unset($data_arr,$draw,$request,$totalCountRecords,$totalRecordswithFilter,$data,$qR,$table,$OrderBy,$start,$length,$SearchCond);
            return response()->json($response, 200);
        }                           
    }

    public function storerole(Request $request){
        if ($request->ajax()) {  
            $validator = \Validator::make($request->all(), [
                 
                'role' => 'required|unique:user_roles,role,'.$request->id,
            ],[
                'role.required' => 'Please choose user role',
            ]);
            // dd($request->all());
            if (!$validator->fails()) {
                 
                if(empty($request->id)){
                    $roleData = new Userroles();
                    $msg  ="Role created successfully";
                }else{
                    $roleData = Userroles::find($request->id);
                    $msg  ="Role updated successfully";
                }     
                $roleData->role = $request->role;
                $roleData->save();
                return response()->json([
                    'success' => true,
                    'msg' => $msg,
                ]);
            } else {
                $msg = $this->validateerrortoarray($validator->errors());
            }
            
        } else {
            $msg = "You're are not allowed to access this module";
        }
        return response()->json([
            'error' => true,
            'msg' => $msg
        ]);
    }

    public function getroledetail(Request $request){
        if($request->ajax()){
            $id = $request->id;

            //get user details
            $userData = Userroles::find($id);
            if($userData){
                return response()->json([
                    'success' => true,
                    'data' => $userData,
                ]);
            } else {
               $msg = 'Role not found';
            }
        }else{
            $msg = "You're are not allowed to access this module";
        }

        return response()->json([
            'error' => true,
           'msg' => $msg
        ]);
    }



    private function validateerrortoarray($errorArr=array()){
        $messages = array();
        foreach ($errorArr->all() as $err) {
            array_push($messages, implode('<br/>', array($err)));
        }
        return implode('<br/>', $messages);
    }
}

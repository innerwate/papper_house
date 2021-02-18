<?php

namespace App\Http\Controllers;
use App\office;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
class OfficeController extends Controller
{   
    public function office(){
  

    $users = office::all();
    return view('welcome',compact('users'));
}
 public function registration(Request $request){

    if(isset($request->login)){
      $validatedData = $request->validate([
        'login' => 'required|unique:offices,login|max:255',
        'email' => 'required|unique:offices,email|max:255|email',
        'password' => 'required',
    ]);
      $login = $request->login;
      $email = $request->email;
      $password = $request->password;
      $password = Hash::make($password);
      $name = $request->name;

     
      
     DB::table('offices')->insert(
        array('login' => $login, 'name' => $name, 'email' => $email, 'password' => $password, 'role' => 'subscriber')
     );
      
      $data['massage'] = "Success!";
    
      }
     else{
       
      $data['massage'] = "fail!";
     }
    //  return response($content, $status)
    //  ->header('Content-Type', $value);
    return response()->json($data);
 }
public function login(Request $request){
   $data['field'] = 'true';
   if(isset($request->login)){
      $validatedData = $request->validate([
        'login' => 'required|max:255',
       
        'password' => 'required',
    ]);
   $user = DB::table('offices')->where('login', $request->login)->first();
   $password = $request->password;
   if (Hash::check($password, $user->password)) {
      
      $data['message'] = 'success auth';
      $data['token'] = 'tre124das1@dasd';
      $data['id'] = $user->id;
 
   }
   else {
     
     $data['message'] = 'success denied';
   }
}
   return response()->json($data);
}
 
 
}

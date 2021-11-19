<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    function signin(Request $request){
        $user_td=DB::select("select u.id,u.username,u.email,u.role_id,u.full_name,r.name role from users u,roles r where u.role_id=r.id and u.username='$request->txtUsername' and u.password='$request->txtPassword'");   
        
        if($user_td==null){

            return redirect("/")->with(['status'=>'Incorrect username or password!','username'=>$request->txtUsername,'password'=>$request->txtPassword]);  

        }else{
        
            $user=$user_td[0];       
            $session_id=session()->getId();
            
            session(['sess_id'=>$session_id,
                    'sess_user_id'=>$user->id,
                    'sess_user_name'=>$user->full_name,
                    'sess_email'=>$user->email,
                    'sess_role_id'=>$user->role_id,
                    'role_name'=>$user->role,
                    ]);

            return redirect("/dashboard");
        }
      
    }

   function logout(){
    session()->forget(['sess_id', 'sess_user_id','sess_user_name','sess_email','sess_role_id','role_name']);
    session()->flush();
    session()->regenerate();

    return redirect("/")->with('status','Bye');
   
   }


}

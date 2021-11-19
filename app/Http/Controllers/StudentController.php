<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    
    public function index()
    {
        try {           
          //DB::connection()->getPdo();            
        $students=DB::select("select * from students");        
        return view("pages.student.index",["students"=>$students]);

        }catch (\Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       

        return view("pages.student.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          

       DB::insert("insert into students(name,mobile,email)values('$request->txtName','$request->txtMobile','$request->txtEmail')");
       
       //$insert_id=DB::getPdo()->lastInsertId();

       return redirect('students');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       echo "View:".$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=DB::select("select id,name,mobile,email from students where id='$id'");        
         return view("pages.student.edit",["student"=>$student[0]]);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    { 
        DB::update("update students set name='$request->txtName',mobile='$request->txtMobile',email='$request->txtEmail' where id='$id'");
        return redirect("students");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       DB::delete("delete from students where id='$id'");
       return redirect('students');
    }
}

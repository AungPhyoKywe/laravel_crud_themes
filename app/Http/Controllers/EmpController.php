<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use DB;

class EmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        
        $emp=Employee::where('status',1)->paginate(5);
         //$emp=DB::table('employee')->paginate(5);
        //$emp=$emp->count();
        //echo $emp;
        //$emp=$emp->count();
        //$emp=DB::select('select * from employee where status=1');
        return view('crud',['emp'=>$emp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required| Alpha',
            'email'=>'required |E-Mail',
            'address'=>'required|Alpha',
            'phone'=>'required|Integer'

        ]);
        $emp=new Employee;
       $emp->name=$request->input('name');
        $emp->email=$request->input('email');
       $emp->address=$request->input('address');
       $emp->phone=$request->input('phone');
        // DB::insert('insert into employee(name,email,address,phone)values(?,?,?,?)',[$name,$email,$address,$phone]);
       $emp->save();
        return redirect('/');
      

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $emp=Employee::where('id',$id)->get();
       // $emp=DB::select('select * from employee where id=?',[$id]);
       return view('edit',['emp'=>$emp]);
        //return view('crud',['emp'=>$emp]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         $this->validate($request,[
            'name'=>'required| Alpha',
            'email'=>'required |E-Mail',
            'address'=>'required|Alpha',
            'phone'=>'required|Integer'

        ]);
        
        $emp= Employee::find($id);
         $emp->name=$request->input('name');
        $emp->email=$request->input('email');
       $emp->address=$request->input('address');
        $emp->phone=$request->input('phone');
       // DB::update('update employee set name=?,email=?,address=?,phone=? where id=?',[$name,$email,$address,$phone,$id]);
        $emp->save();
       return redirect('/')->with('up','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // DB::update('update employee set status=? where id=?',[0,$id]);
        $emp=Employee::find($id);
        $emp->status=0;
         $emp->save();
       return redirect('/')->with('u','Successfully Delete!');
    }
}

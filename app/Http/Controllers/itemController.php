<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp=Item::where('status',1)->paginate(5);
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
            'name'=>'required',
            'description'=>'required',
            'type'=>'required',
            'original_price'=>'required|Integer',
            'selling_price'=>'required|Integer'

        ]);
        $emp=new Item;
       $emp->name=$request->input('name');
        $emp->description=$request->input('description');
       $emp->type=$request->input('type');
       $emp->original_price=$request->input('original_price');
       $emp->selling_price=$request->input('selling_price');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $emp=Item::where('id',$id)->get();
       // $emp=DB::select('select * from employee where id=?',[$id]);
       return view('edit',['emp'=>$emp]);
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
            'name'=>'required',
            'description'=>'required',
            'type'=>'required',
            'original_price'=>'required|Integer',
            'selling_price'=>'required|Integer'

        ]);
        $emp= Item::find($id);
       $emp->name=$request->input('name');
        $emp->description=$request->input('description');
       $emp->type=$request->input('type');
       $emp->original_price=$request->input('original_price');
       $emp->selling_price=$request->input('selling_price');
        // DB::insert('insert into employee(name,email,address,phone)values(?,?,?,?)',[$name,$email,$address,$phone]);
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
       $emp=Item::find($id);
        $emp->status=0;
         $emp->save();
       return redirect('/')->with('u','Successfully Delete!');
    }
}

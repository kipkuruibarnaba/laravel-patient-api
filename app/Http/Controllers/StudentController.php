<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function liststudents()
    {
        $students = Student::all();
        return response()->json([
            'data'=>$students
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Student = new Student;
        $Student->name=$request->name;
        $Student->course=$request->course;
        $Student->email=$request->email;
        $Student->phone=$request->phone;
        $Student->Save();
        return response()->json([
            'status'=>200,
            'message'=>'Student Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::all();
        // return response()->json([
        //     'data'=>$students
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json([
            'status'=>200,
            'data'=>$student
        ]);
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
        $Student = Student::find($id);
        $Student->name=$request->name;
        $Student->course=$request->course;
        $Student->email=$request->email;
        $Student->phone=$request->phone;
        $Student->Save();
        return response()->json([
            'status'=>200,
            'message'=>'Student Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Student = Student::find($id);
//        $Student->delete();
        return  response()->json([
            'message'=>'Student data deleted successfully'
        ]);
    }
}

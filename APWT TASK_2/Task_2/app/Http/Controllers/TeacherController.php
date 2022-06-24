<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    //-----------------------------------------
    //------------  my coding part-------------
    // -----------------------------------------
    public function teacherCreate(){
        return view("pages.teacher.teacherCreate");
    }

    public function teacherCreateSubmit(Request $request){
        $validate=$request->validate([
            'name'=>'required|min:5|max:100',
            'email'=>'email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address'=>'required'
        ],

        [
            'name.required'=>'Please put your name',
            'name.min'=>'Name must be greater than 5 charcters',
            'email'=>"Put your mail",
            'phone.required'=>"put your phone",
            'address.required'=>"put your address"

        ]
    );
       $teacher=new Teacher();
       $teacher->name =$request->name;
       $teacher->email=$request->email;
       $teacher->phone =$request->phone;
       $teacher->address=$request->address;
       $teacher->save();
    
       return redirect()->route('teacherCreate');

    }

    public function teacherList(){
        $teachers = Teacher::all();
        return view('pages.teacher.teacherList')->with('teachers', $teachers);
    }
    public function teacherCourses(Request $request ){

        $t = Teacher::where('id',$request->id)->first();

        //eloquent
        return $t->assignedCourses();
    }
}
    
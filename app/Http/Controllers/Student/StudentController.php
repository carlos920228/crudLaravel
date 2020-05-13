<?php

namespace App\Http\Controllers\Student;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class StudentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes=Student::all();
        return $this->showAll($estudiantes); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $rules=[
              'name'=>'required',
              'address'=>'required',  
              'telephone'=>'required',  
              'sex'=>'required',  
              'age'=>'required',  
              'grade'=>'required',  
              'tutor_name'=>'required',  
              'telephone_tutor'=>'required',  
              'email'=>'required|email|unique:students'
        ];
        $this->validate($request,$rules);
        $campos= $request->all();
        $estudiante= Student::create($campos);
        return $this->showOne($estudiante,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante= Student::findOrFail($id);//si no encuentra envía un 404
        return $this->showOne($estudiante);
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
        $estudiante=Student::findOrFail($id);

        $rules=[
               
              'email'=>'email|unique:students,email,'.$estudiante->email,
        ];
        $this->validate($request,$rules);
        if($request->has('email')){
            $estudiante->email=$request->email;
        }
        if($request->has('name')){
            $estudiante->name=$request->name;
        }
        if($request->has('address')){
            $estudiante->address=$request->address;
        }
        if($request->has('telephone')){
            $estudiante->telephone=$request->telephone;
        }
        if($request->has('sex')){
            $estudiante->sex=$request->sex;
        }
        if($request->has('grade')){
            $estudiante->grade=$request->grade;
        }
        if($request->has('tutor_name')){
            $estudiante->tutor_name=$request->tutor_name;
        }
        if($request->has('telephone_tutor')){
            $estudiante->telephone_tutor=$request->telephone_tutor;
        }

        $estudiante->save();
        return $this->showOne($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudiante= Student::findOrFail($id);//si no encuentra envía un 404
        $estudiante->delete();
        return $this->showOne($estudiante);
        

    }
}

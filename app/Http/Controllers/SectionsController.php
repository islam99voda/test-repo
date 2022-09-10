<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections',compact('sections'));
    } 

    public function show()
    {
        $sections = sections::all();
        return view('sections.show',compact('sections'));
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

    
    public function store(Request $request)
    {     
        $validateData = $request->validate([
            'section_name'=>'required|unique:sections|string|min:3',
            'description'=>'required|string|min:3'
        ],[
                'section_name.required'=>'يرجى إدخال اسم القسم',
                'section_name.unique'  =>  'هذا القسم مسجل مسبقاً',
                'description.required'  =>  'يرجى إدخال شرح للقسم',
        ]);
            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => (Auth::user()->name),
            ]);
            session()->flash('Add','تم اضافة القسم بنجاح');
            return redirect('/sections');
    }

    
    

   //store id 
    public function edit(sections $id)
    {
        //if id in the url = id in db 
        $sections = sections::first(); 
        return view('sections.edit',compact('sections'));
    }

    
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'section_name'=>'required|unique:sections|string|min:3',
        ],[
                'section_name.required'=>'يرجى إدخال اسم القسم',
                'section_name.unique'  =>  'هذا القسم مسجل مسبقاً',
        ]);
        $sections = sections::where('id',$id)->first();//Where id in db = id in url
        $sections->section_name = $request->section_name;//store in field name in db this name="category_name"
        $sections->save(); //save it
        //show succecful massage| success word is a session, value
        session()->flash('edit','تم تعديل القسم بنجاح');
        return back()->with("success","تم تعديل القسم بنجاح");
        return redirect('/sections.edit');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $id)
    {
        sections::destroy('id',$id->id);
        return back()->with("success","تم حذف القسم بنجاح");
        
    }
}

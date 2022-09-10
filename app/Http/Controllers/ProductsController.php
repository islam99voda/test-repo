<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $products = products::all();
        return view('products.products',compact('sections','products'));
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
        $validateData = $request->validate([
            'Product_name'=>'required|unique:products|string|min:3',
            'description'=>'required|string|min:3'
        ],[
                'Product_name.required'=>'يرجى إدخال اسم المنتج',
                'Product_name.unique'  =>  'هذا القسم مسجل مسبقاً',
                'description.required'  =>  'يرجى إدخال شرح للقسم',
        ]);
        Products::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add','تم اضافة المنتج بنجاح');
        return redirect('/products');
    }

    public function show(products $products)
    {
        
        $sections = sections::all();
        $products = products::all();
        return view('products.show',compact('products','sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $id)
    {
        //if id in the url = id in db 
        $products = products::first(); //get first row only
        return view('products.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name'=>'required|unique:products|string|min:3',
        ],[
                'product_name.required'=>'يرجى إدخال اسم القسم',
                'product_name.unique'  =>  'هذا المنتج مسجل مسبقاً',
        ]);
        $products = products::where('id',$id)->first();//Where id in db = id in url
        $products->product_name = $request->product_name;//store in field name in db this name="category_name"
        $products->save(); //save it
        //show succecful massage| success word is a session, value
        session()->flash('edit','تم تعديل المنتج بنجاح');
        return back()->with("success","تم تعديل المنتج بنجاح");
        return redirect('/pr$products.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $id)
    {
        products::destroy('id',$id->id);
        return back()->with("success","تم حذف المنتج بنجاح");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_detales;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    } 


    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        //store in invoices table
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        //store in invoices_detales table
        $invoice_id = invoices::latest()->first()->id;//بتعاها idآخر حاجة تمت في جدول الفاتورة هات ال
        invoices_detales::create([
            'id_Invoice' => $invoice_id, //اللي لسه جايبه
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        
        //sotore atachment 
        if ($request->hasFile('pic')) { //picفيه فايل اسمه  reqouestلو ال
            $invoice_id = Invoices::latest()->first()->id;//اول صورة idهات 
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();//خزنلي اسم الفايل اللي اترفع
            $invoice_number = $request->invoice_number;
            //هخزن بيانات الصورة في الجدول
            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();
            // اسم المرفق احفظه في الجدول/والمرفق احفظه على السيرفر عندي في فولدر لوحده بإسم الفاتورة
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }




   
    public function InvoicesDetails($id)
    {
    $invoices = invoices::where('id',$id)->get();
    $InvoicesDetales = invoices_detales::where('id_Invoice',$id)->get();
    $attachments = invoice_attachments::where('invoice_id',$id)->get();//get all atachment related to invoice number
    return view('invoices.InvoicesDetails', compact('invoices','InvoicesDetales','attachments'));
    }






    public function getproducts($id) //اللي جالي اياً كان خاص ب انهي قسم idال
    {
        //بتاعه idاللي جالك هاتلي اسم المنتج وال idاللي فيه يساوي ال section_idهتروح على جدول المنتجات ولما ال
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products); //JSON ورجعهملي على هيئة 
    }
}

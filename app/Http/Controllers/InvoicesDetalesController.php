<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\invoices_detales;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\InvoiceAttachmentsController;

class InvoicesDetalesController extends Controller
{
    //oppen attachment
    public function open_file($invoice_number,$file_name)
    {
        $st="Attachments";
        $pathFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->file($pathFile);
    }
    //download attachment
    public function download_file($invoice_number,$file_name)
    {
        $st ="Attachments";
        $pathFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->download($pathFile);
    }

    //dstroy file
    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$request->invoice_number.'/'.$request->file_name);
        Storage::delete($pathToFile);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}

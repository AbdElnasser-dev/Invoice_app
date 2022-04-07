<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_detail $invoices_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $invoices = invoices::where('id',$id)->first();

        $details = invoices_detail::where('id_Invoice',$id)->get();

        $attachments = invoices_attachments::where('invoice_id',$id)->get();


        return view("invoices.InvoicesDetails",compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_detail $invoices_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash("delete",'تم حذف المنتج بنجاح');
        return back();
    }
    public function download_file($invoice_number,$file_name){
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($files);

    }
    public function open_file($invoice_number,$file_name){

        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
    
}

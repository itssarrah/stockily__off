<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Customer;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function invoiceAll(){

        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('manager.backend.invoice.invoice_all', compact('allData'));
    }

    public function invoiceAdd(){

        $categories = Category::all();
        $customers = Customer::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();

        if ($invoice_data == null){
            $firstReg = 0;
            $invoice_no = $firstReg + 1;
        } else {
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $invoice_data + 1;
        }
        $date = date('Y-m-d');

        return view('manager.backend.invoice.invoice_add', compact('categories', 'invoice_no', 'date', 'customers'));
    }

    public function invoiceStore(Request $request){

        if ($request->category_id == null) {

            $notification = array(
                'message' => 'Sorry You do not select any item', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        } else{
            if ($request->paid_amount > $request->estimated_amount) {

                $notification = array(
                    'message' => 'Sorry Paid Amount is Maximum the total price', 
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } else {

                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = request()->user()->id; 

                DB::transaction(function() use($request,$invoice){
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category ; $i++) { 
            
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d',strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '0'; 
                            $invoice_details->save(); 
                        }

                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->email = $request->email;
                            $customer->created_by = request()->user()->id;
                            $customer->save();
                            $customer_id = $customer->id;
                            
                        } else{
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
            
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;

                        if ($request->paid_status == 'full_paid') {

                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {

                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';

                        }elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
            
                        $payment_details->invoice_id = $invoice->id; 
                        $payment_details->date = date('Y-m-d',strtotime($request->date));
                        $payment_details->save(); 

                    }
                }); // end transaction
            }
        }

        $notification = array(
            'message' => 'Invoice Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('invoice.pending.list')->with($notification);  
    }

    public function pendingList() {

        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 0)->get();
        return view('manager.backend.invoice.invoice_pending_list', compact('allData'));
    }

    public function invoiceDelete($id) {

        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();

        $notification = array(
            'message' => 'Invoice Delted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  

    }

    public function invoiceApprove($id){

        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        //dd($invoice);
        return view('manager.backend.invoice.invoice_approve',compact('invoice'));
    }

    public function approvalStore(Request $request, $id){
        

        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();

            if($product->quantity < $request->selling_qty[$key]){

                $notification = array(
                    'message' => 'Approve Maximum Value', 
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification); 

            }
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = request()->user()->id;
        $invoice->status = '1';

        DB::transaction(function() use($request,$invoice,$id){
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                $product->save();
            }

            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approved Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);  
    }

    public function printInvoiceList() {

        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('manager.backend.invoice.print_invoice_list', compact('allData'));
    }

    public function printInvoice($id){

        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        //dd($invoice);
        return view('manager.backend.pdf.invoice_pdf',compact('invoice'));
    }

    public function dailyInvoiceReport(){

        return view('manager.backend.invoice.daily_invoice_report');
    }

    public function dailyInvoicePdf(Request $request){

        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $allData = Invoice::whereBetween('date', [$sdate, $edate])->where('status', 1)->get();

        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));
        return view('manager.backend.pdf.daily_invoice_report_pdf', compact('allData', 'startDate', 'endDate'));
    }
}

<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
//use Faker\Provider\Payment;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payment;
use App\Models\PaymentDetail;
class CustomerController extends Controller
{
    public function customerAll() {

        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    }

    public function customerAdd() {

        return view('backend.customer.customer_add');
    }

    public function customerStore(Request $request) {

        /*$image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(200, 200)->save('upload/customer/'.$name_gen);

        $save_url = 'upload/customer/'.$name_gen;
*/
        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'created_by' => request()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function customerEdit($id){

        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    public function customerUpdate(Request $request){

        $customer_id = $request->id;

        if ( $request->file('customer_image') ) {

            $data = Customer::findOrFail($customer_id);

            if( file_exists(public_path($data->customer_image))) {
                @unlink(public_path($data->customer_image));
            }
            /*$image = $request->file('customer_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save('upload/customer/'.$name_gen);

            $save_url = 'upload/customer/'.$name_gen;*/

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'updated_by' => request()->user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Customer Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);

        } else {

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Customer Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        }
    }

    public function customerDelete($id) {

        $customer = Customer::findOrFail($id);


        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function creditCustomer() {

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.customer.customer_credit',compact('allData'));
    }

    public function creditCustomerPrintPdf() {

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer_credit_pdf',compact('allData'));
    }

    public function customerEditInvoice($invoice_id){

        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.customer.edit_customer_invoice', compact('payment'));
    }

    public function customerUpdateInvoice(Request $request, $invoice_id){

        if($request->new_paid_amount < $request->paid_amount){
            $notification = array(
                'message' => 'Paid Maximum Value',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        } else {
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = request()->user()->id;
            $payment_details->save();

            $notification = array(
                'message' => 'Invoice Update Successfully', 
                'alert-type' => 'success'
            );

            return redirect()->route('credit.customer')->with($notification); 
        }
    }

    public function customerInvoiceDetails($invoice_id){

        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.pdf.invoice_details_pdf', compact('payment'));
    }

    public function paidCustomer(){

        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.customer.customer_paid', compact('allData'));
    }

    public function paidCustomerPrintPdf(){

        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_paid_pdf', compact('allData'));
    }

    public function customerWiseReport(){

        $customers = Customer::all();
        return view('backend.customer.customer_wise_report', compact('customers'));
    }

    public function customerWiseCreditReport(Request $request){

        $allData = Payment::where('customer_id', $request->customer_id)->where('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.pdf.customer_wise_credit_pdf', compact('allData'));
    }

    public function customerWisePaidReport(Request $request) {

        $allData = Payment::where('customer_id', $request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_wise_paid_pdf', compact('allData'));
    }
}

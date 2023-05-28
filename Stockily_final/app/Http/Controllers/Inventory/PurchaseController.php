<?php

namespace App\Http\Controllers\Inventory;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\sublocation;

class PurchaseController extends Controller
{
    public function purchaseAll(){

        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('manager.backend.purchase.purchase_all', compact('allData'));
    }

    public function purchaseAdd(){

        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();

        return view('manager.backend.purchase.purchase_add', compact('suppliers', 'categories', 'units'));
    }

    public function PurchaseStore(Request $request){

        if ($request->category_id == null) {
    
        $notification = array(
            'message' => 'Please Select Items', 
            'alert-type' => 'error'
        );
        return redirect()->back( )->with($notification);
        } else {
    
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) { 

                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                // $purchase->description = $request->description[$i];
                $purchase->created_by = request()->user()->id;
                $purchase->status = $request->status[$i];
                $purchase->save();

            } 
        } 
    
        $notification = array(
            'message' => 'Data Save Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification); 
        
    }

    public function purchaseDelete($id) {

        Purchase::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Purchase Deleted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function purchasePending(){

        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status','pending')->get();
        return view('manager.backend.purchase.purchase_pending', compact('allData'));
    }

    public function purchaseApprove($id) {

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();

        $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => 'new',
            ]);

            $notification = array(
                'message' => 'Purchase Approved Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('purchase.all')->with($notification);

        }
    }

    public function dailyPurchaseReport() {
    
        return view('manager.backend.purchase.daily_purchase_report');
    }

    public function dailyPurchasePdf(Request $request) {
        $user_id = Auth::user()->id;
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $allData = Purchase::whereBetween('date', [$sdate, $edate])->where('created_by', $user_id)->get();
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));

        session()->put('daily_purchase_report', [
            'allData' => $allData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
        
        return view('manager.backend.pdf.daily_purchase_report_pdf', compact('allData', 'startDate', 'endDate'));
    }
    public function downloadPDF(Request $request)
    {
        $data = session()->get('daily_purchase_report');

        if (!$data) {
            // Handle case when session data is not available
            // Redirect or show an error message
            return redirect()->back()->with('error', 'No data available for PDF download.');
        }

        $allData = $data['allData'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];
        
        $dataall = compact('allData', 'startDate', 'endDate');
        $publicPath = public_path(); 
        $pdf = new Dompdf();
        
        
        $options = $pdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Outfit');
        $options->set('enable_html5_parser', true);
        $options->set('enable_remote', true);
        $options->set('tempDir', sys_get_temp_dir());
        $options->set('chroot', $publicPath);
        $options->set('base_path', $publicPath);
        
        $pdf->loadHtml(View::make('manager.backend.pdf.template', $dataall)->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('daily_purchase_report.pdf', ['Attachment' => false]);
        
        return $pdf->output();
        
    }


}

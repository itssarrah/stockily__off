<?php

namespace App\Http\Controllers\Inventory;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockReport() {

        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('manager.backend.stock.stock_report', compact('allData'));
    }

    public function stockReportPdf(){
        $user_id = Auth::user()->id;

        $allData = Product::where('created_by', $user_id)
                    ->orderBy('supplier_id', 'asc')
                    ->orderBy('category_id', 'asc')
                    ->get();
        

        session()->put('stock_report', [
            'allData' => $allData,
        ]);
        return view('manager.backend.pdf.stock_report_pdf', compact('allData'));
    }

    public function downloadStockPDF(Request $request)
    {
        $data = session()->get('stock_report');

        if (!$data) {
            // Handle case when session data is not available
            // Redirect or show an error message
            return redirect()->back()->with('error', 'No data available for PDF download.');
        }

        $allData = $data['allData'];
        
        $dataall = compact('allData');
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
        
        $pdf->loadHtml(View::make('manager.backend.pdf.stock_template', $dataall)->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('daily_purchase_report.pdf', ['Attachment' => false]);
        
        return $pdf->output();
        
    }

    public function stockSupplierWise(){

        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('manager.backend.stock.supplier_product_wise_report', compact('suppliers', 'categories'));
    }

    public function supplierWisePdf(Request $request){
        $user_id = Auth::user()->id;
        $allData = Product::where('created_by', $user_id)->orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
  

        session()->put('supplier_report', [
            'allData' => $allData,
        ]);
        return view('manager.backend.pdf.supplier_wise_report_pdf', compact('allData'));
    }

    
    public function downloadSupplierPDF(Request $request)
    {
        $data = session()->get('supplier_report');

        if (!$data) {
            // Handle case when session data is not available
            // Redirect or show an error message
            return redirect()->back()->with('error', 'No data available for PDF download.');
        }

        $allData = $data['allData'];
        
        $dataall = compact('allData');
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
        
        $pdf->loadHtml(View::make('manager.backend.pdf.supplier_template', $dataall)->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('daily_purchase_report.pdf', ['Attachment' => false]);
        
        return $pdf->output();
        
    }

    public function productWisePdf(Request $request){

        $product = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        return view('manager.backend.pdf.product_wise_report_pdf', compact('product'));
    }
}

<?php

namespace App\Http\Controllers\Inventory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockReport() {

        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('manager.backend.stock.stock_report', compact('allData'));
    }

    public function stockReportPdf(){
        
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('manager.backend.pdf.stock_report_pdf', compact('allData'));
    }

    public function stockSupplierWise(){

        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('manager.backend.stock.supplier_product_wise_report', compact('suppliers', 'categories'));
    }

    public function supplierWisePdf(Request $request){

        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
        return view('manager.backend.pdf.supplier_wise_report_pdf', compact('allData'));
    }

    public function productWisePdf(Request $request){

        $product = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        return view('manager.backend.pdf.product_wise_report_pdf', compact('product'));
    }
}

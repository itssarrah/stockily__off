@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <?php
            use App\Models\Product;
            $products = Product::where('unit_id', $unit["id"])->get();    
            ?>
            <thead>
              <tr>
                <th>Date</th>
                <th>Location</th>
                <th>Products</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ date('Y-m-d') }}</td>
                <td>{{ $unit["name"] }}</td>
                <td>
                  @foreach($products as $product)
                    <li>{{ $product->name }}</li>
                  @endforeach
                </td>
              </tr>
            </tbody>
          </table>
    </div>
</div> <!-- end col -->
</div>
 

</div>
</div>
 
@endsection 



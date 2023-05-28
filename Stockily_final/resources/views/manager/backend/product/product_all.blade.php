@extends('manager.admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Manage Your Products/Items</h4>

                                     

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <a href="{{route('product.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right; ">Add Product</a><br><br>

                    <h4 class="card-title">Product All Data </h4>
                    

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>     {{-- serial number --}}
                            <th>Name</th>
                            <th>Supplier Name</th>
                            <th>Location </th>
                            <th>Sub-Location </th>
                            <th>Category </th>
                            <th>Action</th>
                            
                        </thead>
                        <?php 
                        use Illuminate\Support\Facades\Auth;
                        $user_id=Auth::user()->id;
                        ?>

                        <tbody>	
                        	@foreach($product as $key => $item)
                        @if ($item->created_by===$user_id)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item['supplier']['name']}} </td>
                            <td> {{ $item['unit']['name'] }} </td>
                            <td> @if(!Empty($item['sublocation']['name']))
                            {{ $item['sublocation']['name'] }} @endif</td>
                            <td> {{ $item['category']['name'] }} </td>
                            <td>
   <a href="{{route('product.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

    <a href="{{route('product.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>
                           
                        </tr>
                        @endif
                        @endforeach
                        
                        </tbody>
                    </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                     
                        
                    </div> <!-- container-fluid -->
                </div>
 

@endsection
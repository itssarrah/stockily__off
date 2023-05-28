@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0"><i class="fas fa-plus-circle">Purchase Pending</i></h4>


                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{route('purchase.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Purchase</a><br><br>
        
                                        <h4 class="card-title">Purchase Pending Data</h4>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Purchase No</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th>Product Name</th>
                                                <th>Status</th>
                                                <th>Action</th>>
                                            </tr>
                                            </thead>
                                            <?php 
                                            use Illuminate\Support\Facades\Auth;
                                            $user_id=Auth::user()->id;
                                            ?>

        
                                            <tbody>
                                                @php($i = 1)
                                                @foreach($allData as $key => $item)
                                            @if ($item->created_by==$user_id)
                                                
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{ $item->purchase_no }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                <td>{{ $item['supplier']['name'] }}</td>
                                                <td>{{ $item['category']['name'] }}</td>
                                                <td>{{ $item->buying_qty }}</td>
                                                <td>{{ $item['product']['name'] }}</td>
                                                <td>
                                                    @if($item->status == 'pending')
                                                    <span class="btn btn-warning">Pending</span>
                                                    @elseif($item->status == 'new')
                                                    <span class="btn btn-success">New</span>
                                                    @endif
                                                </td>
                                                <td>
                                                @if($item->status == 'pending')
                                                    <a href="{{ route('purchase.approve', $item->id) }}" class="btn btn-danger sm" title="Approved" id="ApproveBtn"><i class="fas fa-check-circle"></i></a>
                                                @endif
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
                <!-- End Page-content -->
@endsection
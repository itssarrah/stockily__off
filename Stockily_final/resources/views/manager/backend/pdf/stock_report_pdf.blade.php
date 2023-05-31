@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Stockily Report</h4>
                                
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Stockily Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="invoice-title">
                                            
                                                    <h3>
                                                        <img src="{{ asset('backend/assets/images/logo-sm.png')}}" alt="logo" height="24"/>
                                                        Whole Stockily Report
                                                    </h3>
                                                </div>
                                                <hr>
                                                
                                                <div class="row">
                                                    <div class="col-6 mt-4">
                                                    <address>
                                                            <strong>Stockily :</strong><br>
                                                            ORCHODE Inc.<br>
                                                            stockily@support.dz
                                                        </address>
                                                    </div>
                                                    <div class="col-6 mt-4 text-end">
                                                        <address>
                                                            
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="p-2">
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="p-2">
                                                    </div>
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Sl</strong></td>
                                                                    <td><strong>Supplier Name</strong></td>
                                                                    <td><strong>Location</strong></td>
                                                                    <td><strong>Category</strong></td>
                                                                    <td><strong>Product Name</strong></td>
                                                                    
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                @endphp
                
                                                                @foreach($allData as $key => $item)
                                                                
                                                                    
                                                                @php
                                                                $buying_total = App\Models\Purchase::where('category_id', $item->category_id)->where('product_id', $item->id)->where('status', 1)->sum('buying_qty');
                                                                $selling_total = App\Models\InvoiceDetail::where('category_id', $item->category_id)->where('product_id', $item->id)->where('status', 1)->sum('selling_qty');
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key++ }}</td>
                                                                    <td>{{ $item['supplier']['name'] }}</td>
                                                                    <td>{{ $item['unit']['name'] }}</td>
                                                                    <td>{{ $item['category']['name'] }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    
                                                                </tr>
                                                               
                                                                @endforeach
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        @php
                                                        $date = new DateTime('now', new DateTimeZone('Africa/Algiers'));
                                                        @endphp
                                                        <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>

                                                        <div class="d-print-none">
                                                            <div class="float-end">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                <a href="{{ route('downloadstock.pdf') }}" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- end row -->
                                    
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>

@endsection
@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Daily Purchase Report</h4>
                                
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Purchase</li>
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
                                                        Stockily Periodic Product Check
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
                                                        <h3 class="font-size-16"><strong>Periodic Product Check:
                                                            <span class="btn btn-info">{{ date('d.m.Y', strtotime($startDate)) }}</span> -
                                                            <span class="btn btn-info">{{ date('d.m.Y', strtotime($endDate)) }}</span>
                                                        </strong></h3>
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
                                                                    <td><strong>Purchase Number</strong></td>
                                                                    <td><strong>Date</strong></td>
                                                                    <td><strong>Product Name</strong></td>
                                                                    <td><strong>Quantity</strong></td>
                                                                    <td><strong>Status</strong></td>
                                                                    <td><strong>Location</strong></td>
                                                                    <td><strong>Sub-Location</strong></td>
                                                                    <td><strong>Unit Price</strong></td>
                                                                    <td><strong>Buying Price</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                @endphp

                                                                @foreach($allData as $key => $item)

                                                                @php
                                                                $totalSum += $item->buying_price;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key+1 }}</td>
                                                                    <td>#{{ $item->purchase_no }}</td>
                                                                    <td>{{ date('d.m.Y', strtotime($item->date)) }}</td>
                                                                    <td>{{ $item['product']['name'] }}</td>
                                                                    <td>{{ $item->buying_qty}}</td>
                                                                    <td>@if($item->status == 'pending')
                                                                        <span class="btn btn-warning">Pending</span>
                                                                         @elseif($item->status == 'out')
                                                                         <span class="btn btn-info">Out</span>
                                                                         @elseif($item->status == 'broken')
                                                                         <span class="btn btn-danger">Broken</span>
                                                                         @elseif($item->status == 'new')
                                                                         <span class="btn btn-success">New</span>
                                                                         @endif</td>
                                                                    <td>{{$item['product']['unit']['name']}}</td>
                                                                    <td>@if(!Empty($item['product']['sublocation']['name']))
                                                                    {{ $item['product']['sublocation']['name']}} @endif</td>
                                                                    <td>{{ $item->unit_price }} DA</td>
                                                                    <td>{{ $item->buying_price }} DA</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Grand Amount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end"><h4 class="m-0">{{ $totalSum }} DA</h4></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="d-print-none">
                                                            <div class="float-end">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                <a href="{{ route('download.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-primary waves-effect waves-light ms-2">Download</a>

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
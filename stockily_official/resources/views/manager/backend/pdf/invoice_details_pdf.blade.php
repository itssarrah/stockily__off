@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Cusomer Payment Report</h4>
                                
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Customer Payment</li>
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
                                                    <h4 class="float-end font-size-16"><strong>Invoice No #{{$payment['invoice']['invoice_no']}}</strong></h4>
                                                    <h3>
                                                        <img src="{{ asset('backend/assets/images/logo-sm.png')}}" alt="logo" height="24"/>
                                                        Easy Shopping Mall
                                                    </h3>
                                                </div>
                                                <hr>
                                                
                                                <div class="row">
                                                    <div class="col-6 mt-4">
                                                        <address>
                                                            <strong>Easy Shopping Mall:</strong><br>
                                                            Purana Palton Dhaka<br>
                                                            support@email.com
                                                        </address>
                                                    </div>
                                                    <div class="col-6 mt-4 text-end">
                                                        <address>
                                                            <strong>Invoice Date:</strong><br>
                                                            {{ date('d.m.Y', strtotime($payment['invoice']['date'])) }}<br><br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="p-2">
                                                        <h3 class="font-size-16"><strong>Customer Invoice</strong></h3>
                                                    </div>
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Customer Name</strong></td>
                                                                    <td><strong>Customer Mobile</strong></td>
                                                                    <td><strong>Address</strong></td>
                                                    
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                <tr>
                                                                    <td>{{ $payment['customer']['name'] }}</td>
                                                                    <td>{{ $payment['customer']['mobile_no'] }}</td>
                                                        
                                                                    
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
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
                                                                    <td><strong>Category</strong></td>
                                                                    <td><strong>Product Name</strong></td>
                                                                    <td><strong>Current Stock</strong></td>
                                                                    <td><strong>Quantity</strong></td>
                                                                    <td><strong>Unit Price</strong></td>
                                                                    <td><strong>Total Price</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                $invoice_details = App\Models\InvoiceDetail::where('invoice_id', $payment->invoice_id)->get();
                                                                @endphp

                                                                @foreach($invoice_details as $key => $details)

                                                                @php
                                                                $totalSum += $details->selling_price;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key++ }}</td>
                                                                    <td>{{ $details['category']['name'] }}</td>
                                                                    <td>{{ $details['product']['name'] }}</td>
                                                                    <td>{{ $details['product']['quantity'] }}</td>
                                                                    <td>{{ $details->selling_qty }}</td>
                                                                    <td>{{ $details->unit_price }}</td>
                                                                    <td>{{ $details->selling_price }}</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                <tr>
                                                                    <td class="thick-line">
                                                                        <strong>Subtotal</strong></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line text-end">{{ $totalSum }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Discount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end">{{ $payment->discount_amount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Paid Amount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end"><h4 class="m-0">{{ $payment->paid_amount }}</h4></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Due Amount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end"><h4 class="m-0">{{ $payment->due_amount }}</h4></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Grant Amount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end"><h4 class="m-0">{{ $payment->total_amount }}</h4></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="7" style="text-align: center; font-weight: bold;">Paid Summary</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" style="text-align: center; font-weight: bold;">Date</td>
                                                                    <td colspan="3" style="text-align: center; font-weight: bold;">Amount</td>
                                                                </tr>
                                                                @php
                                                                $payment_details = App\Models\PaymentDetail::where('invoice_id', $payment->invoice_id)->get();
                                                                @endphp

                                                                @foreach($payment_details as $item)
                                                                <tr>
                                                                    <td colspan="4" style="text-align: center; font-weight: bold;">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                                    <td colspan="3" style="text-align: center; font-weight: bold;">{{ $item->current_paid_amount }}</td>
                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="d-print-none">
                                                            <div class="float-end">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
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
@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Customer Credit Report</h4>
                                
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Customer Credit Report</li>
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
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Sl</strong></td>
                                                                    <td><strong>Customer Name</strong></td>
                                                                    <td><strong>Invoice Number</strong></td>
                                                                    <td><strong>Date</strong></td>
                                                                    <td><strong>Due Amount</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                @endphp

                                                                @foreach($allData as $key => $item)

                                                                @php
                                                                $totalSum += $item->due_amount;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key++ }}</td>
                                                                    <td>{{ $item['customer']['name'] }}</td>
                                                                    <td>#{{ $item['invoice']['name'] }}</td>
                                                                    <td>{{ date('d.m.Y', strtotime($item->date)) }}</td>
                                                                    <td>{{ $item->due_amount }}</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                
                                                                <tr>
                                                                    <td class="no-line">
                                                                    <strong>Grand Due Amount</strong></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                   
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-end"><h4 class="m-0">{{ $totalSum }}</h4></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @php
                                                        $date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
                                                        @endphp
                                                        <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>

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
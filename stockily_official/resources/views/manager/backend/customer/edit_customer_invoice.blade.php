@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Invoice</h4>
                                
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Customer Invoice</li>
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
                                    <a href="{{route('credit.customer')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-list" >Back</i></a><br><br>

                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="p-2">
                                                        <h3 class="font-size-16"><strong>Customer Invoice (#{{$payment['invoice']['invoice_no']}})</strong></h3>
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
                                                                    <td>{{ $payment['customer']['email'] }}</td>
                                                                    
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
                                                <form method="post" action="{{ route('customer.update.invoice', $payment->invoice_id) }}">
                                                @csrf
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
                                                                $invoice_details = App\Models\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
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
                                                                    <strong>Discount Amount</strong></td>
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
                                                                        <strong>Due Amount</strong>
                                                                        <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                                                    </td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line">
                                                                    </td>
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
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label> Paid Status </label>
                                                                <select name="paid_status" id="paid_status" class="form-select">
                                                                    <option value="">Select Status </option>
                                                                    <option value="full_paid">Full Paid </option>
                                                                    <option value="partial_paid">Partial Paid </option>
                                                                </select>
                                                                <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                            <div class="md-3">
                                                                <label for="example-text-input" class="form-label">Date</label>
                                                                <input class="form-control example-date-input" name="date" type="date"  id="date"  placeholder="YYYY-MM-DD">
                                                            </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <div class="md-3" style="padding-top: 30px">
                                                                    <button type="submit" class="btn btn-info">Update Invoice</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                </form>

                                            </div>
                                        </div> <!-- end row -->
                                    

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>

<script type="text/javascript">
    $(document).on('change','#paid_status', function(){
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
    });
</script>

@endsection
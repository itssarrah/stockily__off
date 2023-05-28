<?php
$imagePath = public_path('backend/assets/images/logo-sm.png');
$imageData = file_get_contents($imagePath);
$imageBase64 = base64_encode($imageData);
$imageSrc = 'data:image/png;base64,' . $imageBase64;
?>
<head>
<link
      href="https://fonts.googleapis.com/css?family=Outfit"
      rel="stylesheet"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Orbitron"
      rel="stylesheet"
    />
    <?php 
                                                                use Illuminate\Support\Facades\Auth;
                                                                $username=Auth::user()->name;
                                                                $user_id=Auth::user()->id;
                                                                ?>
    <title>Stockily Periodic Check pdf report ({{ $username }})</title>
</head>

<style>
    *{
        font-family: 'Outfit';
    }
    .invoice-title{
        font-family:'Orbitron' ;
        font-size: 22px;
        font-weight: bold;
        color: #fdc500;
    }
    .btn-warning{
        color: yellow;
        font-size: bold;
    }
    .btn-danger{
        color: red;
        font-size: bold;
    }
    .btn-info{
        color: blue;
        font-size: bold;
    }
    .btn-success{
        color: green;
        font-size: bold;
    }

    .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top:5px
}
.row > * {
    -ms-flex-negative: 0;
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);
    margin-top: var(--bs-gutter-y);
}
table {
    width: 100%;
        border-collapse: separate;
        border: 2px dashed #fdc500;
        border-spacing: 30px; /* Adjust the spacing value as per your needs */
        margin-top: 20px;
    }

    th{
        border-bottom: 1px solid #00296b;
    }

    .down{
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .page-content{
        position: relative;
    }

</style>

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="page-title-right">
                                        <ul class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Stockily Report Listing all products present at stock</li>
                                        </ul>
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
                                                        <img src="{{ $imageSrc }}" alt="logo" height="24"/>
                                                        Warehouse Stockily Report
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
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th><strong>Sl</strong></th>
                                                                    <th><strong>Supplier Name</strong></th>
                                                                    <th><strong>Location</strong></th>
                                                                    <th><strong>Category</strong></th>
                                                                    <th><strong>Product Name</strong></th>
                                                                    
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                @endphp
                                                                
                                                                @foreach($allData as $key => $item)
                                                                @if ($item->created_by==$user_id)
                                                                    
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
                                                                @endif
                                                                @endforeach
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        @php
                                                        $date = new DateTime('now', new DateTimeZone('Africa/Algiers'));
                                                        @endphp
                                                        <i class="down">Download Time: {{$date->format('F j, Y, g:i a')}}</i>

                                                        
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
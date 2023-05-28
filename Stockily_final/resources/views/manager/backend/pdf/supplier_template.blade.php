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
    <title>Stockily Supplier {{ $allData[0]['supplier']['name'] }} Report</title>
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

    #his{
        font-weight: bolder;
        color: #00296b;
    }

</style>

<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Supplier Report: Listing all specific supplier's products</h4>
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
                                                        Stockily Supplier Report
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
                                                            @if (!empty($allData)&& count($allData) > 0)
                                                            <h3 id="his" class="text-center"><strong >Supplier Name: </strong> {{ $allData[0]['supplier']['name'] }}</h3><br>
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Sl</strong></td>
                                                                    <td><strong>Supplier Name</strong></td>
                                                                    <td><strong>Unit</strong></td>
                                                                    <td><strong>Category</strong></td>
                                                                    <td><strong>Product Name</strong></td>
                                                                    <td><strong>Stock</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                $totalSum = 0;
                                                                @endphp

                                                                @foreach($allData as $key => $item)
                                                                
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td >{{ $item['supplier']['name'] }}</td>
                                                                    <td>{{ $item['unit']['name'] }}</td>
                                                                    <td>{{ $item['category']['name'] }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                </tbody>
                                                            </table>
                                                            @endif
                                                        </div>

                                                        @php
                                                        $date = new DateTime('now', new DateTimeZone('Africa/Algiers'));
                                                        @endphp
                                                        <i class="down" >Printing Time: {{$date->format('F j, Y, g:i a')}}</i>

                                                        
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
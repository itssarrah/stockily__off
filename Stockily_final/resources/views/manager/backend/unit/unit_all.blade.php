@extends('manager.admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Locations Managment </h4>

                                     

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <a href="{{route('unit.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right; ">Add Location</a><br><br>
                  <a href="{{route('sublocation.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right; ">Add sublocation</a><br><br>
                    <h4 class="card-title">sublocation Data</h4>
                    

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>     {{-- serial number --}}
                            <th>Name</th>
                            <th>sublocation</th>
                            <th width="20%" >Action</th>
                            
                        </thead>
                        <tbody>
                        	@foreach($units as $key => $item)
                            
                        
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name }} </td>
                            <td> @foreach ($sublocation as $key => $sub_loc)
                                @if ($sub_loc->location_id==$item->id)
                                <li>{{$sub_loc->name}}<a href="{{route('sub.delete',$sub_loc)}}" class="btn btn-danger sm" title="Delete products" id="delete">  <i class="fas fa-trash-alt"></i> </a><a href="{{route('sub.edit',$sub_loc)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a></li>
                                @endif
                                @endforeach
                            </td>
                            <td>
    <!--buttons !-->
    <a href="{{route('unit.display',$item->id)}}" class="btn btn-success sm" title="display Data" id="display">  <i class="fas fa-clipboard"></i> </a>
   <a href="{{route('unit.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

    <a href="{{route('unit.delete',$item->id)}}" class="btn btn-danger sm" title="Delete products" id="delete">  <i class="fas fa-trash-alt"></i> </a>
    

                            </td>
                           
                        </tr>
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
@extends('apps.layouts.main')
@section('header.title')
Agrinesia | Asset Management
@endsection
@section('header.styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-database"></i>Asset Data 
                    </div>
                </div>
                <div class="portlet-body">
                    @if (count($errors) > 0) 
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                        </div>
                    @endif
                    @can('Can Create Product')
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="{{ route('product.create') }}"><button id="sample_editable_1_new" class="btn red btn-outline sbold"> Add New
                            </button></a>
                        </div>
                    </div>
                    @endcan
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>RFID Tag</th>
                                <th>SAP Code</th>
                                <th>Image</th>
                				<th>Name</th>
                                <th>Category</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Status</th>
                				<th>Doc User</th>
                				<th>Doc Date</th>
                				<th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $product)
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $product->rfid_code }}</td>
                                <td>{{ $product->sap_code }}</td>
                                <td><img src="http://fibertekno.iteos.tech/public/products/{{$product->image}}" width="75" height="100" ></td>
                				<td>{{ $product->name }}</td>
                                <td>{{ $product->Categories->name }}</td>
                                <td>{{ $product->Branches->name }}</td>
                                <td>{{ $product->Departments->name }}</td>
                                <td>{{ $product->Locations->location_name }}</td>
                                <td>
                                    @if($product->active == '2b643e21-a94c-4713-93f1-f1cbde6ad633')
                                    <label class="label label-sm label-info">{{ $product->Statuses->name }}</label>
                                    @else
                                    <label class="label label-sm label-danger">{{ $product->Statuses->name }}</label>
                                    @endif
                                </td>
                				<td>{{ $product->Author->name }}</td>
                                <td>{{date("d F Y H:i",strtotime($product->updated_at)) }}</td>
                				<td>
                                    @if($product->is_manufacture == 1)
                                    {!! Form::open(['method' => 'GET','route' => ['product-bom.create', $product ->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-sitemap"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Add BoM']) !!}
                                    {!! Form::close() !!}
                                    @endif
                                    <a class="btn btn-xs btn-success" href="{{ route('product.show',$product->id) }}" title="Show Product" ><i class="fa fa-search"></i></a>
                                    @can('Can Edit Product')
                                    <a class="btn btn-xs btn-success" href="{{ route('product.edit',$product->id) }}" title="Edit Product" ><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('Can Delete Product')
                                    {!! Form::open(['method' => 'POST','route' => ['product.destroy', $product->id],'style'=>'display:inline','onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Disable Product']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                			</tr>
                            @endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
<script>
    function ConfirmDelete()
    {
    var x = confirm("Are you sure you want to deactivate?");
    if (x)
        return true;
    else
        return false;
    }
</script>
@endsection
@extends('apps.layouts.main')
@section('header.title')
Asset Management | Location
@endsection
@section('header.styles')
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-database"></i>Location Data
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
                    @can('Can Create Data')
                    <div class="col-md-6">
                        <div class="form-group">
                            <tr>
                                <td>
                                    <a class="btn red btn-outline sbold fa fa-pencil" data-toggle="modal" href="#basic"> Create </a>
                                </td>
                            </tr>
                        </div>
                    </div>
                    @endcan
                    <div class="col-md-6">
                        <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {!! Form::open(array('route' => 'location.store','method'=>'POST')) !!}
                                    @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">New Location</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">SAP ID</label>
                                                    {!! Form::number('sap_id', null, array('placeholder' => 'SAP ID','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Name</label>
                                                    <select id="warehouse_id" name="warehouse_id" class="form-control select2">
                                                        <option></option>
                                                        @foreach($warehouses as $warehouse)
                                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Location Name</label>
                                                    {!! Form::text('location_name', null, array('placeholder' => 'Name Location','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="close" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                        <button id="register" type="submit" class="btn green">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>SAP ID</th>
                				<th>Branch</th>
                                <th>Location</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Date of Change</th>
                				<th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val) 
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $val->sap_id }}</td>
                				<td>{{ $val->Warehouses->name }}</td>
                                <td>{{ $val->location_name }}</td>
                                <td>{{ $val->Author->name }}</td>
                                <td>
                                    @if(!empty($val->deleted_at))
                                    <label class="label label-sm label-danger">Inactive</label>
                                    @else
                                    <label class="label label-sm label-success">Active</label>
                                    @endif
                                </td>
                                <td>{{date("d F Y H:i",strtotime($val->created_at)) }}</td>
                				<td>
                                    @can('Can Edit Data')
                                    <a class="btn btn-xs btn-success modalMd" href="#" value="{{ action('Apps\ConfigurationController@locationEdit',['id'=>$val->id]) }}" title="Edit Data" data-toggle="modal" data-target="#modalMd"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('Can Delete Data')
                                    {!! Form::open(['method' => 'POST','route' => ['warehouse.destroy', $val->id],'style'=>'display:inline','onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Delete Data']) !!}
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
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
<script>
    function ConfirmDelete()
    {
    var x = confirm("Data Will Be Deleted?");
    if (x)
        return true;
    else
        return false;
    }
</script>
@endsection
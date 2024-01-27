@extends('apps.layouts.main')
@section('header.title')
Asset Management | Audit Report
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
                        <i class="fa fa-database"></i>Audit Report
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                				<th>Tag ID</th>
                				<th>Name</th>
                				<th>DB Branch</th>
                                <th>DB Location</th>
                                <th>Audit Branch</th>
                                <th>Audit Location</th>
                				<th>Result</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val)
                			<tr>
                				<td>{{ $key+1 }}</td>
                				<td>{{ $val->id }}</td>
                				<td>{{ $val->name }}</td>
                                <td>{{ $val->Branches->name }}</td>
                                <td>{{ $val->Locations->location_name}}</td>
                                <td>{{ $val->audit_branch}}</td>
                                <td>{{ $val->audit_location}}</td>
                                <td>
                                    @if($val->Branches->name == $val->audit_branch && $val->Locations->location_name == $val->audit_location)
                                    <label class="label label-sm label-success">Asset Match</label>
                                    @elseif($val->Branches->name == $val->audit_branch && $val->Locations->location_name != $val->audit_location)
                                    <label class="label label-sm label-danger">Asset Move Location In Same Branch</label>
                                    @elseif($val->Branches->name != $val->audit_branch && $val->Locations->location_name != $val->audit_location)
                                    <label class="label label-sm label-danger">Asset Move Branch & Location</label>
                                    @endif
                                </td>
                			</tr>
                            @endforeach
                		</tbody>
                	</table>
                    <div class="form-group">
                        <tr>
                            <td>
                                <a button type="close" class="btn green btn-outline sbold" href="{{ route('audit.index') }}">Close</a>
                                <a button type="close" class="btn red btn-outline sbold" href="{{ url()->previous() }}">Excel</a>
                            </td>
                        </tr>
                    </div>
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
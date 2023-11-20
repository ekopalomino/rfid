@extends('apps.layouts.main')
@section('header.title')
Agrinesia | Asset Movement 
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
                        <i class="fa fa-database"></i>Asset Movement  
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                				<th>RFID Tag</th>
                                <th>SAP Code</th>
                                <th>Asset Name</th>
                                <th>Origin Branch</th>
                                <th>Origin Location</th>
                                <th>Destination Branch</th>
                                <th>Destination Location</th>
                                <th>Doc Date</th>
                                <th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $move)
                			<tr>
                				<td>{{ $key+1 }}</td>
                				<td>{{ $move->Products->rfid_code }}</td>
                                <td>{{ $move->Products->sap_code }}</td>
                                <td>{{ $move->Products->name }}</td>
                                <td>{{ $move->OriginBranch->name }}</td>
                                <td>{{ $move->OriginLocations->location_name }}</td>
                                <td>{{ $move->DestBranch->name }}</td>
                                <td>{{ $move->DestLocations->location_name }}</td>
                                <td>{{date("d F Y H:i",strtotime($move->updated_at)) }}</td>
                                <td></td>
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
@endsection
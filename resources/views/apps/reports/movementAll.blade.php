@extends('apps.layouts.main')
@section('header.title')
Asset Management | Asset Movement 
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
                    <table class="table table-striped table-bordered table-hover" id="movement">
                		<thead>
                			<tr>
                                <th>No</th>
                				<th>SAP Code</th>
                                <th>Asset Name</th>
                                <th>Branch</th>
                                <th>Location</th>
                                <th>Update At</th>
                            </tr>
                		</thead>
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
    $(document).ready(function(){

       // Initialize
       var empTable = $('#movement').DataTable({
             processing: true,
             serverSide: true,
             orderable: true, 
             searchable: true,
             ajax: "{{ route('movement.all') }}",
             columns: [
                { data: 'id' },
                { data: 'sap_code' },
                { data: 'name' },
                {data: 'branches', name: 'branch_id'},
                {data: 'locations', name: 'location_id'},
                {data: 'updated_at', name: 'updated_at'},
             ]
       });
    });
</script>
@endsection
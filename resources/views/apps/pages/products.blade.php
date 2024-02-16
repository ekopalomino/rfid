@extends('apps.layouts.main')
@section('header.title')
Asset Management | Asset Database
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
                        <i class="fa fa-database"></i>Asset Database 
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
                    @can('Can Create Asset')
                    <div class="col-md-6">
                        <div class="form-group">
                            <tr>
                                <td>
                                    <a class="btn red btn-outline sbold fa fa-pencil" data-toggle="modal" href="#basic"> Create </a>
                                </td>
                            </tr>
                            <a href="{{ route('asset.download') }}"><button id="sample_editable_2_new" class="btn green btn-outline sbold fa fa-download"> Download
                            </button></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Choose Method for Creating Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <a href="{{ route('asset.create') }}"><button id="create" class="btn red btn-outline sbold fa fa-edit"> Manual
                                        </button></a>
                                        <a href="{{ route('asset.page') }}"><button id="import" class="btn blue btn-outline sbold fa fa-upload"> Import
                                        </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <table class="table table-striped table-bordered table-hover" id="product">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>SAP Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Branch</th>
                                <th>Location</th>
                                <th>Doc User</th>
                				<th>Doc Date</th>
                				<th></th>
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
       var empTable = $('#product').DataTable({
             processing: true,
             serverSide: true,
             orderable: true, 
             searchable: true,
             ajax: "{{ route('product.table') }}",
             columns: [
                { data: 'id' },
                { data: 'sap_code' },
                { data: 'name' },
                {data: 'categories', name: 'category_id'},
                {data: 'branches', name: 'branch_id'},
                {data: 'locations', name: 'location_id'},
                {data: 'author', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                { data: 'action' },
             ]
       });
       $('#product').on('click','.deleteProduct',function(){
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                 // AJAX request
                 $.ajax({
                     url: "{{ route('asset.destroy') }}",
                     type: 'post',
                     data: {_token: CSRF_TOKEN,id: id},
                     success: function(response){
                          if(response.success == 1){
                               alert("Asset deleted.");

                               // Reload DataTable
                               empTable.ajax.reload();
                          }else{
                                alert("Invalid ID.");
                          }
                     }
                 });
            }
       });
       
    });
</script>
@endsection
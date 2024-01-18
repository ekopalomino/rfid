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
			<table class="table table-striped table-bordered table-hover" id="sample_2">
				<thead>
                	<tr>
                        <th>No</th>
                		<th>Tag ID</th>
                        <th>Nama</th>
                        <th>DB Branch</th>
                		<th>DB Location</th>
                		<th>Audit Branch</th>
                        <th>Audit Location</th>
                	</tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $val)
                	<tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $val->TagID }}</td>
                        <td>Macbook Air</td>
                        <td>Bogor</td>
                        <td>Lantai 2</td>
                        <td>Bogor</td>
                        <td>Lantai 2</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>        
		</div>
	</div>
</div>       
@endsection
@section('footer.scripts')
<script type="text/javascript">
    $(document).on('ajaxComplete ajaxReady ready', function () {
        $('ul.pagination li a').off('click').on('click', function (e) {
            $("#modalLg").modal('show');
            $('#modalLgContent').load($(this).attr('href'));
            $('#modalLgTitle').html($(this).attr('title'));
            e.preventDefault();
        });
    });
</script>
@endsection 
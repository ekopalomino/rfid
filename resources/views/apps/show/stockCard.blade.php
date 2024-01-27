@extends('apps.layouts.main')
@section('header.title')
Asset Management | Movement Card
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered table-hover" id="sample_2">
				<thead>
                	<tr>
                        <th>No</th>
                        <th>Date</th>
                		<th>Tag ID</th>
                        <th>Name</th>
                        <th>From Branch</th>
                		<th>From Location</th>
                		<th>To Branch</th>
                        <th>To Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $val)
                	<tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{date("d F Y H:i",strtotime($val->updated_at)) }}</td>
                        <td>{{ $val->product_id }}</td>
                        <td>{{ $val->Products->name }}</td>
                        <td>{{ $val->OriginBranch->name }}</td>
                        <td>{{ $val->OriginLocations->location_name }}</td>
                        <td>{{ $val->DestBranch->name }}</td>
                        <td>{{ $val->DestLocations->location_name }}</td>
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
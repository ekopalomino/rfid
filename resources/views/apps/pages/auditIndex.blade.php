@extends('apps.layouts.main')
@section('header.title')
Asset Management | Asset Audit
@endsection
@section('header.styles')
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="portlet box red ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-database"></i> Asset Audit Report Query
			</div>
		</div>
		<div class="portlet-body form">
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
			{!! Form::open(array('route' => 'audit.process','method'=>'POST', 'class' => 'horizontal-form')) !!}
			@csrf
			<div class="form-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Audit Start Date</label>
							{!! Form::date('start_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Audit End Date</label>
							{!! Form::date('end_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
						</div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group">
						    <label class="control-label">Audit Branch</label>
							<select id="branch" name="branch" class="form-control select2">
								<option></option>
								@foreach($branches as $branch)
								<option value="{{ $branch->name }}">{{ $branch->name}}</option>
								@endforeach
							</select>
						</div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
						    <label class="control-label">Audit Location</label>
							<select id="location" name="location" class="form-control select2">
								<option></option>
								@foreach($locations as $location)
								<option value="{{ $location->location_name }}">{{ $location->location_name}}</option>
								@endforeach
							</select>
						</div>
                    </div>
				</div>
				<div class="form-actions left"> 
					<a button type="button" class="btn default" href="{{ route('audit.index') }}">Reset</a>
					<button type="submit" class="btn blue">
						<i class="fa fa-play"></i> Run
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
@endsection
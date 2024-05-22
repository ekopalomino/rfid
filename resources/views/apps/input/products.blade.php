@extends('apps.layouts.main')
@section('header.title')
Agrinesia | New Asset
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
                <i class="fa fa-database"></i> New Asset Form
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
            {!! Form::open(array('route' => 'asset.store','method'=>'POST','class' => 'form-horizontal','files' => 'true')) !!}
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Asset Code *</label>
                                <div class="col-md-6">
                                    {!! Form::text('sap_code', null, array('placeholder' => 'SAP Code','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Item Name *</label>
                                <div class="col-md-9">
                                    {!! Form::text('name', null, array('placeholder' => 'Item Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category *</label>
                                <div class="col-md-6">
                                    <select id="category_id" name="category_id" class="form-control select2">
								        <option></option>
								        @foreach($categories as $category)
								        <option value="{{ $category->id }}">{{ $category->name}}</option>
								        @endforeach
							        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Parent Asset</label>
                                <div class="col-md-6">
                                    <select id="parent_id" name="parent_id" class="form-control select2">
								        <option></option>
								        @foreach($parents as $parent)
								        <option value="{{ $parent->id }}">{{ $parent->name}}</option>
								        @endforeach
							        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Purchase Price</label>
                                <div class="col-md-6">
                                    {!! Form::number('price', null, array('placeholder' => 'Item Cost','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Purchase Date</label>
                                <div class="col-md-6">
                                    {!! Form::date('purchase_date', null, array('placeholder' => 'Product Cost Price','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Asset Specification *</label>
                                <div class="col-md-9">
                                    {!! Form::textarea('specification', null, array('placeholder' => 'Item Specification','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Asset Picture</label>
                                <div class="col-md-6">
                                    {!! Form::file('image', null, array('placeholder' => 'Product Image','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-branch"></i> Asset Location
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Branch *</label>
                                            <div class="col-md-6">
                                                <select id="branch_id" name="branch_id" class="form-control select2">
                                                    <option></option>
                                                    @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name}}</option>
                                                    @endforeach
							                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Location *</label>
                                            <div class="col-md-6">
                                                <select id="location_id" name="location_id" class="form-control select2">
                                                    <option></option>
                                                    @foreach($locations as $location)
                                                    <option value="{{ $location->sap_id }}">{{ $location->location_name}}</option>
                                                    @endforeach
							                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Department *</label>
                                            <div class="col-md-6">
                                                <select id="department_id" name="department_id" class="form-control select2">
                                                    <option></option>
                                                    @foreach($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->name}}</option>
                                                    @endforeach
							                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a button type="button" class="btn default" href="{{ route('asset.index') }}">Cancel</a>
                        <button type="submit" class="btn blue">
                        <i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
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
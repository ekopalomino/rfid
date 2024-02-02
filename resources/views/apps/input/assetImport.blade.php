@extends('apps.layouts.main')
@section('header.title')
Asset Management | New Asset Import
@endsection
@section('content')
<div class="page-content">
    <div class="portlet box red ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i> New Asset Import
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
            {!! Form::open(array('route' => 'asset.import','method'=>'POST','class' => 'form-horizontal','files' => 'true')) !!}
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-heading-1 border-red m-bordered">
                                <h3>How to Import Data</h3>
                                    <p>1. Download templates & all the references data.</p>
                                    <p>2. Use id field from references data to fill the category_id,branch_id,location_id & department id on asset template.</p>
                                    <p>3. Import the asset template.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::file('asset', null, array('placeholder' => 'Asset Data','class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-branch"></i> Import Templates
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Asset Template</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('asset.template') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Branch Reference</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('warehouse.export') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Location Reference</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('location.export') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Department Reference</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('uker.export') }}">Download</a>
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
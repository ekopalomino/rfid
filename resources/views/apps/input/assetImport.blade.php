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
                            <div class="form-group">
                                <div class="col-md-6">
                                    {!! Form::file('asset', null, array('placeholder' => 'Asset Data','class' => 'form-control')) !!}
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
                                            <label class="col-md-2 control-label">Asset</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('asset.template') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Branch</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('warehouse.export') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Location</label>
                                            <div class="col-md-6">
                                            <a button type="button" class="btn default red" href="{{ route('location.export') }}">Download</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Department</label>
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
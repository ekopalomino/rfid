@extends('apps.layouts.main')
@section('header.title')
Agrinesia | New Asset
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
                                <label class="col-md-3 control-label">SAP Code *</label>
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
                                    {!! Form::select('category_id', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
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
                                <label class="col-md-3 control-label">Warranty Period</label>
                                <div class="col-md-6">
                                    {!! Form::select('warranty_period', [null=>'Please Select'] + $warranties,[], array('class' => 'form-control')) !!}
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
                                                {!! Form::select('branch_id', [null=>'Please Select'] + $branches,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Department *</label>
                                            <div class="col-md-6">
                                                {!! Form::select('department_id', [null=>'Please Select'] + $divisions,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Location *</label>
                                            <div class="col-md-6">
                                                {!! Form::select('location_id', [null=>'Please Select'] + $locations,[], array('class' => 'form-control')) !!}
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
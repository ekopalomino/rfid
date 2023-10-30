@extends('apps.layouts.main')
@section('header.title')
Agrinesia | Tambah Item
@endsection
@section('content')
<div class="page-content">
    <div class="portlet box red ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i> Form Item Baru
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
            {!! Form::open(array('route' => 'product.store','method'=>'POST','class' => 'form-horizontal','files' => 'true')) !!}
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Kode SAP</label>
                                <div class="col-md-6">
                                    {!! Form::text('barcode', null, array('placeholder' => 'SAP Code','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Item</label>
                                <div class="col-md-9">
                                    {!! Form::text('name', null, array('placeholder' => 'Item Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Kategori</label>
                                <div class="col-md-6">
                                    {!! Form::select('category_id', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Satuan</label>
                                <div class="col-md-6">
                                    {!! Form::select('uom_id', [null=>'Please Select'] + $uoms,[], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Harga Beli</label>
                                <div class="col-md-6">
                                    {!! Form::text('base_price', null, array('placeholder' => 'Item Cost','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tanggal Pembelian</label>
                                <div class="col-md-6">
                                    {!! Form::date('base_price', null, array('placeholder' => 'Product Cost Price','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Spesifikasi Item</label>
                                <div class="col-md-9">
                                    {!! Form::textarea('base_price', null, array('placeholder' => 'Item Specification','class' => 'form-control')) !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Gambar Produk</label>
                                <div class="col-md-6">
                                    {!! Form::file('image', null, array('placeholder' => 'Product Image','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-branch"></i> Lokasi Item
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Cabang</label>
                                            <div class="col-md-6">
                                                {!! Form::select('category_id', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Departemen</label>
                                            <div class="col-md-6">
                                                {!! Form::select('category_id', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Lokasi</label>
                                            <div class="col-md-6">
                                                {!! Form::select('category_id', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a button type="button" class="btn default" href="{{ route('product.index') }}">Cancel</a>
                        <button type="submit" class="btn blue">
                        <i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@extends('apps.layouts.main')
@section('header.title')
Asset Management | View Asset 
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header.styles')
<link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<div class="profile-sidebar">
				<div class="portlet light profile-sidebar-portlet ">
					<div class="profile-userpic">
						<img src="/products/{{$product->image}}" class="img-responsive" alt="">
					</div>
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">{{ $product->name}}</div>
						<div class="profile-usertitle-job">{{ $product->Categories->name}}</div>
						<div class="profile-usertitle-job">{{ $product->id}}</div>
						{{ $product->specification }}
					</div>
				</div>
			</div>
			<div class="profile-content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light ">
							<div class="portlet-title tabbable-line">
								<div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Asset Detail</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        
                                    </li>
                                </ul>
                            </div>
							<div class="portlet-body">
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_1">
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category :</label>
                                                <p>{{ $product->Categories->name }}</p> 
                                            </div>
											<div class="form-group">
                                                <label class="control-label">Location :</label>
                                                <p>{{ $product->Locations->location_name }}</p>
											</div>
                                            <div class="form-group">
                                                <label class="control-label">Department :</label>
                                                <p>{{ $product->Departments->name }}</p> 
                                            </div>
											<div class="form-group">
                                                <label class="control-label">Branch :</label>
                                                <p>{{ $product->Branches->name }}</p> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
											<div class="form-group">
                                                <label class="control-label">Purchase Price :</label>
                                                <p>Rp {{ number_format($product->base_priceprice,2,',','.')}}</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Purchase Date :</label>
                                                <p>{{date("d F Y H:i",strtotime($product->purchase_date)) }}</p>
                                            </div>
											<div class="form-group">
                                                <label class="control-label">Warranty Period :</label>
                                                <p>{{ $product->warranty_period }} Month</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Last Update :</label>
                                                <p>{{date("d F Y H:i",strtotime($product->updated_at)) }}</p> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        	<div class="portlet box red">
                                        		<div class="portlet-title">
                                        			<div class="caption">
                                            			<i class="fa fa-database"></i>Asset Movements
                                            		</div>
                                            	</div>
                                            	<div class="portlet-body">
		                                        	<table class="table table-striped table-bordered table-hover" id="sample_1">
		                                        		<thead>
								                			<tr>
								                                <th>No</th>
								                				<th>Date</th>
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
						                <div class="col-md-6">
							                <div class="form-group">
		                            			<tr>
					                                <td>
					                                    <a button type="close" class="btn green btn-outline sbold" href="{{ url()->previous() }}">Close</a>
					                                </td>
					                            </tr>
	                        				</div>
	                        			</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
@endsection

@extends('apps.layouts.main')
@section('header.title')
Asset Management | Dashboard
@endsection
@section('header.plugins') 
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header.styles')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawBranchChart);
    google.charts.setOnLoadCallback(drawCategoryChart);
    function drawBranchChart() {
        var branches = <?php echo $branches; ?>;
        var data = google.visualization.arrayToDataTable(branches);
        var options = {
          title: 'Asset by Branch',
        };
        var chart = new google.visualization.PieChart(document.getElementById('Branch_chart_div'));
        chart.draw(data, options);
    }
    function drawCategoryChart() {
        var categories = <?php echo $categories; ?>;
        var data = google.visualization.arrayToDataTable(categories);
        var options = {
          title: 'Asset by Category',
        };
        var chart = new google.visualization.PieChart(document.getElementById('Category_chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $totalAsset }}">{{ $totalAsset }}</span>
                    </div>
                    <div class="desc"> Total Registered Asset </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $totalBundle }}">{{ $totalBundle }}</span>
                    </div>
                    <div class="desc"> Total Bundle Asset </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $totalNonBundle }}">{{ $totalNonBundle }}</span>
                    </div>
                    <div class="desc"> Total Non Bundle Asset </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $totalDeleteAsset }}">{{ $totalDeleteAsset }}</span>
                    </div>
                    <div class="desc"> Total Delete Asset </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
        	<div id="Branch_chart_div" style="width: 100%; min-height: 450px"></div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
        	<div id="Category_chart_div" style="width: 100%; min-height: 450px"></div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
@endsection
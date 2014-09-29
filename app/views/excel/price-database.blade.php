<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />
<!-- <link rel="stylesheet" href="{{asset('assets/stylesheets/datatables.css')}}" />
 -->
<!-- Specific Page Vendor -->
<script src="{{asset('assets/vendor/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables/extras/TableTools/media/js/TableTools.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js')}}"></script>

<!-- jQuery Specify page Navigation bar and active status -->
<script type="text/javascript">
	//set page name here
	pagename = "Price Database";
</script>

<?php
// get column of the table
$columns = Schema::getColumnListing('data_medassets');
//search function
$key = Input::get('q');
$count = DB::select('select count(*) as count from data_medassets where item_description like "%'.$key.'%" or item_number like "%'.$key.'%"');
//echo $count[0]->count;
$rows =  DB::select('select * from data_medassets where item_description like "%'.$key.'%" or item_number like "%'.$key.'%" limit 1000');
?>

<section class="panel">
	@if($key != '')
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<p class="m-none h4">
			Total <strong>{{$count[0]->count}}</strong> result(s) for "<b>{{$key}}</b>", see all results please <a href="{{url('excel/price-database')}}" class="alert-link">click</a>
		</p>
	</div>
	@endif
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<a href="#" class="fa fa-times"></a>
		</div>
		<h2 class="panel-title">MedAssets Database</h2>
	</header>
	<div class="panel-body">
		<table class="table table-striped" id="datatable-default">
			<thead>
				<tr>
					<th>id</th>
					<th>Contract</th>
					<th>Item Number</th>
					<th>Item Description</th>
					<th>UOM</th>
					<th>Packaging String</th>
					<th>Tier 1 Price</th>
					<th>Tier 2 Price</th>
					<th>Tier 3 Price</th>
					<th>Tier 4 Price</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($rows as $row)
				<tr>
					<?php
					//var_dump($row);
						echo "<td>".$row->id."</td>";
						echo "<td>".$row->contract_number."</td>";
						echo "<td>".$row->item_number."</td>";
						echo "<td>".Str::lower($row->item_description)."</td>";
						echo "<td>".$row->UOM."</td>";
						echo "<td>".$row->packaging_string."</td>";
						echo "<td>$".number_format($row->price1,2)."</td>";
						echo "<td>$".number_format($row->price2,2)."</td>";
						echo "<td>$".number_format($row->price3,2)."</td>";
						echo "<td>$".number_format($row->price4,2)."</td>";
						echo "<td>".$row->created_at."</td>";
					?>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('#datatable-default').dataTable();
	});
</script>

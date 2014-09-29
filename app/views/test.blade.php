<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Page</title>

</head>
<body>
	<div class="welcome">	
		<h1>You have arrived.</h1>
		<p><?php
		echo App::environment()."<br>";
		echo URL::to('js/test');
		?></p>

		{{asset('js')}}
		{{e('<html>foo</html>')}}
		{{'asdwadd'}}
		<br>
		{{asset("assets/vendor/bootstrap/css/bootstrap.css")}}
		<br>
		{{url('users/signup')}}
		<br>
		{{Form::open(array('url' => 'users/create'))}}
		<br>
		{{Hash::make('123456')}}
		<br>
		$2y$10$lystDjhb.lWH3Wnq3aiCreXCr
		<br>
		{{url('users/emailactivate','12312312');}}
		<br>
		{{Form::open(array('url'=>url('users/sendconfirmation'))).Form::hidden('email','gang.yang2015@gmail.com').Form::submit('Resend').Form::close();}}

		<br>
		<?php
			$columns = Schema::getColumnListing('data_medassets');
			foreach ($columns as $column) {
				echo $column."<br>";
			}
		?>
		<br>
		@if(Session::has('data'))
		<pre> {{print_r(Session::get('data'))}}</pre>
		@endif

		<br>
		<h2>Database</h2>
		<pre>
		<?php
			$result = DB::select('select * from data_medassets');	
			echo $result[12]->price1;	
			$result2 = DB::select('desc data_medassets');
			//var_dump( $result2);
			echo $result2[0]->Field; 
			//var_dump($result[1]->id);





			$statement = <<<EOF
LOAD DATA INFILE 'C:\Users\\\Gang\\\Dropbox\\\Veira\\\data\\\SampleData\\\MedAssetsCDQuickData\\\PFBM07131A.csv' 
REPLACE
INTO TABLE data_medassets_temp
FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '\\\'
LINES TERMINATED BY '\\r\\n' STARTING BY ''
IGNORE 1 LINES
(@dummy, contract_number, product_line, item_number, @item_description ,UOM, conversion_factor, packaging_string, 
@dummy,@dummy, @price1_start_date,@price1_end_date,price1,@dummy,@dummy,@dummy,@dummy,@dummy,
@dummy,@dummy, @price2_start_date,@price2_end_date,price2,@dummy,@dummy,@dummy,@dummy,@dummy,
@dummy,@dummy, @price3_start_date,@price3_end_date,price3,@dummy,@dummy,@dummy,@dummy,@dummy,
@dummy,@dummy, @price4_start_date,@price4_end_date,price4,@dummy,@dummy,@dummy,@dummy,@dummy )
SET item_description			= LOWER(@item_description),
	price1_start_date 			= STR_TO_DATE(@price1_start_date,'%m/%d/%Y'), 
	price1_end_date 			= STR_TO_DATE(@price1_end_date,'%m/%d/%Y'),
	price2_start_date 			= STR_TO_DATE(@price2_start_date,'%m/%d/%Y'), 
	price2_end_date 			= STR_TO_DATE(@price2_end_date,'%m/%d/%Y'),
	price3_start_date 			= STR_TO_DATE(@price3_start_date,'%m/%d/%Y'), 
	price3_end_date 			= STR_TO_DATE(@price3_end_date,'%m/%d/%Y'),
	price4_start_date 			= STR_TO_DATE(@price4_start_date,'%m/%d/%Y'), 
	price4_end_date 			= STR_TO_DATE(@price4_end_date,'%m/%d/%Y'),
	created_at = CURRENT_TIMESTAMP
EOF;
		//echo $statement;
		//	$result = DB::connection()->getpdo()->exec($statement);
		//	echo $result;
		?>
		<?php


		?>
		</pre>
	</div>
</body>
</html>

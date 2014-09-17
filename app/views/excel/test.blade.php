<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" ></script>
<script type="text/javascript">
	$('#getAjax').click(function(){
		$.get("{{url('excel/sheets-number')}}",function(data){
			$('#result').html('Total number of sheets: '+data);
		});
	});
</script>
<div id='result'> test</div>
<button id='getAjax'>Get Total Sheets Number</button>
{{Form::open(array('url'=>'excel/test','files'=>true, 'role'=>'form','id'=>'signin_form'))}}
{{Form::file('excel')}}
{{Form::submit('upload')}}
<br>
@if(isset($sheetsArray))
{{count($sheetsArray)}}
	<table>
		<thead>
			<tr>
			@foreach ($sheetsArray[0][0] as $header)
				<th>
					{{$header}}
				</th>
			@endforeach
			</tr>
		</thead>
		<tbody>
		@foreach (array_slice($sheetsArray[0],1) as $row)
			<tr>
			<?php
				foreach ($row as $cell) {
					echo "<td>";
					echo $cell;
					echo "</td>";
				}
			?>
			</tr>
		@endforeach
		</tbody>
	</table>
@else
@endif


{{Form::close()}}

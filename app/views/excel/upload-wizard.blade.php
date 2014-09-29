<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/pnotify/pnotify.custom.css')}}" />

<!-- Wizard, Specific Page Vendor -->
<script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
<script src="{{asset('assets/vendor/pnotify/pnotify.custom.js')}}"></script>

<!-- jQuery Specify page Navigation bar and active status -->
<script type="text/javascript">
	//set page name here
	pagename = "Upload Wizard";
</script>

<?php
	if(Session::has('tab'))
		$tab = Session::get('tab');
	else
	 	$tab = 1;
?>

<div class="row">
	<div class="col-xs-12">
		<section class="panel form-wizard">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<!-- <a href="#" class="fa fa-times"></a> -->
				</div>

				<h2 class="panel-title">Excel Upload Wizard</h2>
			</header>
			@if($tab == 1)
				{{Form::open(array('url'=>'excel/upload-file','files'=>true, 'id'=>'upload-form', 'role'=>'form','class'=>'form-horizontal'))}}
					<div class="panel-body">
						<div class="wizard-progress wizard-progress-lg">
							<div class="steps-progress">
								<div class="progress-indicator"></div>
							</div>
							<ul class="wizard-steps">
								<li id="tab1" class="active">
									<a href="#" ><span>1</span>Choose File</a>
								</li>
								<li id="tab2">
									<a href="#" onclick="document.getElementById('upload-form').submit();"><span>2</span>Match Fields</a>
								</li>
								<li id="tab3">
									<a  ><span>3</span>Preview Data</a>
								</li>
								<li id="tab4">
									<a  ><span>4</span>Upload To Database</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-content">
							<div id="content1" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="excel">Select Execel File to Upload</label>
									<div class="col-sm-9">
										<input type="file" name="excel" id='excel' required>
									</div>
								</div>
								<div>
									<label class="col-sm-3 control-label" for="table">Select Data Table to store</label>
									<div class="col-sm-9">
										<input type="radio" name="table" value="sales" checked="checked" >Sales Data<br>
										<input type="radio" name="table" value="medassets">MedAssets Data
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<ul class="pager">
							<li class="previous disabled">
								<a><i class="fa fa-angle-left"></i> Previous</a>
							</li>
							<li class="next">
								<a onclick="document.getElementById('upload-form').submit();">Next <i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</div>
				{{Form::close()}}
			@elseif($tab == 2)
				{{Form::open(array('url'=>'excel/match-field','files'=>true, 'id'=>'upload-form', 'role'=>'form','class'=>'form-horizontal'))}}
					<div class="panel-body">
						<div class="wizard-progress wizard-progress-lg">
							<div class="steps-progress">
								<div class="progress-indicator"></div>
							</div>
							<ul class="wizard-steps">
								<li id="tab1">
									<a href="{{url('excel/upload-wizard')}}"><span>1</span>Choose File</a>
								</li>
								<li id="tab2" class="active">
									<a ><span>2</span>Match Fields</a>
								</li>
								<li id="tab3">
									<a  ><span>3</span>Preview Data</a>
								</li>
								<li id="tab4">
									<a  ><span>4</span>Upload To Database</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-content">
							<div id="content2" class="tab-pane active">
								<div class="form-group">
								<?php
									$excel = Session::get('excel');
									$columns = Session::get('columns');
								?>

								<label for="selectSheet">Please select a sheet</label>
								<select id="selectSheet">
									@for($i = 0; $i < $excel['sheetsNumber']; $i++)
									<option value="{{$i}}">{{$excel['sheetsTitles'][$i]}}</option>
									@endfor
								</select>
								<script type="text/javascript">
								var columns = [];

								<?php
									$k=0;
									$optionsHtml = array();
									foreach($excel['totalHeaders'] as $headers){
										$options = '<option value=""></option>';
										foreach($headers as $header){
											$options.= '<option value="'.$header.'">'.$header.'</option>';
										}
										echo 'columns['.$k.'] = \''.$options.'\';';
										$k++;
									}
								?>

								$(document).ready(function(){
									$(".excelColumn").html(columns[0]);
									$("#selectSheet").change(function(){
										var i = $("#selectSheet option:selected").val();
										$(".excelColumn").html(columns[i]);
									});									
								});
								</script>

								<table cellpadding="0" cellspacing="0" border="0">									
									<thead>
										<tr>
											<th>Database Columns</th>
											<th>File Columns</th>
										</tr>
									</thead>
									<tbody>
										@foreach($columns as $column )
										<tr>
											<td><label for="column_{{$column}}">{{$column}}</label></td>
											<td>
												<select class="excelColumn" name="column['{{$column}}']" id="column_{{$column}}">
												
												</select>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<ul class="pager">
							<li class="previous disabled">
								<a><i class="fa fa-angle-left"></i> Previous</a>
							</li>
							<li class="next">
								<a onclick="document.getElementById('upload-form').submit();">Next <i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</div>
				{{Form::close()}}
			@elseif($tab == 3)
			@elseif($tab == 4)
			@endif
		</section>
	</div>
</div>

<!-- functional js should put the end of the page -->
<!-- Examples -->
<!-- <script src="{{asset('assets/javascripts/forms/quantum.wizard.js')}}"></script>  -->

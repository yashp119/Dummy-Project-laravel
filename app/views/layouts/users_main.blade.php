<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Login | Quantum</title>

    <!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
    {{HTML::style('css/bootstrap.min.css')}}

    <!-- MAIN CSS (REQUIRED ALL PAGE)-->
    {{HTML::style('plugins/font-awesome/css/font-awesome.min.css')}}
    {{HTML::style('css/style.css')}}
    {{HTML::style('css/style-responsive.css')}}

    <!-- PLUGINS CSS -->
    {{HTML::style('plugins/slider/slider.min.css')}}
    {{HTML::style('plugins/weather-icon/css/weather-icons.min.css')}}
    {{HTML::style('plugins/prettify/prettify.min.css')}}
    {{HTML::style('plugins/magnific-popup/magnific-popup.min.css')}}
    {{HTML::style('plugins/owl-carousel/owl.carousel.min.css')}}
    {{HTML::style('plugins/owl-carousel/owl.theme.min.css')}}
    {{HTML::style('plugins/owl-carousel/owl.transitions.min.css')}}
    {{HTML::style('plugins/chosen/chosen.min.css')}}
    {{HTML::style('plugins/icheck/skins/all.css')}}
    {{HTML::style('plugins/datepicker/datepicker.min.css')}}
    {{HTML::style('plugins/timepicker/bootstrap-timepicker.min.css')}}
    {{HTML::style('plugins/validator/bootstrapValidator.min.css')}}
    {{HTML::style('plugins/summernote/summernote.min.css')}}
    {{HTML::style('plugins/markdown/bootstrap-markdown.min.css')}}
    {{HTML::style('plugins/datatable/css/bootstrap.datatable.min.css')}}
    {{HTML::style('plugins/morris-chart/morris.min.css')}}
    {{HTML::style('plugins/c3-chart/c3.min.css')}}
    {{HTML::style('plugins/salvattore/salvattore.css')}}
    {{HTML::style('plugins/toastr/toastr.css')}}
    {{HTML::style('plugins/fullcalendar/fullcalendar/fullcalendar.css')}}
    {{HTML::style('plugins/fullcalendar/fullcalendar/fullcalendar.print.css')}}
  </head>
 
  <body class="login tooltips">
		
		<!-- BEGIN PANEL DEMO -->
		<div class="box-demo">
			<div class="inner-panel">
				<div class="cog-panel" id="demo-panel"><i class="fa fa-cog fa-spin"></i></div>
				<p class="text-muted small text-center">COLOR SCHEMES</p>
				<div class="row text-center">
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Default" id="color-reset">
							<div class="half-tiles bg-primary"></div>
							<div class="half-tiles bg-primary"></div>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Success" id="bg-success">
							<div class="half-tiles bg-success"></div>
							<div class="half-tiles bg-success"></div>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Info" id="bg-info">
							<div class="half-tiles bg-info"></div>
							<div class="half-tiles bg-info"></div>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Danger" id="bg-danger">
							<div class="half-tiles bg-danger"></div>
							<div class="half-tiles bg-danger"></div>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Warning" id="bg-warning">
							<div class="half-tiles bg-warning"></div>
							<div class="half-tiles bg-warning"></div>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="xs-tiles" data-toggle="tooltip" title="Dark" id="bg-dark">
							<div class="half-tiles bg-dark"></div>
							<div class="half-tiles bg-dark"></div>
						</div>
					</div>
				</div>
				<button class="btn btn-block btn-primary btn-sm" id="btn-reset">Reset to default</button>
			</div>
		</div>
		<!-- END PANEL DEMO -->


 		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="login-header text-center">
			{{HTML::image('img/logo-login.png',"Logo",array('class'=>'logo'))}}
		</div>
		<div class="login-wrapper">
		@if(Session::has('message'))
			<div class="alert alert-warning alert-bold-border fade in alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  {{Session::get('message')}}
			</div>
		@endif

		{{ $content }}

		</div><!-- /.login-wrapper -->
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		
		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- MAIN JAVASRCIPT (REQUIRED ALL PAGE)-->

		{{HTML::script('js/jquery.min.js')}}
		{{HTML::script('js/bootstrap.min.js')}}
		{{HTML::script('plugins/retina/retina.min.js')}}
		{{HTML::script('plugins/nicescroll/jquery.nicescroll.js')}}
		{{HTML::script('plugins/slimscroll/jquery.slimscroll.min.js')}}
		{{HTML::script('plugins/backstretch/jquery.backstretch.min.js')}}
 
		<!-- PLUGINS -->
		{{HTML::script('plugins/skycons/skycons.js')}}
		{{HTML::script('plugins/prettify/prettify.js')}}
		{{HTML::script('plugins/magnific-popup/jquery.magnific-popup.min.js')}}
		{{HTML::script('plugins/owl-carousel/owl.carousel.min.js')}}
		{{HTML::script('plugins/chosen/chosen.jquery.min.js')}}
		{{HTML::script('plugins/icheck/icheck.min.js')}}
		{{HTML::script('plugins/datepicker/bootstrap-datepicker.js')}}
		{{HTML::script('plugins/timepicker/bootstrap-timepicker.js')}}
		{{HTML::script('plugins/mask/jquery.mask.min.js')}}
		{{HTML::script('plugins/validator/bootstrapValidator.min.js')}}
		{{HTML::script('plugins/datatable/js/jquery.dataTables.min.js')}}
		{{HTML::script('plugins/datatable/js/bootstrap.datatable.js')}}
		{{HTML::script('plugins/summernote/summernote.min.js')}}
		{{HTML::script('plugins/markdown/markdown.js')}}
		{{HTML::script('plugins/markdown/to-markdown.js')}}
		{{HTML::script('plugins/markdown/bootstrap-markdown.js')}}
		{{HTML::script('plugins/slider/bootstrap-slider.js')}}
		
		{{HTML::script('plugins/toastr/toastr.js')}}
		
		<!-- FULL CALENDAR JS -->
		{{HTML::script('plugins/fullcalendar/lib/jquery-ui.custom.min.js')}}
		{{HTML::script('plugins/fullcalendar/fullcalendar/fullcalendar.min.js')}}
		{{HTML::script('js/full-calendar.js')}}
		
		<!-- EASY PIE CHART JS -->
		{{HTML::script('plugins/easypie-chart/easypiechart.min.js')}}
		{{HTML::script('plugins/easypie-chart/jquery.easypiechart.min.js')}}
		
		<!-- KNOB JS -->
		<!--[if IE]>
		<script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js')}}
		<![endif]-->
		{{HTML::script('plugins/jquery-knob/jquery.knob.js')}}
		{{HTML::script('plugins/jquery-knob/knob.js')}}

		<!-- FLOT CHART JS -->
		{{HTML::script('plugins/flot-chart/jquery.flot.js')}}
		{{HTML::script('plugins/flot-chart/jquery.flot.tooltip.js')}}
		{{HTML::script('plugins/flot-chart/jquery.flot.resize.js')}}
		{{HTML::script('plugins/flot-chart/jquery.flot.selection.js')}}
		{{HTML::script('plugins/flot-chart/jquery.flot.stack.js')}}
		{{HTML::script('plugins/flot-chart/jquery.flot.time.js')}}

		<!-- MORRIS JS -->
		{{HTML::script('plugins/morris-chart/raphael.min.js')}}
		{{HTML::script('plugins/morris-chart/morris.min.js')}}
		
		<!-- C3 JS -->
		{{HTML::script('plugins/c3-chart/d3.v3.min.js')}}
		{{HTML::script('plugins/c3-chart/c3.min.js')}}
		
		<!-- MAIN APPS JS -->
		{{HTML::script('js/apps.js')}}
		{{HTML::script('js/demo-panel-1.js')}}

<!-- ############ Customer JS ################################# -->
			<!-- Form Validation -->
			{{HTML::script('plugins/validator/example.js')}}
	
  </body>
</html>
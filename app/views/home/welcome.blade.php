<!-- jQuery Specify page Navigation bar and active status -->
<script type="text/javascript">
	//set page name here
	pagename = "Welcome";
</script>

<h3>
Welcome {{Auth::user()->firstname.' '.Auth::user()->lastname}}, you are logged in system!<br>
</h3>
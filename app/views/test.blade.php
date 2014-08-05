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
		{{}}
	</div>
</body>
</html>

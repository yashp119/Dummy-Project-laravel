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
	</div>
</body>
</html>

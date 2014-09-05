
{{Form::open(array('url'=>'users/recoverpassword','role'=>'form','id'=>'recoverpwd_form'))}}
	<ul>
		@foreach($errors->all() as $error)
			 <font color="red"><li>{{$error}}</li> </font>
		@endforeach
	</ul>
	<div class="alert alert-info">
	<p class="m-none text-semibold h6">Enter your e-mail below and we will send you new password!</p>
	</div>
	<div class="form-group mb-none">
		<div class="input-group">
			<input name="email" type="email" placeholder="E-mail" class="form-control input-lg" />
			<span class="input-group-btn">
				<button class="btn btn-primary btn-lg" type="submit">Recover!</button>
			</span>
		</div>
	</div>

	<p class="text-center mt-lg">Remembered? <a href="{{url('users/signin')}}">Sign In!</a>
{{Form::close()}}

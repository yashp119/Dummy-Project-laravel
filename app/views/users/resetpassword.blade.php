<div class="alert alert-info">
	<p class="m-none text-semibold h6">Enter your e-mail below and we will send you reset instructions!</p>
</div>

{{Form::open(array('url'=>'users/resetpassword','role'=>'form','id'=>'resetpwd_form'))}}
	<div class="form-group mb-none">
		<div class="input-group">
			<input name="email" type="email" placeholder="E-mail" class="form-control input-lg" />
			<span class="input-group-btn">
				<button class="btn btn-primary btn-lg" type="submit">Reset!</button>
			</span>
		</div>
	</div>

	<p class="text-center mt-lg">Remembered? <a href="{{url('users/signin')}}">Sign In!</a>
{{Form::close()}}

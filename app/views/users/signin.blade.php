{{Form::open(array('url'=>'users/login','role'=>'form','id'=>'signin_form'))}}
	<div class="form-group mb-lg">
		<label>Email</label>
		<div class="input-group input-group-icon">
			<input name="email" type="email" class="form-control input-lg" value="{{Input::old('email')}}"/>
			<span class="input-group-addon">
				<span class="icon icon-lg">
					<i class="fa fa-user"></i>
				</span>
			</span>
		</div>
	</div>

	<div class="form-group mb-lg">
		<div class="clearfix">
			<label class="pull-left" >Password</label>
			<a href="{{url('users/recoverpassword')}}" class="pull-right" tabindex="-1">Lost Password?</a>
		</div>
		<div class="input-group input-group-icon">
			<input name="password" type="password" class="form-control input-lg" />
			<span class="input-group-addon">
				<span class="icon icon-lg">
					<i class="fa fa-lock"></i>
				</span>
			</span>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="checkbox-custom checkbox-default">
				<input id="RememberMe" name="remember_me" type="checkbox"/>
				<label for="RememberMe">Remember Me</label>
			</div>
		</div>
		<div class="col-sm-4 text-right">
			<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
			<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
		</div>
	</div>


	<p class="text-center">Don't have an account yet? <a href="{{url('users/signup')}}">Sign Up!</a>

{{Form::close()}}

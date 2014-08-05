{{Form::open(array('url'=>'users/signin','role'=>'form','id'=>'login_form'))}}
	<div class="form-group has-feedback lg no-label">
	  <input type="text" class="form-control no-border input-lg rounded" name="username" placeholder="Enter username" autofocus>
	</div>
	<div class="form-group has-feedback lg no-label">
	  <input type="password" class="form-control no-border input-lg rounded" name="password" placeholder="Enter password">
	</div>
	<div class="form-group">
	  <div class="checkbox">
		<label>
		  <input type="checkbox" name="remember_me" class="i-yellow-flat"> Remember me
		</label>
	  </div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">LOGIN</button>
	</div>
{{Form::close()}}
<p class="text-center"><strong><a href={{URL::to('users/forgot-password')}}>Forgot your password?</a></strong></p>
<p class="text-center">or</p>
<p class="text-center"><strong><a href={{URL::to('users/register')}}>Create new account</a></strong></p>

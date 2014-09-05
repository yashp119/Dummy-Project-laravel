<!-- php validation rules in 'app/models/users.php' -->
{{Form::open(array('url'=>'users/create','id'=>'signup_form'))}}
	<ul>
		@foreach($errors->all() as $error)
			 <font color="red"><li>{{$error}}</li></font> 
		@endforeach
	</ul>

	<div class="form-group mb-lg">
		<label>Registration Code</label>
		<input name="registration_code" type="text" class="form-control input-lg" />
	</div>

	<div class="form-group mb-none">
		<div class="row">
			<div class="col-sm-6 mb-lg">
				<label>First Name</label>
				<input name="firstname" type="text" class="form-control input-lg" />
			</div>
			<div class="col-sm-6 mb-lg">
				<label>Last Name</label>
				<input name="lastname" type="text" class="form-control input-lg" />
			</div>
		</div>
	</div>
<!--
	<div class="form-group mb-lg">
		<label>First Name</label>
		<input name="firstname" type="text" class="form-control input-lg" />
	</div>

	<div class="form-group mb-lg">
		<label>Last Name</label>
		<input name="lastname" type="text" class="form-control input-lg" />
	</div>
-->
	<div class="form-group mb-lg">
		<label>Email Address</label>
		<input name="email" type="email" class="form-control input-lg" />
	</div>
<!--
	<div class="form-group mb-none">
		<div class="row">
			<div class="col-sm-6 mb-lg">
				<label>Password</label>
				<input name="password" type="password" class="form-control input-lg" />
			</div>
			<div class="col-sm-6 mb-lg">
				<label>Password Confirmation</label>
				<input name="password_confirmation" type="password" class="form-control input-lg" />
			</div>
		</div>
	</div>
-->
	<div class="form-group mb-lg">
		<label>Password</label>
		<input name="password" type="password" class="form-control input-lg" />
	</div>

	<div class="form-group mb-lg">
		<label>Password Confirmation</label>
		<input name="password_confirmation" type="password" class="form-control input-lg" />
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="checkbox-custom checkbox-default">
				<input id="AgreeTerms" name="accept_term" type="checkbox"/>
				<label for="AgreeTerms">I agree with <a href="#text-popup">terms of use</a></label>
			</div>
		</div>
		<div class="col-sm-4 text-right">
			<button type="submit" class="btn btn-primary hidden-xs">Sign Up</button>
			<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
		</div>
	</div>

	<span class="mt-lg mb-lg line-thru text-center text-uppercase">
		<span>or</span>
	</span>

	<div class="mb-xs text-center">
		<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
		<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
	</div>

	<p class="text-center">Already have an account yet? <a href="{{url('users/signin')}}">Sign In!</a>

{{Form::close()}}


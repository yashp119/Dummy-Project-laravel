<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">  
                @if(!Auth::check())
                    <li>{{ HTML::link('users/signup', 'Signup') }}</li>   
                    <li>{{ HTML::link('users/signin', 'Signin') }}</li>   
                @else
                    <li>{{ HTML::link('users/logout', 'logout') }}</li>
                @endif
            </ul>  
        </div>
    </div>
</div>

<h1>Dashboard</h1>
 
<p>Welcome to your Dashboard. You rock!</p>


<h3>Change Password</h3>
{{Form::open(array('url'=>'users/changepassword','role'=>'form','id'=>'changepassword_form'))}}
    <ul>
        @foreach($errors->all() as $error)
            <font color="red"><li>{{$error}}</li></font> 
        @endforeach
    </ul>
    <div class="form-group mb-lg">
        <label for="password">Current Password</label>
        <div class="input-group input-group-icon">
            <input name="password" type="password" class="form-control input-lg" />
            <span class="input-group-addon">
                <span class="icon icon-lg">
                    <i class="fa fa-lock"></i>
                </span>
            </span>
        </div>
        <div class="clearfix">
            <a href="{{url('users/recoverpassword')}}" class="pull-right" tabindex="-1">Lost Password?</a>
        </div>
    </div>

    <div class="form-group mb-lg">
        <label for="newpassword">New Password</label>
        <div class="input-group input-group-icon">
            <input name="newpassword" type="password" class="form-control input-lg" />
            <span class="input-group-addon">
                <span class="icon icon-lg">
                    <i class="fa fa-lock"></i>
                </span>
            </span>
        </div>
    </div>

    <div class="form-group mb-lg">
        <label for="newpassword">Verify Password</label>
        <div class="input-group input-group-icon">
            <input name="newpassword_confirmation" type="password" class="form-control input-lg" />
            <span class="input-group-addon">
                <span class="icon icon-lg">
                    <i class="fa fa-lock"></i>
                </span>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 text-right">
            <button type="submit" class="btn btn-primary hidden-xs">Submit</button>
            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Submit</button>
        </div>
    </div>
{{Form::close()}}


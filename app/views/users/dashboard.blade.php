<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">  
                @if(!Auth::check())
                    <li>{{ HTML::link('users/register', 'Register') }}</li>   
                    <li>{{ HTML::link('users/login', 'Login') }}</li>   
                @else
                    <li>{{ HTML::link('users/logout', 'logout') }}</li>
                @endif
            </ul>  
        </div>
    </div>
</div>

<h1>Dashboard</h1>
 
<p>Welcome to your Dashboard. You rock!</p>
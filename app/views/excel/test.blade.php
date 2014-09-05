{{Form::open(array('url'=>'excel/test','files'=>true, 'role'=>'form','id'=>'signin_form'))}}
{{Form::file('excel')}}
{{Form::submit('upload')}}
<br>
{{$table or ''}}
{{Form::close()}}

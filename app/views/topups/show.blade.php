 {{ Form::open(array('url' =>"renew", 'method' => 'post','id' =>'test')) }}
    
    @foreach($plans as $plan)
    
       {{ Form::radio('plancode', $plan->plan_code) }} {{ $plan->plan_code }}
       
       
    @endforeach
    {{ Form::submit('Submit')}}
{{ Form::close() }}
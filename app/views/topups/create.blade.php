 {{ Form::open(array('url' =>"topups", 'method' => 'post','id' =>'test')) }}
     
     <input type="text" name="customer_id" value="" placeholder="Customer Id" />
     <input type="submit" name="submit" value="Submit" />

{{ Form::close() }}
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php 
                
                $base_url = URL::to('/');

			    if(is_object($data_array->CUSTOMERINFO->FIRSTNAME)){
			          
			           $data_array->CUSTOMERINFO->FIRSTNAME="";
			    }

			    if(is_object($data_array->CUSTOMERINFO->MIDDLENAME)){

			    	     $data_array->CUSTOMERINFO->MIDDLENAME="";
			    	
			    }

			    if(is_object($data_array->CUSTOMERINFO->LASTNAME)){
			    	     
			    	     $data_array->CUSTOMERINFO->LASTNAME="";
			    }

			    if(is_object($data_array->CUSTOMERINFO->COMPANYNAME)){
			    	     
			    	     $data_array->CUSTOMERINFO->COMPANYNAME="";
			    }

			    if(is_object($data_array->CUSTOMERINFO->CUSTOMERTYPE)){
			    	     
			    	     $data_array->CUSTOMERINFO->CUSTOMERTYPE="";
			    }

            ?>
			<td>Customer Name</td>
			<td><?php echo $data_array->CUSTOMERINFO->FIRSTNAME." ".$data_array->CUSTOMERINFO->MIDDLENAME." ".$data_array->CUSTOMERINFO->MIDDLENAME; ?></td>
		</tr>
		<tr>
			<td>Customer TYPE</td>
			<td><?php echo $data_array->CUSTOMERINFO->CUSTOMERTYPE; ?></td>
		</tr>
		<tr>
			<td>Company Name</td>
			<td><?php echo $data_array->CUSTOMERINFO->COMPANYNAME; ?></td>
			
		</tr>
		<tr>
			<td>Contract</td>
			<td><?php 
			    ((!is_array($data_array->CUSTOMERINFO->CONTRACTINFO)) ? $data[0] = $data_array->CUSTOMERINFO->CONTRACTINFO : $data = $data_array->CUSTOMERINFO->CONTRACTINFO );
	             
	             ?>
	            @foreach ($data as $row)
                  <?php  
                      
                       $plancode = trim($row->PLANINFO->PLANCODE);
                       $url = $base_url.'/topups/'.$plancode;
                  ?> 
                  
                  {{ HTML::link($url , $plancode )}}
                  
			    @endforeach
			</td>
			
		</tr>
	</tbody>
    </table>    
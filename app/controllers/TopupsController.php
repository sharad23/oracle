<?php

class TopupsController extends \BaseController {

	/**
	 * Display a listing of topups
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = DB::table('PLAN_DTL_VW')->get();
		echo '<pre>';
		print_r($users);
		echo '</pre>';
	}

	/**
	 * Show the form for creating a new topup
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('topups.create');
	}

	/**
	 * Store a newly created topup in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		  
		   $soapClient = new SoapClient( "http://116.90.227.165/wsnlivebkp/Service/Service.asmx?WSDL");
  
           // Prepare SoapHeader parameters
           $sh_param = array(
                    'User_id'    =>    'MQSUPPORT',
                    'Password'    =>    'MQSUPPORT',
                    'ExternalPartyName' => 'MQS'
                    );
           $headers = new SoapHeader('http://tempuri.org/', 'MQUserNameToken', $sh_param, false);

          // Prepare Soap Client
           $soapClient->__setSoapHeaders(array($headers));
  
           //request XML
           $requestXML = '<REQUESTINFO>
                               <KEY_NAMEVALUE>
                                    <KEY_NAME>CUSTOMERNO</KEY_NAME>
                                    <KEY_VALUE>'.$_POST["customer_id"].'</KEY_VALUE>
                               </KEY_NAMEVALUE>
                          </REQUESTINFO>';
           
           $referenceNo = time(); //reference number should be unique
                
           $result = $soapClient->GetCustomerInfo(array('CustomerInfoXML'=> $requestXML,'ReferenceNo' => $referenceNo));
           $xml_data = $result->GetCustomerInfoResult;
           $xml = simplexml_load_string($xml_data);
           $json = json_encode($xml);
           $data_array = json_decode($json);
          // echo '<pre>';
          // print_r($data_array);
          // echo '<pre>';
          
           if($data_array->STATUS->ERRORNO == 0){ 
		           
		           Session::put('user',$_POST["customer_id"]);
		           return View::make('topups.index',compact('data_array'));
           } 
	}

	
	public function show($id)
	{    
		$user = Session::get('user');
        $plan = DB::table('PLAN_DTL_VW')->where('PLAN_CODE', $id)->get();
		$bundle = DB::table('BUNDLE_DTL_VW')->where('BUNDLE_ID',$plan[0]->bundle_id)->get();
		$plans = DB::table('PLAN_DTL_VW')->where('BUNDLE_ID', $bundle[0]->bundle_id)->get();
		$i=1;
		foreach($plans as $plan){
           
              $soapClient = new SoapClient( "http://116.90.227.165/wsnlivebkp/Service/Service.asmx?WSDL");
              $sh_param = array(
                    'User_id'    =>    'MQSUPPORT',
                    'Password'    =>    'MQSUPPORT',
                    'ExternalPartyName' => 'MQS'
                    );
              $headers = new SoapHeader('http://tempuri.org/', 'MQUserNameToken', $sh_param, false);
              $soapClient->__setSoapHeaders(array($headers));
	          $requestXML = '<REQUESTINFO>
	                            <PLANINFO>
							  		<CUSTOMERNBR></CUSTOMERNBR>
							  		<PLANCODE>'.$plan->plan_code.'</PLANCODE>
							 		<EFFECTIVEDATE></EFFECTIVEDATE>
									<REGIONCODE></REGIONCODE>
							  		<CURRENCYCODE></CURRENCYCODE>
							  		<CUSTOMERTYPECODE></CUSTOMERTYPECODE>
							 		<BILLFREQCODE></BILLFREQCODE>
							 		<PRODUCTINFO>
							    			<PRODUCTCODE></PRODUCTCODE>
							    			<PRODUCTTYPE></PRODUCTTYPE>
							   			    <CHOICENBR></CHOICENBR>
							   			    <CHARGEINFO>
							     				 <CHARGECOMPONENT></CHARGECOMPONENT>
							   			    </CHARGEINFO>
							  		</PRODUCTINFO>
								</PLANINFO>
							</REQUESTINFO>';
              $referenceNo = time().$i; //reference number should be unique
	          $result = $soapClient->GetPlanPrice(array('GetPlanPriceXML'=> $requestXML,'ReferenceNo' => $referenceNo));
	          $xml_data = $result->GetPlanPriceResult;
	          $xml = simplexml_load_string($xml_data);
	          $json = json_encode($xml);
	          $data_array = json_decode($json);
	          //echo '<pre>';
	          //print_r($data_array);
	          //echo '</pre>';
	          $i++;

		}
        //echo '<pre>';
        //print_r($plans);
        //echo '</pre>';
        return View::make('topups.show',compact('plans'));

        
	}

	public function renew()
	{
	
		    $plancode = $_POST['plancode'];
		    $user = Session::get('user');
            $soapClient = new SoapClient( "http://116.90.227.165/wsnlivebkp/Service/Service.asmx?WSDL");
  
           // Prepare SoapHeader parameters
           $sh_param = array(
                    'User_id'    =>    'MQSUPPORT',
                    'Password'    =>    'MQSUPPORT',
                    'ExternalPartyName' => 'MQS'
                    );
           $headers = new SoapHeader('http://tempuri.org/', 'MQUserNameToken', $sh_param, false);

          // Prepare Soap Client
           $soapClient->__setSoapHeaders(array($headers));
  
           //request XML
              $requestXML = '<REQUESTINFO>
								<KEY_NAMEVALUE>
									<KEY_NAME>CUSTOMERNO</KEY_NAME>
									<KEY_VALUE>'.$user.'</KEY_VALUE>
								<KEY_NAMEVALUE>  
								<TOPUPINFO>   
								    <PLANCODE>'.$plancode.'</PLANCODE>
								</TOPUPINFO>                  
						    </REQUESTINFO>';
           
	           $referenceNo = time(); //reference number should be unique
	           $result = $soapClient->TopUp(array('TopupXML'=> $requestXML,'ReferenceNo' => $referenceNo));
	           $xml_data = $result->TopUpResult;
	           $xml = simplexml_load_string($xml_data);
	           $json = json_encode($xml);
	           $data_array = json_decode($json);
	           echo '<pre>';
	           print_r($data_array);
	           echo '</pre>';
	        
	}

}

<?php

# lpphp.php
# A php CLASS to communicate with
# LinkPoint: LINKPOINT LSGS API
# via the CURL module
# v2.0.007 20 jan 2003


class lpphp
{
	var $crlf;
	var $lpapi;
    
    function lpphp()
    {
        ### SET THE FOLLOWING FOUR FIELDS ###

        $this->EZ_CONVERSION = 1;       # 1 = HARDWIRE PORT TO 1129  default=1
        $this->DEBUGGING     = 0;       # diagnostic output          default=0=none
                                        #                                    1=ON
										
        #if php version > 4.0.2 use built-in php curl functions  (1=YES, 0=NO)
        $this->PHP_CURLFUNCS = 1;                                  # default=1=yes
                                                                   #         0=no
        
		#otherwise shell out to the curl binary
        #uncomment this next field ONLY if NOT using PHP_CURLFUNCS above (=0)
        #$this->curlpath = "/usr/bin/curl";                         # default=commented
		#$this->curlpath = "c:\\curl7.9\\curl.exe";
    }

	### YOU SHOULD NOT EDIT THIS FILE BELOW THIS POINT ###

    //translate function for the "EASYFUNCS"
    function forward_trans($myfwdarray)
    {
        $ftranslate["gateway"]="invalid_a";
        $ftranslate["hostname"]="host";
        $ftranslate["port"]="port";
        $ftranslate["storename"]="configfile";
        $ftranslate["orderID"]="oid";
        $ftranslate["amount"]="chargetotal";
        $ftranslate["cardNumber"]="cardnumber";
        $ftranslate["cardExpMonth"]="expmonth";
        $ftranslate["cardExpYear"]="expyear";
        $ftranslate["name"]="bname";
        $ftranslate["address"]="baddr1";
        $ftranslate["city"]="bcity";
        $ftranslate["state"]="bstate";
        $ftranslate["zip"]="bzip";
        $ftranslate["country"]="bcountry";
        $ftranslate["trackingID"]="refrencenumber";
        $ftranslate["backOrdered"]="invalid_b";
        $ftranslate["keyfile"]="keyfile";

        reset($myfwdarray);

        while(list($key, $value) = each ($myfwdarray))
        {
            $checkthis=$ftranslate[$key];
            if(ereg("[A-Za-z0-9]+",$checkthis ))
            {
                unset($myfwdarray[$key]);
                $myrevarray[$checkthis]=$value;
            }
            else
            {
                $myrevarray["$key"]="$value";
            }
        }


        //make keyfile if none supplied
        $mykeyfile=$myrevarray["keyfile"];
        if(strlen($mykeyfile) < 1)
        {
            $mykeyfile=$myrevarray["configfile"];
            $mykeyfile.=".pem";
            $myrevarray["keyfile"]="$mykeyfile";
        }

        //make addr from baddr1 unless addr supplied
        $myavsaddr=$myrevarray["addr"];
        if(strlen($myavsaddr) < 1)
        {
            $myrevarray["addr"]=$myrevarray["baddr1"];
        }

        //fix up expyear
        $okexpyear=$myrevarray["expyear"];
        
        if($okexpyear > 1900)
            $okexpyear -=1900;
        
        if($okexpyear > 100)
            $okexpyear -=100;
        
        if(strlen($okexpyear) == 1)
            $okexpyear="0$okexpyear";

        $myrevarray["expyear"]=$okexpyear;

        //fix up expmonth
        $okexpmonth=$myrevarray["expmonth"];
        
        if(strlen($okexpmonth) == 1)
            $okexpymonth="0$okexpmonth";

        $myrevarray["expmonth"]=$okexpmonth;

        return $myrevarray;
    }


###########
# PROCESS #
###########    

    function process($pdata,$mycf)
    {
        $crlf=$this->crlf;
             
         // convert incoming hash to XML string
        $xml = $this->buildXML($pdata);

        if ($this->DEBUGGING == 1)
            echo "\noutgoing XML: \n" . $xml ;

        // prepare the host/port string
        if ($this->EZ_CONVERSION == 1)
            $port = "1129";         #hard-wire to 1129
        else
            $port = $pdata["port"];

        $host = "https://".$pdata["host"].":".$port."/LSGSXML";

        // then setup key
        $key = $pdata["keyfile"];


        // if php version > 4.0.2 use built-in php curl functions.
        // otherwise shell out to curl

        if ($this->PHP_CURLFUNCS != 1) #call curl directly without built in PHP curl functions
        {
            if ($this->DEBUGGING == 1)
                echo "<BR>NOT using PHP curl methods<BR><BR>";

			$cpath = $this->curlpath;
			
            // Win32 command yikes!
		#	$result = exec ("$cpath -E \"$key\" -m 90 -d \"$xml\" $host", $retarr, $retnum);

            // *NIX command
            $result = exec ("'$cpath' -v -E '$key' -m 90 -d '$xml' '$host'", $retarr, $retnum);
        }


        else    # use PHP curl methods
        {  
 #           if ($this->DEBUGGING == 1)
 #               echo "<BR> Using PHP curl methods <BR>";

            // then encrypt and send the xml string
            $ch = curl_init ();
            curl_setopt ($ch, CURLOPT_URL,$host);
            curl_setopt ($ch, CURLOPT_POST, 1); 
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt ($ch, CURLOPT_SSLCERT, $key);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec ($ch);
		}

        if ($this->DEBUGGING == 1)
		{
			echo "\n\nserver response: " . $result . "\n\n";
		}
		
		// then process the server response
        
        if (strlen($result) < 2)    # no response
        {
            $retarr["r_approved"]="ERROR";
            $retarr["r_error"]="Could not execute curl";
            return $retarr;
        }

		// put XML string into hash
        preg_match_all ("/<(.*?)>(.*?)\</", $result, $out, PREG_SET_ORDER);

        $n = 0;
        while (isset($out[$n]))
        {   
            $retarr[$out[$n][1]] = strip_tags($out[$n][0]);
            $n++; 
        }
                
        if ($this->DEBUGGING == 1)
        {	reset ($retarr);
            echo "At end of process(), returned hash:\n";
            while (list($key, $value) = each($retarr))
                echo "$key = $value\n"; 
			echo "\n\n";
        }

        reset ($retarr);
        return $retarr;
    }


###############################
# CAPTURE_PAYMENT (pre-auth)  #
###############################

    function CapturePayment($mydata)
    {
        $mydata["chargetype"]="PREAUTH";

        $mynewdata=$this->forward_trans($mydata);
        $myretv=$this->process($mynewdata,"ALLSTDIN");
        
        if(ereg("APPROVED", $myretv["r_approved"]))
        {
            $myrethash["statusCode"]=1;
            $myrethash["statusMessage"]=$myretv["r_error"];
            $myrethash["AVSCode"]=$myretv["r_code"];
            $myrethash["trackingID"]=$myretv["r_ref"];
            $myrethash["orderID"]=$myretv["r_ordernum"];
        }
        else
        {
            $myrethash["statusCode"]=0;
            $myrethash["statusMessage"]=$myretv["r_error"];
        }
        return $myrethash;
    }


#################
# RETURN_ORDER  #
#################

    function ReturnOrder($mydata)
    {
        $mydata["chargetype"]="CREDIT";
        
        $mynewdata=$this->forward_trans($mydata);
        $myretv=$this->process($mynewdata,"ALLSTDIN");
        
        if(ereg("APPROVED", $myretv["r_approved"]))
        {
            $myrethash["statusCode"]=1;
        }
        else
        {
            $myrethash["statusCode"]=0;
            $myrethash["statusMessage"]=$myretv["r_error"];
        }
        return $myrethash;
    }


################
# RETURN_CARD  #
################

    function ReturnCard($mydata)
    {
        $mydata["chargetype"]="CREDIT";
        
        $mynewdata=$this->forward_trans($mydata);
        $myretv=$this->process($mynewdata,"ALLSTDIN");
        
        if(ereg("APPROVED", $myretv["r_approved"]))
        {
            $myrethash["statusCode"]=1;
            $myrethash["statusMessage"]=$myretv["r_error"];
            $myrethash["trackingID"]=$myretv["r_ref"];
        }
        else
        {
            $myrethash["statusCode"]=0;
            $myrethash["statusMessage"]=$myretv["r_error"];
        }
        return $myrethash;
    }


###############
# BILL_ORDERS #
###############

    function BillOrders ($myarg)
    {
        $ret=0;
        $idx=0;
        $count=count($myarg["orders"]);

        while ($idx < $count)
        {
            $myarg["orders"][$idx]["invalid_a"] = $myarg["invalid_a"];
            $myarg["orders"][$idx]["host"] = $myarg["host"];
            $myarg["orders"][$idx]["port"] = $myarg["port"];
            $myarg["orders"][$idx]["configfile"] = $myarg["configfile"];
            $myarg["orders"][$idx]["keyfile"] = $myarg["keyfile"];
            $myarg["orders"][$idx]["Ip"] = $myarg["Ip"];
            $myarg["orders"][$idx]["result"] = $myarg["result"];

            $this->BillOrder(&$myarg["orders"][$idx]);

            if($myarg["orders"][$idx]["statusCode"] == 1)
            {
            $ret++;
            }
            $idx++;
        }

        return $ret;
    }


#########################
# BILL_ORDER (postauth) #
#########################

    function BillOrder($mydata)
    {
    //process the orders
        $mydata["chargetype"]="POSTAUTH";
		
		// no forwared trans ??!//
		
        $myretv=$this->process($mydata,"ALLSTDIN");

        // show the results
        if(ereg("APPROVED", $myretv["r_approved"]))
        {
            $mydata["statusCode"]=1;
        }
        else
        {
            $mydata["statusCode"]=0;
            $mydata["statusMessage"]=$myretv["r_error"];
            print "Declined!<br>\n";
        }
    }


############################
# AUTHORIZE A SALE  (sale) #
############################

    function ApproveSale($mydata)
    {
        $mydata["chargetype"]="SALE"; 
        $mynewdata=$this->forward_trans($mydata);

        $myretv=$this->process($mynewdata,"ALLSTDIN");

        if(ereg("APPROVED", $myretv["r_approved"]))
        {
              $myrethash["statusCode"]=1;
              $myrethash["statusMessage"]=$myretv["r_error"];
              $myrethash["AVSCode"]=$myretv["r_code"];
              $myrethash["trackingID"]=$myretv["r_ref"];
              $myrethash["orderID"]=$myretv["r_ordernum"];
        }
        else
        {
            $myrethash["statusCode"]=0;
            $myrethash["statusMessage"]=$myretv["r_error"];
        }
        return $myrethash;
    }

######################
# CALCULATE SHIPPING #
######################

  function CalculateShipping($mydata)
    {
    $mydata["chargetype"]="CALCSHIPPING";

    $mynewdata=$this->forward_trans($mydata);
    $myretv=$this->process($mynewdata,"ALLSTDIN");


	if (isset ($myretv["r_shipping"]))
	{
		$myrethash["statusCode"]=1;
		$myrethash["statusMessage"]=$myretv["r_error"];
        $myrethash["shipping"]=$myretv["r_shipping"];
	}
	else
	{
		$myrethash["statusCode"]=0;
		$myrethash["statusMessage"]=$myretv["r_error"];
	}

	return $myrethash;
    }


#################
# CALCULATE TAX #
#################

  function CalculateTax($mydata)
    {
    $mydata["chargetype"]="CALCTAX";

    $mynewdata=$this->forward_trans($mydata);
    $myretv=$this->process($mynewdata,"ALLSTDIN");

    
	if (isset ($myretv["r_tax"]))
	{
		$myrethash["statusCode"]=1;
		$myrethash["statusMessage"]=$myretv["r_error"];
        $myrethash["tax"]=$myretv["r_tax"];
	}
	else
	{
		$myrethash["statusCode"]=0;
		$myrethash["statusMessage"]=$myretv["r_error"];
	}
	
	return $myrethash;
    }


###########################
# VOID A SALE  (Voidsale) #
###########################
    
	function VoidSale($mydata)    {
    $mydata["chargetype"]="VOID";
    $mynewdata=$this->forward_trans($mydata);
	$myretv=$this->process($mynewdata,"ALLSTDIN");
    
	if(ereg("APPROVED", $myretv["r_approved"]))
    {   $myrethash["statusCode"]=1;
        $myrethash["statusMessage"]=$myretv["r_error"];
		$myrethash["AVSCode"]=$myretv["r_code"];
        $myrethash["trackingID"]=$myretv["r_ref"];
        $myrethash["orderID"]=$myretv["r_ordernum"];
    }
    else
    {
        $myrethash["statusCode"]=0;
        $myrethash["statusMessage"]=$myretv["r_error"];
    }
	return $myrethash;
    
	}

    ############################
    # Create a periodic bill   #
    ############################

	function SetPeriodic ($mydata)
	{
    	$mydata["chargetype"]="SALE";

		$mynewdata=$this->forward_trans($mydata);
		$myretv=$this->process($mynewdata,"ALLSTDIN");
		
		if(ereg("APPROVED", $myretv["r_approved"]))
		{
			$myrethash["statusCode"]=1;
			$myrethash["statusMessage"]=$myretv["r_error"];
			$myrethash["AVSCode"]=$myretv["r_code"];
			$myrethash["trackingID"]=$myretv["r_ref"];
			$myrethash["orderID"]=$myretv["r_ordernum"];
		}
		else
		{
			$myrethash["statusCode"]=0;
			$myrethash["statusMessage"]=$myretv["r_error"];
		}
		return $myrethash;
	
	}

##################################
# Electronic check authorization #
##################################

	function VirtualCheck ($mydata)
    {
		# this now does TELECHECK only
		
		$mydata["chargetype"]="sale";

		$mynewdata=$this->forward_trans($mydata);
		$myretv=$this->process($mynewdata,"ALLSTDIN");

		if(ereg("APPROVED", $myretv["r_approved"]))
		{
			$myrethash["statusCode"]=1;
			$myrethash["statusMessage"]=$myretv["r_error"];
			$myrethash["trackingID"]=$myretv["r_ref"];
			$myrethash["orderID"]=$myretv["r_ordernum"];
		}
		else
		{
			$myrethash["statusCode"]=0;
			$myrethash["statusMessage"]=$myretv["r_error"];
		}
		return $myrethash;
		
	}


	function VoidCheck ($mydata)
    {

		$mydata["chargetype"]="VOID";

		##put in new field 12/27
		$mydata["voidcheck"]="1";

		$mynewdata=$this->forward_trans($mydata);
		$myretv=$this->process($mynewdata,"ALLSTDIN");

		if(ereg("APPROVED", $myretv["r_approved"]))// WE'LL SEE SOMETHING ELSE HERE
		{
			$myrethash["statusCode"]=1;
			$myrethash["statusMessage"]=$myretv["r_error"];
			$myrethash["trackingID"]=$myretv["r_ref"];
			$myrethash["orderID"]=$myretv["r_ordernum"];
		}
		else
		{
			$myrethash["statusCode"]=0;
			$myrethash["statusMessage"]=$myretv["r_error"];
		}
		return $myrethash;
		
	}

###############################
#      b u i l d X M L        #
###############################

	function buildXML($pdata)
	{
        if ($this->DEBUGGING == 1)
		{
			echo "\nat buildXML, incoming hash:\n";
			while (list($key, $value) = each($pdata))
				echo "$key = $value \n";
		}

		$xml = "<order><orderoptions>";
	
		if (isset($pdata["chargetype"]))
			$xml .= "<ordertype>" . $pdata["chargetype"] . "</ordertype>";
	
		if (isset($pdata["result"]))
			$xml .= "<result>" . $pdata["result"] . "</result>";
	
		$xml .= "</orderoptions>";
	
		#__________________________________________
	
		$xml .= "<creditcard>";
	
		if (isset($pdata["cardnumber"]))
			$xml .= "<cardnumber>" . $pdata["cardnumber"] . "</cardnumber>";
	
		if (isset($pdata["expmonth"]))
			$xml .= "<cardexpmonth>" . $pdata["expmonth"] . "</cardexpmonth>";
	
		if (isset($pdata["expyear"]))
			$xml .= "<cardexpyear>" . $pdata["expyear"] . "</cardexpyear>";
	
		if (isset($pdata["cvmvalue"]))
			$xml .= "<cvmvalue>" . $pdata["cvmvalue"] . "</cvmvalue>";

		if (isset($pdata["cvmindicator"]))
		{
			if (strtolower($pdata["cvmindicator"]) == "cvm_notprovided")
				$xml .= "<cvmindicator>not_provided</cvmindicator>";
				
			elseif (strtolower($pdata["cvmindicator"]) == "cvm_not_present")
				$xml .= "<cvmindicator>not_present</cvmindicator>";	
            
			elseif (strtolower($pdata["cvmindicator"]) == "cvm_provided")
				$xml .= "<cvmindicator>provided</cvmindicator>";
			
			elseif (strtolower($pdata["cvmindicator"]) == "cvm_illegible")
				$xml .= "<cvmindicator>illegible</cvmindicator>";
			
			elseif (strtolower($pdata["cvmindicator"]) == "cvm_no_imprint")
				$xml .= "<cvmindicator>no_imprint</cvmindicator>";
		}
	
		if (isset($pdata["track"]))
			$xml .= "<track>" . $pdata["track"] . "</track>";
	
		$xml .= "</creditcard>";    
		
		#__________________________________________
		   
		$xml .= "<merchantinfo>";
			
		if (isset($pdata["configfile"]))
			$xml .= "<configfile>" . $pdata["configfile"] . "</configfile>";
	
		if (isset($pdata["keyfile"]))
			$xml .= "<keyfile>" . $pdata["keyfile"] . "</keyfile>";
	
		if (isset($pdata["host"]))
			$xml .= "<host>" . $pdata["host"] . "</host>";
	
		if (isset($pdata["port"]))
			$xml .= "<port>" . $pdata["port"] . "</port>";
		
		$xml .= "</merchantinfo>";
		
		#__________________________________________
		
		$xml .= "<payment>";
			
		if (isset($pdata["chargetotal"]))
			$xml .= "<chargetotal>" . $pdata["chargetotal"] . "</chargetotal>";
		
		if (isset($pdata["tax"]))
			$xml .= "<tax>" . $pdata["tax"] . "</tax>";
		
		// if it's a tax calculation, put the taxtotal field into payment subtotal
		if (isset($pdata["taxtotal"]))
		{
			if ($pdata["chargetype"] == "CALCTAX")
				$xml .= "<subtotal>" . $pdata["taxtotal"] . "</subtotal>";
			else
				if (isset($pdata["subtotal"]))
					$xml .= "<subtotal>" . $pdata["subtotal"] . "</subtotal>";
		}
		else
			if (isset($pdata["subtotal"]))
					$xml .= "<subtotal>" . $pdata["subtotal"] . "</subtotal>";


		if (isset($pdata["vattax"]))
			$xml .= "<vattax>" . $pdata["vattax"] . "</vattax>";
	
		if (isset($pdata["shipping"]))
			$xml .= "<shipping>" . $pdata["shipping"] . "</shipping>";
	
		$xml .= "</payment>";
		
		#__________________________________________
	
		$xml .= "<billing>";
		
		if (isset($pdata["name"]))
			$xml .= "<name>" . $pdata["name"] . "</name>";
		elseif (isset($pdata["bname"]))
			$xml .= "<name>" . $pdata["bname"] . "</name>";
	
	
		if (isset($pdata["bcompany"]))
			$xml .= "<company>" . $pdata["bcompany"] . "</company>";
	
	
		if (isset($pdata["address"]))
			$xml .= "<address1>" . $pdata["address"] . "</address1>";
	
		elseif (isset($pdata["baddr1"]))
			$xml .= "<address1>" . $pdata["baddr1"] . "</address1>";

		elseif (isset($pdata["address1"]))
			$xml .= "<address1>" . $pdata["address1"] . "</address1>";
		
		
		if (isset($pdata["address2"]))
			$xml .= "<address2>" . $pdata["address2"] . "</address2>";
			
		elseif (isset($pdata["baddr2"]))
			$xml .= "<address2>" . $pdata["baddr2"] . "</address2>";
		
		
		if (isset($pdata["city"]))
			$xml .= "<city>" . $pdata["city"] . "</city>";
			
		elseif (isset($pdata["bcity"]))
			$xml .= "<city>" . $pdata["bcity"] . "</city>";
	

		if (isset($pdata["state"]))
			$xml .= "<state>" . $pdata["state"] . "</state>";
		elseif (isset($pdata["bstate"]))
			$xml .= "<state>" . $pdata["bstate"] . "</state>";

			
		if (isset($pdata["zip"]))
			$xml .= "<zip>" . $pdata["zip"] . "</zip>";
	
		else if (isset($pdata["bzip"]))
			$xml .= "<zip>" . $pdata["bzip"] . "</zip>";


		if (isset($pdata["country"]))
			$xml .= "<country>" . $pdata["country"] . "</country>";
	
		else if (isset($pdata["bcountry"]))
			$xml .= "<country>" . $pdata["bcountry"] . "</country>";
	  
	  
		if (isset($pdata["phone"]))
			$xml .= "<phone>" . $pdata["phone"] . "</phone>";
	
		if (isset($pdata["fax"]))
			$xml .= "<fax>" . $pdata["fax"] . "</fax>";
	
		if (isset($pdata["userid"]))
			$xml .= "<userid>" . $pdata["userid"] . "</userid>";
			
		if (isset($pdata["email"]))
			$xml .= "<email>" . $pdata["email"] . "</email>";
	
		if (isset($pdata["addrnum"]))
			$xml .= "<addrnum>" . $pdata["addrnum"] . "</addrnum>";
	
		$xml .= "</billing>";
	
		#__________________________________________

		$xml .= "<shipping>";
	
		if (isset($pdata["sname"]))
			$xml .= "<name>" . $pdata["sname"] . "</name>";
	
		if (isset($pdata["saddr1"]))
			$xml .= "<address1>" . $pdata["saddr1"] . "</address1>";
	
		if (isset($pdata["saddr2"]))
			$xml .= "<address2>" . $pdata["saddr2"] . "</address2>";
	
		if (isset($pdata["scity"]))
			$xml .= "<city>" . $pdata["scity"] . "</city>";
		
		if (isset($pdata["scountry"]))
			$xml .= "<country>" . $pdata["scountry"] . "</country>";
	
		if (isset($pdata["shiptotal"]))
			$xml .= "<total>" . $pdata["shiptotal"] . "</total>";
		
		if (isset($pdata["shipweight"]))
			$xml .= "<weight>" . $pdata["shipweight"] . "</weight>";
	
		if (isset($pdata["shipcountry"]))
			$xml .= "<country>" . $pdata["shipcountry"] . "</country>";
		
		if (isset($pdata["shipcarrier"]))
			$xml .= "<carrier>" . $pdata["shipcarrier"] . "</carrier>";
		
		if (isset($pdata["shipitems"]))
			$xml .= "<items>" . $pdata["shipitems"] . "</items>";
		

		if (isset($pdata["taxstate"]))
			$xml .= "<state>" . $pdata["taxstate"] . "</state>";
		elseif (isset($pdata["shipstate"]))
			$xml .= "<state>" . $pdata["shipstate"] . "</state>";
		elseif (isset($pdata["sstate"]))
			$xml .= "<state>" . $pdata["sstate"] . "</state>";
		
		if (isset($pdata["taxzip"]))
			$xml .= "<zip>" . $pdata["taxzip"] . "</zip>";
		elseif (isset($pdata["shipzip"]))
			$xml .= "<zip>" . $pdata["shipzip"] . "</zip>";
		elseif (isset($pdata["szip"]))
			$xml .= "<zip>" . $pdata["szip"] . "</zip>";
		elseif (isset($pdata["zip"]))
			$xml .= "<zip>" . $pdata["zip"] . "</zip>";
        
		$xml .= "</shipping>";
	
		#__________________________________________
		# Check
	
		if (isset($pdata["routing"]))
		{
			$xml .= "<telecheck>";
			$xml .= "<routing>" . $pdata["routing"] . "</routing>";
	
			if (isset($pdata["account"]))
				$xml .= "<account>" . $pdata["account"] . "</account>";
	
			if (isset($pdata["bankname"]))
				$xml .= "<bankname>" . $pdata["bankname"] . "</bankname>";
	
			if (isset($pdata["bankstate"]))
				$xml .= "<bankstate>" . $pdata["bankstate"] . "</bankstate>";
	
			if (isset($pdata["checknumber"]))
				$xml .= "<checknumber>" . $pdata["checknumber"] . "</checknumber>";
				
			if (isset($pdata["accounttype"]))
				$xml .= "<accounttype>" . $pdata["accounttype"] . "</accounttype>";
	
			$xml .= "</telecheck>";
		}

		#void check 
		
		if (isset($pdata["voidcheck"]))
		{
			$xml .= "<telecheck><void>1</void></telecheck>";
		}

		#__________________________________________
		# periodic
		
		if (isset($pdata["startdate"]))
		{
			$xml .= "<periodic>";
			
			$xml .= "<startdate>" . $pdata["startdate"] . "</startdate>";
	
			if (isset($pdata["installments"]))
				$xml .= "<installments>" . $pdata["installments"] . "</installments>";
	
			if (isset($pdata["threshold"]))
						$xml .= "<threshold>" . $pdata["threshold"] . "</threshold>";
			
			if (isset($pdata["periodicity"]))
						$xml .= "<periodicity>" . $pdata["periodicity"] . "</periodicity>";
			
			if (isset($pdata["pbcomments"]))
						$xml .= "<comments>" . $pdata["pbcomments"] . "</comments>";
			
			if (isset($pdata["pbordertype"]))
			{
				$xml .= "<action>";
				 
				if ($pdata["pbordertype"] == "PbOrder_Submit") 
					$xml .= "submit";
				
				elseif($pdata["pbordertype"] == "PbOrder_Modify")
					$xml .= "modify";
				
				elseif($pdata["pbordertype"] == "PbOrder_Cancel")
					$xml .= "cancel";
				
				$xml .= "</action>";
			}
	
			$xml .= "</periodic>";
		}
		
		//___________________________________________
	
		$xml .= "<transactiondetails>";
	
		if (isset($pdata["transactionorigin"]))
			$xml .= "<transactionorigin>" . $pdata["transactionorigin"] . "</transactionorigin>";
		
		if (isset($pdata["oid"]))
			$xml .= "<oid>" . $pdata["oid"] . "</oid>";
		
		if (isset($pdata["reference_number"]))
			$xml .= "<reference_number>" . $pdata["reference_number"] . "</reference_number>";
		
		if (isset($pdata["ponumber"]))
			$xml .= "<ponumber>" . $pdata["ponumber"] . "</ponumber>";
        
		
		if (isset($pdata["recurring"]))
		{
			if (strtoupper($pdata["recurring"]) == "RECURRING_TRANSACTION")
				$xml .= "<recurring>yes</recurring>";
			elseif (strtoupper($pdata["recurring"]) == "NON_RECURRING_TRANSACTION")
				$xml .= "<recurring>no</recurring>";
		}
		
		if (isset($pdata["taxexempt"]))
				$xml .= "<taxexempt>" . $pdata["taxexempt"] . "</taxexempt>";
		elseif (isset($pdata["taxexmpt"]))
			$xml .= "<taxexempt>" . $pdata["taxexmpt"] . "</taxexempt>";
			
			
		if (isset($pdata["terminaltype"]))
		{
			if (strtoupper($pdata["terminaltype"]) == "TTYPE_UNSPECIFIED")
				$xml .= "<terminaltype>unspecified</terminaltype>";
			elseif (strtoupper($pdata["terminaltype"]) == "TTYPE_STANDALONE")
				$xml .= "<terminaltype>standalone</terminaltype>";	
			elseif (strtoupper($pdata["terminaltype"]) == "TTYPE_POS")
				$xml .= "<terminaltype>pos</terminaltype>";	
			elseif (strtoupper($pdata["terminaltype"]) == "TTYPE_UNATTENDED")
				$xml .= "<terminaltype>unattended</terminaltype>";
        }
		
		if (isset($pdata["ip"]))
			$xml .= "<ip>" . $pdata["ip"] . "</ip>";
		elseif (isset($pdata["Ip"]))
			$xml .= "<ip>" . $pdata["Ip"] . "</ip>";
        
		if (isset($pdata["tdate"]))
			$xml .= "<tdate>" . $pdata["tdate"] . "</tdate>";
		

		if (isset($pdata["mototransaction"]))
		{
			if ($pdata["mototransaction"] == "MOTO_TRANSACTION")	
				$xml .= "<transactionorigin>moto</transactionorigin>";
			
			elseif ($pdata["mototransaction"] == "RETAIL_TRANSACTION")	
				$xml .= "<transactionorigin>retail</transactionorigin>";
			
			elseif ($pdata["mototransaction"] == "ECI_TRANSACTION")	
				$xml .= "<transactionorigin>eci</transactionorigin>";
		}
		
		if (isset($pdata["tdate"]))
			$xml .= "<tdate>" . $pdata["tdate"] . "</tdate>";
		
		$xml .= "</transactiondetails>";
	
	
		if (isset($pdata["comments"]) || isset($pdata["referred"]))
		{
			$xml .= "<notes>";
		
			if (isset($pdata["comments"]))
				$xml .= "<comments>" . $pdata["comments"] . "</comments>";
	
			if (isset($pdata["referred"]))
				$xml .= "<referred>" . $pdata["referred"] . "</referred>";
	
			$xml .= "</notes>";
		}
	
		$xml .= "</order>";    
	
		return $xml;
	}
}
?>
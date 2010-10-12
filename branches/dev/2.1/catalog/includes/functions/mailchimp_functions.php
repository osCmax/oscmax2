<?php
function mc_add_email($email_address, $email_format) {
    include_once(DIR_WS_CLASSES . "MCAPI.class.php");
    $api = new MCAPI(MAILCHIMP_API);
    $merge_vars = array('');
    if ($email_format == 'TEXT') {
       $format = 'text'; 
    } else {
       $format = 'html'; 
    }

    $list_id = MAILCHIMP_ID; 
    $retval = $api->listSubscribe($list_id, $email_address, $merge_vars, $format, MAILCHIMP_OPT_IN, true);
    if ($api->errorCode){
        echo "Unable to load listSubscribe()!\n"; 
        echo   "\tCode=".$api->errorCode."\n";
        echo   "\tMsg=".$api->errorMessage."\n";
    } else {
        echo "Returned: ".$retval."\n";
	}
}
 
function mc_remove_email($email_address) {
  require_once DIR_WS_CLASSES . 'MCAPI.class.php';
  $api = new MCAPI(MAILCHIMP_API);
  $email = $newsletter['customers_email_address'];
  $retval = $api->listUnsubscribe(MAILCHIMP_ID, $email, MAILCHIMP_DELETE, MAILCHIMP_SEND_GOODBYE, MAILCHIMP_SEND_NOTIFY);
}
?>
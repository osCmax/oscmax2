<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<link rel="stylesheet" type="text/css" href="ext/jQuery/themes/smoothness/ui.all.css">
<script type="text/javascript">    
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' type='text/javascript'>\<\/script>");
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js' type='text/javascript'>\<\/script>");
</script>

<script type="text/javascript">
function switchMAT() { 
	if($("#MAT").attr("checked")) {
		$("#MATtd").attr("class", "messageStackSuccess");
		$('#disableMAT').hide();
    	$('#enableMAT').show();
	} else {
		$("#MATtd").attr("class", "messageStackAlert");
		$('#disableMAT').show();
    	$('#enableMAT').hide();
	}
}

function warnMAT() {
		$("#MATtd").attr("class", "messageStackWarning");
}

</script>


<?php require('includes/javascript/password_strength.js'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#password_st").password_strength();
	$('#enableMAT').hide();
	
	if($("#MAT").attr("checked")) {
		$("#MATtd").attr("class", "messageStackSuccess");
		$('#disableMAT').hide();
    	$('#enableMAT').show();
	}
	
    $('#conditions').each(function() {
		var $link = $(this);
		var $dialog = $('<div><\/div>')
			.load($link.attr('href'))
			.dialog({
				autoOpen: false,
				title: $link.attr('title'),
				width: 700,
				height: 400,
				modal: true,
				buttons: { "Ok": function() { 
				  $(this).dialog("close"); 
				  $("#MAT").attr("checked", true); 
				  $("#MATtd").attr("class", "messageStackSuccess"); 
				  $('#disableMAT').hide();	
				  $('#enableMAT').show();
				} }
			});

		$link.click(function() {
			$dialog.dialog('open');
            
			return false;
		});
	});
});
</script>
<script language="javascript" type="text/javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

// LINE MOD: added 'field_size >0 &&'
    if ((field_size > 0 && field_value == '') || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_radio(field_name, message) {
  var isChecked = false;

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;

    if (password == '' || password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password_current = form.elements[field_name_1].value;
    var password_new = form.elements[field_name_2].value;
    var password_confirmation = form.elements[field_name_3].value;

    if (password_current == '' || password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password_new == '' || password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>\r\n\n";

<?php 
  if (ACCOUNT_GENDER == 'true') {
    if (tep_not_null(ENTRY_GENDER_TEXT)) { ?>
	  check_radio("gender", "<?php echo ENTRY_GENDER_ERROR; ?>");
	<?php
	}
  }

  if (tep_not_null(ENTRY_FIRST_NAME_TEXT)) { ?>
    check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
  <?php
  }
  
  if (tep_not_null(ENTRY_LAST_NAME_TEXT)) { ?>
    check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");
  <?php
  }
  
  if (ACCOUNT_DOB == 'true') {
    if (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT)) { ?>
	  check_input("dob", <?php echo ENTRY_DOB_MIN_LENGTH; ?>, "<?php echo ENTRY_DATE_OF_BIRTH_ERROR; ?>");
	<?php
	}
  }

  if (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT)) { ?>
    check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
  <?php
  }
   
  if (ACCOUNT_COMPANY == 'true') {
    if (tep_not_null(ENTRY_COMPANY_TEXT)) { ?>
	  check_input("company", <?php echo ENTRY_COMPANY_MIN_LENGTH; ?>, "<?php echo ENTRY_COMPANY_ERROR; ?>");
	<?php
	}
	if (tep_not_null(ENTRY_COMPANY_TAX_ID_TEXT)) { ?>
	  check_input("company_tax_id", <?php echo ENTRY_COMPANY_MIN_LENGTH; ?>, "<?php echo ENTRY_COMPANY_TAX_ID_ERROR; ?>");
	<?php
	}	
  }
  
  if (tep_not_null(ENTRY_STREET_ADDRESS_TEXT)) { ?>
    check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  <?php
  }

  if (tep_not_null(ENTRY_POST_CODE_TEXT)) { ?>
    check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  <?php
  }

  if (tep_not_null(ENTRY_CITY_TEXT)) { ?>
    check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");
  <?php
  }
  
  if (ACCOUNT_STATE == 'true') {
    if (tep_not_null(ENTRY_STATE_TEXT)) { ?>
	  check_input("state", <?php echo ENTRY_STATE_MIN_LENGTH; ?>, "<?php echo ENTRY_STATE_ERROR; ?>");
	<?php
	}
  }
  
  if (tep_not_null(ENTRY_COUNTRY_TEXT)) { ?>
    check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");
  <?php
  }

  if (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT)) { ?>
    check_input("telephone", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo ENTRY_TELEPHONE_NUMBER_ERROR; ?>");
  <?php
  }
  
  if (tep_not_null(ENTRY_FAX_NUMBER_TEXT)) { ?>
    check_input("fax", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo ENTRY_FAX_NUMBER_ERROR; ?>");
  <?php
  }
?>

  check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
  check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");
  
<!-- // BOF Customers extra fields -->
 <?php
   $extra_fields_query = tep_db_query("select ce.fields_id, ce.fields_input_type, ce.fields_required_status, cei.fields_name, ce.fields_status, ce.fields_input_type, ce.fields_size from " . TABLE_EXTRA_FIELDS . " ce, " . TABLE_EXTRA_FIELDS_INFO . " cei where NOT find_in_set('" . $customer_group_id . "', ce.fields_cef_cg_hide) and ce.fields_status=1 and ce.fields_required_status=1 and cei.fields_id=ce.fields_id and cei.languages_id =" . $languages_id);
   while ($extra_fields = tep_db_fetch_array($extra_fields_query)) {
   $string_error = sprintf(ENTRY_EXTRA_FIELDS_ERROR, $extra_fields['fields_name'], $extra_fields['fields_size']);?>
    check_input("<?php echo 'fields_' . $extra_fields['fields_id']?>", <?php echo $extra_fields['fields_id']-1;?>, "<?php echo $string_error; ?>");
 <?php }?>
<!-- // EOF Customers extra fields -->


  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}

<?php /* BOF: Country-State Selector */ ?>
function refresh_form(form_name) {
   form_name.action.value = 'refresh';
   form_name.state.value = '';
   form_name.submit();
   return true;
   }
<?php /* EOF: Country-State Selector */ ?>
//--></script>
<script language="javascript" type="text/javascript"><!--
function getObject(name) { 
   var ns4 = (document.layers) ? true : false; 
   var w3c = (document.getElementById) ? true : false; 
   var ie4 = (document.all) ? true : false; 

   if (ns4) return eval('document.' + name); 
   if (w3c) return document.getElementById(name); 
   if (ie4) return eval('document.all.' + name); 
   return false; 
}

//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser does not support this feature.  Please upgrade or use a different browser. Older (pre-v2.8) versions of Order Editor do not have this restriction.");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var request = getXmlHttpRequestObject();
/***************************************************
 GET STATES FUNCTIONS 
 ***************************************************/
function getStates(countryID, div_element) {
	if (request.readyState == 4 || request.readyState == 0) {
		// indicator make visible here..
		getObject("indicator").style.visibility = 'visible';
		var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
		var fields = "action=getStates&country="+countryID;
					
		request.open("POST", 'create_account.php', true);
		//request.onreadystatechange = getStatesRequest;
		request.onreadystatechange = function() {
			getStatesRequest(request, div_element);
		};
		
		request.setRequestHeader("Content-Type", contentType);		
		request.send(fields);
	}
}										
//Called when the AJAX response is returned.
function getStatesRequest(request, div_element) {
	if (request.readyState == 4) {
		var obj_div = getObject(div_element);
		// make hidden
		getObject('indicator').style.visibility = 'hidden';
	  obj_div.innerHTML = request.responseText;
		
		for (i=0; i<obj_div.childNodes.length; i++){
			if (obj_div.childNodes[i].nodeName=="SELECT")
				obj_div.childNodes[i].focus();
		}
	}
}
//--></script>
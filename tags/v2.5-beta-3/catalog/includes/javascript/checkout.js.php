<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

<link rel="stylesheet" type="text/css" href="ext/jQuery/themes/smoothness/ui.all.css">
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.js"></script>
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.ajaxq.js"></script>
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.pstrength.js"></script>
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.ui.js"></script>
<script type="text/javascript" language="javascript" src="includes/checkout/checkout.js"></script>
<style>
.pstrength-minchar {
	font-size : 10px;
}
</style>
<script language="javascript"><!--
function CVVPopUpWindow(url) {
	window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=600,height=233,screenX=150,screenY=150,top=150,left=150')
}

function CVVPopUpWindowEx(url) {
	window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=600,height=510,screenX=150,screenY=150,top=150,left=150')
}

  var onePage = checkout;
  onePage.initializing = true;
  onePage.ajaxCharset = '<?php echo CHARSET;?>';
  onePage.storeName = '<?php echo STORE_NAME; ?>';
  onePage.loggedIn = <?php echo (tep_session_is_registered('customer_id') ? 'true' : 'false');?>;
  onePage.autoshow = <?php echo ((ONEPAGE_AUTO_SHOW_BILLING_SHIPPING == 'False') ? 'false' : 'true');?>;
  onePage.stateEnabled = <?php echo (ACCOUNT_STATE == 'true' ? 'true' : 'false');?>;
  onePage.telephoneEnabled = <?php echo (ONEPAGE_TELEPHONE == 'True' ? 'true' : 'false');?>;
  onePage.showAddressInFields = <?php echo ((ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False') ? 'false' : 'true');?>;
  onePage.showMessagesPopUp = <?php echo ((ONEPAGE_CHECKOUT_LOADER_POPUP == 'True') ? 'true' : 'false');?>;
  onePage.ccgvInstalled = <?php echo (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true' ? 'true' : 'false');?>;
  //BOF KGT
  onePage.kgtInstalled = <?php echo (MODULE_ORDER_TOTAL_DISCOUNT_COUPON_STATUS == 'true' ? 'true' : 'false');?>;
  //EOF KGT
  //BOF POINTS
  onePage.pointsInstalled = <?php echo (((USE_POINTS_SYSTEM == 'true') && (USE_REDEEM_SYSTEM == 'true')) ? 'true' : 'false');?>;
  //EOF POINTS
  onePage.shippingEnabled = <?php echo ($onepage['shippingEnabled'] === true ? 'true' : 'false');?>;
  onePage.pageLinks = {
	  checkout: '<?php echo fixSeoLink(tep_href_link(FILENAME_CHECKOUT, session_name() . '=' . session_id() . '&rType=ajax', $request_type));?>',
	  shoppingCart: '<?php echo fixSeoLink(tep_href_link(FILENAME_SHOPPING_CART));?>'
  }

  function getFieldErrorCheck($element){
	  var rObj = {};
	  switch($element.attr('name')){
		  case 'billing_firstname':
		  case 'shipping_firstname':
			  rObj.minLength = <?php echo addslashes(ENTRY_FIRST_NAME_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_FIRST_NAME_ERROR);?>';
		  break;
		  case 'billing_lastname':
		  case 'shipping_lastname':
			  rObj.minLength = <?php echo addslashes(ENTRY_LAST_NAME_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_LAST_NAME_ERROR);?>';
		  break;
		  case 'billing_email_address':
			  rObj.minLength = <?php echo addslashes(ENTRY_EMAIL_ADDRESS_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_EMAIL_ADDRESS_ERROR);?>';
		  break;
		  case 'billing_street_address':
		  case 'shipping_street_address':
			  rObj.minLength = <?php echo addslashes(ENTRY_STREET_ADDRESS_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_STREET_ADDRESS_ERROR);?>';
		  break;
		  case 'billing_zipcode':
		  case 'shipping_zipcode':
			  rObj.minLength = <?php echo addslashes(ENTRY_POSTCODE_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_POST_CODE_ERROR);?>';
		  break;
		  case 'billing_city':
		  case 'shipping_city':
			  rObj.minLength = <?php echo addslashes(ENTRY_CITY_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_CITY_ERROR);?>';
		  break;
		  case 'billing_dob':
			  rObj.minLength = <?php echo addslashes(ENTRY_DOB_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_DATE_OF_BIRTH_ERROR);?>';
		  break;
		  case 'billing_telephone':
			  rObj.minLength = <?php echo addslashes(ENTRY_TELEPHONE_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_TELEPHONE_NUMBER_ERROR);?>';
		  break;
		  case 'billing_country':
		  case 'shipping_country':
			  rObj.errMsg = '<?php echo addslashes(ENTRY_COUNTRY_ERROR);?>';
		  break;
		  case 'billing_state':
		  case 'delivery_state':
			  rObj.minLength = <?php echo addslashes(ENTRY_STATE_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_STATE_ERROR);?>';
		  break;
		  case 'password':
		  case 'confirmation':
			  rObj.minLength = <?php echo addslashes(ENTRY_PASSWORD_MIN_LENGTH);?>;
			  rObj.errMsg = '<?php echo addslashes(ENTRY_PASSWORD_ERROR);?>';
		  break;
	  }
	return rObj;
  }

$(document).ready(function (){
	$('#pageContentContainer').show();
	$('#enableMATC').hide();
	
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
				  $("#MATC").attr("checked", true); 
				  $("#MATCtd").attr("class", "messageStackSuccess"); 
				  $('#disableMATC').hide();	
				  $('#enableMATC').show();
				} }
			});

		$link.click(function() {
			$dialog.dialog('open');
            
			return false;
		});
	});
	
	<?php
  if(ONEPAGE_CHECKOUT_LOADER_POPUP == 'True')
  {
  ?>
  $('#ajaxMessages').dialog({
			shadow: true,
			modal: true,
			width: 400,
		  height: 100,
		  open: function (event, ui){
				$(this).parent().children().children('.ui-dialog-title').hide();
				$(this).parent().children().children('.ui-dialog-titlebar').hide();
				$(this).parent().children().children('.ui-dialog-titlebar-close').hide();
        }
			});
	<?php
  }
  ?>

	var loginBoxOpened = false;
	$('#loginButton').click(function (){
		if (loginBoxOpened){
			$('#loginBox').dialog('open');
			return false;
		}
		$('#loginBox').dialog({
			resizable: false,
			shadow: false,
			open: function (){
				var $dialog = this;
				$('input', $dialog).keypress(function (e){
					if (e.which == 13){
						$('#loginWindowSubmit', $dialog).click();
					}
				});

				$('#loginWindowSubmit', $dialog).hover(function (){
					this.style.cursor = 'pointer';
				}, function (){
					this.style.cursor = 'default';
				}).click(function (){
					var $this = $(this);
					$this.hide();
					var email = $('input[name="email_address"]', $dialog).val();
					var pass = $('input[name="password"]', $dialog).val();
					onePage.queueAjaxRequest({
						url: onePage.pageLinks.checkout,
						data: 'action=processLogin&email=' + email + '&pass=' + pass,
						dataType: 'json',
						type: 'post',
						beforeSend: function (){
							onePage.showAjaxMessage('Refreshing Shopping Cart');
							if ($('#loginStatus', $this.parent()).size() <= 0){
								$('<div>')
								.attr('id', 'loginStatus')
								.html('Processing Login')
								.attr('align', 'center')
								.insertAfter($this);
							}
						},
						success: function (data){
							if (data.success == true){
								$('#loginStatus', $dialog).html(data.msg);
								$('#logInRow').hide();

								$('#changeBillingAddressTable').show();
								$('#changeShippingAddressTable').show();
								$('#newAccountEmail').remove();
								$('#diffShipping').parent().parent().parent().remove();

								onePage.updateAddressHTML('billing');
								onePage.updateAddressHTML('shipping');

								$('#shippingAddress').show();

								var updateTotals = true;
								// Bug fix 582
								//onePage.updateCartView();
								//onePage.updateFinalProductListing();
								//onePage.updatePaymentMethods();
								//if ($(':radio[name="payment"]:checked').size() > 0){
								//	onePage.setPaymentMethod($(':radio[name="payment"]:checked'));
								//	updateTotals = false;
								//}
								//onePage.updateShippingMethods();
								//if ($(':radio[name="shipping"]:checked').size() > 0){
									//onePage.setShippingMethod($(':radio[name="shipping"]:checked').val());
								//	 onePage.setShippingMethod($(':radio[name="shipping"]:checked'));
								//	updateTotals = false;
								//}

								//if (updateTotals == true){
								//	onePage.updateOrderTotals();
								//}
								location.reload(); // Bug fix 582 login problem

								$('#loginBox').dialog('destroy');
							}else{
								$('#logInRow').show();
								$('#loggedInRow').hide();

								$('#loginStatus', $dialog).html(data.msg);
								setTimeout(function (){
									$('#loginStatus').remove();
									$('#loginWindowSubmit').show();
								}, 6000);
								setTimeout(function (){
									$('#loginStatus').html('Try again in 3');
								}, 3000);
								setTimeout(function (){
									$('#loginStatus').html('Try again in 2');
								}, 4000);
								setTimeout(function (){
									$('#loginStatus').html('Try again in 1');
								}, 5000);
							}
						},
						errorMsg: 'There was an error logging in, please inform <?php echo STORE_NAME; ?> about this error.'
					});
				});
			}
		});
		loginBoxOpened = true;
		return false;
	});

	$('#changeBillingAddress, #changeShippingAddress').click(function (){
		var addressType = 'billing';
		if ($(this).attr('id') == 'changeShippingAddress'){
			addressType = 'shipping';
		}
		$('#addressBook').clone().show().appendTo(document.body).dialog({
			shadow: false,
			width: 550,
		   // height: 450,
			minWidth: 550,
			//minHeight: 500,
			open: function (){
				onePage.loadAddressBook($(this), addressType);
			},
			buttons: {
				'<?php echo addslashes(WINDOW_BUTTON_CANCEL);?>': function (){
					var $this = $(this);
					var action = $('input[name="action"]', $this).val();
					//alert($(':input, :select, :radio, :checkbox', this).serialize());
					if (action == 'selectAddress'){
						$this.dialog('close');
					}else if (action == 'addNewAddress' || action == 'saveAddress'){
						onePage.loadAddressBook($this, addressType);
					}
				},
				'<?php echo addslashes(WINDOW_BUTTON_CONTINUE);?>': function (){
					var $this = $(this);
					var action = $('input[name="action"]', $this).val();
					//alert($(':input, :select, :radio, :checkbox', this).serialize());
					if (action == 'selectAddress'){
						onePage.queueAjaxRequest({
							url: onePage.pageLinks.checkout,
							beforeSendMsg: 'Setting Address',
							dataType: 'json',
							data: $(':input, :radio', this).serialize(),
							type: 'post',
							success: function (data){
								$this.dialog('close');
								if (addressType == 'shipping'){
									onePage.updateAddressHTML('shipping');
									onePage.updateShippingMethods();
								}else{
									onePage.updateAddressHTML('billing');
									onePage.updatePaymentMethods();
								}
							},
							errorMsg: 'There was an error saving your address, please inform <?php echo STORE_NAME; ?> about this error.'
						});
					}else if (action == 'addNewAddress'){
						onePage.queueAjaxRequest({
							url: onePage.pageLinks.checkout,
							beforeSendMsg: 'Saving New Address',
							dataType: 'json',
							data: $(':input, :select, :radio, :checkbox', this).serialize(),
							type: 'post',
							success: function (data){
								onePage.loadAddressBook($this, addressType);
							},
							errorMsg: 'There was an error saving your address, please inform <?php echo STORE_NAME; ?> about this error.'
						});
					}else if (action == 'saveAddress'){
						onePage.queueAjaxRequest({
							url: onePage.pageLinks.checkout,
							beforeSendMsg: 'Updating Address',
							dataType: 'json',
							data: $(':input, :select, :radio, :checkbox', this).serialize(),
							type: 'post',
							success: function (data){
								onePage.loadAddressBook($this, addressType);
							},
							errorMsg: 'There was an error saving your address, please inform <?php echo STORE_NAME; ?> about this error.'
						});
					}
				},
				'<?php echo addslashes(WINDOW_BUTTON_NEW_ADDRESS);?>': function (){
					var $this = $(this);
					onePage.queueAjaxRequest({
						url: onePage.pageLinks.checkout,
						data: 'action=getNewAddressForm',
						type: 'post',
						beforeSendMsg: 'Loading New Address Form',
						success: function (data){
							$this.html(data);
							if(onePage.stateEnabled == true)
							{
								onePage.addCountryAjax($('select[name="country"]', $this), 'state', 'stateCol')
							}
						},
						errorMsg: 'There was an error loading new address form, please inform <?php echo STORE_NAME; ?> about this error.'
					});
				},
				'<?php echo addslashes(WINDOW_BUTTON_EDIT_ADDRESS);?>': function (){
					var $this = $(this);
					onePage.queueAjaxRequest({
						url: onePage.pageLinks.checkout,
						data: 'action=getEditAddressForm&addressID=' + $(':radio[name="address"]:checked', $this).val(),
						type: 'post',
						beforeSendMsg: 'Loading Edit Address Form',
						success: function (data){
							$this.html(data);
						},
						errorMsg: 'There was an error loading edit address form, please inform <?php echo STORE_NAME; ?> about this error.'
					});
				}
			}
		});
	   return false;
	});

	onePage.initCheckout();
});

<?php
// Start - CREDIT CLASS Gift Voucher Contribution
if (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true'){
if (MODULE_ORDER_TOTAL_INSTALLED)
	$temp=$order_total_modules->process();
	$temp=$temp[count($temp)-1];
	$temp=$temp['value'];

	$gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
	$gv_result = tep_db_fetch_array($gv_query);

if ($gv_result['amount']>=$temp){ $coversAll=true;
/*
?>
  function clearRadeos(){
	document.checkout.cot_gv.checked=!document.checkout.cot_gv.checked;
	for (counter = 0; counter < document.checkout.payment.length; counter++) {
	  // If a radio button has been selected it will return true
	  // (If not it will return false)
	  if (document.checkout.cot_gv.checked){
		document.checkout.payment[counter].checked = false;
		document.checkout.payment[counter].disabled=true;
	  } else {
		document.checkout.payment[counter].disabled=false;
	  }
	}
  }
<?php
} else {
  $coversAll=false;?>

  function clearRadeos(){
	document.checkout.cot_gv.checked=!document.checkout.cot_gv.checked;
  }
<?php
*/
  }
}?>
function clearRadeos(){
	 return true;
  }
//-->
</script>


<script type="text/javascript">
function switchMATC() { 
	if($("#MATC").attr("checked")) {
		$("#MATCtd").attr("class", "messageStackSuccess");
		$('#disableMATC').hide();
    	$('#enableMATC').show();
	} else {
		$("#MATCtd").attr("class", "messageStackAlert");
		$('#disableMATC').show();
    	$('#enableMATC').hide();
	}
}

function warnMATC() {
		$("#MATCtd").attr("class", "messageStackWarning");
}
</script>
<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
  
*/


  require('includes/application_top.php');

// #### Get Available Customers

	$query = tep_db_query("select customers_id, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " ORDER BY customers_lastname");
    $result = $query;

	
	if (tep_db_num_rows($result) > 0)
	{
 		// Query Successful
 		$SelectCustomerBox = "<select name='Customer'><option value=''>" . TEXT_SELECT_CUST . "</option>\n";
 		while($db_Row = tep_db_fetch_array($result))
 		{ $SelectCustomerBox .= "<option value='" . $db_Row["customers_id"] . "'";
		  if(IsSet($_GET['Customer']) and $db_Row["customers_id"]==$_GET['Customer'])
			$SelectCustomerBox .= " SELECTED ";
		  //$SelectCustomerBox .= ">" . $db_Row["customers_lastname"] . " , " . $db_Row["customers_firstname"] . " - " . $db_Row["customers_id"] . "</option>\n"; 
		  $SelectCustomerBox .= ">" . $db_Row["customers_lastname"] . " , " . $db_Row["customers_firstname"] . "</option>\n";
		
		}
		
		$SelectCustomerBox .= "</select>\n";
	}
	
	$query = tep_db_query("select code, value from " . TABLE_CURRENCIES . " ORDER BY code");
	$result = $query;
	
	if (tep_db_num_rows($result) > 0)
	{
 		// Query Successful
 		$SelectCurrencyBox = "<select name='Currency'><option value='' SELECTED>" . TEXT_SELECT_CURRENCY . "</option>\n";
 		while($db_Row = tep_db_fetch_array($result))
 		{ 
			$SelectCurrencyBox .= "<option value='" . $db_Row["code"] . " , " . $db_Row["value"] . "'";
		  	$SelectCurrencyBox .= ">" . $db_Row["code"] . "</option>\n";
		}
		
		$SelectCurrencyBox .= "</select>\n";
	}

	if(IsSet($_GET['Customer']))
	{
 	$account_query = tep_db_query("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . $_GET['Customer'] . "'");
 	$account = tep_db_fetch_array($account_query);
 	$customer = $account['customers_id'];
 	$address_query = tep_db_query("select * from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $_GET['Customer'] . "'");
 	$address = tep_db_fetch_array($address_query);
 	//$customer = $account['customers_id'];
	} elseif (IsSet($_GET['Customer_nr']))
	{
 	$account_query = tep_db_query("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . $_GET['Customer_nr'] . "'");
 	$account = tep_db_fetch_array($account_query);
 	$customer = $account['customers_id'];
 	$address_query = tep_db_query("select * from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $_GET['Customer_nr'] . "'");
 	$address = tep_db_fetch_array($address_query);
 	//$customer = $account['customers_id'];
	}

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ORDER_PROCESS);
  ?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
<?php require('includes/form_check.js.php'); ?>
</head>
<body>
		<!-- header //-->
		<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
		<!-- header_eof //-->		
	
<!-- body //-->

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="100%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td width="100%">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo TEXT_CREATE_ORDER; ?></td>
                <td class="pageHeading" align="right">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr class="dataTableHeadingRow">
                      <td class="dataTableHeadingContent"><?php echo TEXT_STEP_1; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '10', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo HEADING_SELECT; ?></b></td>
                <td>&nbsp;</td>
                <td class="main"><b><?php echo HEADING_CREATE; ?></b></td>
              </tr>
              <tr>
                <td class="main" valign="top" style="border:solid 1px #dddddd; padding:10px;">
                  <form action="<?php echo $PHP_SELF; ?>" method="GET">
                  <table width="100%" cellpadding="5" cellspacing="0" border="0">
                    <tr>
                      <td width="200"><?php echo $SelectCustomerBox; ?></td>
                      <td valign="bottom"><input type="submit" value="<?php echo BUTTON_SUBMIT; ?>"></td>
                    </tr>
                  </table>
                  </form>
                  <br>
                  <b><?php echo TEXT_OR_BY; ?></b>
                  <br>                
                  <form action="<?php echo $PHP_SELF; ?>" method="GET">
                  <table width="100%" cellpadding="5" cellspacing="0" border="0">
                    <tr>
                      <td width="200"><input type="text" name="Customer_nr"></td>
                      <td valign="bottom"><input type="submit" value="<?php echo BUTTON_SUBMIT; ?>"></td>
                    </tr>
                  </table>
                  </form>
                </td>
                <td align="center"><?php echo tep_image(DIR_WS_ICONS . 'arrow_right.gif', '', '21', '53'); ?></td>
                <td class="main" valign="top" style="border:solid 1px #dddddd; padding:10px;"><?php echo tep_draw_form('create_order', FILENAME_CREATE_ORDER_PROCESS, '', 'post', '', '') . tep_draw_hidden_field('customers_id', $account->customers_id); ?>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><?php require(DIR_WS_MODULES . 'create_order_details.php'); ?></td>
                    </tr>
                    <tr>
                      <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td class="main">&nbsp;</td>
                            <td class="main" align="right"><?php echo tep_image_submit('button_confirm.gif', IMAGE_BUTTON_CONFIRM); ?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>                
                </form></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

require('includes/application_top.php');

// #### Get Available Customers
if(isset($_POST['secu'])) {
	$byfl='where customers_firstname like \''.$_POST['cust2'].'%\' or customers_lastname like \''.$_POST['cust2'].'%\''; 
}else $byfl='';
$query = tep_db_query("select customers_id, customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " ".$byfl." ORDER BY customers_lastname");

$result = $query;
//require_once("../dBug.php");
//new dBug($result);
if (tep_db_num_rows($result) > 0){	// Query Successful
	$SelectCustomerBox = "<select name='Customer' onChange='this.form.submit();'><option value=''>" . SELECT_CUSTOMER . "</option>\n";

	while($db_Row = tep_db_fetch_array($result)){ 	

		$SelectCustomerBox .= "<option value='" . $db_Row["customers_id"] . "'";

	  	if(isset($_POST['Customer']) and $db_Row["customers_id"]==$_POST['Customer']){
	
			$SelectCustomerBox .= " SELECTED ";
			$CustomerEmail = $db_Row["customers_email_address"];
		}
	  	$SelectCustomerBox .= ">" . $db_Row["customers_lastname"] . " , " . $db_Row["customers_firstname"] . "</option>\n";
	}

	$SelectCustomerBox .= "</select>\n";
}
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PHONE_ORDER);

// #### Generate Page
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>

<!-- header //-->

<?php

	require(DIR_WS_INCLUDES . 'header.php');

	?>

<!-- header_eof //-->
<!-- body //-->

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2" class="columnLeft">
        <!-- left_navigation //-->
        <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
        <!-- left_navigation_eof //-->
      </table></td>

    <!-- body_text //-->
    <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                <td class="pageHeading" align="right">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><table border='0' cellpadding='7'>
              <tr>
                <td class="main" valign="top"><table border='0'>
                    <tr>
						<td>
						<form action="<?php echo $PHP_SELF?>" method="post">
							<input type="text" value="<?php echo $_POST['cust2']?>" name="cust2" />
							<input type="submit" name="secu" value="<?php echo SEARCH ?>" />
						</form>
						</td>
					
					</tr>
					<tr>
                      <td><?php
					  	  echo '<form action="' . $PHP_SELF. '" method="POST">';
                          echo '<font class="main"><b>' . SELECT_CUSTOMER . '</b></font><br><br>';
                          echo $SelectCustomerBox;
                          echo '</form>';
						?>
					
						</td>
                      <td valign='bottom'><?php
					  if(isset($_POST['Customer'])){
						  if (ENABLE_SSL_CATALOG == 'true') {
							echo '<form action="' . HTTPS_CATALOG_SERVER . DIR_WS_CATALOG . 'login.php" method="POST" target="_blank">';
						  } else {
							echo '<form action="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'login.php" method="POST" target="_blank">';
						  }
						  echo '<input type="hidden" name="email_address" value="'.$CustomerEmail.'">';
					  echo '<input type="hidden" name="action" value="process">';
						  echo '<input type="hidden" name="phoneorder" value="order">';
						  echo '<input type="submit" value="' . SUBMIT .'"></form>';
					  }
					  ?>
                      </td>
                    </tr>
                  </table>

                  <?php
				    if (ENABLE_SSL_CATALOG == 'true') {
						echo '<form action="' . HTTPS_CATALOG_SERVER . DIR_WS_CATALOG  . 'create_account.php" method="POST" target="_blank">';
				    } else {
						echo '<form action="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG  . 'create_account.php" method="POST" target="_blank">';
				    }
					print "<table border='0'>\n";
					print "<tr>\n";
					print "<td><font class=main><b><br>" . CREATE_NEW . "</b></font>";
					print "<td valign='bottom'><input type='submit' value='" . NEW_CUSTOMER . "'></td>\n";
					print "</tr>\n";
					print "</table>\n";
					print "</form>\n";
					?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table>
      <!-- body_text_eof //--></td>
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
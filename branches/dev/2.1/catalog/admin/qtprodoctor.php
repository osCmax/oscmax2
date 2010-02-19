<?php
/*
  $Id: server_info.php 1785 2008-01-10 15:07:07Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if(isset($HTTP_GET_VARS['action'])){
  	$doctor_action = $HTTP_GET_VARS['action'];
  }
  
  if(isset($HTTP_GET_VARS['pID'])){
  	$products_id = $HTTP_GET_VARS['pID'];
  }
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <!--<tr>
        <td>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo 'QTPro Doctor';//echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table>
		</td>
      </tr>-->
      <tr>
        <td>
		<?php 
			switch($doctor_action){
				case 'examine':
					if(qtpro_doctor_product_healthy($products_id)){
						print '<span style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: green; font-weight: normal; text-decoration: none;"><b>Product is healthy</b><br /> The database entries for this products stock as they should.</span>';
					}else{
						print '<span style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: red; font-weight: normal; text-decoration: none;"><b>Product is sick</b><br /> The database entries for this products stock is messed up. This is why the table above looks messed up.</span>';
					}
				break;
				case 'amputate':
					print qtpro_doctor_amputate_bad_from_product($products_id).' database entries where amputated';
					qtpro_update_summary_stock($products_id);
				break;
				case 'chuck_trash':
					print qtpro_chuck_trash().' database entries where identified as trash and deleted.';
				break;
				case 'update_summary':
					qtpro_update_summary_stock($products_id);
					print 'The summary stock for the product was updated.';
				break;
				
				
				
				default:
					print "<h1 class=\"pageHeading\">QTPro Doctor - Overview</h1>";
					print "<table><tr><td class='main'>You currently have <b>". qtpro_normal_product_count()."</b> products in your store.</td></tr>";
					print "<tr><td class='main'><b>".qtpro_tracked_product_count()."</b> of them have options with tracked stock.</td></tr>";
					print "<tr><td class='main'>In the database we currently have <b>". qtpro_number_of_trash_stock_rows() . "</b> trash rows.</td></tr></table>";
					//print "<b>".qtpro_sick_product_count()."</b> of the producks with tracked stock is sick.<br><br>";
					qtpro_doctor_formulate_database_investigation();

					
				break;
			
			}
		?>

		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
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

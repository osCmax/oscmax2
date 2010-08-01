<?php
/*
  $Id: server_info.php 1785 2008-01-10 15:07:07Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if(isset($_GET['action'])){
  	$doctor_action = $_GET['action'];
  }
  
  if(isset($_GET['pID'])){
  	$products_id = $_GET['pID'];
  }
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="75%" valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
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
				 	print '<p class="messageStackWarning">' . tep_image(DIR_WS_ICONS . 'database_warning.png') . '&nbsp;&nbsp;' . qtpro_doctor_amputate_bad_from_product($products_id) . ' database entries were amputated</p>';
					qtpro_update_summary_stock($products_id);
				break;
				case 'chuck_trash':
					print '<p class="messageStackWarning">' . tep_image(DIR_WS_ICONS . 'database_warning.png') . '&nbsp;&nbsp;' . qtpro_chuck_trash() . ' database entries were identified as trash and deleted.</p>';
				break;
				case 'update_summary':
					qtpro_update_summary_stock($products_id);
					print '<p class="messageStackSuccess">' . tep_image(DIR_WS_ICONS . 'tick.png') . '&nbsp;&nbsp;The summary stock for the product was updated.</p>';
				break;
				default:
					
				break;			
			}
			
					print "<h1 class=\"pageHeading\">QTPro Doctor - Overview</h1>";
					print "<table><tr><td class='main'>You currently have <b>" . qtpro_normal_product_count() . " active</b> and <b>" . qtpro_inactive_product_count() . " inactive</b> products in your store</td></tr>";
					print "<tr><td class='main'><b>" . qtpro_tracked_product_count() . "</b> of the active stocks and <b>" . qtpro_inactive_tracked_product_count() . "</b> of the inactive stocks have options with tracked stock.</td></tr>";
					print "<tr><td class='main'>In the database we currently have <b>" . qtpro_number_of_trash_stock_rows() . "</b> trash rows.</td></tr></table>";
					//print "<b>".qtpro_sick_product_count()."</b> of the products with tracked stock is sick.<br><br>";
					qtpro_doctor_formulate_database_investigation();
					qtpro_doctor_formulate_inactive_database_investigation();

		?>

		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
    </table>
	</td>
    <td width="25%">
      <!-- Placeholder for right hand column -->
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

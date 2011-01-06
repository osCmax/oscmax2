<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  require('includes/application_top.php');
	
	$oID = $_GET['oID'];
	$active = $_GET['active'];
	
	// check to see if there are multiple packages in this shipment
	$packages_query = tep_db_query("select multiple from " . TABLE_SHIPPING_MANIFEST . " where orders_id = " . $oID . " order by multiple asc");
	
	// if there's no other indication, first label should be active label
	if (!$active) {
		$active = 1;
		}
	
	$multiple = array();
	
	while ($packages = tep_db_fetch_array($packages_query)) {
		// if 'multiple' is populated, get all values into an array
/*		
		echo '<pre>';
		echo 'packages is <br>';
		print_r($packages);
		echo '</pre>';
*/		
		if ($packages['multiple']) {
			$multiple[] = $packages['multiple'];
			}
		}
	
	// get the highest value from $multiple, it's the last label
	if ($multiple) {
		$last = max($multiple);
		}
	
	// now get the tracking number for the selected (active) label
	if ($multiple) {
		$tracking_num = tep_manifest_data($oID,$active);
		}
	elseif (!$multiple) {
		$tracking_num = $_GET['num'];
		}

?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>

    <style type="text/css">
    <!-- 
		table { 
			width: 675; 
			border-top: 1px dotted black; 
			}
		td {
			font-family: Verdana, Arial, sans-serif; 
			font-size: 12px; 
			}
		-->
    </style>
    <script language="JavaScript1.1" type="text/javascript">
    var NS4 = (document.layers) ? true : false ;var resolution = 96;if (NS4 && navigator.javaEnabled()){var toolkit = java.awt.Toolkit.getDefaultToolkit();resolution = toolkit.getScreenResolution();}
    </script>
    <script language="JavaScript" type="text/javascript">
    document.write('<img WIDTH=' + (675 * resolution )/100 + '<img HEIGHT=' + (467 * resolution )/100 + ' alt="ASTRA Barcode" src="images/fedex/<?php echo $tracking_num; ?>.png">');
    </script>
    <title></title>
  </head>
  <body>
    <table border="0" width="100%">
      <tr>
        <td colspan="3">
          <img src="images/pixel_trans.gif" border="0" alt=""
          width="1" height="100">
        </td>
      </tr>
      <tr>
        <td align="center">
          <a href="#" onclick=
          "window.print(); return false"><img src=
          "includes/languages/english/images/buttons/button_print.gif"
               border="0" alt="IMAGE_ORDERS_PRINT" title=
               " IMAGE_ORDERS_PRINT "></a>
        </td>
				<td align="center">
<?php

// links for multiple packages

	if ($multiple) {
		if ($active != 1) {
			echo '<a href="?oID=' . $oID . '&active=' . ($active-1) . '">&lt;-- previous</a> &nbsp; ';
			}
		else {
			echo '&lt;-- previous';
			}
		foreach ($multiple as $package_num) {
			if ($active != $package_num) {
				echo ' &nbsp; <a href="?oID=' . $oID . '&active=' . $package_num . '">' . $package_num . '</a> &nbsp; ';
				}
			else {
				echo ' <b>' . $package_num . '</b> ';
				}
			}
		if ($active != $last) {
			echo ' &nbsp; <a href="?oID=' . $oID . '&active=' . ($active+1) . '">next --&gt;</a>';
			}
		else {
			echo ' &nbsp; next --&gt;';
			}
		}		
?>
        </td>
				<td align="center">
          <a href="orders.php?oID=<?php echo $oID; ?>"><img src=
          "includes/languages/english/images/buttons/button_back.gif"
               border="0" alt="IMAGE_ORDERS_BACK" title=
               " IMAGE_ORDERS_BACK "></a>
        </td>
      </tr>
    </table>
  </body>
</html>

<?php

function tep_manifest_data($oID, $active) {
	if (!$active) {
		$packages_query = tep_db_query("select tracking_num from " . TABLE_SHIPPING_MANIFEST . " where orders_id = " . $oID . "");
		}
	else {	
		$packages_query = tep_db_query("select tracking_num from " . TABLE_SHIPPING_MANIFEST . " where orders_id = " . $oID . " and multiple = '" . $active . "'");
		}
	while ($val = tep_db_fetch_array($packages_query)) {
		$tracking_num = $val['tracking_num'];
		}
	return $tracking_num;
	}
?>
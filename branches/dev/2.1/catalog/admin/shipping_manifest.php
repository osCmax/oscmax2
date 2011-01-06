<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

	if ($_GET['pickup_date']) {
		$pickup_date = $_GET['pickup_date'];
		}
	else {
		$latest_date = tep_db_query("select pickup_date from " . TABLE_SHIPPING_MANIFEST . " order by pickup_date desc limit 1");
		$pickup_date = tep_db_fetch_array($latest_date);
		$pickup_date = $pickup_date['pickup_date'];
		}

	if ($_GET['action'] == 'purge') {
		$purge_manifest_date = tep_db_query("delete from " . TABLE_SHIPPING_MANIFEST . " where pickup_date = '" . $pickup_date . "'");
		if ($purge_manifest_date) {
			tep_redirect(FILENAME_SHIPPING_MANIFEST);
			}
		}
	else {
	
		$display_date = explode('-',$pickup_date);
		// format date to look nice
		$display_date = $display_date[1] . '/' . $display_date[2] . '/' . $display_date[0];
		
		// get data about the store
		$store_data = array
			(
				'STORE_NAME', // 0
				'MODULE_SHIPPING_FEDEX1_ADDRESS_1', // 1
				'MODULE_SHIPPING_FEDEX1_CITY', // 2
				'MODULE_SHIPPING_FEDEX1_STATE', // 3
				'MODULE_SHIPPING_FEDEX1_POSTAL', // 4
				'MODULE_SHIPPING_FEDEX1_ACCOUNT' // 5
				);

		$i = 0;
	
		foreach ($store_data as $data) {
			$store_info_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = '" . $data . "'");
			$value = tep_db_fetch_array($store_info_query);
			$value = $value['configuration_value'];
			// add store variables to store_values
			$store_values[] = $value;
			$i++;
			}
	
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>FedEx Shipping Manifest</title>

<style type="text/css">
<!-- 
td {
  font-family: Verdana, Arial, sans-serif;
  font-size: 8px;
	text-align: left;
	padding-left: 5px;
	}
td.head {
	border-left: 1px dashed #000000;
	border-bottom: 1px dashed #000000;
	border-top: 1px dashed #000000;
	padding-top: 3px;
	padding-bottom: 5px;
	}
td.first-head {
	border-bottom: 1px dashed #000000;
	border-top: 1px dashed #000000;
	padding-top: 3px;
	padding-bottom: 5px;
	}
td.data {
	padding-left: 10px;
	}
td.totals {
	border-top: 1px dashed #000000;
	border-bottom: 1px dashed #000000;
	padding-top: 5px;
	padding-bottom: 10px;
	padding-left: 10px;
	}
td.border {
	border-right: 1px dashed #000000;
	border-bottom: 1px dashed #000000;
	padding-top: 10px;
	padding-bottom: 10px;
	}	
td.border-bottom {
	border-bottom: 1px dashed #000000;
	}	
li {
	padding-top: 5px;
	padding-bottom: 5px;
	}
table.bordered {
	margin-left: 5px;
	border-left: 1px dashed #000000;
	border-top: 1px dashed #000000;
	}
	
-->
</style>

</head>

<body>

		<table border="0" cellpadding="0" cellspacing="0" width="640" align="left">
      <tr>
        <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '40'); ?></td>
      </tr>
			<tr>
				<td>&nbsp;</td>
				<td align="center" class="pageHeading"><?php echo strtoupper('FedEx Ground Pick-up Manifest'); ?></td>
				<td>&nbsp;</td>
			</tr>
      <tr>
        <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '40'); ?></td>
      </tr>
			<tr>
				<td width="34%" class="main" valign="top"><?php echo strtoupper($store_values[0]); ?>
<br>
					<?php echo strtoupper($store_values[1]); ?><br>
					<?php echo strtoupper($store_values[2]) . ', ' . strtoupper($store_values[3]); ?> <?php echo strtoupper($store_values[4]); ?></td>
				<td width="33%" class="main" valign="top">FedEx Account Number: <?php echo $store_values[5]; ?></td>
				<td width="33%" align="right" class="main" valign="top">Date: <?php echo $display_date; ?></td>
			</tr>
      <tr>
        <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '50'); ?></td>
      </tr>
			<tr>
				<td colspan="3">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr class="head">
							<td class="first-head" valign="top" align="center" width="150">Tracking #</td>
							<td class="head" valign="top" align="center" width="100">COD<br>
								Amount</td>
							<td class="head" valign="top" align="center" width="100">Decl. Value<br>
								(if &gt;$100)</td>
							<td class="head" valign="top" align="center" width="100">Oversized 1</td>
							<td class="head" valign="top" align="center" width="100">Oversized 2</td>
							<td class="head" valign="top" align="center" width="100">Oversized 3</td>
							<td class="head" valign="top" align="center" width="100">Residential</td>
						</tr>
						<tr>
							<td colspan="7">&nbsp;</td>
						</tr>
<?php

		$manifest_query = tep_db_query("select tracking_num, cod, package_value, oversized, residential from " . TABLE_SHIPPING_MANIFEST . " where pickup_date = '" . $pickup_date . "'");
	
		$package_count = 0;
		$cod_count = 0;
		$package_value_count = 0;
		$oversized_1_count = 0;
		$oversized_2_count = 0;
		$oversized_3_count = 0;
		$residential_count = 0;
		$international_count = 0;
	
		while ($manifest_data = tep_db_fetch_array($manifest_query)) {
		
			// count the number of packages
			$package_count++;
			echo '<tr>';
			echo '<td class="data">' . $manifest_data['tracking_num'] . '</td>';
		
			// cod - count the number of packages shipped cod
			if ($cod) {
				echo '<td class="data">X</td>';
				$cod_count++;
				}
			else {
				echo '<td class="data">&nbsp;</td>';
				}			
		
			// package value - count the number of packages over $100 in value
			if ($manifest_data['package_value']>100) {
				echo '<td class="data">' . $manifest_data['package_value'] . '</td>';
				$package_value_count++;
				}
			else {
				echo '<td class="data">&nbsp;</td>';
				}
			
			if ($manifest_data['oversized']) {
				// count the number of each oversized option
				if ($manifest_data['oversized']==1) {
					echo '<td class="data">X</td>';
					echo '<td class="data">&nbsp;</td><td class="data">&nbsp;</td>';
					$oversized_1_count++;
					}
				elseif ($manifest_data['oversized']==2) {
					echo '<td class="data">&nbsp;</td>';
					echo '<td class="data">X</td><td class="data">&nbsp;</td>';
					$oversized_2_count++;
					}
				elseif ($manifest_data['oversized']==3) {
					echo '<td class="data">&nbsp;</td><td class="data">&nbsp;</td>';
					echo '<td class="data">X</td>';
					$oversized_3_count++;
					}
				}
			else {
				echo '<td class="data">&nbsp;</td><td class="data">&nbsp;</td><td class="data">&nbsp;</td>';
				}

			if ($manifest_data['residential']=='Y') {
				echo '<td class="data">X</td>';
				$residential_count++;
				}
			else {
				echo '<td class="data">&nbsp;</td>';
				}
			echo '</tr>';
			}
?>
					<tr>
						<td colspan="7">&nbsp;</td>
					</tr>
					<tr>
						<td class="totals" align="right">Total Packages:</td>
						<td class="totals"><?php echo $cod_count; ?></td>
						<td class="totals"><?php echo $package_value_count; ?></td>
						<td class="totals"><?php echo $oversized_1_count; ?></td>
						<td class="totals"><?php echo $oversized_2_count; ?></td>						
						<td class="totals"><?php echo $oversized_3_count; ?></td>
						<td class="totals"><?php echo $residential_count; ?></td>						
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<ol>
						<li>THE LIABILITY OF FEDEX GROUND IS LIMITED TO THE SUM OF $100 PER PACKAGE, UNLESS A HIGHER VALUE IS DECLARED BY A SHIPPER AND AN ADDITIONAL CHARGE IS PAID AT THE RATE SET FORTH IN THE CURRENT FEDEX GROUND RATES SCHEDULE AND TARIFF PER EACH $100.00 OF ADDITIONAL VALUE, OR FRACTION THEREOF. CLAIMS NOT MADE TO FEDEX GROUND WITHIN 9 MONTHS OF THE SCHEDULED DELIVERY DATE ARE WAIVED.</li>
						<li>THE ENTRY OF A C.O.D. AMOUNT IS NOT A DECLARATION OF VALUE.</li>
						<li>IN NO EVENT SHALL FEDEX GROUND BE LIABLE FOR ANY SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES, INCLUDING, WITHOUT LIMITATION, LOSS OF PROFITS OR INCOME, WHETHER OR NOT FEDEX GROUND HAD KNOWLEDGE THAT SUCH DAMAGES MIGHT BE INCURRED.</li>
					</ol>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
						</tr>						
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="250" class="bordered">
									<tr>
										<td class="border" colspan="2">This section to be completed by Driver</td>
									<tr>
										<td class="border">Total Packages:</td>
										<td class="border">Core Zone:</td>
									</tr>
									<tr>
										<td class="border" colspan="2">Pickup Time:</td>
									</tr>
									<tr>
										<td class="border" colspan="2">Driver Number:</td>								
									</tr>
									<tr>
										<td class="border" colspan="2">Driver Signature:</td>
									</tr>
								</table>
							</td>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="250" class="bordered">
									<tr>
										<td class="border">Total Domestic Bar Codes:</td>
										<td class="border"><?php echo $package_count - $residential_count - $international_count; ?></td>
									</tr>
									<tr>
										<td class="border">Total International Bar Codes:</td>
										<td class="border"><?php echo $international_count; ?></td>
									</tr>
									<tr>
										<td class="border">Total FedEx Home Delivery Bar Codes:</td>
										<td class="border"><?php echo $residential_count; ?></td>
									</tr>
									<tr>
										<td class="border">Total Packages:</td>
										<td class="border"><?php echo $package_count; ?></td>
									</tr>
								</table>
							<td>
						</tr>
						<tr>
							<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bordered">
									<tr>
										<td class="border" colspan="2">This section to be completed for spotted trailers</td>
									</tr>
									<tr>
										<td class="border">Shipper Load?</td>
										<td class="border">Trailer #:</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
			<tr>
			<tr>
				<td class="border-bottom" colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
			<tr>
			<tr>
				<td><a href="#" onclick="window.print(); return false"><img src=
          "includes/languages/english/images/buttons/button_print.gif"  border="0" alt="<?php echo IMAGE_ORDERS_PRINT; ?>" title="<?php echo IMAGE_ORDERS_PRINT; ?>"></a>
				</td>
				<td align="center" valign="top">Available manifests:<br>
					<form name="manifest_dates">
						<select name="manifest_links" onChange="window.location=document.manifest_dates.manifest_links.options[document.manifest_dates.manifest_links.selectedIndex].value">				

<?php
		// menu options for all available dates
		$manifest_dates_query = tep_db_query("select distinct pickup_date from " . TABLE_SHIPPING_MANIFEST . "");
		while ($date = tep_db_fetch_array($manifest_dates_query)) {
			$new_display_date = explode('-',$date['pickup_date']);
			$new_display_date = $new_display_date[1] . '/' . $new_display_date[2] . '/' . $new_display_date[0];
			if ($new_display_date == $display_date) {
				echo '<option selected value="javascript:void(0)">' . $display_date;
				}
			else {	
				echo '<option value="?pickup_date=' . $date['pickup_date'] . '">' . $new_display_date;
				}
			$i++;
			}
?>
						</select>
					</form>
				</td>
				<td><a href="?action=purge&pickup_date=<?php echo $pickup_date; ?>" onClick="return(window.confirm('Delete all manifest entries from <?php echo $display_date; ?>?'));"><img src=
          "includes/languages/english/images/buttons/button_purge_manifest.gif"  border="0" alt="<?php echo IMAGE_PURGE_MANIFEST; ?>" title="<?php echo IMAGE_PURGE_MANIFEST; ?>"></a>
				</td>
			</tr>
		</table>
	</body>

</html>

<?php
		}
?>
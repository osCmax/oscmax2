<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// debugging? 
	
	$debug = 0; // 1 for yes, 0 for no
	
	$action = $_GET['action'];
	$order = $_GET['oID'];
	$tracking_number = $_GET['num'];

	include(DIR_WS_INCLUDES . 'fedexdc.php');

// create new FedExDC object
// For tracking results you do not need an account# or meter#
	$fed = new FedExDC();
	
//tracking example
	$track_Ret = $fed->ref_track(array(1537 => $tracking_number,));

// debug (prints array of all data returned)

if ($debug) {

	echo '<pre>';

	if ($error = $fed->getError()) {
	  echo "ERROR :". $error;
		} else {
	  echo $fed->debug_str. "\n<BR>";
	  print_r($track_Ret);
	  echo "\n\n";
	  for ($i=1; $i<=$track_Ret[1584]; $i++) {
	  	echo PACKAGE_DELIVERED_ON . $track_Ret['1720-'.$i];
	    echo '\n' . PACKAGE_SIGNED_BY . $track_Ret['1706-'.$i];
		  }
		}

	echo '</pre>';
	}

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
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php 
						echo HEADING_TITLE;
						if ($order) {
							echo ', ' . ORDER_NUMBER . $order;
							}
						?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('action'))) . 'oID=' . $order . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="80%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', 1, 15); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
<?php

	if ($error = $fed->getError()) {
	  if (strstr($error, '500139')) {
			echo PACKAGE_NOT_IN_SYSTEM . '<br/>';
			}
	  if (strstr($error, '6070')) {
			echo INVALID_TRACKING_NUM . '<br/>';
			}
		else {
			echo PACKAGE_ERROR . $error;
			}
		} 
	else {
	  for ($i=1; $i<=$track_Ret[1584]; $i++) {
// list destination
			$dest_city = $track_Ret['15-'.$i];
			$dest_state = $track_Ret['16-'.$i];
			$dest_zip = $track_Ret['17-'.$i];
			$signed_by = $track_Ret['1706-'.$i];
			$delivery_date = $track_Ret['1720-'.$i];
			$delivery_time = $track_Ret['1707-'.$i];
			
// format date
			$delivery_date = strtotime($delivery_date);
			$delivery_date = date("F j, Y", $delivery_date);
			
// format time, determine am or pm
			$hour = substr($delivery_time,0,2);
			$minute = substr($delivery_time,2,2);
			if ($hour >= 12) {
				$time_mod = 'pm';
// make pm hours non-military time
				if ($hour > 12) {
					$hour = ($hour - 12);
					}
				}
			else {
				$time_mod = 'am';
				}

// everyone (other than error messages) gets a status report
			if (!$error) {
				echo '<td class="main"><b>' . PACKAGE_DESTINATION . '</b></td></tr><tr><td class="main"> ' . $dest_city . ', ' . $dest_state . ' ' . $dest_zip . '</td></tr>';
?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', 1, 15); ?></td>
          </tr>
<?php
				echo '<tr><td class="main"><b>' . PACKAGE_STATUS . '</b></td></tr>';
			
// for delivered packages
				if ($signed_by) {
						
// if left without signature, let them know
// (add more as they appear)
					if (strstr($signed_by,'F.RONTDOOR')) {
						$signed_by = '<tr><td class="main">' . DELIVERED_FRONTDOOR . '</td></tr>';
						}
					if (strstr($signed_by,'S.IDEDOOR')) {
						$signed_by = '<tr><td class="main">' . DELIVERED_SIDEDOOR . '</td></tr>';
						}
					if (strstr($signed_by,'G.ARAGE')) {
						$signed_by = '<tr><td class="main">' . DELIVERED_GARAGE . '</td></tr>';
						}
					if (strstr($signed_by,'B.ACKDOOR')) {
						$signed_by = '<tr><td class="main">' . DELIVERED_BACKDOOR . '</td></tr>';
						}
					echo '<tr><td class="main">' . PACKAGE_DELIVERED_ON . $delivery_date . PACKAGE_DELIVERED_AT . $hour . ':' . $minute . ' ' . $time_mod . '</td></tr>';

?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', 1, 15); ?></td>
          </tr>
<?php

		      echo '<tr><td class="main"><b>' . PACKAGE_SIGNED_BY . '</b></td></tr><tr><td class="main">' . $signed_by . '</td></tr>';					
					}
				else {
					$status_note = $track_Ret['1159-'.$i.'-1'];
					$status_city = $track_Ret['1160-'.$i.'-1'];
					$status_state = $track_Ret['1161-'.$i.'-1'];
					echo '<tr><td class="main"><b>' . PACKAGE_IN_TRANSIT . '</td></tr>';
					echo '<tr><td class="main">' . $status_note . ': ' . $status_city . ', ' . $status_state . '</td></tr>';
					}
				}
			else {
				echo '&nbsp;';
				}
			}
		}
?>
					</table>
          </tr>
        </table></td>
      </tr>
    </table></td>
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
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>	
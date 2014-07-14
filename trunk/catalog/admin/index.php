<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  if (isset($_GET['setasdefault'])) {
    tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . $_GET['setasdefault'] . "' where configuration_key = 'INDEX_TAB'");
	// Configuration Cache modification start
    require ('includes/configuration_cache.php');
    // Configuration Cache modification end
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
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
<td valign="top">
<table width="95%" align="center">
<tr><td>

<div id="tabs" class="ui-tabs">
    <ul class="ui-tabs ui-tabs-nav">
        <li><a href="#tabs-1"><?php echo TEXT_TAB1; ?></a></li>
        <li><a href="#tabs-2"><?php echo TEXT_TAB2; ?></a></li>
        <li><a href="#tabs-3"><?php echo TEXT_TAB3; ?></a></li>
        <li><a href="#tabs-4"><?php echo TEXT_TAB4; ?></a></li>
        <li><a href="#tabs-5"><?php echo TEXT_TAB5; ?></a></li>
        <li><a href="#tabs-6"><?php echo TEXT_TAB6; ?></a></li>
    </ul>

<div id="tabs-1" class="ui-tabs ui-tabs-container ui-tabs-hide">
  <table border="0" width="95%" align="center">
    <tr valign="top">
      <td width="50%" align="center">
        <table border="0" width="100%">
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/top_ten_customers.php'); ?>
            </td>
          </tr>
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/order_snapshot.php'); ?>
            </td>
          </tr>
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/database_snapshot.php'); ?>
            </td>
          </tr>
        </table>
      </td>
      <td width="50%" align="center">
        <?php include('includes/modules/dashboard/review_checking.php'); ?>
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '1') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=1') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=1') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>

<div id="tabs-2" class="ui-tabs ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td align="center" width="50%">
        <table border="0" cellspacing="0" cellpadding="2" align="center">
          <tr>
            <td><?php include('includes/modules/dashboard/products_viewed.php'); ?></td>
          </tr>
        </table>
      </td>
      <td align="center" width="50%">
        <table border="0" cellspacing="0" cellpadding="2" align="center">
          <tr>
            <td><?php include('includes/modules/dashboard/products_purchased.php'); ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '2') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=2') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=2') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>

<div id="tabs-3" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/admin_logging.php'); ?></td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '3') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=3') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=3') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>

<div id="tabs-4" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/customer_logging.php'); ?></td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '4') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=4') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=4') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>

<div id="tabs-5" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/http_error.php'); ?></td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '5') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=5') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=5') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>

<div id="tabs-6" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/system.php'); ?></td>
    </tr>
  </table>
  <table width="100%">
    <tr valign="top" align="right">
      <?php if (INDEX_TAB == '6') { ?>
      <td class="setasdefault"><?php echo SET_DEFAULT; ?></td><td width="20"><?php echo tep_image(DIR_WS_ICONS . 'star_on.png'); ?></td>
      <?php } else { ?>
      <td class="setasdefault"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=6') . '">' . SET_DEFAULT . '</a>'; ?></td><td width="20"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'setasdefault=6') . '">' . tep_image(DIR_WS_ICONS . 'star_off.png') . '</a>'; ?></td>
      <?php } ?>
    </tr> 
  </table>
</div>


</div>
</td></tr></table>
</table>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
</body>
</html>
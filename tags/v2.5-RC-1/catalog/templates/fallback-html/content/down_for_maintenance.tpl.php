<?php
/*
$Id: down_for_maintenance.tpl.php 1026 2011-01-07 18:18:43Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<table width="100%" border="0" cellspacing="2" cellpadding="1">
  <tr>

<?php 
if (DOWN_FOR_MAINTENANCE == 'true') { 
  $maintenance_on_at_time_raw = tep_db_query("select last_modified from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'DOWN_FOR_MAINTENANCE'"); 
  $maintenance_on_at_time= tep_db_fetch_array($maintenance_on_at_time_raw); 
  define('TEXT_DATE_TIME', $maintenance_on_at_time['last_modified']); 
} 

  $information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE information_id='" . (int)DOWN_FOR_MAINTENANCE_INFO_ID . "' and language_id='" . (int)$languages_id ."'");
  $information = tep_db_fetch_array($information_query);
  $title = stripslashes($information['information_title']);
  $page_description = stripslashes($information['information_description']);
	
  // Added as noticed by infopages module
  if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $page_description)) {
	$page_description = str_replace("\r\n", "<br>\r\n", $page_description); 
  }

  $breadcrumb->add($title, tep_href_link(FILENAME_INFORMATION, 'NONSSL'));
?> 
<!-- body_text //-->
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr> 
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr> 
                <td class="pageHeading"><?php echo $title; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <tr> 
          <td><br>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr> 
                <td class="main"><?php echo $page_description; ?></td>
              </tr>
              <?php if (DISPLAY_MAINTENANCE_TIME == 'true') { ?>
              <tr> 
                <td class="main"><?php echo TEXT_MAINTENANCE_ON_AT_TIME . TEXT_DATE_TIME; ?></td>
              </tr>
              <?php
		  } 
		  if (DISPLAY_MAINTENANCE_PERIOD == 'true') { ?>
              <tr> 
                <td class="main"><?php echo TEXT_MAINTENANCE_PERIOD . TEXT_MAINTENANCE_PERIOD_TIME; ?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr> 
          <td align="right" class="main"><br>
            <?php echo DOWN_FOR_MAINTENANCE_STATUS_TEXT . '<br><br>' . '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
        </tr>
      </table></td>
<!-- body_text_eof //-->
  </tr>
</table>


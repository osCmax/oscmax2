<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	$affiliate_query = tep_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");
	$affiliate = tep_db_fetch_array($affiliate_query);
?>

<?php echo tep_draw_form('affiliate_details', tep_href_link(FILENAME_AFFILIATE_DETAILS, '', 'SSL'), 'post', 'onSubmit="return check_form();"') . tep_draw_hidden_field('action', 'process'); ?>
  <table border="0" width="100%" cellspacing="0" cellpadding="0">
 	<tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td class="productinfo_header">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
	        </tr>
          </table>
     	</td>
  	  </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><?php require(DIR_WS_MODULES . 'affiliate_account_details.php'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>
    </table>
</form>
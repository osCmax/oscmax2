<?php
/*
$Id: administrator.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- administrator //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATOR,
                     'link'  => tep_href_link(FILENAME_ADMIN_MEMBERS, 'set=admin_members&selected_box=administrator'));
//                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=administrator'));

  if ($selected_box == 'administrator') {
    $contents[] = array('text'  => tep_admin_files_boxes(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS, TOP) .
                                   tep_admin_files_boxes(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES, TOP).
                                   tep_admin_files_boxes('merchant_info.php' , 'Merchant Application', TOP).
                                   tep_admin_files_boxes('paypal_info.php' , 'Paypal Signup', TOP).
                                   tep_admin_files_boxes('ssl_info.php' , 'SSL Certificates', TOP).
                                   tep_admin_files_boxes('hosting_info.php' , 'osCMax Hosting', TOP).
                                   tep_admin_files_boxes('domain_info.php' , 'Register Domains', TOP).
                                   tep_admin_files_boxes('affiliate_info.php', 'Affiliate Program', TOP));
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- administrator_eof //-->
<?php
/*
$Id: column_left.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

// BOF: MOD - Admin w/access levels
// OLD LINES:
//  require(DIR_WS_BOXES . 'configuration.php');
//  require(DIR_WS_BOXES . 'catalog.php');
//  require(DIR_WS_BOXES . 'modules.php');
//  require(DIR_WS_BOXES . 'customers.php');
//  require(DIR_WS_BOXES . 'taxes.php');
//  require(DIR_WS_BOXES . 'localization.php');
//  require(DIR_WS_BOXES . 'reports.php');
//  require(DIR_WS_BOXES . 'tools.php');

  if (tep_admin_check_boxes('administrator.php') == true) {
    require(DIR_WS_BOXES . 'administrator.php');
  }
  if (tep_admin_check_boxes('configuration.php') == true) {
    require(DIR_WS_BOXES . 'configuration.php');
  }
  if (tep_admin_check_boxes('catalog.php') == true) {
    require(DIR_WS_BOXES . 'catalog.php');
  }
  if (tep_admin_check_boxes('modules.php') == true) {
    require(DIR_WS_BOXES . 'modules.php');
  }
  if (tep_admin_check_boxes('customers.php') == true) {
    require(DIR_WS_BOXES . 'customers.php');
  }
  if (tep_admin_check_boxes('taxes.php') == true) {
    require(DIR_WS_BOXES . 'taxes.php');
  }
  if (tep_admin_check_boxes('localization.php') == true) {
    require(DIR_WS_BOXES . 'localization.php');
  }
  if (tep_admin_check_boxes('reports.php') == true) {
    require(DIR_WS_BOXES . 'reports.php');
  }
  if (tep_admin_check_boxes('tools.php') == true) {
    require(DIR_WS_BOXES . 'tools.php');
  }
// ADDED: Affiliate
  if (tep_admin_check_boxes('affiliate.php') == true) {
    require(DIR_WS_BOXES . 'affiliate.php');
  }
// ADDED: CREDIT CLASS Gift Voucher Contribution
  if (tep_admin_check_boxes('gv_admin.php') == true) {
    require(DIR_WS_BOXES . 'gv_admin.php');
  }
// ADDED: Infoboxes
  if (tep_admin_check_boxes('info_boxes.php') == true) {
    require(DIR_WS_BOXES . 'info_boxes.php');
  }
// ADDED: Articles
  if (tep_admin_check_boxes('articles.php') == true) {
    require(DIR_WS_BOXES . 'articles.php');
  }
// EOF: MOD - Admin w/access levels
?>
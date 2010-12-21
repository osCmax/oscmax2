<?php
/*
  Copyright (C) 2007 Google Inc.

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * Google Checkout v1.5.0
 * $Id$
 * 
 * TODO(eddavisson): This class is illegible. Refactor.
 */

include_once('includes/application_top.php');
//require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

$products = tep_db_input(implode(',', explode(',', !empty($HTTP_GET_VARS['products_id'])?$HTTP_GET_VARS['products_id']:'-1')));

$product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
$product_check = tep_db_fetch_array($product_check_query);

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GC_RETURN);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_GC_RETURN, '', 'SSL'));
  //$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_GC_RETURN, '', 'SSL'));

  $content = CONTENT_GC_RETURN;
  $javascript = $content . '.js.php';

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
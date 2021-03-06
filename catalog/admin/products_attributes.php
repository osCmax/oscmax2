<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  $languages = tep_get_languages();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $option_page = (isset($_GET['option_page']) && is_numeric($_GET['option_page'])) ? $_GET['option_page'] : 1;
  $value_page = (isset($_GET['value_page']) && is_numeric($_GET['value_page'])) ? $_GET['value_page'] : 1;
  $attribute_page = (isset($_GET['attribute_page']) && is_numeric($_GET['attribute_page'])) ? $_GET['attribute_page'] : 1;

  $page_info = 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page;

  if (tep_not_null($action)) {

    switch ($action) {
		
	  // BOF: Attribute Sort with Clone Tool
	  case 'clone_attributes':
		$clone_product_id_from = $_POST['clone_products_id_from'];
		$clone_product_id_to = $_POST['clone_products_id_to'];
		tep_db_query("delete from ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='".$clone_product_id_to."'");
		$attributes = tep_db_query("select products_id, options_id, options_values_id, options_values_price, price_prefix, weight_prefix, options_values_weight, products_options_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES ." where products_id='".$clone_product_id_from."'");
		while($attributes_values = tep_db_fetch_array($attributes)) {	
          tep_db_query("INSERT INTO " . TABLE_PRODUCTS_ATTRIBUTES . " ( products_id, options_id, options_values_id, options_values_price, price_prefix, weight_prefix, options_values_weight, products_options_sort_order ) VALUES (".$clone_product_id_to.", ".$attributes_values['options_id'].", ".$attributes_values['options_values_id'].", ".$attributes_values['options_values_price'].", '".$attributes_values['price_prefix']."', '".$attributes_values['weight_prefix']."', '".$attributes_values['options_values_weight']."', ".$attributes_values['products_options_sort_order'].")");
		}	
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      // EOF: Attribute Sort with Clone Tool	
		
      case 'add_product_options':
        $products_options_id = tep_db_prepare_input($_POST['products_options_id']);
        $option_name_array = $_POST['option_name'];
		$option_type = $_POST['option_type'];	//clr 030714 update to add option type to products_option
		$option_length = $_POST['option_length'];	//clr 030714 update to add option length to products_option

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);
//BOF: MOD - QT Pro
          $track_stock=isset($_POST['track_stock'])?1:0;
          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id, products_options_track_stock, products_options_type, products_options_length) values ('" . (int)$products_options_id . "', '" . tep_db_input($option_name) . "', '" . (int)$languages[$i]['id'] . "', '" . (int)$track_stock . "', '" . tep_db_input($option_type) . "', '" . tep_db_input($option_length) . "')");
//EOF: MOD - QT Pro
// iii 030811 added:  For TEXT and FILE option types, automatically add 
// PRODUCTS_OPTIONS_VALUE_TEXT to the TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS
        switch ($option_type) {
          case PRODUCTS_OPTIONS_TYPE_TEXT:
          case PRODUCTS_OPTIONS_TYPE_FILE:
            tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_values_id, products_options_id) values ('" . PRODUCTS_OPTIONS_VALUES_TEXT_ID .  "', '" .  (int)$products_options_id .  "')");
            break;
        }
// iii 030811 added:  END
        }
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_product_option_values':
        $value_name_array = $_POST['value_name'];
        $value_id = tep_db_prepare_input($_POST['value_id']);
        $option_id = tep_db_prepare_input($_POST['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$value_id . "', '" . (int)$languages[$i]['id'] . "', '" . tep_db_input($value_name) . "')");
        }

        tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . (int)$option_id . "', '" . (int)$value_id . "')");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_product_attributes':
// iii 030811 added:  For TEXT and FILE option types, ignore option value 
// entered by administrator and use PRODUCTS_OPTIONS_VALUES_TEXT instead.
        $products_options_query = tep_db_query("select products_options_type from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $_POST['options_id'] . "'");
        $products_options_array = tep_db_fetch_array($products_options_query);
        $values_id = tep_db_prepare_input((($products_options_array['products_options_type'] == PRODUCTS_OPTIONS_TYPE_TEXT) or ($products_options_array['products_options_type'] == PRODUCTS_OPTIONS_TYPE_FILE)) ? PRODUCTS_OPTIONS_VALUE_TEXT_ID : $_POST['values_id']);
// iii 030811 added:  END
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $options_id = tep_db_prepare_input($_POST['options_id']);
        $values_id = tep_db_prepare_input($_POST['values_id']);
	$code_suffix = tep_db_prepare_input($_POST['code_suffix']); //Attributes Product-Codes
        $suffix_sort_order = tep_db_prepare_input($_POST['suffix_sort_order']); //Attributes Product-Codes
        $value_price = tep_db_prepare_input($_POST['value_price']);
        $price_prefix = tep_db_prepare_input($_POST['price_prefix']);
// BOF: More Product Weight
        $value_weight = tep_db_prepare_input($_POST['value_weight']);
        $weight_prefix = tep_db_prepare_input($_POST['weight_prefix']);
// EOF: More Product Weight
// BOF: Attribute Sort with Clone Tool
        $products_options_sort_order = tep_db_prepare_input($_POST['products_options_sort_order']);
// EOF: Attribute Sort with Clone Tool

        // tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values (null, '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . tep_db_input($value_price) . "', '" . tep_db_input($price_prefix) . "')");
        // Attributes Product Codes added . tep_db_input($code_suffix) . "', '" . tep_db_input($suffix_sort_order) . "', '" to query
		// Attribute sort order added: tep_db_input($products_options_sort_order)
	tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values ('', '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . tep_db_input($code_suffix) . "', '" . tep_db_input($suffix_sort_order) . "', '" . (float)tep_db_input($value_price) . "', '" . tep_db_input($price_prefix) . "', '" . tep_db_input($weight_prefix) . "', '" . tep_db_input($value_weight) . "', '" . tep_db_input($products_options_sort_order) . "')");
        // END: More Product Weight

        if (DOWNLOAD_ENABLED == 'true') {

          $products_attributes_id = tep_db_insert_id();

          $products_attributes_filename = tep_db_prepare_input($_POST['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($_POST['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($_POST['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . tep_db_input($products_attributes_filename) . "', '" . tep_db_input($products_attributes_maxdays) . "', '" . tep_db_input($products_attributes_maxcount) . "')");
          }
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_option_name':
        $option_name_array = $_POST['option_name'];
        $option_id = tep_db_prepare_input($_POST['option_id']);
        $option_type = $_POST['option_type'];	//clr 030714 update to add option type to products_option
	$option_length = $_POST['option_length'];	//clr 030714 update to add option length to products_option

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);
//BOF: QT Pro
          $track_stock=isset($_POST['track_stock'])?1:0;
          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_track_stock='".(int)$track_stock."', products_options_name = '" . tep_db_input($option_name) . "', products_options_type = '" . $option_type . "', products_options_length = '" . $option_length . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
//          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_track_stock='" . (int)$track_stock . "',products_options_name = '" . tep_db_input($option_name) . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
//EOF: QT Pro
        }
// iii added 030811:  automate insertion or deletion of text option values
        switch ($option_type) {
          case PRODUCTS_OPTIONS_TYPE_TEXT:
          case PRODUCTS_OPTIONS_TYPE_FILE:
//            tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . $_POST['option_id'] . "'"); // disabled because this could cause trouble if someone changed types unintentionally and deleted all their option values.  Shops with small numbers of values per option should consider uncommenting this.
            tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " values (NULL, '" . $_POST['option_id'] . "', '" . PRODUCTS_OPTIONS_VALUES_TEXT_ID . "')");
            break;
          default:
            tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . PRODUCTS_OPTIONS_VALUES_TEXT_ID . "'");
        }
// iii added 030811:  END
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_value':
        $value_name_array = $_POST['value_name'];
        $value_id = tep_db_prepare_input($_POST['value_id']);
        $option_id = tep_db_prepare_input($_POST['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . tep_db_input($value_name) . "' where products_options_values_id = '" . tep_db_input($value_id) . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " set products_options_id = '" . (int)$option_id . "'  where products_options_values_id = '" . (int)$value_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_product_attribute':
// iii 030811 added:  Enforce rule that TEXT and FILE Options use value PRODUCTS_OPTIONS_VALUE_TEXT_ID
        $products_options_query = tep_db_query("select products_options_type from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $_POST['options_id'] . "'");
        $products_options_array = tep_db_fetch_array($products_options_query);
        switch ($products_options_array['products_options_type']) {
          case PRODUCTS_OPTIONS_TYPE_TEXT:
          case PRODUCTS_OPTIONS_TYPE_FILE:
            $values_id = PRODUCTS_OPTIONS_VALUE_TEXT_ID;
            break;
          default: 
        $values_id = tep_db_prepare_input($_POST['values_id']);
}
// iii 030811 added END

        $products_id = tep_db_prepare_input($_POST['products_id']);
        $options_id = tep_db_prepare_input($_POST['options_id']);
//        $values_id = tep_db_prepare_input($_POST['values_id']);
        $code_suffix = tep_db_prepare_input($_POST['code_suffix']); //Attrbutes Product-Codes
        $suffix_sort_order = tep_db_prepare_input($_POST['suffix_sort_order']);
        $value_price = tep_db_prepare_input($_POST['value_price']);
        $price_prefix = tep_db_prepare_input($_POST['price_prefix']);
        $attribute_id = tep_db_prepare_input($_POST['attribute_id']);
// BOF: More Product Weight
        $value_weight = tep_db_prepare_input($_POST['value_weight']);
        $weight_prefix = tep_db_prepare_input($_POST['weight_prefix']);
// EOF: More Product Weight
// BOE: Attribute Sort with Clone Tool
        $products_options_sort_order = tep_db_prepare_input($_POST['products_options_sort_order']);
// EOE: Attribute Sort with Clone Tool

        // tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . (int)$products_id . "', options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', options_values_price = '" . (float)tep_db_input($value_price) . "', price_prefix = '" . tep_db_input($price_prefix) . "' where products_attributes_id = '" . (int)$attribute_id . "'");
        // Attributes Product Codes Added code_suffix = '" . tep_db_input($code_suffix) . "', suffix_sort_order = '" . tep_db_input($suffix_sort_order) . "', to query
	tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . (int)$products_id . "', options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', code_suffix = '" . tep_db_input($code_suffix) . "', suffix_sort_order = '" . tep_db_input($suffix_sort_order) . "',options_values_price = '" . (float)tep_db_input($value_price) . "', price_prefix = '" . tep_db_input($price_prefix) . "', options_values_weight = '" . tep_db_input($value_weight) . "', weight_prefix = '" . tep_db_input($weight_prefix) . "', products_options_sort_order = '" . tep_db_input($products_options_sort_order) . "' where products_attributes_id = '" . (int)$attribute_id . "'");
        // END: More Product Weight

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_filename = tep_db_prepare_input($_POST['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($_POST['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($_POST['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . tep_db_input($products_attributes_filename) . "', products_attributes_maxdays = '" . tep_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . tep_db_input($products_attributes_maxcount) . "'");
          }
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_option':
        $option_id = tep_db_prepare_input($_GET['option_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$option_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_value':
        $value_id = tep_db_prepare_input($_GET['value_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . (int)$value_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_attribute':
        $attribute_id = tep_db_prepare_input($_GET['attribute_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attribute_id . "'");

// added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
    }
  }

//iii 031103 added to get results from database option type query
  $products_options_types_list = array();
  $products_options_types_query = tep_db_query("select products_options_types_id, products_options_types_name from " . TABLE_PRODUCTS_OPTIONS_TYPES . " where language_id='" . (int)$languages_id . "' order by products_options_types_id");
  while ($products_options_type_array = tep_db_fetch_array($products_options_types_query)) {
    $products_options_types_list[$products_options_type_array['products_options_types_id']] = $products_options_type_array['products_options_types_name'];
  }
  
  //CLR 030312 add function to draw pulldown list of option types
// Draw a pulldown for Option Types
//iii 031103 modified to use results of database option type query from above
function draw_optiontype_pulldown($name, $default = '') {
  global $products_options_types_list;
  $values = array();
  foreach ($products_options_types_list as $id => $text) {
    $values[] = array('id' => $id, 'text' => $text);
  }

  return tep_draw_pull_down_menu($name, $values, $default);
}

//CLR 030312 add function to translate type_id to name
// Translate option_type_values to english string
//iii 031103 modified to use results of database option type query from above
function translate_type_to_name($opt_type) {
  global $products_options_types_list;
  return isset($products_options_types_list[$opt_type]) ? $products_options_types_list[$opt_type] : 'Error ' . $opt_type;

}
// iii 031103 added/modified:  END
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript"><!--
function go_option() {
  if (document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value != "none") {
    location = "<?php echo tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . ($_GET['option_page'] ? $_GET['option_page'] : 1)); ?>&option_order_by="+document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value;
  }
}
//--></script>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- options and values//-->
      <tr>
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- options //-->
<?php
  if ($action == 'delete_product_option') { // delete product option
    $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$_GET['option_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);
?>
              <tr>
                <td class="pageHeading">&nbsp;<?php echo $options_values['products_options_name']; ?>&nbsp;</td>
                <td>&nbsp;<?php echo tep_draw_separator('pixel_trans.gif', '1', '53'); ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
    $products = tep_db_query("select p.products_id, pd.products_name, pov.products_options_values_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pov.language_id = '" . (int)$languages_id . "' and pd.language_id = '" . (int)$languages_id . "' and pa.products_id = p.products_id and pa.options_id='" . (int)$_GET['option_id'] . "' and pov.products_options_values_id = pa.options_values_id order by pd.products_name");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
      $rows = 0;
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['products_id']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_name']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_values_name']; ?>&nbsp;</td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
                  <tr>
                    <td colspan="5" class="main"><br><?php echo TEXT_WARNING_OF_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="5" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="5"><br><?php echo TEXT_OK_TO_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="5"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option&option_id=' . $_GET['option_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_delete.gif', ' delete '); ?></a>&nbsp;&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
<?php
  } else {
    if (isset($_GET['option_order_by'])) {
      $option_order_by = $_GET['option_order_by'];
    } else {
      $option_order_by = 'products_options_id';
    }
?>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="5" class="pageHeading">&nbsp;<?php echo HEADING_TITLE_OPT; ?>&nbsp;</td>
                <td align="right"><br><form name="option_order_by" action="<?php echo FILENAME_PRODUCTS_ATTRIBUTES; ?>"><select name="selected" onChange="go_option()"><option value="products_options_id"<?php if ($option_order_by == 'products_options_id') { echo ' SELECTED'; } ?>><?php echo TEXT_OPTION_ID; ?></option><option value="products_options_name"<?php if ($option_order_by == 'products_options_name') { echo ' SELECTED'; } ?>><?php echo TEXT_OPTION_NAME; ?></option></select></form></td>
              </tr>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="5" class="smallText">
<?php
    $options = "select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by " . $option_order_by;
    $options_split = new splitPageResults($option_page, MAX_ROW_LISTS_OPTIONS, $options, $options_query_numrows);

    echo $options_split->display_links($options_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $option_page, 'value_page=' . $value_page . '&amp;attribute_page=' . $attribute_page, 'option_page');
?>
                </td>
              </tr>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="7"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                <!-- CLR 030212 - Add column for option type //-->
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_TYPE; ?>&nbsp;</td>	
		<!-- CLR 030212 - Add column for option length //-->				
    		<td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_LENGTH; ?>&nbsp;</td>	

<?php /* BOF: QT Pro changed "TABLE_HEADING_OPT_TYPE" to "TABLE_HEADING_TRACK_STOCK" */ ?>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_TRACK_STOCK; ?>&nbsp;</td>
<?php /* EOF: QT Pro */ ?>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="7"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $options = tep_db_query($options);
    while ($options_values = tep_db_fetch_array($options)) {
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option') && ($_GET['option_id'] == $options_values['products_options_id'])) {
        echo '<form name="option" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_name&' . $page_info, 'NONSSL') . '" method="post">';
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $option_name = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $options_values['products_options_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
          $option_name = tep_db_fetch_array($option_name);
          $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20" value="' . $option_name['products_options_name'] . '">&nbsp;<br>';
        }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $options_values['products_options_id']; ?><input type="hidden" name="option_id" value="<?php echo $options_values['products_options_id']; ?>">&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td class="smallText"><?php echo draw_optiontype_pulldown('option_type', $options_values['products_options_type']); ?></td>	<!-- CLR 030212 - Add column for option type //-->
                <td class="smallText"><?php echo ' <input type="text" name="option_length" size="4" value="' . $option_name['products_options_length'] . '">'; ?></td>	<!-- CLR 030212 - Add column for option length //-->

<?php /* BOF: QT Pro */ ?>
                <td align="center" class="smallText"><input type=checkbox name=track_stock <?php echo $options_values['products_options_track_stock']?"checked":""; ?> ></td>
<?php /* EOF: QT Pro */ ?>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php
        echo '</form>' . "\n";
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $options_values["products_options_id"]; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $options_values["products_options_name"]; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo translate_type_to_name($options_values["products_options_type"]); ?>&nbsp;</td> <!-- CLR 030212 - Add column for option type //-->
		<td class="smallText">&nbsp;<?php echo $options_values["products_options_length"]; ?>&nbsp;</td>	<!-- CLR 030212 - Add column for option length //-->

<?php /* BOF: QT Pro */ ?>
                <td align="center" class="smallText">&nbsp;<?php echo $options_values['products_options_track_stock']?"Yes":"No"; ?></td>
<?php /* EOF: QT Pro */ ?>
                <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option&option_id=' . $options_values['products_options_id'] . '&option_order_by=' . $option_order_by . '&option_page=' . $option_page, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.gif', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_option&option_id=' . $options_values['products_options_id'], 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.gif', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
      }
?>
              </tr>
<?php
      $max_options_id_query = tep_db_query("select max(products_options_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS);
      $max_options_id_values = tep_db_fetch_array($max_options_id_query);
      $next_id = $max_options_id_values['next_id'];
    }
?>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="7"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    if ($action != 'update_option') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      echo '<form name="options" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_options&' . $page_info, 'NONSSL') . '" method="post"><input type="hidden" name="products_options_id" value="' . $next_id . '">';
      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20">&nbsp;<br>';
      }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
		<td class="smallText"><?php echo draw_optiontype_pulldown('option_type'); ?></td>	<!-- CLR 030212 - Add column for option type //-->
                <td class="smallText"><?php echo ' <input type="text" name="option_length" size="4" value="' . $option_name['products_options_length'] . '">'; ?></td>	<!-- CLR 030212 - Add column for option length //-->

<?php /* BOF: QT Pro */ ?>
                <td align="center" ><input type=checkbox name=track_stock></td>
                <td align="left" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.gif', IMAGE_INSERT); ?>&nbsp;</td>
<?php /* EOF: QT Pro */ ?>
<?php
//++++ QT Pro: End Changed Code
      echo '</form>';
?>
              </tr>
              <tr>
<?php /* MOD: QT Pro Added 1 to colspan */ ?>
                <td colspan="7"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
<!-- options eof //-->
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- value //-->
<?php
  if ($action == 'delete_option_value') { // delete product option value
    $values = tep_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$_GET['value_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);
?>
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;<?php echo $values_values['products_options_values_name']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
    $products = tep_db_query("select p.products_id, pd.products_name, po.products_options_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and po.language_id = '" . (int)$languages_id . "' and pa.products_id = p.products_id and pa.options_values_id='" . (int)$_GET['value_id'] . "' and po.products_options_id = pa.options_id order by pd.products_name");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['products_id']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_name']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_name']; ?>&nbsp;</td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="5"><?php echo tep_black_line(); ?></td>
                  </tr>
                  <tr>
                    <td class="main" colspan="3"><br><?php echo TEXT_WARNING_OF_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="3"><br><?php echo TEXT_OK_TO_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_value&value_id=' . $_GET['value_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_delete.gif', ' delete '); ?></a>&nbsp;&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    }
?>
              	</table></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;<?php echo HEADING_TITLE_VAL; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" class="smallText">
<?php
    $values = "select pov.products_options_values_id, pov.products_options_values_name, pov2po.products_options_id from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po on pov.products_options_values_id = pov2po.products_options_values_id where pov.language_id = '" . (int)$languages_id . "' order by pov.products_options_values_id";
    $values_split = new splitPageResults($value_page, MAX_ROW_LISTS_OPTIONS, $values, $values_query_numrows);

    echo $values_split->display_links($values_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $value_page, 'option_page=' . $option_page . '&attribute_page=' . $attribute_page, 'value_page');
?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $values = tep_db_query($values);
    while ($values_values = tep_db_fetch_array($values)) {
      $options_name = tep_options_name($values_values['products_options_id']);
      $values_name = $values_values['products_options_values_name'];
// iii 030813 added: Option Type Feature and File Uploading
// fetch products_options_id for use if the option value is deleted
// with TEXT and FILE Options, there are multiple options for the single TEXT 
// value and only the single reference should be deleted
      $option_id = $values_values['products_options_id'];
      $values_name = $values_values['products_options_values_name'];
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option_value') && ($_GET['value_id'] == $values_values['products_options_values_id'])) { ?>
		        <td colspan="4"><?php echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_value&amp;' . $page_info, 'NONSSL') . '" method="post">'; ?>
                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
<?php        
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $value_name = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_values['products_options_values_id'] . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $value_name = tep_db_fetch_array($value_name);
          $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15" value="' . $value_name['products_options_values_name'] . '">&nbsp;<br>';
        }
?>
                      <td align="center" class="smallText">&nbsp;<?php echo $values_values['products_options_values_id']; ?><input type="hidden" name="value_id" value="<?php echo $values_values['products_options_values_id']; ?>">&nbsp;</td>
                      <td align="center" class="smallText">&nbsp;<?php echo "\n"; ?><select name="option_id">
<?php
        $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by products_options_name");
        while ($options_values = tep_db_fetch_array($options)) {
          echo "\n" . '<option label="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '"';
          if ($values_values['products_options_id'] == $options_values['products_options_id']) { 
            echo ' selected';
          }
          echo '>' . $options_values['products_options_name'] . '</option>';
        } 
?>
                </select>&nbsp;</td>
                      <td class="smallText"><?php echo $inputs; ?></td>
                      <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
<?php
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values["products_options_values_id"]; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_value&amp;value_id=' . $values_values['products_options_values_id'] . (isset($_GET['value_page']) ? '&amp;value_page=' . $_GET['value_page'] : ''), 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.gif', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option_value&amp;value_id=' . $values_values['products_options_values_id'], 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.gif', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
      }
      $max_values_id_query = tep_db_query("select max(products_options_values_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS_VALUES);
      $max_values_id_values = tep_db_fetch_array($max_values_id_query);
      $next_id = $max_values_id_values['next_id'];
    }
?>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    if ($action != 'update_option_value') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                <td colspan="4"><?php echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_option_values&amp;value_page=' . $value_page, 'NONSSL') . '" method="post">'; ?>
                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                      <td align="center" class="smallText">&nbsp;<select name="option_id">
<?php
      $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while ($options_values = tep_db_fetch_array($options)) {
        echo '<option label="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
      }

      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15">&nbsp;<br>';
      }
?>
                </select>&nbsp;</td>
                      <td class="smallText"><input type="hidden" name="value_id" value="<?php echo $next_id; ?>"><?php echo $inputs; ?></td>
                      <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.gif', IMAGE_INSERT); ?>&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
          </tr>
        </table></td>
<!-- option value eof //-->
      </tr> 
<!-- products_attributes //-->  
      <tr>
        <td class="smallText">&nbsp;</td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE_ATRIB; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
<?php
  if ($action == 'update_attribute') {
    $form_action = 'update_product_attribute';
  } else {
    $form_action = 'add_product_attributes';
  }
?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText" align="right">
<?php
  $attributes = "select pa.* from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pa.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name";
  $attributes_split = new splitPageResults($attribute_page, MAX_ROW_LISTS_OPTIONS, $attributes, $attributes_query_numrows);

  echo $attributes_split->display_links($attributes_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $attribute_page, 'option_page=' . $option_page . '&amp;value_page=' . $value_page, 'attribute_page');
?>
            </td>
          </tr>
        </table>
        <form name="attributes" action="<?php echo tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=' . $form_action . '&amp;' . $page_info); ?>" method="post"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <!-- START: More Product Weight -->
            <!-- <td colspan="7"><?php echo tep_black_line(); ?></td> -->
            <td colspan="13"><?php echo tep_black_line(); ?></td>
            <!-- END: More Product Weight -->
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_SORT_ORDER; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_CODE_SUFFIX; ?>&nbsp;</td> 
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_CODE_ORDER; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE_PREFIX; ?>&nbsp;</td>
            <!-- START: More Product Weight -->
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_OPT_WEIGHT; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_WEIGHT_PREFIX; ?>&nbsp;</td>
            <!-- END: More Product Weight -->
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
          </tr>
          <tr>
            <!-- START: More Product Weight -->
            <!-- <td colspan="7"><?php echo tep_black_line(); ?></td> -->
            <td colspan="13"><?php echo tep_black_line(); ?></td>
            <!-- END: More Product Weight -->
          </tr>
<?php
  $next_id = 1;
  $attributes = tep_db_query($attributes);
  while ($attributes_values = tep_db_fetch_array($attributes)) {
    $products_name_only = tep_get_products_name($attributes_values['products_id']);
    $options_name = tep_options_name($attributes_values['options_id']);
    $values_name = tep_values_name($attributes_values['options_values_id']);
	// BOE: Attribute Sort with Clone Tool
    $products_options_sort_order = tep_attribute_sort($attributes_values['products_attributes_id']);
    // EOE: Attribute Sort with Clone Tool
    $rows++;
?>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
    if (($action == 'update_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values['products_attributes_id']; ?><input type="hidden" name="attribute_id" value="<?php echo $attributes_values['products_attributes_id']; ?>">&nbsp;</td>
            <td class="smallText">&nbsp;<select name="products_id">
<?php
      $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
      while($products_values = tep_db_fetch_array($products)) {
        if ($attributes_values['products_id'] == $products_values['products_id']) {
          echo "\n" . '<option label="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '" SELECTED>' . $products_values['products_name'] . '</option>';
        } else {
          echo "\n" . '<option label="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
      $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option label="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option label="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
      $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id ='" . $languages_id . "' order by products_options_values_name");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option label="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option label="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } 
?>        
            </select>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="products_options_sort_order" value="<?php echo $products_options_sort_order; ?>" size="3">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="code_suffix" value="<?php echo $attributes_values['code_suffix']; ?>" size="10">&nbsp;</td>
	    <!-- START: Attribute Product Codes -->
	    <td align="center" class="smallText">&nbsp;<input type="text" name="suffix_sort_order" value="<?php echo $attributes_values['suffix_sort_order']; ?>" size="2">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" value="<?php echo $attributes_values['options_values_price']; ?>" size="6">&nbsp;</td>
            <!-- END: Attribute Product Codes -->
	    <td align="center" class="smallText">&nbsp;<input type="text" name="price_prefix" value="<?php echo $attributes_values['price_prefix']; ?>" size="1">&nbsp;</td>
            <!-- START: More Product Weight -->
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_weight" value="<?php echo $attributes_values['options_values_weight']; ?>" size="6">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="weight_prefix" value="<?php echo $attributes_values['weight_prefix']; ?>" size="2">&nbsp;</td>
            <!-- END: More Product Weight -->
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&amp;attribute_page=' . $attribute_page, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = tep_db_query($download_query_raw);
        if (tep_db_num_rows($download_query) > 0) {
          $download = tep_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        }
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <!-- START: More Product Weight -->
            <!-- <td colspan="5"> -->
            <td colspan="8">
            <!-- END: More Product Weight -->
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      }
?>
<?php
    } elseif (($action == 'delete_product_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<b><?php echo $attributes_values["products_attributes_id"]; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $products_name_only; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $options_name; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $values_name; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $products_options_sort_order; ?></b>&nbsp;</td>
	    <!-- START: Attribute Product Codes -->
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["code_suffix"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["suffix_sort_order"]; ?></b>&nbsp;</td>
            <!-- END: Attribute Product Codes -->
	    <td align="right" class="smallText">&nbsp;<b><?php echo $attributes_values["options_values_price"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["price_prefix"]; ?></b>&nbsp;</td>
            <!-- START: More Product Weight -->
            <td align="right" class="smallText">&nbsp;<b><?php echo $attributes_values["options_values_weight"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["weight_prefix"]; ?></b>&nbsp;</td>
            <!-- END: More Product Weight -->
            <td align="center" class="smallText">&nbsp;<b><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_attribute&amp;attribute_id=' . $_GET['attribute_id']) . '">'; ?><?php echo tep_image_button('button_confirm.gif', IMAGE_CONFIRM); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&amp;option_page=' . $option_page . '&amp;value_page=' . $value_page . '&amp;attribute_page=' . $attribute_page, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</b></td>
<?php
    } else {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values["products_attributes_id"]; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $products_options_sort_order; ?>&nbsp;</td>
	    <!-- START: Attribute Product Codes -->
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["code_suffix"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["suffix_sort_order"]; ?>&nbsp;</td>
	    <!-- END: Attribute Product Codes -->
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_price"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["price_prefix"]; ?>&nbsp;</td>
            <!-- START: More Product Weight -->
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_weight"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["weight_prefix"]; ?>&nbsp;</td>
            <!-- END: More Product Weight -->
            <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_attribute&amp;attribute_id=' . $attributes_values['products_attributes_id'] . '&amp;attribute_page=' . $attribute_page, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.gif', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_attribute&amp;attribute_id=' . $attributes_values['products_attributes_id'] . '&amp;attribute_page=' . $attribute_page, 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.gif', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
    }
    $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
    $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
    $next_id = $max_attributes_id_values['next_id'];
?>
          </tr>
<?php
  }
  if ($action != 'update_attribute') {
?>
          <tr>
            <!-- START: More Product Weight -->
            <!-- <td colspan="7"><?php echo tep_black_line(); ?></td> -->
            <td colspan="13"><?php echo tep_black_line(); ?></td>
            <!-- END: More Product Weight -->
          </tr>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
            <td class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
      	    <td class="smallText">&nbsp;<select name="products_id">
<?php
    $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
    while ($products_values = tep_db_fetch_array($products)) {
      echo '<option label="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
    $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option label="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
    $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . $languages_id . "' order by products_options_values_name");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option label="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="products_options_sort_order" size="3">&nbsp;</td>
	    <!-- START: Attribute Product Codes -->
            <td align="center" class="smallText">&nbsp;<input type="text" name="code_suffix" size="6">&nbsp;</td>
	    <td align="center" class="smallText">&nbsp;<input type="text" name="suffix_sort_order" size="6">&nbsp;</td>
            <!-- END: Attribute Product Codes -->
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" size="6">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</td>
            <!-- START: More Product Weight -->
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_weight" size="6">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="weight_prefix" size="2" value="+">&nbsp;</td>
            <!-- END: More Product Weight -->
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.gif', IMAGE_INSERT); ?>&nbsp;</td>
          </tr>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
        $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <!-- START: More Product Weight -->
            <!-- <td colspan="5"> -->
            <td colspan="11">
            <!-- END: More Product Weight -->
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      } // end of DOWNLOAD_ENABLED section
?>
<?php
  }
?>
          <tr>
            <!-- START: More Product Weight -->
            <!-- <td colspan="7"><?php echo tep_black_line(); ?></td> -->
            <td colspan="13"><?php echo tep_black_line(); ?></td>
            <!-- END: More Product Weight -->
          </tr>
        </table></form></td>
      </tr>
      
      <!-- BOF: Attribute Sort with Clone Tool //-->
      <tr>
        <td>
     	<?php echo '<form name="clone" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=clone_attributes', 'NONSSL') . '" method="post">'; ?>
          <table>
	      <!-- Data Start -->
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE_CLONE; ?></td>
            </tr>
       	    <tr>
       	      <td class="smallText"><?php echo TABLE_TEXT_FROM; ?>
              <select name="clone_products_id_from">
         	  <?php
  	          $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
       	      while ($products_values = tep_db_fetch_array($products)) {
	            echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
	          }
      	      ?>
	          </select></td>
	          <td class="smallText"><?php echo TABLE_TEXT_TO; ?>
	          <select name="clone_products_id_to">
	          <?php
              $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
              while ($products_values = tep_db_fetch_array($products)) {
                echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
              }
              ?>
              </select></td>
              <td><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
            </tr>
          </table>
        </form></td>
      </tr>	
<!-- EOF: Attribute Sort with Clone Tool //-->

    </table></td>
<!-- products_attributes_eof //-->
  </tr>
</table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

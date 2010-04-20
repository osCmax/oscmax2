<?php
/*
  $Id: admin/discount_categories_groups_pp.php v1.0 2008/08/24 JanZ Exp $
  popup window for QPBPP for Separate Pricing Per Customer
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Copyright (c) 2006
  
  Released under the GNU General Public License 
*/

  require('includes/application_top.php');
  
  function discount_categories_drop_down_pp($discount_categories, $dc_to_be_selected = 0, $customers_group_id) {    
        $return_string = '<select name="pdcID[' . $customers_group_id . ']">';
        $return_string .= '<option value="0" ' . ($dc_to_be_selected == 0 ? " SELECTED" : "") . '>' . TEXT_NONE . '</option>';        
        foreach ($discount_categories as $key => $name) {
          $return_string .= '<option value="' . $key . '"';
          if ($key == $dc_to_be_selected) {
                $return_string .= ' SELECTED';
          }
                $return_string .= '>' . (strlen($name) > 70 ? substr($name, 0, 69) . '...': $name) . '</option>';
        }
        $return_string .= '</select>';
        return $return_string;
  }
	
	if (isset($_POST['submitbutton_x']) || isset($_POST['submitbutton_y'])) { // "save" button pressed
    $pid = (int)$_POST['products_id'];
        foreach ($_POST['pdcID'] as $cgID => $new_discount_category) {
          if (isset($_POST['pdcID_old'][$cgID])) {
            $discount_category_result = qpbpp_insert_update_discount_cats($pid, (int)$_POST['pdcID_old'][$cgID], $new_discount_category, $cgID);
            if ($discount_category_result == false) {
            $messageStack->add(ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY, 'error');
            }
          }
        } // end foreach ($_POST['pdcID'] as $cgID => $new_discount_category)
    $messageStack->add(NUMBER_OF_SAVES . (isset($_POST['no_of_saves']) ? (int)$_POST['no_of_saves']+1 : 0), 'success'); 
	} // end if(isset($_POST['submitbutton_x']) || isset($_POST['submitbutton_y'])) 

  if (!isset($_GET['pID'])) {
	  $messageStack->add(ERROR_NO_PRODUCTS_ID, 'error');
  } elseif (isset($_GET['pID']) && !tep_not_null($_GET['pID'])) {
	  $messageStack->add(ERROR_NO_PRODUCTS_ID, 'error');
  } else {
	  $products_id = (int)$_GET['pID'];
  }	
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php
  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

	if (isset($products_id)) {
	  $customers_groups_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . "  order by customers_group_id");

    while ($_customers_groups = tep_db_fetch_array($customers_groups_query)) {
		  $customers_groups[] = $_customers_groups;
	  }
	  $no_of_customer_groups = count($customers_groups);

// populate array of discount categories for each with dropdowns in products
    $get_discount_categories_query = tep_db_query("select discount_categories_id, discount_categories_name from " . TABLE_DISCOUNT_CATEGORIES . "  order by discount_categories_name");
    $get_discount_categories = array();
    while ($_get_discount_categories = tep_db_fetch_array($get_discount_categories_query)) {
      $get_discount_categories[$_get_discount_categories['discount_categories_id']] = $_get_discount_categories['discount_categories_name'];
    }
		$product_query = tep_db_query("select p.products_id, p.products_model, pd.products_name from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION .  " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = '" . $products_id . "'");
		$product_info = tep_db_fetch_array($product_query);
		
		$prods_to_dc_query = tep_db_query("select discount_categories_id, customers_group_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . $products_id . "' order by customers_group_id");
		while ($_prods_to_discount_cats = tep_db_fetch_array($prods_to_dc_query)) {
		  $prods_to_discount_cats[] = $_prods_to_discount_cats;
		}
?>
<div align="center" style="margin-top: 30px;">
<?php 
echo '<form name="discount_groups_pp" action="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES_GROUPS_PP,'pID=' . $products_id, 'NONSSL') . '"  method="post">' ."\n";
echo tep_draw_hidden_field('products_id', $products_id) . "\n";
  if (isset($_POST['no_of_saves'])) {
	  $noofsaves = (int)$_POST['no_of_saves']+1;
  } else {
    $noofsaves = '0';
	}
echo tep_draw_hidden_field('no_of_saves', $noofsaves) . "\n";
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<table border="0" cellspacing="0" cellpadding="2">
		<tr>
      <td class="pageHeading" colspan="7"><?php echo HEADING_TITLE; ?></td>
		</tr>
    <tr>
      <td colspan="3"><?php echo tep_black_line(); ?></td>
    </tr>
    <tr class="dataTableHeadingRow">
		  <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
		  <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
			<td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_MODEL; ?>&nbsp;</td>
		</tr>
    <tr>
      <td colspan="3"><?php echo tep_black_line(); ?></td>
    </tr>
    <tr class="attributes-even">
		  <td class="smallText">&nbsp;<?php echo $products_id; ?>&nbsp;</td>
		  <td class="smallText">&nbsp;<?php echo $product_info['products_name']; ?>&nbsp;</td>
			<td class="smallText">&nbsp;<?php echo $product_info['products_model']; ?>&nbsp;</td>
		</tr>
    <tr>
      <td style="margin-top: 50px;">&#160;</td>
      <td>&#160;</td>
      <td>&#160;</td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td>
<table border="0" cellspacing="0" cellpadding="2" width="100%">    
    <tr>
      <td colspan="2"><?php echo tep_black_line(); ?></td>
    </tr>
    <tr class="dataTableHeadingRow">
		  <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_GROUP_NAME; ?>&nbsp;</td>
			<td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_DISCOUNT_CATEGORY; ?>&nbsp;</td>
		</tr>
    <tr>
      <td colspan="2"><?php echo tep_black_line(); ?></td>
    </tr>
<?php
	$rows = 0;
	for ($x = 0; $x < $no_of_customer_groups; $x++) {
   $dc_to_be_selected = 0; // if not set for a group this will be --none--
   if (tep_not_null($prods_to_discount_cats)) {
      foreach($prods_to_discount_cats as $ptdc_key => $discount_cat_cg_id) {
        if ($discount_cat_cg_id['customers_group_id'] == $customers_groups[$x]['customers_group_id']) { 
          $dc_to_be_selected = $discount_cat_cg_id['discount_categories_id'];
        }
      }
    } // end if (tep_not_null($prods_to_discount_cats))
		echo '<tr class="' . (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd') . '">' . "\n";
		echo '<td class="smallText">' . $customers_groups[$x]['customers_group_name'] . '</td>' . "\n";
		echo '<td class="smallText">' . tep_draw_hidden_field('pdcID_old[' . $customers_groups[$x]['customers_group_id'] . ']', $dc_to_be_selected) . discount_categories_drop_down_pp($get_discount_categories, $dc_to_be_selected, $customers_groups[$x]['customers_group_id']) . '</td>' . "\n";
		echo '</td>'. "\n";
		$rows++;
		echo '</tr>' . "\n";
	} // end for ($x = 0; $x < $no_of_customer_groups; $x++)
?>
</table>
    </td>
  </tr>
</table>
<?php echo '<p style="margin-top: 20px;">' . tep_image_submit('button_save.gif', IMAGE_SAVE, 'name="submitbutton"') . '&#160;' . tep_image_button('button_cancel.gif', IMAGE_CANCEL, 'onclick=\'self.close()\'') .'</p>' . "\n";
?>
</form>
</div>
<?php
} // end if (isset($products_id))
  else {
    echo '<div align="center" style="margin-top: 50px;">' . "\n" . '<form name="close">' . "\n" . tep_image_button('button_cancel.gif', IMAGE_CLOSE, 'onclick=\'self.close()\'') .'</form>' . "\n" . '</div>' . "\n";
}
?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
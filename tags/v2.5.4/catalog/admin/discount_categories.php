<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
    
  
  if (isset($_GET['row_by_page'])) {
   $row_by_page = (int)$_GET['row_by_page'];
   }
  if (isset($_GET['manufacturer'])) {
   $manufacturer = (int)$_GET['manufacturer'];
  }
  if (isset($_GET['dcID']) && is_numeric($_GET['dcID'])) {
   $dcID = (int)$_GET['dcID'];
  } elseif (isset($_GET['dcID']) && $_GET['dcID'] == 'all') {
   $dcID = 'all';
  }
  if (isset($_GET['cPath'])) {
    $current_category_id = (int)$_GET['cPath'];
  } else {
    $current_category_id = 0;
  }
  if (isset($_GET['cgID']) && is_numeric($_GET['cgID'])) {
    $cgID = (int)$_GET['cgID'];
  } else {
    $cgID = 0; // retail group default for drop-down 
  }

// Displays the list of manufacturers
  function manufacturers_list(){
        global $manufacturer;

        $manufacturers_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name from " . TABLE_MANUFACTURERS . " m order by m.manufacturers_name ASC");
        $return_string = '<select name="manufacturer" onChange="this.form.submit();">';
        $return_string .= '<option value="' . 0 . '">' . TEXT_ALL_MANUFACTURERS . '</option>';
        while($manufacturers = tep_db_fetch_array($manufacturers_query)){
                $return_string .= '<option value="' . $manufacturers['manufacturers_id'] . '"';
                if($manufacturer && $manufacturers['manufacturers_id'] == $manufacturer) $return_string .= ' SELECTED';
                $return_string .= '>' . $manufacturers['manufacturers_name'] . '</option>';
        }
        $return_string .= '</select>';
        return $return_string;
  }

  function discount_categories_list() {
        global $dcID;

        $discount_categories_query = tep_db_query("select * from " . TABLE_DISCOUNT_CATEGORIES . "  order by discount_categories_id");
    
        $return_string = '<select name="dcID" onChange="this.form.submit();">';
        $return_string .= '<option value="all" ' . ($dcID == "all" ? " SELECTED" : "") . '>' . TEXT_ALL_DISCOUNT_CATEGORIES . '</option>';
        $return_string .= '<option value="0" ' . ($dcID == "0" ? " SELECTED" : "") . '>' . TEXT_NONE . '</option>';        
        while ($discount_categories = tep_db_fetch_array($discount_categories_query)) {
                $return_string .= '<option value="' . $discount_categories['discount_categories_id'] . '"';
                if($dcID && $discount_categories['discount_categories_id'] == $dcID) $return_string .= ' SELECTED';
                $return_string .= '>' . (strlen($discount_categories['discount_categories_name']) > 70 ? substr($discount_categories['discount_categories_name'], 0, 69) . '...': $discount_categories['discount_categories_name']) . '</option>';
        }
        $return_string .= '</select>';
        return $return_string;
}

  function discount_categories_drop_down($discount_categories, $p_dcID = 0, $pid) {
    
        $return_string = '<select name="pdcID[' . $pid . ']">';
        $return_string .= '<option value="0" ' . ((int)$p_dcID == 0 ? " SELECTED" : "") . '>' . TEXT_NONE . '</option>';        
        foreach ($discount_categories as $key => $name) {
                $return_string .= '<option value="' . $key . '"';
                if($key == $p_dcID) $return_string .= ' SELECTED';
                $return_string .= '>' . (strlen($name) > 70 ? substr($name, 0, 69) . '...': $name) . '</option>';
        }
        $return_string .= '</select>';
        return $return_string;
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {

      case 'update':
        $error = false;
	      $discount_categories_id = (int)$_GET['dcID'];
		    $discount_categories_name = tep_db_prepare_input($_POST['discount_categories_name']);

        tep_db_query("update " . TABLE_DISCOUNT_CATEGORIES . " set discount_categories_name='" . tep_db_input($discount_categories_name) . "' where discount_categories_id = '" . $discount_categories_id ."'");
        tep_redirect(tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $discount_categories_id));
        break;
        
      case 'deleteconfirm':
        $discount_categories_id = (int)$_GET['dcID'];
        tep_db_query("delete from " . TABLE_DISCOUNT_CATEGORIES . " where discount_categories_id = '" . $discount_categories_id ."'");
        tep_db_query("delete from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where discount_categories_id = '" . $discount_categories_id ."'");   
        tep_redirect(tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')))); 
        break;
        
      case 'newconfirm' :
        $discount_categories_name = tep_db_prepare_input($_POST['discount_categories_name']);

        $last_id_query = tep_db_query("select MAX(discount_categories_id) as last_dc_id from " . TABLE_DISCOUNT_CATEGORIES . "");
        $last_dc_id_inserted = tep_db_fetch_array($last_id_query);
        $new_dc_id = $last_dc_id_inserted['last_dc_id'] +1;
        tep_db_query("insert into " . TABLE_DISCOUNT_CATEGORIES . " set discount_categories_id = '" . $new_dc_id . "', discount_categories_name = '" . tep_db_input($discount_categories_name) . "'");
        tep_redirect(tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action'))));
        break;
    }
  }
  
  $do = (isset($_GET['do']) ? $_GET['do'] : '');
  
  if (tep_not_null($do)) {
    switch ($do) {

      case 'update':
        foreach ($_POST['pdcID'] as $pid => $new_discount_category) {
          if (isset($_POST['pdcID_old'][$pid])) {
            $discount_category_result = qpbpp_insert_update_discount_cats($pid, (int)$_POST['pdcID_old'][$pid], $new_discount_category, $cgID);
            if ($discount_category_result == false) {
            $messageStack->add(ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY, 'error');
            }
          }
        } // end foreach ($_POST['pdcID'] as $pid => $new_discount_category)
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script language="javascript" type="text/javascript" src="includes/general.js"></script>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  if ($_GET['action'] == 'edit') {
    $discount_categories_query = tep_db_query("select * from " . TABLE_DISCOUNT_CATEGORIES . "  where discount_categories_id = '" . $_GET['dcID'] . "'");
    $discount_categories = tep_db_fetch_array($discount_categories_query);
    $cInfo = new objectInfo($discount_categories);
?>

<script language="javascript" type="text/javascript"><!--
function check_form() {
  var error = 0;

  var discount_categories_name = document.discount_categories.discount_categories_name.value;
  
  if (discount_categories_name == "") {
    error_message = "<?php echo ERROR_DISCOUNT_CATEGORIES_NAME; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

	  <tr><?php echo tep_draw_form('discount_categories', FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action')) . 'action=update', 'post', 'onsubmit="return check_form();"'); ?>
        <td class="main"><?php echo ENTRY_DISCOUNT_CATEGORIES_NAME; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo TABLE_HEADING_DISCOUNT_CATEGORIES_ID; ?></td>
            <td class="main"><?php echo '<b>' . TABLE_HEADING_DISCOUNT_CATEGORIES_NAME . '</b>' . ENTRY_DISCOUNT_CATEGORIES_NAME_MAX_LENGTH; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo '<b>' . $cInfo->discount_categories_id . '</b>'; ?></td>
            <td class="main"><?php echo tep_draw_input_field('discount_categories_name', $cInfo->discount_categories_name, 'maxlength="255" size="70"', false); ?></td>
          </tr>
       </table></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;" align="right" class="main"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action','dcID'))) .'">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form>

	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '70'); ?></td>
      </tr>

<?php
  } elseif ($_GET['action'] == 'new') {   
?>
<script language="javascript" type="text/javascript"><!--
function check_form() {
  var error = 0;

  var discount_categories_name = document.discount_categories.discount_categories_name.value;
  
  if (discount_categories_name == "") {
    error_message = "<?php echo ERROR_DISCOUNT_CATEGORIES_NAME; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('discount_categories', FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action')) . 'action=newconfirm', 'post', 'onsubmit="return check_form();"'); ?>
        <td class="main"><?php echo HEADING_TITLE_NEW_DISCOUNT_CATEGORIES_NAME; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo '<b>' . TABLE_HEADING_NEW_DISCOUNT_CATEGORIES_NAME . '</b>' . ENTRY_DISCOUNT_CATEGORIES_NAME_MAX_LENGTH; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_draw_input_field('discount_categories_name', '', 'maxlength="255" size="70"', false); ?></td>
          </tr>
       </table></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;" align="right" class="main"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action','dcID'))) .'">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form>
<?php 
  } elseif ($_GET['action'] == 'show_products') {  // end action=new

  $customers_groups_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
  while ($customers_groups_results =  tep_db_fetch_array($customers_groups_query)) {
    $customers_group_array[] = array("id" => $customers_groups_results['customers_group_id'], "text" => "&#160;" . $customers_groups_results['customers_group_name'] . "&#160;");
  }
  
 ($row_by_page) ? define('MAX_DISPLAY_ROW_BY_PAGE' , $row_by_page ) : $row_by_page = MAX_DISPLAY_SEARCH_RESULTS; define('MAX_DISPLAY_ROW_BY_PAGE' , MAX_DISPLAY_SEARCH_RESULTS );
  
// define the steps for the dropdown menu max rows per page
   for ($i = 10; $i <= 100 ; $i = $i+5) {
     if ($row_by_page < 10 && $i == 10) {
       $row_bypage_array[] = array('id' => $row_by_page, 'text' => $row_by_page);
     }
      $row_bypage_array[] = array('id' => $i, 'text' => $i);
     if ($row_by_page > 10 && $row_by_page%5 !== 0) {
       if (($i < $row_by_page) && ($i+5 > $row_by_page)) {
         $row_bypage_array[] = array('id' => $row_by_page, 'text' => $row_by_page);
       }
     }    
   } // end for ($i = 10; $i <= 100 ; $i = $i+5)

// populate array of discount categories for each with dropdowns in products
  $get_discount_categories_query = tep_db_query("select discount_categories_id, discount_categories_name from " . TABLE_DISCOUNT_CATEGORIES . "  order by discount_categories_name");
  $get_discount_categories = array();
  while ($_get_discount_categories = tep_db_fetch_array($get_discount_categories_query)) {
    $get_discount_categories[$_get_discount_categories['discount_categories_id']] = $_get_discount_categories['discount_categories_name'];
  }
?>
      <tr style="margin-bottom: 10px">
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_PRODUCTS_TO_DISCOUNT_CATEGORIES; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr class="formArea" align="center" style="margin-top: 6px; margin-bottom: 6px;">
          <td class="smallText" style="padding-left: 2px; padding-right: 2px; padding-top: 6px; padding-bottom: 6px; border-left: 1px solid #7b9ebd; border-top: 1px solid #7b9ebd"><?php echo TABLE_HEADING_CUSTOMERS_GROUPS; ?></td>
          <td class="smallText" style="border-top: 1px solid #7b9ebd"><?php echo TEXT_MAXI_ROW_BY_PAGE; ?></td>
          <td class="smallText" style="border-top: 1px solid #7b9ebd"><?php echo DISPLAY_CATEGORIES; ?></td>
          <td class="smallText" style="border-top: 1px solid #7b9ebd"><?php echo DISPLAY_MANUFACTURERS; ?></td>
          <td class="smallText" style="border-top: 1px solid #7b9ebd; border-right: 1px solid #7b9ebd"><?php echo DISPLAY_DISCOUNT_CATEGORIES; ?></td>         
        </tr>
<tr class="formArea" align="center">
  <td class="smallText" style="border-left: 1px solid #7b9ebd"><?php echo tep_draw_form('customer_group', FILENAME_DISCOUNT_CATEGORIES, '', 'get'); 
  echo tep_draw_hidden_field( 'action', 'show_products');
  echo tep_draw_hidden_field( 'dcID', $dcID);
  echo tep_draw_hidden_field( 'row_by_page', $row_by_page); 
  echo tep_draw_hidden_field( 'manufacturer', $manufacturer); 
  echo tep_draw_hidden_field( 'cPath', $current_category_id) . tep_draw_pull_down_menu('cgID', $customers_group_array, $cgID, 'onChange="this.form.submit();"'); ?></form></td>
  <td class="smallText" align="center" valign="top"><?php echo tep_draw_form('row_by_page', FILENAME_DISCOUNT_CATEGORIES, '', 'get'); 
  echo tep_draw_hidden_field( 'action', 'show_products');
  echo tep_draw_hidden_field( 'cgID', $cgID);
  echo tep_draw_hidden_field( 'dcID', $dcID);
  echo tep_draw_hidden_field( 'manufacturer', $manufacturer); 
  echo tep_draw_hidden_field( 'cPath', $current_category_id) . tep_draw_pull_down_menu('row_by_page', $row_bypage_array, $row_by_page, 'onChange="this.form.submit();"'); ?></form></td>
   <td class="smallText" align="center" valign="top"><?php echo tep_draw_form('categorie', FILENAME_DISCOUNT_CATEGORIES, '', 'get');
   echo tep_draw_hidden_field( 'action', 'show_products');
   echo tep_draw_hidden_field( 'cgID', $cgID);
   echo tep_draw_hidden_field( 'dcID', $dcID);
   echo tep_draw_hidden_field( 'row_by_page', $row_by_page); 
   echo tep_draw_hidden_field( 'manufacturer', $manufacturer);
   echo tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"'); ?></form></td>
  <td class="smallText" align="center" valign="top"><?php echo tep_draw_form('manufacturers', FILENAME_DISCOUNT_CATEGORIES, '', 'get'); 
  echo tep_draw_hidden_field( 'action', 'show_products');
  echo tep_draw_hidden_field( 'cgID', $cgID);
  echo tep_draw_hidden_field( 'dcID', $dcID);
  echo tep_draw_hidden_field( 'row_by_page', $row_by_page); 
  echo tep_draw_hidden_field( 'cPath', $current_category_id); 
  echo manufacturers_list(); ?></form></td>
  <td class="smallText" align="center" valign="top" style="border-right: 1px solid #7b9ebd;"><?php echo tep_draw_form('discount_categorie', FILENAME_DISCOUNT_CATEGORIES, '', 'get');
  echo tep_draw_hidden_field( 'action', 'show_products');
  echo tep_draw_hidden_field( 'cgID', $cgID);
  echo tep_draw_hidden_field( 'row_by_page', $row_by_page);
  echo tep_draw_hidden_field( 'manufacturer', $manufacturer);
  echo tep_draw_hidden_field( 'cPath', $current_category_id); 
  echo discount_categories_list(); ?></form></td>
    </tr>
    <tr class="formArea"><td colspan="5" style="border-left: 1px solid #7b9ebd; border-right: 1px solid #7b9ebd; border-bottom: 1px solid #7b9ebd"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td></tr>
       </table>
     </td>
   </tr>
<?php  // control rows per page
     $split_page = (int)$_GET['page'];
     if ($split_page > 1) $rows = $split_page * MAX_DISPLAY_ROW_BY_PAGE - MAX_DISPLAY_ROW_BY_PAGE;

//  select customers_group_id ($cgID)
//  $select_cgID = " and ptdc.customers_group_id = '" . (int)$cgID . "' ";

//  select categories
  if (is_int($dcID) && $dcID > 0) {
    $select_dcID = " and ptdc.discount_categories_id = '" . $dcID . "' ";
  } elseif (is_int($dcID) && $dcID == 0) {
     $select_dcID = " and ptdc.discount_categories_id IS NULL ";
  } elseif ($dcID == "all") {
     $select_dcID = " "; // all discount categories
  }

// control string sort page
  if (isset($_GET['sort_by']) && !ereg('order by', $_GET['sort_by'])) {
          switch ($_GET['sort_by']) {
              case "pid":
              $order = " order by p.products_id";
              break;
              case "pid-desc":
              $order = " order by p.products_id DESC";
              break;
              case "model":
              $order = " order by p.products_model";
              break;
              case "model-desc":
              $order = " order by p.products_model DESC";
              break;
              case "name":
              $order = " order by pd.products_name";
              break;
              case "name-desc":
              $order = " order by pd.products_name DESC";
              break;
              default:
              $order = " order by p.products_id";
          }
  }

  if ($current_category_id == 0) {
          if($manufacturer != 0){
            $products_query_raw = "select p.products_id, p.products_model, pd.products_name, p.products_status, p.manufacturers_id, ptdc.discount_categories_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION .  " pd left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '". $cgID . "') as ptdc using(products_id) where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . $manufacturer . "' $select_dcID $order";
          } else {
            $products_query_raw = "select p.products_id, p.products_model, pd.products_name, p.products_status, p.manufacturers_id, ptdc.discount_categories_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION .  " pd left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '". $cgID . "') as ptdc using(products_id) where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' $select_dcID $order";
        }
  } // end if ($current_category_id == 0)
  else {
         if ($manufacturer != 0) {
                 $products_query_raw = "select p.products_id, p.products_model, pd.products_name, p.products_status, p.manufacturers_id, ptdc.discount_categories_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION .  " pd left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '". $cgID . "') as ptdc using(products_id), " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = pc.products_id and pc.categories_id = '" . $current_category_id . "' and p.manufacturers_id = '" . $manufacturer . "' $select_dcID $order";
          } else {
                $products_query_raw = "select p.products_id, p.products_image, p.products_model, pd.products_name, p.products_status, p.manufacturers_id, ptdc.discount_categories_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION .  " pd left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '". $cgID . "') as ptdc using(products_id), " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = pc.products_id and pc.categories_id = '" . $current_category_id . "' $select_dcID $order";
        }
  }

//// page splitter and display each products info
  $products_split = new splitPageResults($split_page, MAX_DISPLAY_ROW_BY_PAGE, $products_query_raw, $products_query_numrows);
  $products_query = tep_db_query($products_query_raw);

  if ($products_query_numrows > 0) {
?>
<!-- table products to discount categories -->
      <tr>
        <td valign="top"><?php echo tep_draw_form('ptodcats', FILENAME_DISCOUNT_CATEGORIES, 'page=' . $split_page . '&amp;row_by_page=' . $row_by_page . '&amp;manufacturer=' . $manufacturer . '&amp;cgID=' . $cgID . '&amp;dcID=' . $dcID . '&amp;action=show_products&amp;cPath=' . $current_category_id . '&amp;do=update', 'post') . "\n"; ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by','do')) . 'sort_by=pid'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_up.gif', SORT_BY_PRODUCTS_ID_ASC); ?></a>&nbsp;<a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by','do')) . 'sort_by=pid-desc'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_down.gif', SORT_BY_PRODUCTS_ID_DESC); ?></a><br><?php echo TABLE_HEADING_PRODUCTS_ID; ?></td>
            <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by','do')) . 'sort_by=model'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_up.gif', SORT_BY_PRODUCTS_MODEL_ASC); ?></a>&nbsp;<a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by')) . 'sort_by=model-desc'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_down.gif', SORT_BY_PRODUCTS_MODEL_DESC); ?></a><br><?php echo TABLE_HEADING_MODEL; ?></td>
            <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by','do')) . 'sort_by=name'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_up.gif', SORT_BY_PRODUCTS_NAME_ASC); ?></a>&nbsp;<a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('sort_by','do')) . 'sort_by=name-desc'); ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_down.gif', SORT_BY_PRODUCTS_NAME_DESC); ?></a><br><?php echo TABLE_HEADING_NAME; ?></td>
            <td class="dataTableHeadingContent" align="center" valign="bottom"><?php echo TABLE_HEADING_STATUS; ?></td>
            <td class="dataTableHeadingContent" valign="bottom"><?php echo TABLE_HEADING_DISCOUNT_CATEGORY; ?></td>
            <td class="dataTableHeadingContent" valign="bottom"><?php echo TABLE_HEADING_ACTION; ?></td>
          </tr>

<?php 
 while ($products = tep_db_fetch_array($products_query)) {
   echo '        <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
   echo '         <td class="dataTableContent">' . $products['products_id'] . tep_draw_hidden_field('pdcID_old['. $products['products_id'] .']', (int)$products['discount_categories_id']) . '</td>' . "\n";
   echo '         <td class="dataTableContent">' . $products['products_model'] . '</td>' . "\n";
   echo '         <td class="dataTableContent">' . $products['products_name'] . '</td>' . "\n";
   echo '         <td class="dataTableContent" align="center">';
   if ($products['products_status'] == '1') {
        echo tep_image(DIR_WS_ICONS .  'icon_status_green.gif', DC_ICON_STATUS_GREEN_LIGHT, 10, 10);
      } else {
        echo tep_image(DIR_WS_ICONS . 'icon_status_red.gif', DC_ICON_STATUS_RED_LIGHT, 10, 10);
      }
   echo '</td>' . "\n";
   echo '         <td class="dataTableContent">' . discount_categories_drop_down($get_discount_categories, $products['discount_categories_id'], $products['products_id']) . '</td>' . "\n";
	 echo '         <td class="dataTableContent" align="right"><a href="javascript:void(0)" onmouseover="window.status=\'' . TEXT_MOUSE_OVER_DISCOUNT_GROUPS_PER_GROUP_POPUP . '\';return true;" onmouseout="window.status=\'\'; return true;" onclick="window.open(\'' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES_GROUPS_PP, 'pID=' . $products['products_id'], 'NONSSL') . '\',\'' . NAME_WINDOW_DISCOUNT_GROUPS_PER_GROUP_POPUP . '\',\'menubar=yes,resizable=yes,scrollbars=yes,status=no,location=no,width=500,height=350\');return false">' . tep_image(DIR_WS_ICONS . 'icon_popup.gif', TEXT_IMAGE_EDIT_GROUP_DISCOUNT_CATEGORIES) . '</a>' . tep_draw_separator('pixel_trans.gif', 16, 16) .'<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=new_product') . '">' . tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', TEXT_IMAGE_SWITCH_EDIT) . '</a></td>' . "\n";
   echo '        </tr>' . "\n";
 } // end while ($products = tep_db_fetch_array($products_query))
?>
      <tr>
        <td colspan="3" align="left" style="padding-top: 6px;" class="smallText"><a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES) . '">';
        echo TEXT_BACK_TO_DISCOUNT_CATEGORIES; ?></a></td>
        <td colspan="3" align="right" style="padding-top: 6px;">
<?php
// display bottom page buttons
              echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
              echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('action','do','x','y')) . 'action=show_products') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
?></td>
      </tr>
        </table>
       </form></td>
      </tr><!-- end table products to discount categories/begin navigation to other result pages -->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
             <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, $split_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS);  ?></td>
                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, MAX_DISPLAY_PAGE_LINKS, $split_page, tep_get_all_get_params(array('page', 'do', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
       </tr>
<?php
  } else { // end if ($products_query_numrows > 0) 
?>
	  <tr>
      <td class="main" style="margin-top: 6px;"><?php echo TEXT_NO_PRODUCTS; ?></td>     
    </tr>
	  <tr>
      <td style="padding-top: 20px;" class="smallText"><a href="<?php echo tep_href_link(FILENAME_DISCOUNT_CATEGORIES) . '">';
        echo TEXT_BACK_TO_DISCOUNT_CATEGORIES; ?></a></td>
     </tr>     
<?php     
  } // if/else ($products_query_numrows > 0) 
  } else { // end action=show_products
?>

      <tr>
        <td><?php echo tep_draw_form('search', FILENAME_DISCOUNT_CATEGORIES, '', 'get'); ?>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
              <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?></td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>

          <?php
          switch ($_GET['listing']) {
              case "dc":
              $order = "dc.discount_categories_name";
              break;
              case "dc-desc":
              $order = "dc.discount_categories_name DESC";
              break;
              case "id":
              $order = "dc.discount_categories_id";
              break;
              case "id-desc":
              $order = "dc.discount_categories_id DESC";
              break;
              default:
              $order = "dc.discount_categories_name ASC";
          }
          ?>
	    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
               <tr class="dataTableHeadingRow">
	       <td class="dataTableHeadingContent" width="10%"><a href="<?php echo basename($_SERVER['PHP_SELF']) . '?listing=id'; ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_up.gif', ' Sort ' . TABLE_HEADING_ID . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo basename($_SERVER['PHP_SELF']) . '?listing=id-desc'; ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_down.gif', ' Sort ' . TABLE_HEADING_ID . ' --> 3-2-1 From Top '); ?></a><br><?php echo TABLE_HEADING_ID; ?></td>
	       <td class="dataTableHeadingContent"><a href="<?php echo basename($_SERVER['PHP_SELF']) . '?listing=dc'; ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_up.gif', ' Sort ' . TABLE_HEADING_NAME . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo basename($_SERVER['PHP_SELF']) . '?listing=dc-desc'; ?>"><?php echo tep_image(DIR_WS_ICONS . 'ic_down.gif', ' Sort ' . TABLE_HEADING_NAME . ' --> Z-X-Y From Top '); ?></a><br><?php echo TABLE_HEADING_NAME; ?></td>
				   <td class="dataTableHeadingContent" align="right" valign="bottom"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
			   </tr>

<?php
    $search = '';
    if ( ($_GET['search']) && (tep_not_null($_GET['search'])) ) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      $search = "where dc.discount_categories_name like '%" . $keywords . "%'";
    }

    $discount_categories_query_raw = "select dc.discount_categories_id, dc.discount_categories_name from " . TABLE_DISCOUNT_CATEGORIES . " dc  " . $search . " order by $order";
    $discount_categories_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $discount_categories_query_raw, $discount_categories_query_numrows);
    $discount_categories_query = tep_db_query($discount_categories_query_raw);

    while ($discount_categories = tep_db_fetch_array($discount_categories_query)) {
      if ((!isset($_GET['dcID']) || (@$_GET['dcID'] == $discount_categories['discount_categories_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($discount_categories);
      }

      if ( (is_object($cInfo)) && ($discount_categories['discount_categories_id'] == $cInfo->discount_categories_id) ) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $cInfo->discount_categories_id . '&amp;action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID')) . 'dcID=' . $discount_categories['discount_categories_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $discount_categories['discount_categories_id']; ?></td>
                <td class="dataTableContent"><?php echo $discount_categories['discount_categories_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($discount_categories['discount_categories_id'] == $cInfo->discount_categories_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID')) . 'dcID=' . $discount_categories['discount_categories_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    } // end while ($discount_categories = tep_db_fetch_array($discount_categories_query)) 
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $discount_categories_split->display_count($discount_categories_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES); ?></td>
                    <td class="smallText" align="right"><?php echo $discount_categories_split->display_links($discount_categories_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'dcID'))); ?></td>
                  </tr>
<?php
    if (tep_not_null($_GET['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES) . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    } else {
?>
			      <tr>
                    <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php
	}
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'confirm':
        if ($_GET['dcID'] != '0') {
            $heading[] = array('text' => ''. tep_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br><b>' . TEXT_INFO_HEADING_DELETE_DISCOUNT_CATEGORY . '</b>');
            $contents = array('form' => tep_draw_form('discount_categories', FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $cInfo->discount_categories_id . '&amp;action=deleteconfirm'));
            $contents[] = array('text' => TEXT_DELETE_INTRO . '<br><br><b>' . $cInfo->discount_categories_name . ' </b>');
        /*    if ($cInfo->number_of_reviews > 0) $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('delete_reviews', 'on', true) . ' ' . sprintf(TEXT_DELETE_REVIEWS, $cInfo->number_of_reviews)); */
            $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $cInfo->discount_categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        } else {
            $heading[] = array('text' => ''. tep_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br><b>' . TEXT_INFO_HEADING_DELETE_DISCOUNT_CATEGORY . '</b>');
            $contents[] = array('text' => ERROR_DISCOUNT_CATEGORIES_ID . '<br><br><b>' . $cInfo->discount_categories_name . ' </b>');
        }
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => ''. tep_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br><b>' . $cInfo->discount_categories_name . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $cInfo->discount_categories_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action')) . 'dcID=' . $cInfo->discount_categories_id . '&amp;action=confirm') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, tep_get_all_get_params(array('dcID', 'action', 'page')) . 'dcID=' . $cInfo->discount_categories_id . '&amp;action=show_products') . '">' . tep_image_button('button_show_products.gif', IMAGE_SHOW_PRODUCTS) . '</a>');

      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
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
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
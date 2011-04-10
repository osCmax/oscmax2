<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  switch($_GET['action']) {
    case 'update_cross' :
	if ($_POST['product']) {
      foreach ($_POST['product'] as $temp_prod){
        tep_db_query('delete from ' . TABLE_PRODUCTS_XSELL . ' where xsell_id = "'.$temp_prod.'" and products_id = "'.$_GET['add_related_product_ID'].'"');
        tep_db_query('delete from ' . TABLE_PRODUCTS_XSELL . ' where xsell_id = "'.$_GET['add_related_product_ID'].'" and products_id = "'.$temp_prod.'"');		  
      }
    }

    if ($_POST['cross']) {
      foreach ($_POST['cross'] as $temp) {
        $insert_array = array();
        $insert_array = array('products_id' => $_GET['add_related_product_ID'],
                              'xsell_id' => $temp);
        tep_db_perform(TABLE_PRODUCTS_XSELL, $insert_array);
      } // foreach $temp
    } // if cross

    // insert reciprocable x-sell products BOF
    if ($_POST['reciprocal_link_cross']){
      foreach ($_POST['reciprocal_link_cross'] as $temp2) {
        $insert_array = array();
        $insert_array = array('products_id' => $temp2,
                              'xsell_id' => $_GET['add_related_product_ID']);
        tep_db_perform(TABLE_PRODUCTS_XSELL, $insert_array);
      } // foreach $temp2
    } // if reciprocal_link_cross
	// insert reciprocable x-sell products EOF
    
	if ($_POST['option']) {
      $products_options = $_POST['option'];
	  
      $xsell_id = $_POST['product'];
	  $xsell_id2 = array_unique($xsell_id);
	  $xsell_id3 = array_values($xsell_id2);
	  
		for ($i=0;$i<sizeof($products_options);$i++) {
		  tep_db_query('update ' . TABLE_PRODUCTS_XSELL . ' set sort_order = "' . $products_options[$i] . '" where xsell_id = "' . $xsell_id3[$i]  . '"');
		} // end for
	} // end if ($_POST['option'])

    // Cache
    $cachedir = DIR_FS_CACHE_XSELL . $_GET['add_related_product_ID'];
      if(is_dir($cachedir)) {
        rdel($cachedir);
      } // end if

  	// tep_redirect(tep_href_link(FILENAME_XSELL_PRODUCTS));
	  $messageStack->add(SORT_CROSS_SELL_SUCCESS, 'success');
  
  break;
  } // end switch($_GET['action'])
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
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="100%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" class="pageHeading">
		    <table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
			    <td><?php echo HEADING_TITLE; ?></td>
                <td align="right" class="smallText">
                
                <?php
				// Check if we are editing a cross sell - if so hide the form
				if ( (!isset($_GET['sort'])) && (!isset($_GET['add_related_product_ID'])) ) {
				
				  // PGM adds cross sell filter
				  $action_filter[0] = array('id' => 'all',
                                            'text' => TEXT_ALL_PRODUCTS);
				  $action_filter[1] = array('id' => 'edit_xsell',
                                            'text' => TEXT_PRODUCTS_WITH);
		  	      $action_filter[2] = array('id' => 'new_xsell',
                                            'text' => TEXT_PRODUCTS_WITHOUT);
								  
				  echo tep_draw_form('action', FILENAME_XSELL_PRODUCTS, '', 'get');
                  echo TEXT_FILTER_XSELL . tep_draw_pull_down_menu('action', $action_filter, '', 'onChange="this.form.submit();"');
                  echo tep_hide_session_id() . '</form>';
				
				
                  // PGM adds category filter
                  echo tep_draw_form('category_', FILENAME_XSELL_PRODUCTS, '', 'get');
                  echo '&nbsp;&nbsp;' . TEXT_CATEGORY_XSELL . tep_draw_pull_down_menu('category', tep_get_category_tree(), '', 'onChange="this.form.submit();"');
                  echo tep_hide_session_id() . '</form>';
                                
				  // PGM adds Search functionality to xSell
                  echo tep_draw_form('search', FILENAME_XSELL_PRODUCTS, '', 'get');
                  echo '&nbsp;&nbsp;' . TEXT_SEARCH_XSELL . ' ' . tep_draw_input_field('search');
                  echo '</form>';
                               
                  echo '&nbsp;&nbsp;<td align="right" width="10"><a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS) . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a></td>';
				} // end if ( (!isset($_GET['sort'])) && (!isset($_GET['add_related_product_ID'])) )
                                
                if ( (isset($_GET['category'])) && ($_GET['category'] != 0) ) {
                  $category_filter =  " and p2c.categories_id = '" . (int)$_GET['category'] . "'";
                } else {
                  $category_filter = "";
                }
                                
                if (isset($_GET['search'])) { 
                  $search_string = " and ((pd.products_name like '%" . tep_db_prepare_input($_GET['search']) . "%') or (p.products_model like '%" . tep_db_prepare_input($_GET['search']) . "%'))"; 
                } else { 
                  $search_string = "";
                }
                ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
	    <tr>
	      <td align="left">
 		
<?php
  if (isset($_GET['add_related_product_ID'])) { 
    if (isset($_GET['sort'])) {
	  $products_name_query = tep_db_query('select pd.products_name, p.products_model, p.products_image, p.products_price from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"');
	  $products_name = tep_db_fetch_array($products_name_query);
	
	  if ($products_name['products_model'] == NULL) {
	    $products_model = TEXT_NONE;
	  } else {
	    $products_model = $products_name['products_model'];
	  } // end if ($products_name['products_model'] == NULL)
?>
        
		    <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr class="dataTableHeadingRow" style="line-height:25px;">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TEXT_EDITTING_SELLS . $products_name['products_name']; ?></td>
              </tr>
		      <tr>
			    <td><?php echo tep_draw_form('update_cross', FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'action=update_cross', 'post');?>
				  <table cellpadding="1" cellspacing="1" border="0" width="100%">
				    <tr>
				      <td colspan="7">
                        <table cellpadding="3" cellspacing="0" border="0" width="100%">
				          <tr class="dataTableHeadingRow">
				            <td valign="middle" align="left" width="<?php echo SMALL_IMAGE_WIDTH; ?>"><?php echo tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '/'.$products_name['products_image'], "", SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);?></td>
					        <td valign="top" align="left"><span class="main"><?php echo $products_name['products_name'].' <br>('.TEXT_MODEL.': '.$products_model.')<br>('.TEXT_PRODUCT_ID.': '.$_GET['add_related_product_ID'].')';?></span></td>
					        <td valign="middle" align="center" width="10"><?php echo tep_image_submit('button_update.gif')?>&nbsp;&nbsp;<?php echo '<a href="'.tep_href_link(FILENAME_XSELL_PRODUCTS).'">' . tep_image_button('button_cancel.gif') . '</a>'; ?></td>
				          </tr>
				        </table>
                      </td>
				    </tr>
			        <tr class="dataTableHeadingRow">
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
				      <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_SORT;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_CROSS_SELL_THIS;?>&nbsp;</td>
				    </tr>
		<?php
			$products_query_raw = 'select distinct p.products_id as products_id, p.products_price, p.products_image, p.products_model, pd.products_name, x.products_id as xproducts_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" group by p.products_id order by x.sort_order asc';
			$products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
		      $sort_order_drop_array = array();
				for($i=1;$i<=$products_query_numrows;$i++) {
				  $sort_order_drop_array[] = array('id' => $i, 'text' => $i);
				}
			   $products_query = tep_db_query($products_query_raw);
		       while ($products = tep_db_fetch_array($products_query)) {
				   
			     if ($products['products_model'] == NULL) {
				   $products_model = TEXT_NONE;
			     } else {
				   $products_model = $products['products_model'];
			     } // end if ($products['products_model'] == NULL)
				 
				 $xsold_query = tep_db_query('select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$_GET['add_related_product_ID'].'" and xsell_id = "'.$products['products_id'].'"');
				 $xsold_query_reciprocal = tep_db_query('select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$products['products_id'].'" and xsell_id = "'.$_GET['add_related_product_ID'].'"');   
			
		?>
				    <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
				      <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
				      <td class="dataTableContent" align="center">&nbsp;<?php echo $products_model;?>&nbsp;</td>
				      <td class="dataTableContent" align="center">&nbsp;<?php echo ((is_file(DIR_FS_CATALOG_IMAGES . '/'.$products['products_image'])) ?  tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '/'.$products['products_image'], "", SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : TEXT_NONE);?>&nbsp;</td>
				      <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
				      <td class="dataTableContent" align="center">&nbsp;<?php echo $currencies->format($products['products_price']);?>&nbsp;</td>
				      <td class="dataTableContent" align="center">&nbsp;<?php echo tep_draw_hidden_field('product[]', $products['xsell_id']).tep_draw_pull_down_menu('option[]', $sort_order_drop_array, $products['sort_order']);?>&nbsp;</td>
				      <td class="dataTableContent">&nbsp;<?php echo tep_draw_hidden_field('product[]', $products['products_id']) . tep_draw_checkbox_field('cross[]', $products['products_id'], ((tep_db_num_rows($xsold_query) > 0) ? true : false), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo TEXT_CROSS_SELL;?></label><br>&nbsp;<?php echo tep_draw_hidden_field('product[]', $products['products_id']) . tep_draw_checkbox_field('reciprocal_link_cross[]', $products['products_id'], ((tep_db_num_rows($xsold_query_reciprocal) > 0) ? true : false), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo TEXT_RECIPROCAL_LINK;?></label>&nbsp;</td>
                    </tr>
		<?php
			   } // end while ($products = tep_db_fetch_array($products_query))
		?>
			      </table>
                </form></td>
		      </tr>
    <?php          		  
              if (tep_db_num_rows(tep_db_query($products_query_raw)) == 0) { // no results ?>
			    <tr>
                  <td class="messageStackAlert" colspan="7" align="center"><?php echo TEXT_NO_RESULTS_FOUND; ?></td>
                </tr>
			
	<?php	  } ?>
    
		      <tr>
			    <td colspan="7">
			      <table border="0" width="100%" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
			          <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
			        </tr>
			      </table>
                </td>
		      </tr>
		    </table>
	<?php
    } else { // if (isset($_GET['sort']))
    // Add Cross Sell Code
    
	  $products_name_query = tep_db_query('select pd.products_name, p.products_model, p.products_image, p.products_price from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"');
	  $products_name = tep_db_fetch_array($products_name_query);
	
	  if ($products_name['products_model'] == NULL) {
	    $products_model = TEXT_NONE;
	  } else {
	    $products_model = $products_name['products_model'];
	  } // end if ($products_name['products_model'] == NULL)
	?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TEXT_SETTING_SELLS.$products_name['products_name']; ?></td>
                <td class="dataTableHeadingContent" nowrap align="right">
			    <?php 
				// Search
				echo tep_draw_form('search_add_xsell', FILENAME_XSELL_PRODUCTS, '', 'get') . tep_draw_hidden_field('add_related_product_ID', $_GET['add_related_product_ID']);
				echo TEXT_SEARCH_IN_RESULTS . ' ' . tep_draw_input_field('search_add_xsell');
				echo '</form>';
                ?>            
                </td>
              </tr>
	          <tr>
		        <td colspan="2"><?php echo tep_draw_form('update_cross', FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'action=update_cross', 'post');?>
                  <table cellpadding="1" cellspacing="1" border="0" width="100%">
			        <tr>
			          <td colspan="6">
                        <table cellpadding="5" cellspacing="0" border="0" width="100%">
			              <tr class="dataTableHeadingRow">
			                <td valign="middle" align="left" width="<?php echo SMALL_IMAGE_WIDTH; ?>"><?php echo tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '/'.$products_name['products_image'], "", SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);?></td>
		                    <td valign="top" align="left"><span class="main"><?php echo $products_name['products_name'] . ' <br>('.TEXT_MODEL.': '.$products_model.') <br>('.TEXT_PRODUCT_ID.': '.$_GET['add_related_product_ID'].')';?></span></td>
				            <td valign="middle" align="center" width="10"><?php echo tep_image_submit('button_update.gif'); ?>&nbsp;&nbsp;<?php echo '<a href="'.tep_href_link(FILENAME_XSELL_PRODUCTS).'">' . tep_image_button('button_cancel.gif') . '</a>'; ?></td>
			              </tr>
			            </table>              
                      </td>
			        </tr>
			        <tr class="dataTableHeadingRow">
				      <td class="dataTableHeadingContent" width="75">&nbsp;<?php echo TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_CROSS_SELL_THIS;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
				      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
			        </tr>
                    
	<?php // Create a list of products to cross sell
			$xsell_array = array(); 
            $xsell_query = tep_db_query('select x.xsell_id from ' . TABLE_PRODUCTS . ' p, ' . TABLE_PRODUCTS_XSELL . ' x where x.products_id = "'.$_GET['add_related_product_ID'].'"');
			while ($xsell = tep_db_fetch_array($xsell_query)) {
			  $xsell_array[] = $xsell['xsell_id'];
		    } // end while ($xsell = tep_db_fetch_array($xsell_query))
            $num_xsell = tep_db_num_rows($xsell_query);
		    if (isset($_GET['search_add_xsell'])) {
		      $products_query_raw = 'select distinct p.products_id, p.products_image, p.products_model, p.products_price, pd.products_name from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = pd.products_id and ((pd.products_name like "%' . tep_db_prepare_input($_GET['search_add_xsell']) . '%") or (p.products_model like "%' . tep_db_prepare_input($_GET['search_add_xsell']) . '%")) and pd.language_id = "'.(int)$languages_id.'" group by p.products_id order by pd.products_name asc';
		    } else {
		      $products_query_raw = 'select distinct p.products_id, p.products_image, p.products_model, pd.products_name, p.products_price from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" group by p.products_id order by pd.products_name asc';
		    } // end if (isset($_GET['search']))
		    $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
		  
		    $products_query = tep_db_query($products_query_raw);
			while ($products = tep_db_fetch_array($products_query)) {
			  if (!in_array($products['products_id'], $xsell_array)) {
			    $xsold_query = tep_db_query('select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$_GET['add_related_product_ID'].'" and xsell_id = "'.$products['products_id'].'"');
			    $xsold_query_reciprocal = tep_db_query('select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$products['products_id'].'" and xsell_id = "'.$_GET['add_related_product_ID'].'"');
				
				if ($products['products_model'] == NULL) {
			      $products_model = TEXT_NONE;
		        } else {
			      $products_model = $products['products_model'];
		        } // end if ($products['products_model'] == NULL)
	?>
			        <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
			          <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
                      <td class="dataTableContent" align="center">&nbsp;<?php echo $products_model;?>&nbsp;</td>
			          <td class="dataTableContent" align="center">&nbsp;<?php echo ((is_file(DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '/'.$products['products_image'])) ?  tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '/'.$products['products_image'], "", SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : TEXT_NONE);?>&nbsp;</td>
			          <td class="dataTableContent"><?php echo tep_draw_hidden_field('product[]', $products['products_id']) . tep_draw_checkbox_field('cross[]', $products['products_id'], ((tep_db_num_rows($xsold_query) > 0) ? true : false), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo TEXT_CROSS_SELL;?></label><br><?php echo tep_draw_hidden_field('product[]', $products['products_id']) . tep_draw_checkbox_field('reciprocal_link_cross[]', $products['products_id'], ((tep_db_num_rows($xsold_query_reciprocal) > 0) ? true : false), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo TEXT_RECIPROCAL_LINK;?></label>&nbsp;</td>
			          <td class="dataTableContent">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
			          <td class="dataTableContent">&nbsp;<?php echo $currencies->format($products['products_price']);?>&nbsp;</td>
			        </tr>
	<?php
		      } // end if (!in_array($products['products_id'], $xsell_array))
	        } // end while ($products = tep_db_fetch_array($products_query))
	?>
			      </table>
                </form></td>
	          </tr>
              
    <?php          		  
              if (tep_db_num_rows(tep_db_query($products_query_raw)) == 0) { // no results ?>
			    <tr>
                  <td class="messageStackAlert" colspan="7" align="center"><?php echo TEXT_NO_RESULTS_FOUND; ?></td>
                </tr>
			
	<?php	  } ?>
    
	          <tr>
		        <td colspan="6">
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
		            <tr>
		              <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
		              <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
		            </tr>
		          </table>
                </td>
	          </tr>
	        </table> 
<?php
    } // end if (isset($_GET['sort']))
  } else { // end if (isset($_GET['add_related_product_ID']))
  	$xsell_array = array();
    $xsell_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_XSELL . " x where x.products_id = p.products_id");
	while ($xsell = tep_db_fetch_array($xsell_query)) {
	  $xsell_array[] = $xsell['products_id'];
	}
	// Build an array of products with cross sells
	$cleaned_xsell_array = array_unique($xsell_array);
	$list_string .= ' and p.products_id not in (';
	$list_string_ex .= ' and p.products_id in (';
	$i = 0;
    foreach ($cleaned_xsell_array as &$value) {
	  if ($i == 0) { // first item in array
        $list_string .= $value;
		$list_string_ex .= $value;
	  } else {
        $list_string .= ', ' . $value;
		$list_string_ex .= ', ' . $value;
	  }
	  $i++;
    } // end foreach
	$list_string .= ')';
	$list_string_ex .= ')';
	
	
	if ($i == 0) { // There are no products without cross sells
	  $list_string = '';
	  $list_string_ex = '';
	}
	
    $num_xsell = tep_db_num_rows($xsell_query);
    if (($num_xsell < 1) || $_GET['action'] == 'new_xsell') { // Show products without any cross sells attached to them.
    ?>
                        
            <table border="0" cellspacing="1" cellpadding="2" width="100%">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" colspan="4" nowrap align="right">
			    <?php 
				// Search
			    echo tep_draw_form('search_new_xsell', FILENAME_XSELL_PRODUCTS, '', 'get'). tep_draw_hidden_field('action', 'new_xsell');
				echo TEXT_SEARCH_IN_RESULTS . ' ' . tep_draw_input_field('search_new_xsell');
				echo '</form>';
                ?>            
                </td>
              </tr>
              
						<?php
				        if (isset($_GET['search_new_xsell'])) { // A Sub-Search is used
						  $search = tep_db_prepare_input($_GET['search_new_xsell']);
						  $products_query_raw = "select p.products_id, p.products_model, p.products_image, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and ((pd.products_name like '%" . tep_db_prepare_input($search) . "%') or (p.products_model like '%" . tep_db_prepare_input($search) . "%')) " . $list_string . " order by p.products_model";
						} else {
						  $products_query_raw = "select p.products_id, p.products_model, p.products_image, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' " . $list_string . " order by p.products_model";
				        }
				        $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
				        ?>
            
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="75"><?php echo TABLE_HEADING_PRODUCT_ID;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME;?></td>
              </tr>

        <?php 
				$products_query = tep_db_query($products_query_raw);
				while ($products = tep_db_fetch_array($products_query)) {
				
				    if ($products['products_model'] == NULL) {
					  $products_model = TEXT_NONE;
					} else {
					  $products_model = $products['products_model'];
					} // end if ($products['products_model'] == NULL)
		?>
			  <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $products['products_id'], 'NONSSL'); ?>'">
			    <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
				<td class="dataTableContent" align="center">&nbsp;<?php echo tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);?>&nbsp;</td>
				<td class="dataTableContent" valign="top">&nbsp;<?php echo $products_model;?>&nbsp;</td>
				<td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
		      </tr>
		<?php 
				} // end while ($products = tep_db_fetch_array($products_query))
				
			  
              if (tep_db_num_rows(tep_db_query($products_query_raw)) == 0) { // no results ?>
			    <tr>
                  <td class="messageStackAlert" colspan="7" align="center"><?php echo TEXT_NO_RESULTS_FOUND; ?></td>
                </tr>
			
	<?php	  } ?>
                               
		      <tr>
		        <td class="smallText" valign="top" colspan="2"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
		        <td class="smallText" align="right" colspan="2"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
		      </tr>
		    </table>
				
		<?php 
    } elseif ($_GET['action'] == 'edit_xsell') { // Show only products with a cross sell attached
	
		?>
            <table border="0" cellpadding="2" cellspacing="1" width="100%">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" colspan="7" nowrap align="right">
			    <?php 
				// Search
				echo tep_draw_form('search_edit_xsell', FILENAME_XSELL_PRODUCTS, '', 'get'). tep_draw_hidden_field('action', 'edit_xsell');
				echo TEXT_SEARCH_IN_RESULTS . ' ' . tep_draw_input_field('search_edit_xsell');
				echo '</form>';
                ?>            
                </td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="75"><?php echo TABLE_HEADING_PRODUCT_ID;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME;?></td>
                <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_CURRENT_SELLS;?></td>
                <td class="dataTableHeadingContent" colspan="2" nowrap align="center"><?php echo TABLE_HEADING_UPDATE_SELLS;?></td>
              </tr>
              <?php
				if (isset($_GET['search_edit_xsell'])) {
		          $search = tep_db_prepare_input($_GET['search_edit_xsell']);
				  $products_query_raw = 'select distinct p.products_id, p.products_model, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_id from '.TABLE_PRODUCTS.' p, ' . TABLE_PRODUCTS_DESCRIPTION . ' pd, ' . TABLE_PRODUCTS_XSELL . ' x, ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c where p.products_id = x.products_id and p.products_id = p2c.products_id and p.products_id = pd.products_id and ((pd.products_name like "%' . tep_db_prepare_input($search) . '%") or (p.products_model like "%' . tep_db_prepare_input($search) . '%")) and pd.language_id = "' . (int)$languages_id . '" ' . $list_string_ex . ' group by p.products_id order by pd.products_name asc';
				} else { 
		          $products_query_raw = 'select distinct p.products_id, p.products_model, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_id from '.TABLE_PRODUCTS.' p, ' . TABLE_PRODUCTS_DESCRIPTION . ' pd, ' . TABLE_PRODUCTS_XSELL . ' x, ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c where p.products_id = x.products_id and p.products_id = p2c.products_id and p.products_id = pd.products_id and pd.language_id = "' . (int)$languages_id . '" ' . $list_string_ex . ' group by p.products_id order by pd.products_name asc';
				} // end if (isset($_GET['search_edit_xsell']))
				$products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
			    $products_query_numrows = tep_db_query($products_query_raw);
		        $products_query_numrows = tep_db_num_rows($products_query_numrows);
		
			    $products_query = tep_db_query($products_query_raw);
		
		        while ($products = tep_db_fetch_array($products_query)) {
			
		          if ($products['products_model'] == NULL) {
		            $products_model = TEXT_NONE;
		          } else {
		            $products_model = $products['products_model'];
		          } // end if ($products['products_model'] == NULL)
	          ?>
	          <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $products['products_id'], 'NONSSL'); ?>'">
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products_model;?>&nbsp;</td>
		        <td class="dataTableContent" align="center">&nbsp;<?php echo tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
	              <?php
		          $products_cross_query = tep_db_query('select p.products_id, p.products_model, pd.products_name, p.products_id, x.products_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$products['products_id'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by x.sort_order asc');
			      $i=0;
			      while ($products_cross = tep_db_fetch_array($products_cross_query)) {
			        $i++;
	              ?>
					<tr>
					  <td class="dataTableContent">&nbsp;<?php echo $i . '.&nbsp;&nbsp;<b>' . $products_cross['products_model'] . '</b>&nbsp;' . $products_cross['products_name'];?>&nbsp;</td>
					</tr>
	             <?php } // end while ($products_cross = tep_db_fetch_array($products_cross_query)
			     if ($i <= 0) { ?>
					<tr>
					  <td class="dataTableContent">&nbsp;--&nbsp;</td>
					</tr>
	             <?php } else { ?>
					<tr>
					  <td class="dataTableContent"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10');?></td>
			        </tr>
	             <?php } ?>
		          </table>
                </td>
		        <td class="dataTableContent" valign="top" align="center">&nbsp;<a href="<?php echo tep_href_link(FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'add_related_product_ID=' . $products['products_id'], 'NONSSL');?>"><?php echo TEXT_ADD_XSELLS;?></a>&nbsp;</td>
		        <td class="dataTableContent" valign="top" align="center" align="center">&nbsp;<?php echo (($i > 0) ? '<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'sort=1&add_related_product_ID=' . $products['products_id'], 'NONSSL') .'">'.TEXT_EDIT_XSELLS.'</a>&nbsp;' : '--'); ?></td>
              </tr>
	<?php
			  } // end while ($products = tep_db_fetch_array($products_query))
			  
              if (tep_db_num_rows(tep_db_query($products_query_raw)) == 0) { // no results ?>
			    <tr>
                  <td class="messageStackAlert" colspan="7" align="center"><?php echo TEXT_NO_RESULTS_FOUND; ?></td>
                </tr>
			
	<?php	  } ?>
    
	          <tr>
		        <td colspan="7">
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
		            <tr>
		              <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
		              <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
		            </tr>
		          </table>
                </td>
	          </tr>
	        </table>
<?php
				
			} elseif ( (!isset ($_GET['action'])) || ($_GET['action'] == 'all') ) { // Show all products
	
		?>
            <table border="0" cellpadding="2" cellspacing="1" width="100%">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="75"><?php echo TABLE_HEADING_PRODUCT_ID;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE;?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME;?></td>
                <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_CURRENT_SELLS;?></td>
                <td class="dataTableHeadingContent" colspan="2" nowrap align="center"><?php echo TABLE_HEADING_UPDATE_SELLS;?></td>
              </tr>
              <?php		
		      $products_query_raw = 'select distinct p.products_id, p.products_model, pd.products_name, p.products_id, p.products_image from ' . TABLE_PRODUCTS . ' p, ' . TABLE_PRODUCTS_DESCRIPTION . ' pd, ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c where p.products_id = pd.products_id ' . $search_string . ' and pd.language_id = "'.(int)$languages_id.'" and p.products_id = p2c.products_id ' . $category_filter . ' group by p.products_id order by p.products_id asc';
		      $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
		      $products_query = tep_db_query($products_query_raw);
			  
		      while ($products = tep_db_fetch_array($products_query)) {
			
		        if ($products['products_model'] == NULL) {
		          $products_model = TEXT_NONE;
		        } else {
		          $products_model = $products['products_model'];
		        } // end if ($products['products_model'] == NULL)
	          ?>
	          <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $products['products_id'], 'NONSSL'); ?>'">
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products_model;?>&nbsp;</td>
		        <td class="dataTableContent" align="center">&nbsp;<?php echo tep_image(DIR_WS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
		        <td class="dataTableContent" valign="top">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
	<?php
		$products_cross_query = tep_db_query('select p.products_id, p.products_model, pd.products_name, p.products_id, x.products_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$products['products_id'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by x.sort_order asc');
			$i=0;
			while ($products_cross = tep_db_fetch_array($products_cross_query)) {
			  $i++;
	?>
					<tr>
					  <td class="dataTableContent">&nbsp;<?php echo $i . '.&nbsp;&nbsp;<b>' . $products_cross['products_model'] . '</b>&nbsp;' . $products_cross['products_name'];?>&nbsp;</td>
					</tr>
	<?php
			} // end while ($products_cross = tep_db_fetch_array($products_cross_query))
		    
			if ($i <= 0) {
	?>
					<tr>
					  <td class="dataTableContent">&nbsp;--&nbsp;</td>
					</tr>
	<?php
			} else {
	?>
					<tr>
					  <td class="dataTableContent"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10');?></td>
			        </tr>
	<?php
            }
    ?>
		            </table>
                  </td>
		          <td class="dataTableContent" valign="top" align="center">&nbsp;<a href="<?php echo tep_href_link(FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'add_related_product_ID=' . $products['products_id'], 'NONSSL');?>"><?php echo TEXT_ADD_XSELLS;?></a>&nbsp;</td>
		          <td class="dataTableContent" valign="top" align="center" align="center">&nbsp;<?php echo (($i > 0) ? '<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, tep_get_all_get_params(array('action')) . 'sort=1&add_related_product_ID=' . $products['products_id'], 'NONSSL') .'">'.TEXT_EDIT_XSELLS.'</a>&nbsp;' : '--'); ?></td>
	            </tr>
	<?php
			}
			
			if (tep_db_num_rows(tep_db_query($products_query_raw)) == 0) { // no results ?>
			    <tr>
                  <td class="messageStackAlert" colspan="7" align="center"><?php echo TEXT_NO_RESULTS_FOUND; ?></td>
                </tr>
			
	<?php	} ?>
	            <tr>
		          <td colspan="7">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
		              <tr>
		                <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
		                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action', 'search'))); ?></td>
		              </tr>
		            </table>
                  </td>
	            </tr>
	          </table>
<?php
				
			}
		}
?>
<!-- body_text_eof //-->
            </td>
          </tr>
        </table>
      </td>
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
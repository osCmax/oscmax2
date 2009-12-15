<?php
/*
      QT Pro Version 4.0
  
      stats_low_stock_attrib.php
  
      Contribution extension to:
        osCMax Power E-Commerce
        http://oscdox.com
     
      Copyright 2006 osCMax2004 Ralph Day
      Released under the GNU General Public License
  
      Based on prior works released under the GNU General Public License:
        QT Pro prior versions
          Ralph Day, October 2004
          Tom Wojcik aka TomThumb 2004/07/03 based on work by Michael Coffman aka coffman
          FREEZEHELL - 08/11/2003 freezehell@hotmail.com Copyright 2006 osCMax2003 IBWO
          Joseph Shain, January 2003
        osCommerce MS2
          Copyright 2006 osCMax
          
      Modifications made:
        11/2004 - Clean up to not replicate for all languages
                  Handle multiple attributes per product
                  Ignore attributes that stock isn't tracked for
                  Remove unused code
        
*******************************************************************************************
  
      QT Pro Low Stock Report
  
      This report lists all products and products attributes that have stock less than
      the reorder level configured in the osCommerce admin site

      
*******************************************************************************************

$Id: stats_low_stock_attrib.php 3 2006-05-27 04:59:07Z user $
  (v 1.3 by Tom Wojcik aka TomThumb 2004/07/03)
  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">


<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="menuboxheading" align="center"><?php echo strftime(DATE_FORMAT_LONG); ?></td>
          </tr>

        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="formAreaTitle"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td class="formAreaTitle"><?php echo TABLE_HEADING_QUANTITY; ?></td>
                
                <td class="formAreaTitle" align="right"><?php echo TABLE_HEADING_PRICE; ?>&nbsp;</td>
                
              </tr>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
<?php
  $products_query_raw = "select p.products_id, pd.products_name, p.products_quantity,p.products_price, l.name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_LANGUAGES . " l where p.products_id = pd.products_id and p.products_id = pd.products_id and l.languages_id = pd.language_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name ASC";
  
  $products_query = tep_db_query($products_query_raw);
  while ($products = tep_db_fetch_array($products_query)) {
      $products_id = $products['products_id'];

      // check for product or attributes below reorder level
      $products_stock_query=tep_db_query("SELECT products_stock_attributes, products_stock_quantity 
                                          FROM " . TABLE_PRODUCTS_STOCK . " 
                                          WHERE products_id=" . $products['products_id'] ." 
                                          AND products_stock_quantity < '" . STOCK_REORDER_LEVEL ."' 
                                          ORDER BY products_stock_attributes");
      $products_stock_rows=tep_db_num_rows($products_stock_query);
      if (($products['products_quantity'] < STOCK_REORDER_LEVEL) || ($products_stock_rows > 0)) {
        $products_quantity=($products_stock_rows > 0) ? '&nbsp;' : $products['products_quantity'];
        $products_price=($products_stock_rows > 0) ? '&nbsp;' : $currencies->format($products['products_price']);
?>
              <tr class="tableRow">
               <td class="formAreaTitle"><?php echo '<a href="' . tep_href_link(FILENAME_STOCK, 'product_id=' . $products['products_id']) . '"><font size="+1"><strong>' . $products['products_name'] . '</strong></font></a>'; ?>&nbsp;</td>

               <td class="dataTableContent"><?php echo $products_quantity; ?></td>
               <td class="dataTableContent" align="right"><?php echo $products_price; ?>&nbsp;</td>
              </tr>
             
              
              <?php
              
               /////////////////  Add Attributes
               

               
        if ($products_stock_rows > 0) {
          $products_options_name_query = tep_db_query("SELECT distinct popt.products_options_id, popt.products_options_name 
                                                       FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib 
                                                       WHERE patrib.products_id='" . $products['products_id'] . "' 
                                                       AND patrib.options_id = popt.products_options_id 
                                                       AND popt.products_options_track_stock = '1' 
                                                       AND popt.language_id = '" . (int)$languages_id . "' 
                                                       ORDER BY popt.products_options_id");
?>
            <tr class="dataTableRow">
              <td class="main">
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableRow">
<?php
          // build headng line with option names
          while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
            echo "                    <td class=\"main\">" . $products_options_name['products_options_name'] . "</td>\n";
          }
?>
                  </tr>
<?php
          // buld array of attributes price delta
          $attributes_price = array();
          $products_attributes_query = tep_db_query("SELECT pa.options_id, pa.options_values_id, pa.options_values_price, pa.price_prefix 
                                                     FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                                                     WHERE pa.products_id = '" . $products['products_id'] . "'"); 
          while ($products_attributes_values = tep_db_fetch_array($products_attributes_query)) {
            $option_price = $products_attributes_values['options_values_price'];
            if ($products_attributes_values['price_prefix'] == "-") $option_price= -1*$option_price;
            $attributes_price[$products_attributes_values['options_id']][$products_attributes_values['options_values_id']] = $option_price;
          }
    
          // now display the attribute value names, table the html for quantity & price to get everything
          // to line up right
          $quantity_html_table="                <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"2\">\n";
          $quantity_html_table.="                  <tr class=\"dataTableRow\"><td class=\"main\" colspan=\"" . sizeof($products_options_array) . "\">&nbsp;</td></tr>\n";
          $price_html_table="                <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"2\">\n";
          $price_html_table.="                  <tr class=\"dataTableRow\"><td class=\"main\" colspan=\"" . sizeof($products_options_array) . "\">&nbsp;</td></tr>\n";
          while($products_stock_values=tep_db_fetch_array($products_stock_query)) {
            $attributes=explode(",",$products_stock_values['products_stock_attributes']);
            echo "                  <tr class=\"dataTableRowSelected\">\n";
            $quantity_html_table.="                  <tr class=\"dataTableRowSelected\">\n";
            $price_html_table.="                  <tr class=\"dataTableRowSelected\">\n";
            $total_price=$products['products_price'];
            foreach($attributes as $attribute) {
              $attr=explode("-",$attribute);
              echo "                    <td class=smalltext>".tep_values_name($attr[1])."</td>\n";
              $total_price+=$attributes_price[$attr[0]][$attr[1]];
            }
            echo "                  </tr>\n";
            $quantity_html_table.="                    <td class=smalltext>" . $products_stock_values['products_stock_quantity'] . "</td>\n";
            $quantity_html_table.="                  </tr>\n";
            $price_html_table.="                    <td align=\"right\" class=smalltext>" . $total_price . "&nbsp;</td>\n";
            $price_html_table.="                  </tr>\n";
          }
          echo "                </table>\n";
          echo "              </td>\n";
          $quantity_html_table.="                </table>\n";
          $price_html_table.="                </table>\n";
          echo "              <td class=smalltext>" . $quantity_html_table . "</td>\n";
          echo "              <td>" . $price_html_table . "</td>\n";
          echo "            </tr>\n";
        }
      }
  ////////////////////////// End Attributes
  }
?>
              <tr>
                <td colspan="3"><?php echo tep_draw_separator(); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

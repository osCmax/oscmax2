    <!-- START OF PRODUCTS VIEWED -->
            <table border="0" width="500" cellspacing="0" cellpadding="0" align="center">
<tr>
<td class="pageheading">Products Viewed</td>
</tr>
                  <tr>
                    <td valign="top">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr class="dataTableHeadingRow">
                        <td class="dataTableHeadingContent">Rank</td>
                        <td class="dataTableHeadingContent">Product</td>
                        <td class="dataTableHeadingContent" align="center">Views</td>
                      </tr>
        <?php
          if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
          $rows = 0;
          $products_query_raw = "select p.products_id, pd.products_name, pd.products_viewed from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id order by pd.products_viewed DESC LIMIT 10";
          $products_query = tep_db_query($products_query_raw);
          while ($products = tep_db_fetch_array($products_query)) {
            $rows++;
        
            if (strlen($rows) < 2) {
              $rows = '0' . $rows;
            }
        ?>
                      <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL'); ?>'">
                        <td class="dataTableContent"><?php echo $rows; ?>.</td>
                        <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL') . '">' . $products['products_name'] . '</a> ' . $products['name'] . ''; ?></td>
                        <td class="dataTableContent" align="center"><?php echo $products['products_viewed']; ?>&nbsp;</td>
                      </tr>
        <?php
          }
        ?>
        			</table>
             </td>
             </tr>
             <tr><td><?php echo '<a href="' . FILENAME_STATS_PRODUCTS_VIEWED . '">'; ?>View complete report</a>
             </td></tr>
             </table>
    <!-- END OF PRODUCTS VIEWED -->
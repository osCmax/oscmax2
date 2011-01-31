<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  $column_left_query_raw = "select quick_links_id, quick_links_image, quick_links_name, quick_links_sort_order, quick_links_link, quick_links_target, date_added, last_modified from " . TABLE_QUICK_LINKS . " order by quick_links_sort_order";
  $column_left_query = tep_db_query($column_left_query_raw);
  while ($column_left = tep_db_fetch_array($column_left_query)) {
?>
<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
  <td class="dataTableContent"><a href="<?php if (substr($column_left['quick_links_link'], 0, 4) == 'http') { echo $column_left['quick_links_link']; } else { echo tep_href_link($column_left['quick_links_link'], '', 'NONSSL'); } ?>" target="<?php echo $column_left['quick_links_target']; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'quick_links/' . $column_left['quick_links_image'] , $column_left['quick_links_name']); ?></a></td>
  <td class="dataTableContent"><a href="<?php if (substr($column_left['quick_links_link'], 0, 4) == 'http') { echo $column_left['quick_links_link']; } else { echo tep_href_link($column_left['quick_links_link'], '', 'NONSSL'); } ?>" target="<?php echo $column_left['quick_links_target']; ?>"><?php echo $column_left['quick_links_name']; ?></a></td>
</tr>
<?php
  }
?>
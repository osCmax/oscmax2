<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<tr valign="bottom">
    <td width="45%">
<?php echo ' &nbsp;&nbsp;&nbsp;
	<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'dashboard.png', 'Admin Home') . '</a>&nbsp;
	<a href="https://www.google.com/analytics/reporting/" target="_blank">' . tep_image(DIR_WS_IMAGES . 'webtools.png', 'Google Analytics') . '</a>&nbsp;
	<a href="https://www.google.com/webmasters/tools/dashboard" target="_blank">' . tep_image(DIR_WS_IMAGES . 'analytics.png', 'Google WebTools') . '</a>&nbsp;
    <a href="https://pp.pingdom.com/index.php/member/default" target="_blank">' . tep_image(DIR_WS_IMAGES . 'pingdom.png', 'Pingdom') . '</a>&nbsp;';
	?></td>

<td align="right" width="45%">
<?php echo '
	
	<a href="' . tep_catalog_href_link('admin/categories.php') . '">' . tep_image(DIR_WS_IMAGES . 'categories.png', 'Edit Catalog') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link('admin/xsell.php') . '">' . tep_image(DIR_WS_IMAGES . 'xsell.png', 'X Sell Products') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link('admin/backup.php') . '">' . tep_image(DIR_WS_IMAGES . 'backup.png', 'Backup') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link('admin/orders.php') . '">' . tep_image(DIR_WS_IMAGES . 'orders.png', 'Orders') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link('admin/customers.php') . '">' . tep_image(DIR_WS_IMAGES . 'customers.png', 'Customers') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link('admin/newsletters.php') . '">' . tep_image(DIR_WS_IMAGES . 'newsletters.png', 'Newsletters') . '</a>&nbsp;
	<a href="' . tep_catalog_href_link() . '">' . tep_image(DIR_WS_IMAGES . 'catalog.png', HEADER_TITLE_ONLINE_CATALOG) . '</a>&nbsp;';
	
	 ?>&nbsp;
     </td>
</tr>
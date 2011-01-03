<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

?>		

<ul class="sf-menu">
<!-- START OF MENU -->

<!-- ADMINISTRATOR -->
<?php
  if (tep_admin_check_boxes('administrator.php') == true) { ?>
    <li>
      <a href="#">Administrator</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'administrator.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CONFIGURATION -->
<?php
  if (tep_admin_check_boxes('configuration.php') == true) { ?>
    <li>
      <a href="#">Configuration</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'configuration.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CATALOG -->
<?php
  if (tep_admin_check_boxes('catalog.php') == true) { ?>
    <li>
      <a href="#">Catalog</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'catalog.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- MODULES -->
<?php
  if (tep_admin_check_boxes('modules.php') == true) { ?>
    <li>
      <a href="#">Modules</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'modules.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CUSTOMERS -->
<?php
  if (tep_admin_check_boxes('customers.php') == true) { ?>
    <li>
      <a href="#">Customers</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'customers.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- TAXES -->
<?php
  if (tep_admin_check_boxes('taxes.php') == true) { ?>
    <li>
      <a href="#">Locations / Taxes</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'taxes.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- LOCALIZATION -->
<?php
  if (tep_admin_check_boxes('localization.php') == true) { ?>
    <li>
      <a href="#">Localization</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'localization.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- REPORTS -->
<?php
  if (tep_admin_check_boxes('reports.php') == true) { ?>
    <li>
      <a href="#">Reports</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'reports.php'); ?>
        </ul>
    </li>
<?php } ?>


<!-- TOOLS -->
<?php
  if (tep_admin_check_boxes('tools.php') == true) { ?>
    <li>
      <a href="#">Tools</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'tools.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- AFFILIATES -->
<?php
  if (tep_admin_check_boxes('affiliate.php') == true) { ?>
    <li>
      <a href="#">Affiliates</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'affiliate.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- VOUCHERS -->
<?php
  if (tep_admin_check_boxes('gv_admin.php') == true) { ?>
    <li>
      <a href="#">Vouchers</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'gv_admin.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- ARTICLES -->
<?php
  if (tep_admin_check_boxes('articles.php') == true) { ?>
    <li>
      <a href="#">Articles</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'articles.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- SECURITY -->
<?php
  if (tep_admin_check_boxes('sitemonitor.php') == true) { ?>
    <li>
      <a href="#">Security</a>
        <ul>
           <?php require(DIR_WS_BOXES . 'sitemonitor.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- END OF MENU -->
</ul>
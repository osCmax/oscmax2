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
      <a href="#"><?php echo BOX_HEADING_ADMINISTRATOR; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'administrator.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CONFIGURATION -->
<?php
  if (tep_admin_check_boxes('configuration.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_CONFIGURATION; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'configuration.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CATALOG -->
<?php
  if (tep_admin_check_boxes('catalog.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_CATALOG; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'catalog.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- MODULES -->
<?php
  if (tep_admin_check_boxes('modules.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_MODULES; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'modules.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- CUSTOMERS -->
<?php
  if (tep_admin_check_boxes('customers.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_CUSTOMERS; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'customers.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- TAXES -->
<?php
  if (tep_admin_check_boxes('taxes.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_LOCATION_AND_TAXES; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'taxes.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- LOCALIZATION -->
<?php
  if (tep_admin_check_boxes('localization.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_LOCALIZATION; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'localization.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- REPORTS -->
<?php
  if (tep_admin_check_boxes('reports.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_REPORTS; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'reports.php'); ?>
        </ul>
    </li>
<?php } ?>


<!-- TOOLS -->
<?php
  if (tep_admin_check_boxes('tools.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_TOOLS; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'tools.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- AFFILIATES -->
<?php
  if (tep_admin_check_boxes('affiliate.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_AFFILIATES; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'affiliate.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- VOUCHERS -->
<?php
  if (tep_admin_check_boxes('gv_admin.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_VOUCHERS; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'gv_admin.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- ARTICLES -->
<?php
  if (tep_admin_check_boxes('articles.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_ARTICLES; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'articles.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- SECURITY -->
<?php
  if (tep_admin_check_boxes('sitemonitor.php') == true) { ?>
    <li>
      <a href="#"><?php echo BOX_HEADING_SECURITY; ?></a>
        <ul>
           <?php require(DIR_WS_BOXES . 'sitemonitor.php'); ?>
        </ul>
    </li>
<?php } ?>

<!-- END OF MENU -->
</ul>
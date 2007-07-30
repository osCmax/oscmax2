<?php
/*
$Id: install.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/
?>

<p class="pageTitle">New Installation</p>

<form name="install" action="install.php?step=2" method="post">

<p><b>Please customize the new installation with the following options:</b></p>

<table width="95%" border="0" cellpadding="2" class="formPage">
  <tr>
    <td width="30%" valign="top">Import Catalog Database:</td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_checkbox_field('install[]', 'database', true); ?>
      <img src="images/layout/help_icon.gif" onClick="toggleBox('dbImport');"><br>
      <div id="dbImportSD">Install the database</div>
      <div id="dbImport" class="longDescription">Checking this box will import the database structure, and required data. (required for first time installations)</div>
    </td>
  </tr>
  <tr>
    <td width="30%" valign="top">Automatic Configuration:</td>
    <td width="70%" class="smallDesc">
      <?php echo osc_draw_checkbox_field('install[]', 'configure', true); ?>
      <img src="images/layout/help_icon.gif" onClick="toggleBox('autoConfig');"><br>
      <div id="autoConfigSD">Save configuration values</div>
      <div id="autoConfig" class="longDescription">Checking this box will save all entered data during the installation procedure to the appropriate configuration files on the server.</div>
    </td>
  </tr>
</table>

<p>&nbsp;</p>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continue"></td>
  </tr>
</table>

</form>

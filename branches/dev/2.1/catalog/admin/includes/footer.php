<?php
/*
$Id: footer.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/
?>

<?php

  if (strpos($PHP_SELF, "login.php") == 0 && strpos($PHP_SELF, "logoff.php") == 0 && strpos($PHP_SELF, "password_forgotten.php") == 0) {
?>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="5">
  <tr bgcolor="#606060">
    <td align="left" class="footer">
      Copyright &copy; <?php echo date("Y"); ?> <?php echo STORE_NAME; ?>  | Powered by <a href="http://www.oscmax.com" target="_blank" class="footer"><?php echo PROJECT_VERSION; ?></a>    
    </td>
    <td align="right" class="footer">
      <a href="http://bugtrack.oscmax.com/" target="_blank" class="footer">Report Bugs</a> | <a href="http://www.oscmax.com/forums/" target="_blank" class="footer">Forum</a> | <a href="http://wiki.oscdox.com" target="_blank" class="footer">Wiki Help Documents</a>
    </td>
  </tr>
</table>
<?php
  } else { ?>

<br>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr align="center">
    <td class="smallText">
<?php
/*
  The following copyright announcement is in compliance
  to section 2c of the GNU General Public License, and
  thus can not be removed, or can only be modified
  appropriately.

  For more information please vist osCMax
  support site:

  http://oscmax.com/

  Please leave this comment intact together with the
  following copyright announcement.
*/
?>

Copyright &copy; <?php echo date("Y"); ?>  <?php echo STORE_NAME; ?><br />
Powered by <a href="http://www.oscmax.com" target="_blank"><?php echo PROJECT_VERSION; ?></a><br>

    </td>
  </tr>
  <tr>
    <td><?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5'); ?></td>
  </tr>

</table>

<?php } ?>
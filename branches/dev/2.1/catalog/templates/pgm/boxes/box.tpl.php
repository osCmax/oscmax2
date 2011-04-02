<?php if (!defined ('DIR_FS_CATALOG')) die ("Access denied."); ?>
<?php /* infobox template  */ ?>
          <tr>
            <td>
              <table class="infoBoxWrapper" cellspacing="0" cellpadding="0">
              <tr><td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_left) { case 'square': echo 'corner_right_left.gif';	break; case 'rounded': echo 'corner_left.gif'; break;} ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/<?php switch ($corner_right) { case 'square': echo 'pixel_trans.gif';	break; case 'rounded': echo 'infobox/corner_right.gif'; break;} ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxColumns">
                  <tr>
                    <td>
                    	<table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
                          <tr>
                            <td><img src="images/icons/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
                          </tr>
                          <tr>
                            <td class="boxText"<?php echo $boxContent_attributes; ?>><?php echo $boxContent; ?></td>
                          </tr>
                          <tr>
                            <td><img src="images/icons/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
                          </tr>
                        </table>
                     </td>
                  </tr>
              </table>
              <table width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                  	<?php echo '<td><img src="' . DIR_WS_TEMPLATES . 'images/infobox_bottom.png"></td>'; ?>
                  </tr>
              </table>
              </td></tr>
              </table>
 			  <table width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                  	<td><img src="images/icons/pixel_trans.gif" border="0" alt="" width="100%" height="5"></td>
                  </tr>
              </table>
 
            </td>
          </tr>
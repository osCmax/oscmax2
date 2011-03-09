<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  $err = "";

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
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
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
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="pageHeading" width="75%"><?php echo HEADING_TITLE; ?></td>
          <td width="25%">&nbsp;</td>
        </tr>
        <tr class="dataTableHeadingRow">
          <td class="dataTableHeadingContent">&nbsp;</td>
          <td class="infoBoxHeading"><?php echo HEADING_TITLE; ?></td>
        </tr>
        <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          <td rowspan="4" class="infoBoxContent" valign="top">
          <?php
            if ( (isset($_POST['submit'])) && ($_POST['submit']) ) {
		  ?>
            <table width="100%"><tr><td class="messageStackSuccess"><?php echo TEXT_SAVED_COMMENT; ?></td></tr></table>
          <?php	
			} elseif ( (isset($_POST['delete'])) && ($_POST['delete']) )  {
		  ?>
            <table width="100%"><tr><td class="messageStackWarning"><?php echo TEXT_DELETED_COMMENT; ?></td></tr></table>
			  
          <?php	
			} elseif ( (isset($_POST['add'])) && ($_POST['add']) && ($err != "") ) {
		  ?>
            <table width="100%"><tr><td class="messageStackSuccess"><?php echo TEXT_ADDED_COMMENT; ?></td></tr></table>
          <?php	
			} else {
		  ?>
              <?php echo TEXT_INSTRUCTIONS_DEFAULT; ?>
		  <?php
		    } // end if
		  ?>
          </td>
        </tr>
        <tr>
          <td>
          <?php
          if ( (isset($_POST['submit'])) && ($_POST['submit']) ) {
				$namecheck = mysql_fetch_array(mysql_query("SELECT * FROM " . TABLE_ORDERS_PREMADE_COMMENTS . " WHERE title = '" . $_POST['title'] . "'"));
				$err = "";
				
				if (!$_POST['title']) {
					$err .= ERROR_TITLE;
				}
				if (!$_POST['text']) {
				    $err .= ERROR_TEXT;
				}
				if ($namecheck['title'] && ($_POST['title'] !== $_POST['old_title'])) {
					$err .= ERROR_COMMENT;
				}
				if (!$err) {
					tep_db_query("UPDATE " . TABLE_ORDERS_PREMADE_COMMENTS . " SET title = '" . $_POST['title'] . "', text = '" . $_POST['text'] . "' WHERE id = '" . $_POST['p_id'] . "'");
				}
			}
			elseif ( (isset($_POST['delete'])) && ($_POST['delete']) ) {
				tep_db_query("DELETE FROM " . TABLE_ORDERS_PREMADE_COMMENTS . " WHERE id = '" . $_POST['p_id'] . "'");
			}
			elseif ( (isset($_POST['add'])) && ($_POST['add']) ) {
				
				$namecheck = mysql_fetch_array(mysql_query("SELECT * FROM " . TABLE_ORDERS_PREMADE_COMMENTS . " WHERE title = '" . $_POST['title'] . "'"));
				
				$err = "";
				if (!$_POST['title']) {
					$err .= ERROR_TITLE;
				}
				if (!$_POST['text']) {
				    $err .= ERROR_TEXT;
				}
				if ( (!empty($namecheck)) && (!$err) )  {
					$err .= ERROR_COMMENT_FIX;
					tep_db_query("INSERT INTO " . TABLE_ORDERS_PREMADE_COMMENTS . " (title, text) VALUES ('" . $_POST['title'] . TEXT_DUPLICATE . "', '" . $_POST['text'] . "')");
				}
				if (!$err) {
					tep_db_query("INSERT INTO " . TABLE_ORDERS_PREMADE_COMMENTS . " (title, text) VALUES ('" . $_POST['title'] . "', '" . $_POST['text'] . "')");
				}
			}
			?>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td>
     			<form action="" method="post">
	            <input type="hidden" name="a" value="premade">
    	        <input type="hidden" name="p_id" value="<?php echo $_POST['p_id']; ?>">
				  <table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td class="main" width="200"><b><?php echo TEXT_PREMADE_REPLIES; ?></b></td>
                      <td>
						<select name="p_id">

						<?php
                        $premades = mysql_query("SELECT * FROM " . TABLE_ORDERS_PREMADE_COMMENTS . " order by title");
                          while ($premade = tep_db_fetch_array($premades)) {
                              $selected = ($premade[id] == $p_id) ? " SELECTED": "";
                        ?>
                          <option value="<?php echo $premade['id']; ?>"<?php echo $selected; ?>><?php echo $premade['title']; ?></option>
						<?php
						  } // end while
						?>
                        </select>
                      </td>
                      <td><?php echo tep_draw_separator('pixel_trans.gif', '5', '5'); ?></td>
                      <td><input type="submit" name="select" value="<?php echo BUTTON_SELECT; ?>" class="inputsubmit"></td>
                      <td><?php echo tep_draw_separator('pixel_trans.gif', '5', '5'); ?></td>
                      <td><input type="submit" name="submit_new" value="<?php echo BUTTON_ADD_NEW; ?>" class="inputsubmit"></td>
                    </tr>
                    <tr>
                      <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '10'); ?></td>
                    </tr>
                  </table>
                  
                  <?php
				  if ($err <> '') {
				  ?>
                  <table width="100%">
                    <tr>
                      <td class="messageStackError"><?php echo $err; ?></td>
                    </tr>
				  </table>
                  <?php
                  } // end if
				  ?>
                  
                  <table border="0" cellspacing="3" cellpadding="0" class="TableMsg">
				    
				<?php
                if ( (isset($_POST['p_id'])) && (!$_POST['p_id']) ) { $_POST['submit_new'] = true; }
                if ( (isset($_POST['select'])) && ($_POST['select']) ) {
					
			      $premade_query = tep_db_query("SELECT * FROM " . TABLE_ORDERS_PREMADE_COMMENTS . " where id = " . $_POST['p_id']);
                  $premade = tep_db_fetch_array($premade_query);
					
                ?> 
                	<tr>
                      <td class="main" colspan="2"><b><?php echo TEXT_EDIT_COMMENT; ?></b></td>
                    </tr>
                     <input type="hidden" name="old_title" value="<?php echo $premade['title']; ?>">
				    <tr>
                      <td class="main" width="200" align="right"><b><?php echo TEXT_TITLE; ?></b></td>
                      <td class="mainTableAlt"><input type="text" name="title" value="<?php echo $premade['title']; ?>" size="60"></td>
                    </tr>
				    <tr>
                      <td class="main" valign="top" align="right"><b><?php echo TEXT_TEXT; ?></b></td>
                      <td class="mainTableAlt"><textarea name="text" cols="58" rows="10"><?php echo $premade['text']; ?></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right"><input class="inputsubmit" type="submit" name="delete" value="<?php echo BUTTON_DELETE; ?>">
                      	  <?php echo tep_draw_separator('pixel_trans.gif', '5', '5'); ?>
				  		  <input class="inputsubmit" type="submit" name="submit" value="<?php echo BUTTON_SAVE_CHANGES; ?>"></td>
                    </tr>
				  </table>
				<?php
				} else { // Create New
				?>
                    <tr>
                      <td class="main" colspan="2"><b><?php echo TEXT_CREATE_COMMENT; ?></b></td>
                    </tr>
                    <tr>
                      <td class="main" width="200" align="right"><b><?php echo TEXT_TITLE; ?></b></td>
                      <td class="mainTableAlt"><input type="text" name="title" size="60"></td>
                    </tr>
					<tr>
                      <td class="main" valign="top" align="right"><b><?php echo TEXT_TEXT; ?></b></td>
                      <td class="mainTableAlt"><textarea name="text" cols="58" rows="10"></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right"><input class="inputsubmit" type="submit" name="add" value="<?php echo BUTTON_CREATE_REPLY; ?>"></td>
                    </tr>
				  </table>
				  
				<?php
				} // end if
				?>
				  </form></td>
                </tr>
            </table>
          </td>
        </tr>
	    <tr>
          <td class="main"><br></td>
        </tr>
	  </table>
    </td>
    <!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
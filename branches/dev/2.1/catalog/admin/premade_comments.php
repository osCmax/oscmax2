<?php
/*
  $Id: premade_comments.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
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
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading">Premade Order Comments</td>
      </tr>
      <tr>
        <td class="main">
								<p><br>
								</p>
							</td>
      </tr>
      <tr>
        <td>
        
        <?php
        
        if ($_POST[submit]) {
				$namecheck = mysql_fetch_array(mysql_query("SELECT * FROM orders_premade_comments WHERE title='$_POST[title]'"));
				$err = "";
				
				if (!$_POST[title] or !$_POST[text]) {
					$err .= "Required fields missing.<br>";
				}
				if ($namecheck[title] and ($_POST[title] !== $_POST[old_title])) {
					$err .= "Category already exists.<br>";
				}
				if (!$err) {
					$query_sql = "UPDATE orders_premade_comments SET title='$_POST[title]', text='$_POST[text]' WHERE id=$_POST[p_id]";
					mysql_query($query_sql);
				}
				$inc = "premade";
			}
			elseif ($_POST[delete]) {
				mysql_query("DELETE FROM orders_premade_comments WHERE id=$_POST[p_id]");
			
			}
			elseif ($_POST[add]) {
				$err = "";
				if (!$_POST[title] or !$_POST[text]) {
					$err .= "Required fields missing.<br>";
				}
				if (!$err) {
					mysql_query("INSERT INTO orders_premade_comments (title, text) VALUES ('$_POST[title]', '$_POST[text]')");
				}
				$inc = "premade";
			}
			else {
				$inc = "premade";
			}
			?>
			
			<table width="100%" border="0" cellspacing=0 cellpadding=0>
<form action="" method="post">
<input type="hidden" name="a" value="premade">
<input type="hidden" name="p_id" value="<?php echo $_POST[p_id]; ?>">
<tr><td>
<table border="0" cellspacing=0 cellpadding=0><tr><td>
<select name="p_id">

<?php
	$premades = mysql_query("SELECT * FROM orders_premade_comments order by title");
while ($premade = mysql_fetch_array($premades)) {
	$selected = ($premade[id] == $p_id) ? " SELECTED": "";
	?> <option value="<?php echo $premade[id]; ?>"<?php echo $selected; ?>><?php echo $premade[title]; ?></option>
<?php
}
?> </select></td><td>&nbsp;</td><td><input type="submit" name="select" value="Select" class="inputsubmit">
<input class="inputsubmit" type="submit" name="delete" value="Delete"> <input type="submit" name="submit_new" value="Add New" class="inputsubmit"></td></tr></table>
<p>

<table width="100%" border="0" cellspacing=1 cellpadding=2 class="TableMsg">
<tr><td class="main" width="120">&nbsp;<b>Premade Replies:</b></td><td>&nbsp;</td></tr>
<?php
if (!$_POST[p_id]) { $_POST[submit_new] = true; }

if ($_POST[select]) {
	$premade = mysql_fetch_array(mysql_query("SELECT * FROM orders_premade_comments WHERE id='".$_POST['p_id']."'"));
    ?> 
    <input type="hidden" name="old_title" value="<?php echo $premade[title]; ?>">
<tr><td class="main"><b>Title:</b></td><td class="mainTableAlt"><input type="text" name="title" value="<?php echo$premade[title]; ?>" size="60"></td></tr>
<tr><td class="main" valign="top"><b>Text:</b></td><td class="mainTableAlt"><textarea name="text" cols="58" rows="10"><?php echo $premade[text]; ?></textarea></td></tr>
</table>
<p>
<input class="inputsubmit" type="submit" name="submit" value="Save Changes">
<?php
}
elseif ($_POST[submit_new] or $_POST[submit] or $_POST[add] or $_POST[delete]) {
    ?> <tr><td class="main"><b>Title:</b></td><td class="mainTableAlt"><input type="text" name="title" size="60"></td></tr>
<tr><td class="main" valign="top"><b>Text:</b></td><td class="mainTableAlt"><textarea name="text" cols="58" rows="10"></textarea></td></tr>
</table>
<p>
<input class="inputsubmit" type="submit" name="add" value="Create Reply">
<?php
}
?>
</td></tr></form></table>

        
        </td>
      </tr>
						<tr>
        <td class="main"><br>
							</td>
      </tr>
					</table></td>
    <!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
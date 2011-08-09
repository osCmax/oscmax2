<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/  

  require('includes/application_top.php');
$_REQUEST['contents']='';

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php echo 'CHARSET'; ?>">
<title>osCmax Database Update - v2.5 RC2</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css"
	href="includes/javascript/jquery-ui-1.8.2.custom.css">
<style type="text/css">
body {
	font-family: Verdana, Arial, sans-serif;
	font-size: 90%;
	text-align: center;
}

table {
	margin: 0 auto;
	text-align: left;
}

.required {
	border: #ff0000 solid 1px;
	margin: 1px;
}

.feedback {
	text-align: left;
}
</style>

</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

     
   
<?php  
    if (!defined('DB_SERVER') || !defined('DB_SERVER_USERNAME') || !defined('DB_SERVER_PASSWORD') || !defined('DB_DATABASE')) die('Can not find database definitions.');

 $connect = mysql_connect (DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
  if (!$connect) {
     die('Could not connect: ' . mysql_error());
    }

    

    
  ?>

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
	<tr>
		<td width="<?php echo BOX_WIDTH; ?>" valign="top">
		<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1"
			cellpadding="1" class="columnLeft">
			<!-- left_navigation //-->
			<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
			<!-- left_navigation_eof //-->
		</table>
		</td>
		<!-- body_text //-->
		<td width="100%" valign="top">
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
			<tr>
				<td>
				<h3>osCmax Upgrade System</h3>
<?php
    @mysql_select_db(DB_DATABASE);
    
    $result = @mysql_query("SELECT * FROM db_version");
    if (!$result) { echo '<p>No version table detected. This will be created for you.</p>'; }
    $version='';
    while ($row = @mysql_fetch_array($result)) {

    $version = $row['database_version'];
    }
   
  
    //mysql_close($connect);
	if ($version == 'v2.5_RC2') { 
	  if (PROJECT_VERSION == 'osCmax_v2.5_RC2') { 
					?>
				<center>
				<p>You have successfully upgraded your osCmax installation to
				<?php echo $version; ?></p>
				<br>
				</center>
				<?php 
				 } else {
				 ?>
				<strong>Complete your upgrade by uploading the  <?php echo $version; ?> files now. </strong></center> 
				<?php
				 }
	  } else { ?>

				
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<?php
          
              if ($version == 'v2.5_RC1') { ?>
						<td>Your current osCmax version is <strong><?php echo $version; ?></strong></td>
						
						<?php } elseif (!$version) { ?>
						<td> Manually verify that your minimum osCmax version is v2.5 Beta 3.<br>You can check this by visiting your admin panel login screen. <br> In the copyright notice at the bottom, the current version will be displayed.</td>
						

						<?php  }  ?>
					</tr>
					<tr>
						<td><br>Check to display sql output: <input type="checkbox" name="contents" value="1" /><br></td>
					</tr>
					<tr>
					    <td>
					    <br><strong>Before proceeding, please make a backup of
				your database.<br><br></strong>
					    </td>
					</tr>    
				</table>
				
				<button id="Button" type="submit" name="upgrade" value="upgrade">Upgrade</button>
				</form>

				<div class="feedback"><?php
 }


 				

	if (!$version) {
	$file = fopen('upgrade/2.5beta3_to_2.5rc1.sql', 'r');
	} elseif ($version == 'v2.5_RC1') {
 	$file = fopen('upgrade/2.5rc1_to_2.5rc2.sql', 'r');
	}	
if (!empty($_REQUEST['upgrade']))

         {
	
        # Connect to database.
        //@mysql_connect($_POST['hostname'], $_POST['username'], $_POST['password']);
        //mysql_check_error();
        mysql_select_db(DB_DATABASE);
        //mysql_check_error();
	print '<pre>';
	print mysql_error();
	$temp = '';
	$count = 0;
	while($line = fgets($file)) {
	  if ((substr($line, 0, 2) != '--') && (substr($line, 0, 2) != '/*') && strlen($line) > 1) {
	    $last = trim(substr($line, -2, 1));
	    $temp .= trim(substr($line, 0, -1));
	    if ($last == ';') {
	      mysql_query($temp);
	      $count++;
	      if ($_POST['contents'] ==1) {
	      print $temp . '<br>';
	      }
	      $temp = '';
	    }
	  }
	}
	print mysql_error();
	print "Total {$count} queries done\n<br>";
	print '</pre>';


}


?></div>

				</td>
			</tr>
			<tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
		</table>
		</td>
		<td width="25%"><!-- Placeholder for right hand column --></td>
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
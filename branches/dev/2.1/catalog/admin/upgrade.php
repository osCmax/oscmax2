<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/  
/*
 * SQLimport -- Version 01-Oct-2006
 *
 * Execute SQL statements from a file on a MySQL database.
 *
 * You can use this script to import your database structure
 * and data without the use of a complex tool like phpMyAdmin.
 *
 * Copyright (c) 2003-2006 Jochen Kupperschmidt
 * Released under the terms of the GNU General Public License
 *   _                               _
 *  | |_ ___ _____ ___ _ _ _ ___ ___| |_
 *  |   | . |     | ._| | | | . |  _| . /
 *  |_|_|___|_|_|_|___|_____|___|_| |_|_\
 *    http://homework.nwsnet.de/
 *
 * History:
 *   - 20-Mar-2003: initial release
 *   - 01-Oct-2006: use of XHTML/CSS, superglobals and code cleanup
 */

 
# Check if variable is a non-empty, non-whitespace string.
function is_param($var) {
    $var = trim($var);
    return is_string($var) and ($var != '');
}

function show_error($msg) {
    printf("<p><strong>Error: $msg</strong></p>\n");
}

# Check for MySQL errors.
function mysql_check_error() {
    if (mysql_errno() != 0) {
        show_error(sprintf('MySQL #%d: %s', mysql_errno(), mysql_error()));
    }
}

  require('includes/application_top.php');
  //require('../includes/configure.php');
  //require('../includes/database_tables.php');
# ---------------------------------------------------------------- #

# Prevent this page from being cached.
header('Cache-Control: no-store, no-cache, must-revalidate');  # HTTP/1.1
header('Pragma: no-cache');                                    # HTTP/1.0
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
    //echo 'connection success';
    //mysql_select_db(DB_DATABASE) or die(mysql_error());
    //$result = mysql_query("SELECT * FROM db_version");
    //or die(mysql_error());
    //while ($row = mysql_fetch_array($result)) {

    //$version = $row['database_version'];
    
    //}
    

    
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
   
  
    mysql_close($connect);
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
						<input type="hidden" name="version" value="2">
						<?php } elseif (!$version) { ?>
						<td> Manually verify that your minimum osCmax version is v2.5 Beta 3.<br>You can check this by visiting your admin panel login screen. <br> In the copyright notice at the bottom, the current version will be displayed.</td>
						<input type="hidden" name="version" value="1">

						<?php  }  ?>
					</tr>
					<?php
				
       $db_params = array(
       	 array( 'hostname' => DB_SERVER, 'username' => DB_SERVER_USERNAME, 'password' => DB_SERVER_PASSWORD, 'database' => DB_DATABASE));
	 //array( 'hostname', 'username', 'password', 'database')) ;
	 
    for ($row = 0; $row < 1; $row++)      
       {
       foreach ($db_params[$row] as $param => $value) { ?>
					<tr>
						<input type="hidden" name="<?php echo $param; ?>"
							value="<?php echo $value; ?>">
					</tr>
					<?php }
     } ?>
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
				
				<button type="submit">Upgrade</button>
				</form>

				<div class="feedback"><?php
 }
 				
if (is_param(isset($_POST['hostname']))
        and is_param($_POST['username'])        
        and is_param($_POST['database'])
        ) {
	if (is_param($_POST['version']==1)) {
       $file = 'upgrade/2.5beta3_to_2.5rc1.sql';
	} elseif (is_param($_POST['version']==2)) {
 	$file = 'upgrade/2.5rc1_to_2.5rc2.sql';
	}	
    if (! file_exists($file)) {
        show_error(sprintf('File "%s" does not exist.', $file));
    } else if (! is_file($file)) {
        show_error(sprintf('File "%s" is not a regular file.', $file));
    } else if (! is_readable($file)) {
        show_error(sprintf('File "%s" is not readable.', $file));
    } else {
        $contents = file($file);

        # Display file contents if activated.
        if (1 == $_POST['contents']) {
            printf("<pre>\n%s</pre>\n", implode('', $contents));
        }

        # Remove blank lines and comments.
        $sql = '';
        foreach ($contents as $line) {
            $line = trim($line);
            # Sort out empty or comment lines.
            if (($line == '') or ($line{0} == '#') or (substr($line, 0, 2) == '--')) {
                continue;
            }
            $sql .= $line . ' ';
        }

        # Connect to database.
        @mysql_connect($_POST['hostname'], $_POST['username'], $_POST['password']);
        mysql_check_error();
        @mysql_select_db($_POST['database']);
        mysql_check_error();

        # Execute SQL statements.
        foreach (explode(';', $sql) as $cmd) {
            $cmd = trim($cmd);
            if ($cmd != '') {
                mysql_query($cmd);
                mysql_check_error();
            }
	    
        }
     	
    }
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

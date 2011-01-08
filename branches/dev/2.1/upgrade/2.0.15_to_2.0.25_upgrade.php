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

  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

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

# ---------------------------------------------------------------- #

# Prevent this page from being cached.
header('Cache-Control: no-store, no-cache, must-revalidate');  # HTTP/1.1
header('Pragma: no-cache');                                    # HTTP/1.0
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>osCmax Database Update - v2.0.15 to v2.0.25</title>
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

<h2>osCmax 2.0.15 to 2.0.25 Stable<br>Database Upgrade Script</h2>
<p><strong>Before proceeding, please make a backup of your database.</strong><br>Do not run this updater more than once, <br>or you will get duplicate entries in your database</p>
<p>Specify the correct settings<br />to connect to your database.Only use this updater if you are currently running osCmax v2.0.15 and intend to upgrade to v2.0.25</p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <table>
<?php foreach (array('hostname', 'username', 'password', 'database') as $param) { ?>
    <tr>
      <td><?php echo ucfirst($param); ?>:</td>
      <td><input type="text" name="<?php echo $param; ?>"
                 value="<?php echo $_POST[$param]; ?>"<?php if (! is_param($_POST[$param])) { echo ' class="required"'; } ?> /></td>
    </tr>
<?php } ?>
    <tr>
      <td>Check to display sql output:</td>
      <td><input type="checkbox" name="contents" value="1" /></td>
    </tr>
  </table>
  <button type="submit">Import</button>
</form>

<div class="feedback">
<?php
if (is_param($_POST['hostname'])
        and is_param($_POST['username'])        
        and is_param($_POST['database'])
        ) {
    $file = '2.0.15_to_2.0.25.sql';
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
        echo "<center><p>You have successfully upgraded your osCmax 2.0.15 database to osCmax 2.0.25 format.</p><br><br><strong>Delete this file from your server now!</strong></center>\n";
    }
}
?>
</div>

<p>( <a href="<?php echo $_SERVER['PHP_SELF']; ?>">new</a> )</p>

<p><small>Copyright &copy; 2010 <a href="http://www.oscmax.com/">osCmax</a></small></p>

</body>
</html>
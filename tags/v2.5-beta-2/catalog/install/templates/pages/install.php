<?php
/*
$Id: install.php 3 2006-05-27 04:59:07Z user $

  osCmax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCmax

  Released under the GNU General Public License
*/
?>

<script language="javascript" type="text/javascript" src="ext/xmlhttp/xmlhttp.js"></script>
<script language="javascript" type="text/javascript">
<!--

  var dbServer;
  var dbUsername;
  var dbPassword;
  var dbName;

  var formSubmited = false;

  function handleHttpResponse_DoImport() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/success.gif" align="right" hspace="5" vspace="5" border="0" />Database imported successfully.<br><br>';

          setTimeout("document.getElementById('installForm').submit();", 2000);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" />There was a problem importing the database. The following error had occured:<br><br>%s<br><br>Please verify the connection parameters and try again.'.replace('%s', result[1]);
        }
      }

      formSubmited = false;
    }
  }

  function handleHttpResponse() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" />The database structure is now being imported. Please be patient during this procedure.<br><br>';

          loadXMLDoc("rpc.php?action=dbImport&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse_DoImport);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" />There was a problem connecting to the database server. The following error had occured:<br><br>%s<br><br>Please verify the connection parameters and try again.'.replace('%s', result[1]);
          formSubmited = false;
        }
      } else {
        formSubmited = false;
      }
    }
  }

  function prepareDB() {
    if (formSubmited == true) {
      return false;
    }

    formSubmited = true;

    showDiv(document.getElementById('mBox'));

    document.getElementById('mBoxContents').innerHTML = '<br><br><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" />Testing database connection.<br><br>';

    dbServer = document.getElementById("DB_SERVER").value;
    dbUsername = document.getElementById("DB_SERVER_USERNAME").value;
    dbPassword = document.getElementById("DB_SERVER_PASSWORD").value;
    dbName = document.getElementById("DB_DATABASE").value;

    loadXMLDoc("rpc.php?action=dbCheck&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse);
  }

//-->
</script>

<div id="menublock">
  <ul id="menutabs">
    <li><a href="index.php" id="first">Start</a></li>
    <li><a href="#" id="active">Database Server</a></li>
    <li><a href="#">Web Server</a></li>
    <li><a href="#">Store Settings</a></li>
    <li><a href="#" id="last">Finished</a></li>
  </ul>
</div>

<div class="mainBlock">
  <p>The database server stores the content of the online store such as product information, customer information, and the orders that have been made.</p>
      <p>Please consult your server administrator if your database server parameters are not yet known.</p>
</div>

<div class="contentBlock">

  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=2" method="post" onsubmit="prepareDB(); return false;">

    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'Database Server<br />' . osc_draw_input_field('DB_SERVER', null, 'class="text"'); ?></td>
        <td class="inputDescription">The address of the database server in the form of a hostname or IP address.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Username<br />' . osc_draw_input_field('DB_SERVER_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">The username used to connect to the database server.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Password<br />' . osc_draw_password_field('DB_SERVER_PASSWORD', 'class="text"'); ?></td>
        <td class="inputDescription">The password that is used together with the username to connect to the database server.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Database Name<br />' . osc_draw_input_field('DB_DATABASE', null, 'class="text"'); ?></td>
        <td class="inputDescription">The name of the database to hold the data in.</td>
      </tr>
    </table>

<div id="mBox">
    <div id="mBoxContents"></div>
</div>

<div id="buttons">
  <table width="100%">
    <tr>
      <td align="right"><input type="image" src="images/button_continue.gif" alt="Continue" id="inputButton" /></td>
    </tr>
  </table>
</div>

    </form>
  </div>
</div>
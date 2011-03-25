<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<?php
  // Check language pack for installer
  if (isset($_POST['language'])) {
    $language_selected = ($_POST['language']);
  } else {
	$language_selected = 'english';
  }
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
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/success.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo TEXT_DATABASE_SUCCESS; ?><br><br>';

          setTimeout("document.getElementById('installForm').submit();", 2000);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo TEXT_DATABASE_PROBLEM; ?>' . replace('%s', result[1]);
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
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo TEXT_DATABASE_IMPORTING; ?><br><br>';

          loadXMLDoc("rpc.php?action=dbImport&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse_DoImport);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<br><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo TEXT_DATBASE_CONNECTION_ERROR; ?>' . replace('%s', result[1]);
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

    document.getElementById('mBoxContents').innerHTML = '<br><br><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo TEXT_TESTING_DATABASE; ?><br><br>';

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
    <li><a href="index.php" id="first"><?php echo TAB_START; ?></a></li>
    <li><a href="#" id="active"><?php echo TAB_DATABASE_SERVER; ?></a></li>
    <li><a href="#"><?php echo TAB_WEB_SERVER; ?></a></li>
    <li><a href="#"><?php echo TAB_STORE_SETTINGS; ?></a></li>
    <li><a href="#" id="last"><?php echo TAB_FINISHED; ?></a></li>
  </ul>
</div>

<div class="mainBlock">
  <?php echo TEXT_DATABASE_SERVER_BLOCK; ?>
</div>

<div class="contentBlock">

  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=2" method="post" onsubmit="prepareDB(); return false;">
    
    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo TEXT_DATABASE_SERVER . '<br />' . osc_draw_input_field('DB_SERVER', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_DATABASE_SERVER_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_USERNAME . '<br />' . osc_draw_input_field('DB_SERVER_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_USERNAME_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_USERNAME . '<br />' . osc_draw_password_field('DB_SERVER_PASSWORD', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_PASSWORD_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_DATABASE_NAME . '<br />' . osc_draw_input_field('DB_DATABASE', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_DATABASE_NAME_DESC; ?></td>
      </tr>
    </table>

<div id="mBox">
    <div id="mBoxContents"></div>
</div>

<div id="buttons">
  <table width="100%">
    <tr>
      <td align="right"><input type="hidden" name="language" value="<?php echo $language_selected; ?>"><input type="image" src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_continue.gif" alt="<?php echo IMAGE_CONTINUE; ?>" id="inputButton" /></td>
    </tr>
  </table>
</div>

    </form>
  </div>
</div>
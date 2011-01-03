<?php
/*
  $Id$
  Released under the GNU General Public License
*/

  require('includes/application_top.php');
   
  	function GenerateSubmitURL($search_engine){
		$url = urlencode(HTTP_SERVER . DIR_WS_CATALOG . 'sitemapindex.xml');
	  
	  switch($search_engine) {
        case 'google':
          return htmlspecialchars(utf8_encode('http://www.google.com/webmasters/tools/ping?sitemap=' . $url));
          break;
		case 'ask':
          return htmlspecialchars(utf8_encode('http://submissions.ask.com/ping?sitemap=' . $url));
          break;
		case 'bing':
          return htmlspecialchars(utf8_encode('http://www.bing.com/webmaster/ping.aspx?siteMap=' . $url));
          break;
	  }
	  
	} # end function

// controllo delle lingue	
        $controllo = $languages_id;
		$query = "SELECT 
							languages_id,
							code
					FROM
							" . TABLE_LANGUAGES . "
					WHERE
							languages_id = $controllo";
    	
		$result = mysql_query($query);
    	
		while ($row = mysql_fetch_array($result))
				{ 
					$codice = $row[code]; 
							    };
	
	$file = 'sitemaps.index.php?language=';
	$url = $file . $codice;

// Fine	
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
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
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
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="pageHeading"><?php echo TITLE_GOOGLE_SITEMAPS; ?></td>
                <td class="pageHeading" align="right">&nbsp;</td>
              </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
              <tr valign="top">
                <td width="75%">
                  <table width="100%" border="0" cellpadding="2" cellspacing="0" class="main">
                    <tr class="dataTableHeadingRow">
                      <td class="dataTableHeadingContent"><?php echo OVERVIEW_TITLE_GOOGLE_SITEMAPS; ?></td>
                    </tr>
                    <tr>
                      <td width="75%" align="left" valign="top">
                        
                        <p><?php echo OVERVIEW_GOOGLE_SITEMAPS; ?></p>
                        <?php echo INSTRUCTIONS_STEP1_GOOGLE_SITEMAPS; ?>
                        <center><a id="regenerate" href="<?php echo $HTTP_SERVER . DIR_WS_CATALOG . $url; ?>" title="Google Sitemaps Generation Report"><?php echo tep_image_button('button_regenerate.gif', IMAGE_REGENERATE); ?></a></center>

                        <div id="ping">
                        <p><?php echo INSTRUCTIONS_NOTE_GOOGLE_SITEMAPS; ?></p>
                        <p><?php echo INSTRUCTIONS_STEP2_GOOGLE_SITEMAPS; ?></p>
                        <center>
                        <a target="_blank" href="<?php echo $returned_url = GenerateSubmitURL(google); ?>" title="Google Sitemaps Ping"><?php echo tep_image_button('button_google.gif', IMAGE_PING); ?></a>
                        <a target="_blank" href="<?php echo $returned_url = GenerateSubmitURL(ask); ?>" title="Ask Sitemaps Ping"><?php echo tep_image_button('button_ask.gif', IMAGE_PING); ?></a>
                        <a target="_blank" href="<?php echo $returned_url = GenerateSubmitURL(bing); ?>" title="Bing Sitemaps Ping"><?php echo tep_image_button('button_bing.gif', IMAGE_PING); ?></a>
                        </center>
                        </div>
                        
                        <div id="complete">
                        <p><?php echo COMPLETE_GOOGLE_SITEMAPS; ?></p>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="25%" align="right" valign="top">
                  <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                    <tr class="infoBoxHeading">
                      <td align="left" class="smallText"> <strong><?php echo WHATIS_TITLE_GOOGLE_SITEMAPS; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="infoBoxContent"><p><?php echo WHATIS_TEXT_GOOGLE_SITEMAPS; ?></p><?php echo WHATIS_REGISTER_GOOGLE_SITEMAPS; ?><br><br><center><a href="http://www.google.com/webmasters/tools/" target="_blank"><?php echo tep_image_button('button_login.gif', IMAGE_LOGIN); ?></a></center><p>&nbsp;</p></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>       
<!-- body_text_eof //-->
      </table>
    </td>
  </tr>
</table>
<!-- body_eof //-->
<script type="text/javascript">
$(document).ready(function() {
	$('#ping').hide();
	$('#complete').hide();
	$('#regenerate').each(function() {
		var $link = $(this);
		var $dialog = $('<div><\/div>')
			.load($link.attr('href'))
			.dialog({
				autoOpen: false,
				title: $link.attr('title'),
				width: 700,
				height: 400,
				modal: true,
				buttons: { "Ok": function() { $(this).dialog("close"); $('#ping').show(); } }
			});

		$link.click(function() {
			$dialog.dialog('open');
            
			return false;
		});
	});
});
</script>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
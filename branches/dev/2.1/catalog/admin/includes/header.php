<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="includes/javascript/hoverIntent.js"></script>
<script type="text/javascript" src="includes/javascript/superfish.js"></script>
<script type="text/javascript" src="includes/javascript/supersubs.js"></script>
<script type="text/javascript" src="includes/javascript/jquery.cluetip.min.js" ></script>

<script type="text/javascript">
// initialise Superfish & jQuery UI Tabs

    $(document).ready(function(){
        $("ul.sf-menu").supersubs({
            minWidth:    12,   // minimum width of sub-menus in em units
            maxWidth:    27,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
        }).superfish();  // call supersubs first, then superfish, so that subs are
                         // not display:none when measuring. Call before initialising
                         // containing tabs for same reason.

// Datepickers
    $('#product_available').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 2});
    $('#specials').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 2});
	$('#articles').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 2});
	$('#batch_print_start').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
    $('#batch_print_end').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
    $('#banners_expires').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#banners_scheduled').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#nopurchases_start').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#nopurchases_end').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#products_featured_until').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#categories_featured_until').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#manufacturers').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});
	$('#manufacturer').datepicker({inline: true, dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, numberOfMonths: 1});

//Batch Print Center
	$("#Labels").hide();
	$("#Invoices").hide();
    $("#file_type").change(function(){
		var show_options = (this.value);
		if(show_options == 'Labels.php') {
			$("#Invoices").hide();
			$("#Labels").show();
			$("#No_Options").hide();
		} else {
			if (show_options == 'Invoice.php') {
        	$("#Invoices").show();
			$("#Labels").hide();
			$("#No_Options").hide();
		} else {
			$("#Invoices").hide();
			$("#Labels").hide();
			$("#No_Options").show();
		}}
	});

// Tabs
    $("#searchtabs").tabs();
    $("#tabs").tabs();

    $("#descriptiontabs0").tabs();
	$("#descriptiontabs1").tabs();
	$("#descriptiontabs2").tabs();
	$("#descriptiontabs3").tabs();
	$("#descriptiontabs4").tabs();
	$("#descriptiontabs5").tabs();

	$("#languagetabs").tabs();
	$("#authortabs").tabs();
	$("#articletabs").tabs();
	$("#informationtabs").tabs();

    $('span[title]').cluetip({splitTitle: '|', arrows: true, dropShadow: false, cluetipClass: 'jtip'});


<!--//Tabs for QPBPP for SPPC -->
/* Tabs for Languages */
    $("#langtabs").tabs();
/* Tabs for Customer Groups */
    $("#qpbpp").tabs();

	$("#categorytabs").tabs();

/* Show/Hide for QPBPP for SPPC */
	$('#show0').click(function(){ $('#row-1').show(); $('#show0').hide(); });
	$('#show1').click(function(){ $('#row-2').show(); $('#show1').hide(); });
	$('#show2').click(function(){ $('#row-3').show(); $('#show2').hide(); });
	$('#show3').click(function(){ $('#row-4').show(); $('#show3').hide(); });
	$('#show4').click(function(){ $('#row-5').show(); $('#show4').hide(); });
	$('#show5').click(function(){ $('#row-6').show(); $('#show5').hide(); });
	$('#show6').click(function(){ $('#row-7').show(); $('#show6').hide(); });
	$('#show7').click(function(){ $('#row-8').show(); $('#show7').hide(); });
	$('#show8').click(function(){ $('#row-9').show(); $('#show8').hide(); });
	$('#show9').click(function(){ $('#row-10').show(); $('#show9').hide(); });

//Code for EPF show/hide list functions
var toggle = $("input[name='yestoggle']:checked").val();
if (toggle == 0) {
  $("#listofvalues").hide();
}

$("#yestoggle").click(function(){
	$("#listofvalues").show();						   
});
$("#notoggle").click(function(){
	$("#listofvalues").hide();						   
});


});

</script>
<script language="javascript" type="text/javascript">
<!--
function setMessage() {
var newmessage = document.status.responses.value;
document.status.comments.value += newmessage;
}
//-->
</script>
<?php
/*
$Id: header.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }

?>
<?php
  $my_userid_query = tep_db_query ("select a.admin_id, a.admin_username, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id= " . $login_id . " and g.admin_groups_id= " . $login_groups_id . "");
  $myLogin = tep_db_fetch_array($my_userid_query);
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F0F1F1">
<tr valign="top">
  <td width="33%" align="left"><a href="http://www.oscmax.com/" target="_blank" class="header"><?php echo tep_image(DIR_WS_IMAGES . STORE_LOGO); ?></a></td>
  <td width="33%" align="center">
    <table width="236">
      <tr>
        <td class="smallText" align="center">
            <div id="searchtabs" class="ui-tabs">
                <ul>
                <li><a href="#searchtabs-1">Customers</a></li>
                <li><a href="#searchtabs-2">Products</a></li>
                <li><a href="#searchtabs-3">Orders</a></li>
                </ul>

                <div id="searchtabs-1" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search_customers', FILENAME_CUSTOMERS, '', 'get') . tep_draw_input_field('search') . tep_hide_session_id(); ?></form></div>

                <div id="searchtabs-2" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search_products', FILENAME_CATEGORIES, '', 'get') . tep_draw_input_field('search') . tep_hide_session_id(); ?></form></div>

                <div id="searchtabs-3" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search_orders', FILENAME_ORDERS, '', 'get') . tep_draw_input_field('q', '', $orderparams, false, 'text', false) . tep_draw_input_field('action', 'edit', '', false, 'hidden', false); ?></form></div>

            </div>
	    </td>
	  </tr>
    </table>
  </td>
  <td width="33%" class="smalltext" align="right">

  <?php
$current_page = basename($_SERVER['SCRIPT_FILENAME']);

//Could be extended to language specific help documents
//$help_pages_query_raw = tep_db_query ("select current_page, help_page, help_page_title, language from " . TABLE_HELP_PAGES . " where current_page = '" . tep_db_input($current_page) . "' and language = '" . (int)$languages[$i]['id'] . "'");
$help_pages_query_raw = tep_db_query ("select current_page, help_page, help_page_title, language from " . TABLE_HELP_PAGES . " where current_page = '" . tep_db_input($current_page) . "'");


$help_pages_query = tep_db_fetch_array($help_pages_query_raw);

if ($help_pages_query['help_page'] != '' ) {
	echo '<a href="' . $help_pages_query['help_page'] . '" title="' . $help_pages_query['help_page_title'] . '" target="_blank">' . tep_image(DIR_WS_IMAGES . 'icons/help.png', 'Help') . '</a>';
}
?>
  	<?php echo tep_draw_form('languages', 'index.php', '', 'get'); ?>
  	<?php echo tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?>
  	<?php echo tep_hide_session_id(); ?></form>

	<?php echo '<a href="' . tep_href_link(FILENAME_ADMIN_ACCOUNT, '', 'SSL') . '" class="header">'; ?>
	<?php echo tep_image(DIR_WS_ICONS . 'book_key.png', 'Manage Account'); ?> Welcome, <?php echo $myLogin['admin_username']; ?>.</a>
	<?php echo '<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'SSL') . '" class="header">'; ?>
	<?php echo tep_image(DIR_WS_ICONS . 'exit.png', 'Logoff'); ?> Logoff &nbsp;</a>
  </td>
</tr>
<tr style="background-color:#606060">
  <td colspan="4">
    <?php require(DIR_WS_INCLUDES . 'menu.php'); ?>
  </td>
</tr>
</table>
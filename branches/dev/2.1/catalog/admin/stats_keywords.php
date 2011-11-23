<?php
/*
  $Id: stats_keywords.php,v 0.90 10/03/2002 03:15:00 Exp $
	by Cheng	


  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  if(isset($_GET['txtWord']) && $_GET['txtWord'] != '' && isset($_GET['txtReplacement']) && $_GET['txtReplacement'] != '' && !isset($_GET['updateword'])){
    $newword_sql = "INSERT INTO searchword_swap (sws_word, sws_replacement)VALUES('" . addslashes($_GET['txtWord']) . "', '" . addslashes($_GET['txtReplacement']) . "' )";
    $result = tep_db_query($newword_sql);
    header('location: ' . tep_href_link('stats_keywords.php', 'action=' . BUTTON_VIEW_WORD_LIST . ''));
    exit;	  	
  }
  
  if(isset($_GET['removeword']) && isset($_GET['delete'])){
   $word_delete_sql = "DELETE FROM searchword_swap WHERE sws_id = " . $_GET['delete'];
   $result = tep_db_query($word_delete_sql);
   header('location: ' . tep_href_link('stats_keywords.php', 'action=' . BUTTON_VIEW_WORD_LIST . ''));    	  	
  }

  if(isset($_GET['editword']) && isset($_GET['link'])){
   $word_select_sql = "SELECT * FROM searchword_swap WHERE sws_id = " . $_GET['edit'];
   $result = tep_db_query($word_select_sql);
   $word_select_result = tep_db_fetch_array($result);  	  	
  } 

  if(isset($_GET['editword']) && isset($_GET['updateword'])){
   $word_update_sql = "UPDATE searchword_swap SET sws_word= '" . addslashes($_GET['txtWord']) . "', sws_replacement = '" . addslashes($_GET['txtReplacement']) . "' WHERE  sws_id = " . $_GET['id'];
   $result = tep_db_query($word_update_sql);
   header('location: ' . tep_href_link('stats_keywords.php', 'action=' . BUTTON_VIEW_WORD_LIST . ''));    	  	
  }  
  
  if ($_GET['action'] == BUTTON_DELETE) {
	tep_db_query("delete from search_queries_sorted");
	header('location: ' . tep_href_link('stats_keywords.php', '')); 
  } // delete db					

  if ($_GET['update'] == BUTTON_UPDATE_WORD_LIST) {
    $sql_q = tep_db_query("SELECT DISTINCT search_text, COUNT(*) AS ct FROM search_queries GROUP BY search_text");

       while ($sql_q_result = tep_db_fetch_array($sql_q)) {                        				
	   $update_q = tep_db_query("select search_text, search_count from search_queries_sorted where search_text = '" . addslashes($sql_q_result['search_text']) . "'");
           $update_q_result = tep_db_fetch_array($update_q);
           $count = $sql_q_result['ct'] + $update_q_result['search_count'];

             if ($update_q_result['search_count'] != '') {
	        tep_db_query("update search_queries_sorted set search_count = '" . $count . "' where search_text = '" . addslashes($sql_q_result['search_text']) . "'");
	     } else {
                tep_db_query("insert into search_queries_sorted (search_text, search_count) values ('" . 
		 addslashes($sql_q_result['search_text']) . "'," . $count . ")");
	     } // search_count

           tep_db_query("delete from search_queries where search_text = '" . addslashes($sql_q_result['search_text']) ."'");
        } // while
   } // update db
  
  switch($_GET['sortorder']){
    case BUTTON_SORT_NAME:
      $pw_sql = "SELECT search_text, search_count FROM search_queries_sorted ORDER BY search_text ASC" ;
      break;
    case BUTTON_SORT_TOTAL:
      $pw_sql = "SELECT search_text, search_count FROM search_queries_sorted ORDER BY search_count DESC" ;
      break;
    default:
      $pw_sql = "SELECT search_text, search_count FROM search_queries_sorted ORDER BY search_count DESC" ;
      break;
  }
  		
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
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="0">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
<table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1"  class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
</table></td>
<!-- body_text //-->
    <td valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="pageHeading"><?php echo HEADING_TITLE ?></td>
    <td class="pageHeading" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td class="main" colspan="2">
<?php
	
if (isset($_GET['action']) && $_GET['action']== BUTTON_VIEW_WORD_LIST) {
//switch for view word list	
  echo tep_draw_form('addwords', 'stats_keywords.php', '', 'get');

	?>
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<?php if(isset($_GET['add'])) { ?>
<tr><td colspan="4">
<table border="1" cellpadding="0" cellspacing="1" width="100%" bgcolour="gray"><tr><td>
  <table border="0" cellpadding="2" cellspacing="0" width="100%"><tr class="dataTableRow">
    <td class="main" nowrap><br><?php echo WORD_ENTRY_ORIGINAL ?> 
    <input type="text" name="txtWord" value="<?php if(isset($word_select_result['sws_word'])){echo stripslashes($word_select_result['sws_word']);} ?>" size="12">&nbsp;
    <?php echo WORD_ENTRY_REPLACEMENT ?>
    <input type="text" name="txtReplacement" value="<?php if(isset($word_select_result['sws_replacement'])){echo stripslashes($word_select_result['sws_replacement']);} ?>" size="12"></td>
    <?php if(isset($word_select_result['sws_id'])){echo '<input type="hidden" name="id" value="' . $word_select_result['sws_id'] . '">';} ?>
  </tr>
  <tr class="dataTableRow">
    <td class="main"><?php  if(isset($_GET['editword']) && isset($_GET['link'])){ ?>
    <input type="submit" name="editword" value="<?php echo BUTTON_EDIT_WORD ?>">
    <input type="hidden" name="updateword" value="1">
    <br><br><?php }
    else { ?>
    <input type="submit" name="newword" value="<?php echo BUTTON_ADD_WORD ?>"><br><br>
    <?php } ?>
    </td>
  </tr>
  </table></td></tr></table>
  </d></tr>  
<?php } ?>  
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" width="40%"><?php echo WORD_ENTRY_ORIGINAL ?></td>
    <td class="dataTableHeadingContent" colspan="3"><?php echo WORD_ENTRY_REPLACEMENT ?></td>
  </tr>
<?php

$pw_word_sql = "SELECT * FROM searchword_swap ORDER BY sws_word ASC" ;
$pw_words = tep_db_query($pw_word_sql);
    while ($pw_words_result = tep_db_fetch_array($pw_words)) { ?>
  <tr class="dataTableRow">
    <td class="dataTableContent"><?php echo stripslashes($pw_words_result['sws_word']); ?></td>  
    <td class="dataTableContent"><?php echo stripslashes($pw_words_result['sws_replacement']); ?></td>
    <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link('stats_keywords.php', 'editword=1&link=1&add=1&action=' . BUTTON_VIEW_WORD_LIST . '&edit=' . $pw_words_result['sws_id']); ?>"><u><?php echo LINK_EDIT ?></u></a></td>
    <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link('stats_keywords.php', 'removeword=1&delete=' . $pw_words_result['sws_id']); ?>"><u><?php echo LINK_DELETE ?></u></a></td>
  </tr>
<?php    } // while 
?>
  <tr>
    <td colspan="4" class="main" align="right"><br><input type="submit" value="New Entry" name="add" />
    <input type="hidden" name="action" value="<?php echo BUTTON_VIEW_WORD_LIST ?>"></td>
  </tr>
</table></form>
    <?php } //end 'if' switch for view word list
    
    if ($_GET['sortorder'] == BUTTON_SORT_NAME) {
	  $name_icon = tep_image_button('ic_down.gif', BUTTON_SORT_NAME);
	  $number_icon = '';
	} else {
	  $name_icon = '';
	  $number_icon = tep_image_button('ic_down.gif', BUTTON_SORT_TOTAL);
	}
    
    if(!isset($_GET['action']) && $_GET['action'] != BUTTON_VIEW_WORD_LIST){
    	?>
    	<table border="0" cellpadding="2" cellspacing="0" width="100%">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent"><a href="<?php echo tep_href_link(FILENAME_KEYWORDS, 'sortorder=' . BUTTON_SORT_NAME); ?>"><b><?php echo KEYWORD_TITLE . '&nbsp;' . $name_icon; ?></b></a></td>
    <td class="dataTableHeadingContent" width="100" align="center"><a href="<?php echo tep_href_link(FILENAME_KEYWORDS, 'sortorder=' . BUTTON_SORT_TOTAL); ?>"><b><?php echo KEYWORD_TITLE2 . '&nbsp;' . $number_icon; ?></b></a></td>
  </tr>
<?php

  $result_count = 0;
  $sql_q = tep_db_query($pw_sql);
    while ($sql_q_result = tep_db_fetch_array($sql_q)) {
	  $result_count++;	
	  ?>
      <tr class="dataTableRow"  onmouseover="this.className='dataTableRowOver'" onMouseOut="this.className='dataTableRow'" >
        <td class="dataTableContent"><a target="_blank" href="<?php echo tep_catalog_href_link( 'advanced_search_result.php', 'keywords=' . urlencode($sql_q_result['search_text']). '&amp;search_in_description=1&amp;nocount=1' ); ?>"><?php echo $sql_q_result['search_text']; ?></a></td>  
        <td class="dataTableContent" align="center"><?php echo $sql_q_result['search_count']; ?></td>
      </tr>
<?php
    } // while 
    
	// lets check if there is no data
	if ($result_count == 0) { ?>
	  <tr>
	    <td class="messageStackAlert" colspan="2"><?php echo TEXT_NO_RESULTS; ?></td>
      </tr>
	<?php
    }
?>
    </td></tr></table>
    	
     <?php } ?>
    </td>
  </tr>
 </table>
    </td>
<!-- body_eof //-->
<!-- right_column_bof //-->
<td valign="top" width="25%">
<?php echo tep_draw_form('delete', 'stats_keywords.php', '', 'get'); ?>
<table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td class="pageHeading" align="right">&nbsp;</td>
  </tr><tr>
    <td>
<?php
    $heading = array();
    $contents = array();

    $heading[]  = array('text'  => '<b>' . SIDEBAR_HEADING . '</b>');

    $contents[] = array('text'  => '<br>' . SIDEBAR_INFO_1);
    $contents[] = array('align' => 'center', 'text'  => '<input type="submit" name="update" value="' . BUTTON_UPDATE_WORD_LIST . '">');
    $contents[] = array('text'  =>  tep_draw_separator());
    $contents[] = array('text'  => '<br>' . SIDEBAR_INFO_2);
    $contents[] = array('align' => 'center', 'text'  => '<input type="submit" name="action" value="' . BUTTON_DELETE . '">');
    $contents[] = array('text'  =>  tep_draw_separator());
    $contents[] = array('text'  => SIDEBAR_INFO_3);
    $contents[] = array('align' => 'center', 'text'  => '<input type="submit" name="action" value="' . BUTTON_VIEW_WORD_LIST . '">');

    
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {

    $box = new box;
    echo $box->infoBox($heading, $contents);
  } ?>    
</td></tr></table></form>
</td>
  </tr>
</table>  
<!-- right_column_eof //-->
            
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>         
</html>       
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php
/*
$Id: advanced_search.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

// Search enhancement mod start

if(isset($_GET['keywords']) && $_GET['keywords'] != ''){
	if(!isset($_GET['s'])){
  	    $pwstr_check = strtolower(substr($_GET['keywords'], strlen($_GET['keywords'])-1, strlen($_GET['keywords'])));
  	    if($pwstr_check == 's'){
  	            $pwstr_replace = substr($_GET['keywords'], 0, strlen($_GET['keywords'])-1);
  	            header('location: ' . tep_href_link( FILENAME_ADVANCED_SEARCH_RESULT , 'search_in_description=1&s=1&keywords=' . urlencode($pwstr_replace) . '' ));
  	            exit;
  	    }
        } 

       $pw_keywords = explode(' ',stripslashes(strtolower($_GET['keywords'])));
       $pw_boldwords = $pw_keywords;
       $sql_words = tep_db_query("SELECT * FROM searchword_swap");
       $pw_replacement = '';
       while ($sql_words_result = tep_db_fetch_array($sql_words)) {
       	   if(stripslashes(strtolower($_GET['keywords'])) == stripslashes(strtolower($sql_words_result['sws_word']))){
       	       $pw_replacement = stripslashes($sql_words_result['sws_replacement']);
       	       $pw_link_text = '<b><i>' . stripslashes($sql_words_result['sws_replacement']) . '</i></b>';
       	       $pw_phrase = 1;
       	       $pw_mispell = 1;
       	       break;
       	   }
           for($i=0; $i<sizeof($pw_keywords); $i++){
               if($pw_keywords[$i]  == stripslashes(strtolower($sql_words_result['sws_word']))){
                   $pw_keywords[$i]  = stripslashes($sql_words_result['sws_replacement']);
                   $pw_boldwords[$i] = '<b><i>' . stripslashes($sql_words_result['sws_replacement']) . '</i></b>';
                   $pw_mispell = 1;
                   break;
               }
           }	
       }
       if(!isset($pw_phrase)){
           for($i=0; $i<sizeof($pw_keywords); $i++){
               $pw_replacement .= $pw_keywords[$i]. ' ';
       	       $pw_link_text   .= $pw_boldwords[$i]. ' ';	
           }
       }
       
       $pw_replacement = trim($pw_replacement);
       $pw_link_text   = trim($pw_link_text);
       $pw_string      = '<br><span class="main"><font color="red">' . TEXT_REPLACEMENT_SUGGESTION . '</font><a href="' . tep_href_link( FILENAME_ADVANCED_SEARCH_RESULT , 'keywords=' . urlencode($pw_replacement) . '&search_in_description=1' ) . '">' . $pw_link_text . '</a></span><br><br>';
}
// Search enhancement mod end

// Search enhancement mod start
                $search_enhancements_keywords = $_GET['keywords'];
                $search_enhancements_keywords = strip_tags($search_enhancements_keywords);
                $search_enhancements_keywords = addslashes($search_enhancements_keywords);                
          
                if ($search_enhancements_keywords != $last_search_insert) {
                        tep_db_query("insert into search_queries (search_text)  values ('" .  $search_enhancements_keywords . "')");
                        tep_session_register('last_search_insert');
                        $last_search_insert = $search_enhancements_keywords;
                }
// Search enhancement mod end
  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));

  $content = CONTENT_ADVANCED_SEARCH;
  $javascript = $content . '.js.php';

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

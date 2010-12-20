<?php 
 /**
 *
 * ULTIMATE Seo Urls 5
 *
 * 
 * @package Ultimate Seo Urls 5
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link http://www.fwrmedia.co.uk
 * @copyright Copyright 2008-2009 FWR Media
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2009-11-29 13:12:25 +0000 (Sun, 29 Nov 2009)       $:  Date of last commit
 * @version $Rev:: 107                                                 $:  Revision of last commit
 * @Id $Id:: notfound_404.php 107 2009-11-29 13:12:25Z Rob             $:  Full Details   
 */

$text = array(
'title' => 'Page not found',
'text' => 'The page you were looking for could not be found. Please click the below link to return to ' . STORE_NAME . '
<p><a href="' . tep_href_link( FILENAME_DEFAULT ) . '" title="' . STORE_NAME . '">' . STORE_NAME . '</a></p><br />' );
header( "HTTP/1.0 404 Not Found" );
?>
<title>Page Not Found</title>  
<div style="padding: 3em; font-family: verdana; margin: 3em; border: 1px solid #e5e5e5;">
  <div style="background-color: #2E8FCA; font-size: 12pt; font-weight: bold; padding: 0.5em; color: #00598E;">
    <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div><?php echo $text['title']; ?></div>
  <div style="padding: 0.5em; font-size: 9pt; font-family: verdana;"><?php echo $text['text']; ?></div></div>
</div>
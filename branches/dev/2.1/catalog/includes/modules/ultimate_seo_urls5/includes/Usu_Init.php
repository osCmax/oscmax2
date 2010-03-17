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
 * @copyright Portions Copyright 2005 Bobby Easland
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2009-11-29 17:56:51 +0000 (Sun, 29 Nov 2009)       $:  Date of last commit
 * @version $Rev:: 108                                                 $:  Revision of last commit
 * @Id $Id:: Usu_Init.php 108 2009-11-29 17:56:51Z Rob                 $:  Full Details   
 */

   // Set to true to delete the cache (or alternatively just delete the cache files via ftp)
   // You have to set this back to false after running the front of the site once or the cache will not rebuild
  @define( 'SEO_URLS_RESET_CACHE', 'false' );
  // true to turn Seo Url 5 on - false reverts to standard urls ( even search engine safe if you are mad )
  @define( 'SEO_URLS_ENABLED', 'true' ); // Recommended true
  // Options rewrite and standard ( rewrite requires mods to .htaccess)
  @define( 'SEO_URLS_TYPE', 'standard' ); // Recommended rewrite
  // Special language characters to replace comma seperated key=>value pairs
  @define( 'SEO_URLS_CHAR_CONVERT_SET', '' ); //Like: a=>b,g=>z,h=>y
  // Filter short words so a setting of e.g. 2 will omit in / of / at / etc.
  @define( 'SEO_URLS_FILTER_SHORT_WORDS', 3 );
  // unwise this one - you'd end up with mygreatproduct instead of my-great-product
  @define( 'SEO_URLS_REMOVE_ALL_SPEC_CHARS', 'false' ); // Recommended false
  // Legnth of time for the cache to remain current in days
  @define( 'SEO_URLS_CACHE_DAYS', 7 );
  // Output W3C valid urls
  @define( 'SEO_URLS_USE_W3C_VALID', 'true' );
  // Add cPath to the product urls -- why? just to bold the category links?
  @define( 'SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS', 'false' );
  // Show the output from Seo Urls 5 and guage its efficiency
  @define( 'SEO_URLS_OUPUT_PERFORMANCE', 'false' );
  // Add category parent to the front of categories names
  @define( 'SEO_URLS_ADD_CAT_PARENT', 'true' );
  // Cache system to use
  @define( 'SEO_URLS_CACHE_SYSTEM', 'FileSystem' );
?>
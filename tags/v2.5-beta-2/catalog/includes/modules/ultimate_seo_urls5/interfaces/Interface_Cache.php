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
 * @lastmod $Date:: 2009-05-25 14:45:39 +0100 (Mon, 25 May 2009)       $:  Date of last commit
 * @version $Rev:: 66                                                  $:  Revision of last commit
 * @Id $Id:: Interface_Cache.php 66 2009-05-25 13:45:39Z Rob           $:  Full Details   
 */

  interface Interface_Cache {
    
    public function store();
    
    public function retrieve();
    
    public function gc();
  }
?>
<?php
  require('../../../includes/configure.php');

//************************** BEGIN CONFIGURATION *****************************//

//example, this is the actual file system path
//of the web server document root. e.g.
// Filesystem == /home/web/www.yourdomain.com 
$BASE_DIR = DIR_FS_DOCUMENT_ROOT;

//the path where the browser sees the document root (i.e. http://www.yourdomain.com/)
$BASE_URL = HTTP_SERVER;

//this is where the files will be stored relative to the $BASE_DIR (and $BASE_URL)
//this directory MUST be readable AND writable by the web server.
$BASE_ROOT = 'catalog/download';


//************************** END CONFIGURATION *****************************//

$FILE_ROOT = $BASE_ROOT;

if(strrpos($BASE_DIR, '/')!= strlen($BASE_DIR)-1)
        $BASE_DIR .= '/';

if(strrpos($BASE_URL, '/')!= strlen($BASE_URL)-1)
        $BASE_URL .= '/';

//Built in function of dirname is faulty
//It assumes that the directory name can not contain a . (period)
function dir_name($dir) 
{
        $lastSlash = intval(strrpos($dir, '/'));
        if($lastSlash == strlen($dir)-1){
                return substr($dir, 0, $lastSlash);
        }
        else
                return dirname($dir);
}

?>

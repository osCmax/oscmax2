<?php
/*
** Change ONLY the following lines to match your server setup
*/

// CONSTRAIN_* indicates the image constraints used to scale uploads (0 = none)
define("CONSTRAIN_HEIGHT", 0);
define("CONSTRAIN_WIDTH", 0);

// IMAGE_DIR and IMAGE_URL identify the Image directory "root" (MUST end in "/")
// Do NOT include "http://my.hostname.com" in IMAGE_URL; just the path from the
// DocumentRoot of your webserver.
define("IMAGE_DIR", trim("/path/from/filesystem/root/"));
define("IMAGE_URL", trim("/path/from/webserver/document/root/"));

// NETPBM_DIR identifies the directory where NETPBM is located (MUST end in "/")
// Not used if either CONSTRAIN_HEIGHT or CONSTRAIN_WIDTH (above) is specified as "0".
define("NETPBM_DIR", trim("/path/from/filesystem/root/"));

// SCRIPT_DIR and SCRIPT_URL identify where these scripts reside (MUST end in "/")
// Do NOT include "http://my.hostname.com" in SCRIPT_URL; just the path from the
// DocumentRoot of your webserver.
define("SCRIPT_DIR", trim("/path/from/filesystem/root/"));
define("SCRIPT_URL", trim("/path/from/webserver/document/root/"));

// SUPPORT_* identify optional features
define("SUPPORT_BITMAP", TRUE);  // supported by Internet Explorer ONLY!
define("SUPPORT_CREATE", TRUE);
define("SUPPORT_DELETE", TRUE);
define("SUPPORT_METAFILE", TRUE);// supported by Internet Explorer ONLY!
define("SUPPORT_UPLOAD", TRUE);

// UPLOAD_LIMIT indicates the maximum file size (in BYTES!) which can be uploaded (0 = unlimited)
define("UPLOAD_LIMIT", 0);

/*
** Change ONLY the preceeding lines to match your server setup
*/

/*
** DO NOT CHANGE beyond this point UNLESS you have
** modified 'insert_image.html' OR any of the scripts
*/
$dpi = 0;
if(isset($HTTP_GET_VARS["DPI"])) {
   $dpi = $HTTP_GET_VARS["DPI"];
}
else if(isset($HTTP_POST_VARS["DPI"])) {
   $dpi = $HTTP_POST_VARS["DPI"];
}
if($dpi < 72 || $dpi > 150)
   $dpi = 96;

// AGENT_DPI identifies the DPI setting being used by the web browser
define("AGENT_DPI", $dpi);

// ICON_* identify the icons to be used by the "tree" pane
define("ICON_CLOSED", "closed.gif");
define("ICON_INDENT", "indent.gif");
define("ICON_OPENED", "opened.gif");
define("ICON_BMP", "bmp.gif");
define("ICON_GIF", "gif.gif");
define("ICON_JPG", "jpg.gif");
define("ICON_PNG", "png.gif");
define("ICON_WMF", "wmf.gif");

// IMAGE_* identify the image type values (most returned by PHP's getImageSize)
define("IMAGE_BMP", 6);
define("IMAGE_GIF", 1);
define("IMAGE_JPG", 2);
define("IMAGE_PNG", 3);
define("IMAGE_WMF", 42);

// LISTER_* identify elements used by the "tree" pane
define("LISTER_DELETE", "font: italic 7pt 'MS Shell Dlg', Helvetica, sans-serif;");
define("LISTER_NAME", "lister");
define("LISTER_PADDING", "4");
define("LISTER_SPACING", "0");
define("LISTER_STYLE", "font: 8pt 'MS Shell Dlg', Helvetica, sans-serif;");
define("LISTER_TAG", "IFRAME");

// MANAGER_* identify elements used to connect the panes to the "action" form
define("MANAGER_NAME", "manager");
define("MANAGER_SRC", "txtFileName");
define("MANAGER_TAG", "TABLE");

// METAFILE_* indentify constants used in decoding Placeable Metafile Headers
define("METAFILE_DPI", 96);
define("METAFILE_KEY", "9ac6cdd7");

// NETPBM_* indentify commands used in image constraining (WMFs cannot be constrained!)
define("NETPBM_BMP", "bmptopnm  \"%s\" | pnmscale %s | ppmtobmp  >\"%s\"");
define("NETPBM_GIF", "giftopnm  \"%s\" | pnmscale %s | ppmtogif  >\"%s\"");
define("NETPBM_JPG", "jpegtopnm \"%s\" | pnmscale %s | pnmtojpeg >\"%s\"");
define("NETPBM_PNG", "pngtopnm  \"%s\" | pnmscale %s | pnmtopng  >\"%s\"");

// PANE_* identify the geometry and conversion factors used by the panes
define("PANE_XFACTOR", ((AGENT_DPI == 96) ? 1 : (AGENT_DPI / ((AGENT_DPI < 96) ? 95 : 97.5))));
define("PANE_YFACTOR", ((AGENT_DPI == 96) ? 1 : (AGENT_DPI / ((AGENT_DPI < 96) ? 95 : 99.5))));
define("PANE_HEIGHT", floor((115 * PANE_YFACTOR)));
define("PANE_LABEL", ceil((35 * PANE_YFACTOR)));
define("PANE_WIDTH", floor((200 * PANE_XFACTOR)));

// TEXT_* identify literal text used by the "tree" and "preview" panes
define("TEXT_DELETE", "[delete]");
define("TEXT_ROOT", "Images Root");
define("TEXT_SELECT", "<i>No<br>Image<br>Selected<br>for<br>Preview</i>");

// VIEWER_* identify elements used by the "preview" pane
define("VIEWER_NAME", "viewer");
define("VIEWER_NONE", "font: italic 12pt 'MS Shell Dlg', Helvetica, sans-serif;");
define("VIEWER_PADDING", "2");
define("VIEWER_SPACING", "0");
define("VIEWER_STYLE", "font: 8pt 'MS Shell Dlg', Helvetica, sans-serif; background-color: #c0c0c0;");
define("VIEWER_TAG", "IFRAME");

// WRAPPER_* identify elements used to connect the "tree" and "preview" panes
define("WRAPPER_NAME", "wrapper");
define("WRAPPER_TAG", "TABLE");

/*
** Globals
*/
$base = "";
$dirs = array();
$error = "";
$info = "";

/*
** Returns a complete Path from the Base.
**
** Params:  $path    - Path to complete
**          $nodes   - Count of Nodes to include
*/
function basePath($path, $nodes = 999) {
   global $base, $dirs;

   // initialize context
   $result = "";
   $count = count($dirs);

   // for ALL desired Nodes ...
   for($index = 0; $nodes > 0 && $index < $nodes && $index < $count; $index++)

      // ... if Node is NOT null ...
      if(strlen($dirs[$index]) > 0)

         // ... append the Node and separator
         $result .= $dirs[$index] . "/";

   // append the Path
   $result .= $path;

   // return the Path
   return $result;
}

/*
** Parses, cleans and sets the Base path.
**
** Params:  $path    - Path to parse and clean
*/
function cleanPath($path) {
   global $dirs, $base;

   // initialize context
   $nodes = 0;
   $clean = "";

   // parse the Path
   $dirs = split('[/\\]', "$path");

   // for ALL Directories in the Path ...
   foreach($dirs as $dir) {

      // ... if this is a Relative path ...
      if(!(strcmp($dir, ".."))) {

         // ... if NOT at the ROOT ...
         if($nodes > 1)

            // ... decrement Node depth
            $nodes--;
      }

      // ... otherwise, if Directory is NOT null ...
      else if(strlen($dir) > 0) {

         // ... based on Node depth ...
         switch($nodes++) {

         default:
            // ... append a Path separator
            $clean .= "/";

            //
            // fall-thru is intentional
            //

         case 0:
            // ... append the Directory
            $clean .= $dir;
            break;
         }
      }
   }

   // re-parse the Path (w/o any relative nodes!)
   $dirs = split('[/\\]', "$clean");
   $base = implode("/", $dirs);

   // return the Path
   return $dirs;
}

/*
** Returns a fully-qualified URL for the specified Image file
**
** Params:  $path    - Path to Image
**          $encode  - TRUE if URL is to be encoded; FALSE otherwise
**
** Returns: Fully-qualified URL
*/
function imageInfo($path) {

   // if Image info is NOT available ...
   if(!($size = @getImageSize($path))) {

      // ... if Metafile support is desired AND File opens ...
      if(SUPPORT_METAFILE && ($fp = fopen($path, "rb"))) {

         // ... read the File
         $key = readDWORD($fp);

         // if File is a Windows Metafile (WMF) ...
         if(!(strcasecmp(dechex($key), METAFILE_KEY))) {

            // ... read remainder of WMF header
            readWORD($fp);
            $x2 = readSHORT($fp);
            $y2 = readSHORT($fp);
            $x = readSHORT($fp);
            $y = readSHORT($fp);
            $inch = readWORD($fp);

            // calculate the size
            $width = abs(($x2 - $x));
            $height = abs(($y2 - $y));
            $width = round((($width * METAFILE_DPI) / $inch));
            $height = round((($height * METAFILE_DPI) / $inch));

            // return the Info
            $size = array($width, $height, IMAGE_WMF, "width=\"$width\" height=\"$height\"");
         }

         // close the File
         fclose($fp);
      }
   }

   // return the Info
   return $size;
}

/*
** Returns a fully-qualified URL for the specified Image file
**
** Params:  $path    - Path to Image
**          $encode  - TRUE if URL is to be encoded; FALSE otherwise
**
** Returns: Fully-qualified URL
*/
function imageURL($path, $encode = FALSE) {
   global $HTTP_SERVER_VARS;

   // initialize context
   $url = (IMAGE_URL . $path);

   // if URL is to be encoded ...
   if($encode) {

      // ... encode the URL
      $url = rawurlencode($url);
      $url = str_replace("%2F", "/", $url);
   }

   // return the URL
   return ("http://" . $HTTP_SERVER_VARS["HTTP_HOST"] . $url);
}

/*
** Returns the Windows status.
**
** Returns: TRUE if server is Windows hosted; FALSE otherwise
*/
function isWindows() {
   global $HTTP_SERVER_VARS;

   // return the Windows status
   return isset($HTTP_SERVER_VARS["WINDIR"]);
}

/*
** Reads a BYTE from the specified file.
**
** Params:  $fp      - File to read
**
** Returns: BYTE read
*/
function readBYTE($fp) {

   // return the BYTE
   return ord(@fread($fp, 1));
}

/*
** Reads a DWORD from the specified file.
**
** Params:  $fp      - File to read
**
** Returns: DWORD read
*/
function readDWORD($fp) {

   // create the DWORD
   $lo = readWORD($fp);
   $hi = readWORD($fp);
   $dword = (($hi << 16) | $lo);

   // return the DWORD
   return $dword;
}

/*
** Reads a SHORT from the specified file.
**
** Params:  $fp      - File to read
**
** Returns: SHORT read
*/
function readSHORT($fp) {

   // create the SHORT
   $short = readWORD($fp);

   // if SHORT is signed ...
   if($short & 0x8000)

      // ... make it negative
      $short |= 0xffff0000;

   // return the SHORT
   return $short;
}

/*
** Reads a WORD from the specified file.
**
** Params:  $fp      - File to read
**
** Returns: WORD read
*/
function readWORD($fp) {

   // create the WORD
   $lo = readBYTE($fp);
   $hi = readBYTE($fp);
   $word = (($hi << 8) | $lo);

   // return the WORD
   return $word;
}

/*
** Returns a fully-qualified URL for the specified Script
**
** Params:  $path    - Path to Script
**          $encode  - TRUE if URL is to be encoded; FALSE otherwise
**
** Returns: Fully-qualified URL
*/
function scriptURL($path, $encode = FALSE) {
   global $HTTP_SERVER_VARS;

   // initialize context
   $url = (SCRIPT_URL . $path);

   // if URL is to be encoded ...
   if($encode) {

      // ... encode the URL
      $url = rawurlencode($url);
      $url = str_replace("%2F", "/", $url);
   }

   // return the URL
   return ("http://" . $HTTP_SERVER_VARS["HTTP_HOST"] . $url);
}
?>
<meta http-equiv="expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<script language="javascript">
function findAncestor(element, name, type) {
   while(element != null && (element.name != name || element.tagName != type))
      element = element.parentElement;
   return element;
}
</script>
<?php

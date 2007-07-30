<html>
<head>
<?php
require("config.inc.php");
?>
<style type="text/css">
TD { <?php echo LISTER_STYLE; ?> }
TD.delete { <?php echo LISTER_DELETE; ?> }
</style>
<script language="javascript">

function actionComplete(action, path, error, info) {
   var manager = findAncestor(window.frameElement, '<?php echo MANAGER_NAME; ?>', '<?php echo MANAGER_TAG; ?>');
   var wrapper = findAncestor(window.frameElement, '<?php echo WRAPPER_NAME; ?>', '<?php echo WRAPPER_TAG; ?>');

   if(manager) {
      if(error.length < 1) {
         manager.all.actions.reset();
<?php
// if UPLOAD is supported ...
if(SUPPORT_UPLOAD) {

   // ... emit the JavaScript
   echo "         if(action == 'upload') {\n";
   echo "            manager.all.actions.image.value = '';\n";
   echo "            manager.all.actions.name.value = '';\n";
   echo "            manager.all.actions.width.value = '';\n";
   echo "            manager.all.actions.height.value = '';\n";
   echo "            manager.all.actions.aspect.checked = true;\n";
   echo "         }\n";

   // if NETPBM is NOT available ...
   if(!(file_exists(NETPBM_DIR))) {

      // ... emit the JavaScript
      echo "         manager.all.actions.width.disabled = true;\n";
      echo "         manager.all.actions.height.disabled = true;\n";
      echo "         manager.all.actions.aspect.disabled = true;\n";
   }
}

// if CREATE is supported ...
if(SUPPORT_CREATE) {

   // ... emit the JavaScript
   echo "         if(action == 'create')\n";
   echo "            manager.all.actions.folder.value = '';\n";
}

// if DELETE is supported ...
if(SUPPORT_DELETE) {

   // ... emit the JavaScript
   echo "         if(action == 'delete')\n";
   echo "            manager.all." . MANAGER_SRC . ".value = '';\n";
}
?>
      }
      manager.all.actions.DPI.value = <?php echo AGENT_DPI; ?>;
      manager.all.actions.path.value = path;
   }
   if(wrapper)
      wrapper.all.viewer.contentWindow.navigate('<?php echo scriptURL("viewer.php?DPI=") . AGENT_DPI; ?>');
   if(error.length > 0)
      alert(error);
   else if(info.length > 0)
      alert(info);
}
</script>
</head>
<?php
/*
** Emits the appropriate HTML for the specified Directory.
**
** Params:  $value - Directory name
**          $key - Array key (undefined)
**          $depth - Indent depth
**          $icon - Icon filename
**          $link - TRUE if Directory should be linked; FALSE otherwise
*/
function dirTag($value, $key, $depth, $icon = ICON_CLOSED, $link = TRUE) {
   global $HTTP_SERVER_VARS, $base;

   // initialize context
   $path = basePath($value, ($depth - 1));

   // emit the HTML
   echo "<tr><td align=\"left\" valign=\"bottom\" width=\"100%\">\n";

   // indent as required
   indentTag($depth);

   // emit the HTML
   echo "<img align=\"bottom\" src=\"" . scriptURL($icon) . "\" alt=\"$value\">";
   if($link) {
      echo "<a href=\"" . scriptURL(basename($HTTP_SERVER_VARS["PHP_SELF"])) . "?DPI=" . AGENT_DPI;
      if(strcmp(TEXT_ROOT, $value))
         echo "&path=" . urlencode($path);
      echo "\">";
   }
   echo "<b>$value</b>";
   echo "</a>";
   echo "</td><td class=\"delete\" align=\"right\" valign=\"bottom\">\n";
   if(SUPPORT_DELETE) {
      if(!(strcmp($icon, ICON_CLOSED)) && isEmpty($path))
         echo "<a href=\"javascript:deletePath('" . $path . "')\">" . TEXT_DELETE . "</a>";
   }
   echo "</td></tr>\n";
}

/*
** Creates a new Folder.
**
** Params:  $folder - Folder to create
*/
function doCreate($folder) {
   global $error;

   // initialize context
   $path = basePath($folder);

   // if Folder does NOT already exist ...
   if(!(file_exists(IMAGE_DIR . $path))) {

      // ... if Folder does NOT create ...
      if(!(@mkdir(IMAGE_DIR . $path, 0777)))

         // ... report the error
         $error = "Folder \'" . $path . "\' could not be created";
   }

   // ... otherwise, report the error
   else
      $error = "Folder \'" . $path . "\' already exists";
}

/*
** Deletes a Folder/File.
**
** Params:  $file - Folder/file to delete
*/
function doDelete($file) {
   global $base, $error;

   // if Folder/File exists ...
   if(file_exists(IMAGE_DIR . $file)) {

      // ... if this is a Folder ...
      if(is_dir(IMAGE_DIR . $file)) {

         // ... if Folder does NOT delete ...
         if(!(@rmdir(IMAGE_DIR . $file)))

            // ... report the error
            $error = "Folder \'" . $file . "\' could not be deleted";
      }

      // ... otherwise, if File does NOT delete ...
      else if(!(@unlink(IMAGE_DIR . $file)))

         // ... report the error
         $error = "Image \'" . $file . "\' could not be deleted";
   }

   // ... otherwise, report the error
   else
      $error = "Folder or file \'" . $file . "\' not found";
}

/*
** Lists a Path.
*/
function doList() {
   global $dirs;
   $exts = array("gif", "jpg", "jpeg", "png");

   // initialize context
   $nodes = 0;
   $current = (count($dirs) + 1);

   // emit the HTML
   echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n";
   dirTag(TEXT_ROOT, "", $nodes++, ICON_OPENED);

   // for ALL Directories in the Path ...
   foreach($dirs as $dir) {

      // ... if Directory is exists ...
      if(strlen($dir) > 0)

         // ... emit the HTML
         dirTag($dir, "", $nodes++, ICON_OPENED, ($nodes != $current));
   }

   // list Directories and emit the HTML
   $list = listDirs();
   @array_walk($list, dirTag, $nodes);

   // if BITMAP support is desired ...
   if(SUPPORT_BITMAP)

      // ... include BMP extensions
      $exts[] = "bmp";

   // if METAFILE support is desired ...
   if(SUPPORT_METAFILE)

      // ... include WMF extensions
      $exts[] = "wmf";

   // list Image files and emit the HTML
   $list = listFiles($exts);
   @array_walk($list, fileTag, $nodes);

   // emit the HTML
   echo "</table>\n";
}

/*
** Uploads an Image.
**
** Params:  $name - Name for uploaded Image
**          $width - Width to resize (OR zero)
**          $height - Height to resize (OR zero)
**          $aspect - TRUE if aspect ration is to be preserved; false otherwise
*/
function doUpload($name, $width, $height, $aspect) {
   global $HTTP_POST_FILES, $error, $info;

   // initialize context
   $temp = $HTTP_POST_FILES["image"]["tmp_name"];

   // if File is a legitimate upload ...
   if(is_uploaded_file($temp)) {
      $type = $HTTP_POST_FILES["image"]["type"];
      $types = array("image/gif" => "[.]gif$", "image/jpg" => "[.]jp[e]?g$", "image/jpeg" => "[.]jp[e]?g$", "image/pjpeg" => "[.]jp[e]?g$", "image/png" => "[.]png$", "image/x-png" => "[.]png$");

      // ... if BITMAP support is desired ...
      if(SUPPORT_BITMAP) {

         // ... add BITMAP type
         $types["image/bmp"] =  "[.]bmp$";
         $types["image/x-bmp"] =  "[.]bmp$";
      }

      // if METAFILE support is desired ...
      if(SUPPORT_METAFILE)

         // ... add METAFILE type
         $types["image/x-wmf"] =  "[.]wmf$";

      // if File is a valid image ...
      if(isset($types[$type])) {
         $search = (isWindows() ? "eregi" : "ereg");
         $replace = (isWindows() ? "eregi" : "ereg");

         // ... if Name was NOT specified ...
         if(strlen($name) < 1)

            // ... use the same Name
            $name = $HTTP_POST_FILES["image"]["name"];

         // if File has NO or an improper extension ...
         if(!($search($types[$type], $name))) {
            $exts = array("image/gif" => ".gif", "image/jpg" => ".jpg", "image/jpeg" => ".jpg", "image/pjpeg" => ".jpg", "image/png" => ".png", "image/x-png" => ".png", "image/bmp" => ".bmp", "image/x-bmp" => ".bmp", "image/x-wmf" => ".wmf");

            // ... if NO extension exists ...
            if(!($search("[.].+$", $name)))

               // ... append the proper extension
               $name .= $exts[$type];

            // ... otherwise, force a proper extension
            else
               $name = $replace("[.].*$", $exts[$type], $name);

            // notify the user
            $info = "Proper extension was added to make \'" . $name . "\' valid for this image type";
         }

         // if File has the proper extension now ...
         if($search($types[$type], $name)) {
            $path = basePath($name);

            // ... if File does NOT already exist ...
            if(!(file_exists(IMAGE_DIR . $path))) {
               $size = $HTTP_POST_FILES["image"]["size"];

               // ... if NO size limit exists OR File is NOT over the limit ...
               if(UPLOAD_LIMIT == 0 || $size <= UPLOAD_LIMIT) {

                  // ... if File CANNOT be copied ...
                  if(!(@copy($temp, (IMAGE_DIR . $path))))

                     // ... report the error
                     $error = "File \'" . $path . "\' could not be created";

                  // ... otherwise, if NETPBM is available ...
                  else if(file_exists(NETPBM_DIR)) {
                     $size = @imageInfo(IMAGE_DIR . $path);
                     $action = "resized";

                     // ... if Width was NOT specified ...
                     if($width < 1)

                        // ... use the image width
                        $width = $size[0];

                     // if Width exceeds image constraint ...
                     if(CONSTRAIN_WIDTH > 0 && CONSTRAIN_WIDTH < $width) {

                        // ... use the constrained width
                        $width = CONSTRAIN_WIDTH;
                        $action = "constrained";
                     }

                     // if Height was NOT specified ...
                     if($height < 1)

                        // ... use the image height
                        $height = $size[1];

                     // if Height exceeds image constraint ...
                     if(CONSTRAIN_HEIGHT > 0 && CONSTRAIN_HEIGHT < $height) {

                        // ... use the constrained height
                        $height = CONSTRAIN_HEIGHT;
                        $action = "constrained";
                     }

                     // if image must be scaled ...
                     if($size[0] != $width || $size[1] != $height) {
                        $script = "";

                        // ... based on type ...
                        switch($size[2]) {
                        case IMAGE_GIF:
                           $script = NETPBM_GIF;
                           break;
                        case IMAGE_JPG:
                           $script = NETPBM_JPG;
                           break;
                        case IMAGE_PNG:
                           $script = NETPBM_PNG;
                           break;
                        case IMAGE_BMP:
                           $script = NETPBM_BMP;
                           break;
                        }

                        // if image can be constrained using NETPBM (WMFs cannot) ...
                        if(strlen($script) > 0) {

                           // ... if aspect ration is to be preserved ...
                           if($aspect)

                              // ... set bounding box
                              $options = "-xysize $width $height";

                           // ... otherwise, set absolute dimensions
                           else
                              $options = "-xsize=$width -ysize=$height";

                           // if Windows environment ...
                           if(isWindows())

                              // ... prepend the command shell
                              $script = "cmd.exe /C $script";

                           // scale the image
                           $dir = getcwd();
                           chdir(NETPBM_DIR);
                           shell_exec(sprintf($script, $temp, $options, (IMAGE_DIR . $path)));
                           chdir($dir);

                           // notify the user
                           $size = @imageInfo(IMAGE_DIR . $path);
                           $info = "Image \'" . $name . "\' was $action to $size[0] × $size[1]";
                        }
                     }
                  }
               }

               // ... otherwise, report the error
               else
                  $error = "File \'" . $path . "\' exceeds " . round((UPLOAD_LIMIT / 1024)) . " KByte size limit";
            }

            // ... otherwise, report the error
            else
               $error = "File \'" . $path . "\' already exists";
         }

         // ... otherwise, report the error
         else
            $error = "Files of type \'" . $type . "\' require a matching extension";
      }

      // ... otherwise, report the error
      else
         $error = "File \'" . $HTTP_POST_FILES["image"]["name"] . "\' is not a supported type ($type)";
   }

   // ... otherwise, report the error
   else
      $error = "Invalid upload environment";
}

/*
** Emits the appropriate HTML for the specified File.
**
** Params:  $value - File name
**          $key - Array key (undefined)
**          $depth - Indent depth
*/
function fileTag($value, $key, $depth) {

   // initialize context
   $file = basePath($value);
   $size = @imageInfo(IMAGE_DIR . $file);

   // if Image size and type are available ...
   if($size) {

      // ... emit the HTML
      echo "<tr><td align=\"left\" valign=\"bottom\" width=\"100%\">\n";

      // indent as required
      indentTag($depth);

      // emit the HTML
      echo "<img align=\"bottom\" src=\"";
      switch($size[2]) {
      case IMAGE_GIF:
         echo scriptURL("gif.gif");
         break;
      case IMAGE_JPG:
         echo scriptURL("jpg.gif");
         break;
      case IMAGE_PNG:
         echo scriptURL("png.gif");
         break;
      case IMAGE_BMP:
         echo scriptURL("bmp.gif");
         break;
      case IMAGE_WMF:
         echo scriptURL("wmf.gif");
         break;
      }
      echo "\" alt=\"" . $value . "\">";
      echo "<a href=\"" . scriptURL("viewer.php?DPI=" . AGENT_DPI . "&file=" . urlencode($file)) . "\" target=\"" . VIEWER_NAME . "\">";
      echo $value;
      echo "</a>\n";
      echo "</td><td class=\"delete\" align=\"right\" valign=\"bottom\">\n";
      if(SUPPORT_DELETE) {
         echo "<a href=\"javascript:deletePath('" . $file . "')\">" . TEXT_DELETE . "</a>";
      }
      echo "</td></tr>\n";
   }
}

/*
** Emits the appropriate HTML for an Indent.
**
** Params:  $depth - Indent depth
*/
function indentTag($depth) {

   // if Indent is desired ...
   if($depth > 0) {
      $size = @getImageSize(SCRIPT_DIR . ICON_INDENT);

      // ... emit the HTML
      echo "<img src=\"" . scriptURL(ICON_INDENT) . "\" width=\"" . ($size[0] * $depth) . "\" height=\"" . $size[1] . "\">";
   }
}

/*
** Returns the empty status of the specified Directory.
**
** Params:  $path    - Path to check
**
** Return:  TRUE if Directory is empty; FALSE otherwise
*/
function isEmpty($path) {

   // initialize context
   $empty = TRUE;

   // if the Directory opens ...
   if(($dir = @opendir(IMAGE_DIR . $path))) {

      // ... while Files remain ...
      while($empty && FALSE !== ($file = readdir($dir))) {

         // ... if NOT hierarchy entries ...
         if($file != "." && $file != "..")

            // ... indicate NOT empty
            $empty = FALSE;
      }

      // close the Directory
      closedir($dir);
   }

   // return the status
   return $empty;
}

/*
** Returns an array of the Directories within the specified path.
**
** Return:  Array of Directory names
*/
function listDirs() {
   global $base;
   $result = array();

   // if the Directory opens ...
   if(($dir = @opendir(IMAGE_DIR . $base))) {

      // ... while Files remain ...
      while(FALSE !== ($file = readdir($dir))) {

         // ... if NOT hierarchy entries ...
         if($file != "." && $file != "..") {

            // ... if File is a Directory ...
            if(is_dir(IMAGE_DIR . basePath($file)))

               // ... return the Directory
               $result[] = $file;
         }
      }

      // close the Directory
      closedir($dir);
   }

   // return the Directories
   return $result;
}

/*
** Returns an array of the Files within the specified path.
**
** Params:  $filter - Extension filter(s)
**
** Return:  Array of File names
*/
function listFiles($filter = Array()) {
   global $base;
   $result = Array();

   // if the Directory opens ...
   if(($dir = @opendir(IMAGE_DIR . $base))) {
      $filters = count($filter);

      // ... while Files remain ...
      while(FALSE !== ($file = readdir($dir))) {

         // ... if File is NOT a Directory ...
         if(!(is_dir(IMAGE_DIR . basePath($file)))) {

            // ... if Filters were specified ...
            if($filters > 0) {
               $compare = (isWindows() ? "strcasecmp" : "strcmp");

               // ... isolate the Extension
               $parts = pathinfo(IMAGE_DIR . basePath($file));
               $ext = $parts["extension"];

               // for ALL specified Filters ...
               for($index = 0; $index < $filters; $index++) {

                  // ... if this a Filtered extension ...
                  if(!($compare($ext, $filter[$index])))

                     // ... get out now!
                     break;
               }

               // if File is NOT to be included ...
               if($index >= $filters)

                  // ... continue listing Files
                  continue;
            }

            // return the File
            $result[] = $file;
         }
      }

      // close the Directory
      closedir($dir);
   }

   // return the Files
   return $result;
}

// process GET/POST parameters
$action = "";
if(isset($HTTP_GET_VARS["action"]))
   $action = urldecode($HTTP_GET_VARS["action"]);
else if(isset($HTTP_POST_VARS["action"]))
   $action = urldecode($HTTP_POST_VARS["action"]);
$aspect = false;
if(SUPPORT_UPLOAD)
   $aspect = isset($HTTP_POST_VARS["aspect"]);
$file = "";
if(SUPPORT_DELETE) {
   if(isset($HTTP_GET_VARS["file"]))
      $file = urldecode($HTTP_GET_VARS["file"]);
   else if(isset($HTTP_POST_VARS["file"]))
      $file = urldecode($HTTP_POST_VARS["file"]);
}
$folder = "";
if(SUPPORT_CREATE) {
   if(isset($HTTP_POST_VARS["folder"]))
      $folder = $HTTP_POST_VARS["folder"];
}
$height = 0;
if(SUPPORT_UPLOAD) {
   if(isset($HTTP_POST_VARS["height"]) && is_numeric($HTTP_POST_VARS["height"]))
      $height = (int) $HTTP_POST_VARS["height"];
}
$name = "";
if(SUPPORT_UPLOAD) {
   if(isset($HTTP_POST_VARS["name"]))
      $name = $HTTP_POST_VARS["name"];
}
$path = "";
if(isset($HTTP_GET_VARS["path"]))
   $path = urldecode($HTTP_GET_VARS["path"]);
else if(isset($HTTP_POST_VARS["path"]))
   $path = urldecode($HTTP_POST_VARS["path"]);
$width = 0;
if(SUPPORT_UPLOAD) {
   if(isset($HTTP_POST_VARS["width"]) && is_numeric($HTTP_POST_VARS["width"]))
      $width = (int) $HTTP_POST_VARS["width"];
}

// parse and clean the Path
cleanPath($path);

?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
// if CREATE is supported AND this is CREATE ...
if(SUPPORT_CREATE && !(strcasecmp($action, "create")))

   // ... create the Folder
   doCreate($folder);

// ... otherwise, if DELETE is supported AND this is DELETE ...
else if(SUPPORT_DELETE && !(strcasecmp($action, "delete")))

   // ... delete the Folder/File
   doDelete($file);

// ... otherwise, if UPLOAD is supported AND this is UPLOAD ...
else if(SUPPORT_UPLOAD && !(strcasecmp($action, "upload")))

   // ... upload the Image
   doUpload(basename($name), $width, $height, $aspect);

// list the Path
doList();

// emit the HTML
echo "<script language=\"javascript\">\n";

// if DELETE is supported ...
if(SUPPORT_DELETE) {

   // ... emit the HTML
   echo "function deletePath(path) {\n";
   echo "   var lister = findAncestor(window.frameElement, '" . LISTER_NAME . "', '" . LISTER_TAG . "');\n\n";
   echo "   if(lister && confirm(\"Delete '\" + path + \"'?\"))\n";
   echo "      lister.contentWindow.navigate('" . scriptURL("lister.php?DPI=") . AGENT_DPI . "&action=delete&path=" . $base . "&file=" . "' + escape(path));\n";
   echo "}\n\n";
}
?>
actionComplete("<?php echo $action; ?>", "<?php echo $path; ?>", "<?php echo $error; ?>", "<?php echo $info; ?>");
</script>
</body>
</html>

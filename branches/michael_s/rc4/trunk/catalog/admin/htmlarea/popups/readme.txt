Changes in this Version
=======================
Mar. 18 - Suppress new warning notices under PHP 4.3 which complain about the
          use of 'dirTag' and 'fileTag' as parameters to the 'array_walk'
          function

Mar.  7 - Added OPTIONAL support for constraining uploads using NETPBM (Win32
          subset included as 'netpbm-10.6-Win32-subset.zip')

          Added resize support for uploads using NETPBM (image constraints, if
          any, override users resize parameters)

Feb. 26 - Added OPTIONAL support for Bitmaps and Metafiles (IE only)

Feb. 20 - Fixed bug causing a bad URL to be generated under PHP 4.2 or later

Feb. 19 - Added UPLOAD_LIMIT configuration variable to enforce size limitations
          on uploads

Enhanced PHP Image Manager for htmlArea
=======================================

These scripts extend the "Insert Image" feature of Interactive Tools' htmlArea
to include a full-blown Image Manager allowing for:

        - Preview of existing images
        - Selection of existing images (rather than typing a URL!)
        - Uploading of new images (OPTIONAL)
        - Creating of new folders (OPTIONAL; below the "Image Root" ONLY!)
        - Deleting of images (OPTIONAL)
        - Deleting of EMTPY folders (OPTIONAL; below the "Image Root" ONLY!)
        - Support for GIF, JPEG and PNG image files
        - Support for BMP and WMF image files (OPTIONAL; work with IE only!)
        - Dynamic adjustment to varying DPI settings in the user's browser
        - Automatic image constraints for all raster types (OPTIONAL)

These scripts use the concept of an "Image Root" directory which it will manage.
You should NOT use a directory containing anything other than images as the
"root" because this COULD compromise your webserver's security.

These scripts require PHP 4.0.6 (or later) to be installed on your webserver
and have been developed and tested under htmlArea 2.03 fairly extensively. They
SHOULD work with htmlArea 2.x AS LONG AS the interface between the htmlArea
script and the "Insert Image" dialog is the same as 2.03.

The entire modification consists of 1 "replacement" file and 14 new files:

        - insert_image.html             (total replacement HTML)

        - config.inc.php                (Image Manager configuration)
        - lister.php                    (Tree display and action script)
        - viewer.php                    (Image preview script)
        - bmp.gif                       (BMP icon)
        - dpi.gif                       (DPI detection image)
        - gif.gif                       (GIF icon)
        - jpg.gif                       (JPG/JPEG icon)
        - png.gif                       (PNG icon)
        - wmf.gif                       (WMF icon)
        - closed.gif                    ("Closed" folder icon)
        - opened.gif                    ("Open" folder icon)
        - indent.gif                    (Tree indent icon)
        - readme.txt                    (This file)
        - netpbm-10.6-Win32-subset.zip  (NETPBM subset for Windows)

Why was NETPBM chosen over GD to perform image constraint? The GD graphics
extension of PHP rely upon the GD library which no longer supports GIF images
(since version 1.6). As GIF images are still very prevelant on the web, NETPBM
is used to perform image constraint even though it is somewhat clunky compared
to the GD extension of PHP.

-------------------------------------------------------------------------------

To install this modification, perform the following steps:

        1. Make a backup copy of the original 'popups/insert_image.html'

        2. Unzip all of these files into the 'popups' directory

        3. Edit 'popups/config.inc.php' and specify:

           a. 'CONSTRAIN_HEIGHT' and 'CONSTRAIN_WIDTH' as the maximum dimension
              for uploaded images. If you do not wish to constrain uploaded
              images, specify '0' for either (OR both).

           b. 'IMAGE_DIR' as the path from the filesystem root on your server
              to the directory which will be "managed" by these scripts.

           c. 'IMAGE_URL' as the path from the document root on your webserver
              to the directory named in 'IMAGE_DIR' in step 3b. Do NOT include
              the hostname (http://my.host.com) portion in the URL; just the
              from the document root.

           d. 'NETPBM_DIR' as the path from the filesystem root on your server
              to the directory which contains the NETPBM graphics package. If
              you use a WIndows-based server, you can use the NETPBM subset
              provided otherwise you will need to download the proper package
              for your server platform at http://netpbm.sourceforge.net. This
              package is needed ONLY if you desire the image constraint feature.

           e. 'SCRIPT_DIR' as the path from the filesystem root on your server
              to the directory which contains these scripts.

           f. 'SCRIPT_URL' as the path from the document root on your webserver
              to the directory named in 'SCRIPT_DIR' in step 3e. Do NOT include
              the hostname (http://my.host.com) portion in the URL; just the
              from the document root.

           g. 'SUPPORT_BITMAP' as either 'TRUE' or 'FALSE' (w/o quotes!) to
              indicate if you wish to support Bitmap image files (only works
              with Internet Explorer!).

           h. 'SUPPORT_CREATE' as either 'TRUE' or 'FALSE' (w/o quotes!) to
              indicate if you wish to allow creation of directories below the
              directory named in 'IMAGE_DIR' in step 3b.

           i. 'SUPPORT_DELETE' as either 'TRUE' or 'FALSE' (w/o quotes!) to
              indicate if you wish to allow deletion of images and/or EMPTY
              directories below the directory named in 'IMAGE_DIR' in step 3a.

           j. 'SUPPORT_METAFILE' as either 'TRUE' or 'FALSE' (w/o quotes!) to
              indicate if you wish to support Metafile image files (only works
              with Internet Explorer!).

           k. 'SUPPORT_UPLOAD' as either 'TRUE' or 'FALSE' (w/o quotes!) to
              indicate if you wish to allow uploading of images to directories
              below the directory named in 'IMAGE_DIR' in step 3b.

           l. 'UPLOAD_LIMIT' as a size limit (in bytes) for uploaded images. If
              you do not wish to enforce a limit, specify '0' (w/o quotes!).

        4. If you disabled EITHER the 'CREATE' and/or 'UPLOAD' features, you
           will need to edit 'popups/insert_image.html' and match the HTML to
           your configuration choices.

           a. Choose the matching 'HTML' tag at the top of the file

           b. Remove the trailing '>' from the commented line(s) to match those
              features which you have disabled

        5. That's it!

-------------------------------------------------------------------------------

To uninstall this modification, perform the following steps:

        1. Restore your backup copy of 'popups/insert_image.html'

        2. That's it!

-------------------------------------------------------------------------------

If you run into any major issues with these scripts, please let me know at:

        dave@dsear.org

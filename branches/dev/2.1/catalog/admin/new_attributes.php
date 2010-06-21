<?php
  $adminImages = "includes/languages/english/images/buttons/";
  $backLink = "<a href=\"javascript:history.back()\">";

  require('new_attributes_config.php');
  require('includes/application_top.php');
  $action = (isset($_POST['action']) ? $_POST['action'] : '');
  $current_product_id = (isset($_POST['current_product_id']) ? $_POST['current_product_id'] : '');
  $optionValues = (isset($_POST['optionValues']) ? $_POST['optionValues'] : '');
  $languageFilter = $languages_id;

  if ( $cPathID && $action == "change" )
  {
        require('new_attributes_change.php');

        tep_redirect( './' . FILENAME_CATEGORIES . '?cPath=' . $cPathID . '&pID=' . $current_product_id );

  }

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
     <table border="0" width="100%" cellspacing="2" cellpadding="2">
     <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
     <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>

<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
    
<?php
function findTitle( $current_product_id, $languageFilter )
{
  $query = "SELECT * FROM products_description where language_id = '$languageFilter' AND products_id = '$current_product_id'";

  $result = mysql_query($query) or die(mysql_error());

  $matches = mysql_num_rows($result);

  if ($matches) {

  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                          	
        $productName = $line['products_name'];
        
  }
  
  return $productName;
  
  } else { return "Something isn't right...."; }
  
}

function attribRedirect( $cPath )
{

 return '<script type="text/javascript"> window.location="./configure.php?cPath=' . $cPath . '"; </script>';
 
}

switch( $action )
{
  case 'select':
  $pageTitle = 'Edit Attributes -> ' . findTitle( $current_product_id, $languageFilter );
  require('new_attributes_include.php');
  break;
  
  case 'change':
  $pageTitle = 'Product Attributes Updated.';
  require('new_attributes_change.php');
  require('new_attributes_select.php');
  break;

  default:
  $pageTitle = 'Edit Attributes';
  require('new_attributes_select.php');
  break;
  
}

?>

    </table></TD>
    </TR>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

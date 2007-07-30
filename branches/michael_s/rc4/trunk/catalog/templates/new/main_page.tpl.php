<?php require(DIR_WS_INCLUDES . 'counter.php'); ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php /* echo HTML_PARAMS; */ ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" >
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','main_layout.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<style type="text/css">
<!--
body {
  text-align: center;
}
#wrapper {
  text-align: left;
  width: 780px;
  border: 3px ridge red;
  margin: auto;
  padding: 1em;
} 
-->
</style>
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
</head>
<body>

<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<!--
"Fluid CSS Layout" template for PandA.nl, Copyright: Paul Mathot Haarlem, Netherlands 2004/02/15
-->
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>
<div id="wrapper">
<h1>Sample file</h1>
<p>This is a sample only please overwrite this file (<?php echo DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE; ?>) with your own <?php echo TEMPLATENAME_MAIN_PAGE; ?> .</p>
<p>If you create a new templates directory (like this one for example), and it does not contain any files yet, the fallback files will be loaded. But if you take a template file (i.e. stylesheet.css), and copy it (after editting it) to this new template directory the new file inside this template directory will be used i.s.o. the one inside the fallback directory.</p>
</div>
</body>
</html>

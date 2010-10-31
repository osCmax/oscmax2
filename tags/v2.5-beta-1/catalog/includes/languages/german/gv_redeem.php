<?php
/*
$Id: gv_redeem.php 3 2006-05-27 04:59:07Z user $

   osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Gutschein verbuchen');
define('HEADING_TITLE', 'Gutschein verbuchen');
define('TEXT_INFORMATION', 'FRagen und Antworten zu Gutscheinen finden Sie unter <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a>');
define('TEXT_INVALID_GV', 'Der von Ihnen eingegebene Gutscheincode ist ungültig oder der Gutschein wurde bereits eingelöst. Bitte überprüfen Sie Ihre Angaben oder schreiben Sie uns über die Kontaktseite');
define('TEXT_VALID_GV', 'Glückwunsch, Sie haben erfolgreich Ihren Gutschein über  %s verbucht !');
define('TEXT_NEEDS_TO_LOGIN', 'We are sorry but we are unable to process your Gift Voucher claim at this time. You need to login first or create an account with us, if you don\'t already have one, before you can claim your Gift Voucher. Please <a href="' . tep_href_link(FILENAME_LOGIN,'','SSL').'">click here to login or create an account.</a> ');
?>
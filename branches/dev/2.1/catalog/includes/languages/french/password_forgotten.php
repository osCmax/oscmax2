<?php
/*
  $Id: password_forgotten.php,v 1.1.1.1.2.1 2005/06/12 00:04:34 Michael Sasek Exp $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

define('NAVBAR_TITLE_1', 'Ouverture session');
define('NAVBAR_TITLE_2', 'Mot de passe oubli&eacute;');

define('HEADING_TITLE', 'J\'ai oubli&eacute; mon mot de passe!');

define('TEXT_MAIN', 'Si vous avez oubli&eacute; votre mot de passe, entrez votre adresse &eacute;lectronique ci-dessous et nous vous enverrons un courrier &eacute;lectronique contenant votre nouveau mot de passe.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Erreur: L\'adresse &eacute;lectronique n\'a pas &eacute;t&eacute; trouv&eacute;e dans notre base, veuillez r&eacute;essayer. ');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nouveau mot de passe');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Un nouveau mot de passe a &eacute;t&eacute; demand&eacute; de ' . $REMOTE_ADDR . '.' . "\n\n" . 'Votre nouveau mot de passe sur \'' . STORE_NAME . '\' est:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Succ&egrave;s: Un nouveau mot de passe a &eacute;t&eacute; envoy&eacute; &agrave; votre adresse &eacute;lectronique.');
?>
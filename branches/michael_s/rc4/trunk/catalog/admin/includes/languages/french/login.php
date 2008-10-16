<?php
/*
  $Id: login.php,v 1.1 2005/05/04 20:07:31 tropic Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
// translation by CRDD (coroidedroite@yahoo.fr)


define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Bienvenu, veuillez vous identifier.');
define('TEXT_STEP_BY_STEP', ''); // should be empty


define('HEADING_RETURNING_ADMIN', 'Panneau Login:');
define('HEADING_PASSWORD_FORGOTTEN', 'Mot de passe oubli&eacute;?');
define('TEXT_RETURNING_ADMIN', 'Staff uniquement!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_PASSWORD', 'Mot de passe:');
define('ENTRY_FIRSTNAME', 'Pr&eacute;nom:');
define('IMAGE_BUTTON_LOGIN', 'Envoyer');

define('TEXT_PASSWORD_FORGOTTEN', 'Mot de passe oubli&eacute;?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERREUR:</b></font> Login ou mot de passe erron&eacute;!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERREUR:</b></font> le pr&eacute;nom et le mot de passe ne correspondent pas!');
define('TEXT_FORGOTTEN_FAIL', 'Vous avez essay&eacute ; trois fois. Pour des raisons de s&eacute;curit&eacute;, veuillez contacter votre administrateur web pour obtenir un nouveau mot de passe.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Le nouveau mot de passe a &eacute;t&eacute; envoy&eacute à votre adresse email. Veuillez la consulter et revenez vous identifier.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nouveau mot de passe');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'Vous pouvez acceder au module administration avec le mot de passe suivant. Une fois connect&eacute;, veuillez le modifier!' . "\n\n" . 'Site : %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un email automatique, veuillez ne pas r&eacute;pondre &agrave; ce message!');
?>
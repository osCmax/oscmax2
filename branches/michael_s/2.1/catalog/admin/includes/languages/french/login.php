<?php
/*
$Id: login.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['origin'] == FILENAME_CHECKOUT_PAYMENT) {
  define('NAVBAR_TITLE', 'Order');
  define('HEADING_TITLE', 'Ordering online is easy.');
  define('TEXT_STEP_BY_STEP', 'We\'ll walk you through the process, step by step.');
} else {
define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Bienvenu, veuillez vous identifier.');
define('TEXT_STEP_BY_STEP', ''); // should be empty
}

define('HEADING_RETURNING_ADMIN', 'Panneau Login:');
define('HEADING_PASSWORD_FORGOTTEN', 'Mot de passe oubli&eacute;?');
define('TEXT_RETURNING_ADMIN', 'Staff uniquement!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_PASSWORD', 'Mot de passe:');
define('ENTRY_FIRSTNAME', 'Pr&eacute;nom:');
define('ENTRY_LASTNAME', 'Nom de famille:');
define('IMAGE_BUTTON_LOGIN', 'Envoyer');

define('TEXT_PASSWORD_FORGOTTEN', 'Mot de passe oubli&eacute;?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERREUR:</b></font> Login ou mot de passe erron&eacute;!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERREUR:</b></font> le pr&eacute;nom et le mot de passe ne correspondent pas!');
define('TEXT_FORGOTTEN_FAIL', 'Vous avez essay&eacute ; trois fois. Pour des raisons de s&eacute;curit&eacute;, veuillez contacter votre administrateur web pour obtenir un nouveau mot de passe.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Le nouveau mot de passe a &eacute;t&eacute; envoy&eacute à votre adresse email. Veuillez la consulter et revenez vous identifier.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nouveau mot de passe');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'Vous pouvez acceder au module administration avec le mot de passe suivant. Une fois connect&eacute;, veuillez le modifier!' . "\n\n" . 'Site : %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un email automatique, veuillez ne pas r&eacute;pondre &agrave; ce message!');
?>
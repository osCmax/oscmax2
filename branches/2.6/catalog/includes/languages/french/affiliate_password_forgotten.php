<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Mot de passe du partenariat perdu');
define('NAVBAR_TITLE_1', 'Connexion');
define('NAVBAR_TITLE_2', 'Mot de passe du partenariat perdu');
define('HEADING_TITLE', 'J\'ai perdu mon mot de passe du partenariat!');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<span class="warning"><b>NOTE:</b></span> L\'adresse du couriel n\'a pas &eacute;t&eacute; trouv&eacute; dans notre base de données. S\'il vous plait réessayez.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nouveau mot de passe de partenaire');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Une demande d\'un nouveau mot de passe a &eacute;t&eacute; demand&eacute;e de la part de ' . $REMOTE_ADDR . '.' . "\n\n" . 'Votre nouveau mot de passe de partenaire pour \'' . STORE_NAME . '\' est :' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Un nouveau mot de passe a &eacute;t&eacute; envoy&eacute; vers votre couriel');
?>
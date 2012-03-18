<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Mot de passe affilié perdu');
define('NAVBAR_TITLE_1', 'Connexion');
define('NAVBAR_TITLE_2', 'Mot de passe affilié perdu');
define('HEADING_TITLE', 'J\'ai perdu mon mot de passe affilié !');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<span class="notice"><b>NOTE:</b></span> L\'adresse e-mail n\'a pas été trouvé dans nos bases. Veuillez renouveler votre demande s\'il vous plait.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Mot de passe Nouvel Affilié');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Une demande de nouveau mot de passe a été demandée de la part de ' . $REMOTE_ADDR . '.' . "\n\n" . 'Votre nouveau mot de passe pour \'' . STORE_NAME . '\' est :' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Un nouveau mot de passe a été envoyé sur votre e-mail');
?>
<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Cuénteselo a un amigo');

define('HEADING_TITLE', 'Háblele a un amigo sobre \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Sus datos');
define('FORM_TITLE_FRIEND_DETAILS', 'Los datos de sus amigo');
define('FORM_TITLE_FRIEND_MESSAGE', 'Su mensaje');

define('FORM_FIELD_CUSTOMER_NAME', 'Su nombre:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Su dirección e-mail:');
define('FORM_FIELD_FRIEND_NAME', 'Nombre de su amigo:');
define('FORM_FIELD_FRIEND_EMAIL', 'Dirección e-mail de su amigo:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Su e-mail acerca de <b>%s</b> ha sido correctamente enviado a <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Tu amigo %s te ha recomendado este fantástico producto de %s');
define('TEXT_EMAIL_INTRO', '¡Hola %s!' . "\n\n" . 'Tu amigo, %s, cree que puedes estar interesado en %s de %s.');
define('TEXT_EMAIL_LINK', 'Para ver el producto pulsa en el siguiente enlace o bien copia y pega el enlace en tu navegador:' . "\n\n" . '%s');
// LINE ADDED: MOD - ARTICLE MANAGER
define('TEXT_EMAIL_LINK_ARTICLE', 'Para ver la noticia pulsa en el siguiente enlace o bien copia y pega el enlace en tu navegador:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Saludos,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Error: Debe rellenar el nombre de tu amigo.');
define('ERROR_TO_ADDRESS', 'Error: La dirección e-mail de su amigo debe ser una dirección válida.');
define('ERROR_FROM_NAME', 'Error: Debes rellenar su nombre.');
define('ERROR_FROM_ADDRESS', 'Error: Su dirección e-mail debe ser una dirección válida.');
?>

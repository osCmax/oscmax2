<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_WISHLIST','Mis favoritos');
define('NAVBAR_TITLE_1','Favoritos');
define('HEADING_TITLE','Mis favoritos:');
define('HEADING_TITLE2', ' tiene como favoritos:');

define('TEXT_NAME','Nombre:');
define('TEXT_EMAIL','Correo electrónico:');
define('TEXT_YOUR_NAME','Su nombre:');
define('TEXT_YOUR_EMAIL','Su correo electrónico:');
define('TEXT_MESSAGE','Mensaje:');
define('TEXT_ITEM_IN_CART','Artículo en el carrito');
define('TEXT_ITEM_NOT_AVAILABLE','El artículo ya no está disponible');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST','Mostrando <b>%d</b> a <b>%d</b> (<b>%d</b> elementos de sus favoritos.)');
define('WISHLIST_EMAIL_TEXT','Si desea enviar por correo sus favoritos a varios amigos o familiares, simplemente introduzca sus nombres y los correos electrónicos en cada fila. No tiene que rellenar cada campo, sólo las filas necesarias según las personas a las que desee enviar los favoritos. Después introduzca un breve mensaje que le gustaría incluir en su email. Este mensaje será añadido a todos los correos electrónicos que envíe.');
define('WISHLIST_EMAIL_TEXT_GUEST','Si desea enviar por correo sus favoritos a varios amigos o familiares, por favor, introduzca sus nombre y los correos electrónicos en cada fila. No tiene que rellenar cada campo, sólo las filas necesarias según las personas a las que desee enviar los favoritos. Después introduzca un breve mensaje que le gustaría incluir en su email. Este mensaje será añadido a todos los correos electrónicos que envíe.');
define('WISHLIST_EMAIL_SUBJECT','le ha enviado sus favoritos de ' . STORE_NAME);  //Customers name will be automatically added to the beginning of this.
define('WISHLIST_SENT','Se han enviado sus favoritos.');
define('WISHLIST_EMAIL_LINK', '

$from_name\'s public Wish List is located here:
$link

Thank you,
' . STORE_NAME); //$from_name = Customers name  $link = public wishlist link

define('WISHLIST_EMAIL_GUEST', 'Thank you,
' . STORE_NAME);

define('ERROR_YOUR_NAME','Por favor, introduzca su nombre.');
define('ERROR_YOUR_EMAIL','Por favor, introduzca su correo electrónico.');
define('ERROR_VALID_EMAIL','Por favor, introduzca una dirección de correo electrónico válida.');
define('ERROR_ONE_EMAIL','Debe incluir al menos un nombre y correo electrónico.');
define('ERROR_ENTER_EMAIL','Por favor, introduzca una dirección de correo electrónico.');
define('ERROR_ENTER_NAME','Por favor, introduzca el nombre del destinatario del correo electrónico.');
define('ERROR_MESSAGE','Por favor, incluya un mensaje breve.');

define('WISHLIST_SECURITY_CHECK','Por favor complete esta comprobación de seguridad:');
define('WISHLIST_SECURITY_CHECK_ERROR','No ha escrito correctamente el código de comprobación de seguridad. Inténtelo de nuevo.');
define('CLEAR_WISHLIST','¿Está seguro que desea quitar todos los favoritos de la lista?');
?>
<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE_WISHLIST','Meine Wunschliste');
define('NAVBAR_TITLE_1','Wunschzettel');
define('HEADING_TITLE', 'Meine Wunschliste enth&auml;lt:');
define('HEADING_TITLE2', '\'s Wunschliste enth&auml;lt:');
define('TEXT_NAME', 'Name: ');
define('TEXT_EMAIL', 'E-Mail: ');
define('TEXT_YOUR_NAME', 'Ihr Name: ');
define('TEXT_YOUR_EMAIL', 'Ihre E-Mail: ');
define('TEXT_MESSAGE', 'Nachricht: ');
define('TEXT_ITEM_IN_CART', 'Produkt im Warenkorb');
define('TEXT_ITEM_NOT_AVAILABLE', 'Produkt nicht mehr verf&uuml;gbar');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln in Ihrer Wunschliste)');
define('WISHLIST_EMAIL_TEXT', 'If you would like to email your wishlist to multiple friends or family, just enter their name\'s and email\'s in each row.  You don\'t have to fill every box up, you can just fill in for however many people you want to email your wishlist link too.  Then fill out a short message you would like to include in with your email in the text box provided.  This message will be added to all the emails you send.');
define('WISHLIST_EMAIL_TEXT_GUEST', 'If you would like to email your wishlist to multiple friends or family, please enter your name and email address.  Then enter their name\'s and email\'s in each row.  You don\'t have to fill every box up, you can just fill in for however many people you want to email your wishlist link too.  Then fill out a short message you would like to include in with your email in the text box provided.  This message will be added to all the emails you send.');
define('WISHLIST_EMAIL_SUBJECT', 'has sent you their wishlist from ' . STORE_NAME);  //Customers name will be automatically added to the beginning of this.
define('WISHLIST_SENT', 'Your wishlist has been sent.');
define('WISHLIST_EMAIL_LINK', '

$from_name\'s &ouml;ffentliche Wunschliste ist hier zu finden:
$link

Vielen Dank,
' . STORE_NAME); //$from_name = Customers name  $link = public wishlist link

define('WISHLIST_EMAIL_GUEST', 'Vielen Dank,
' . STORE_NAME);

define('ERROR_YOUR_NAME' , 'Bitte geben Sie Ihren Namen ein.');
define('ERROR_YOUR_EMAIL' , 'Bitte geben Sie Ihre E-Mail-Adresse ein.');
define('ERROR_VALID_EMAIL' , 'Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse ein.');
define('ERROR_ONE_EMAIL' , 'Sie m&uuml;ssen zumindestens einen Namen und eine E-Mail-Adresse eingeben.');
define('ERROR_ENTER_EMAIL' , 'Bitte geben Sie eine E-Mail-Adresse des Empf&auml;ngers ein.');
define('ERROR_ENTER_NAME' , 'Bitte geben Sie den Namen des Empf&auml;ngers ein.');
define('ERROR_MESSAGE', 'Bitte verfassen Sie eine kurze Nachricht.');

define('WISHLIST_SECURITY_CHECK', 'Bitte vervollst&auml;ndingen Sie die Sicherheitsabfrage: ');
define('WISHLIST_SECURITY_CHECK_ERROR', 'Die Sicherheitsabfrage stimmt nicht &uuml;berein. Bitte versuchen Sie es noch einmal.');
define('CLEAR_WISHLIST', 'M&ouml;chten Sie Ihre gesamte Wunschliste l&ouml;schen?');
?>
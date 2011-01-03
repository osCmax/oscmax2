<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'eMail an Kunden versenden');

define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Absender:');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SELECT_CUSTOMER', 'Kunden ausw&auml;hlen');
define('TEXT_ALL_CUSTOMERS', 'Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter-Abonnenten');

define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde ausgew&auml;hlt.');
// BOF: MOD - WYSIWYG HTML Area
define('TEXT_EMAIL_BUTTON_TEXT', '<p><HR><b><font color="red">The Back Button has been DISABLE while HTML WYSIWG Editor is turned ON,</b></font> WHY? - Because if you click the back button to edit your HTML email, The PHP (php.ini - "Magic Quotes = On") will automatically add "\\\\\\\" backslashes everywhere Double Quotes " appear (HTML uses them in Links, Images and More) and this destorts the HTML and the pictures will dissapear once you submit the email again, If you turn OFF WYSIWYG Editor in Admin the HTML Ability of osCommerce is also turned OFF and the back button will re-appear. A fix for this HTML and PHP issue would be nice if someone knows a solution Iv\'e tried.<br><br><b>If you really need to Preview your emails before sending them, use the Preview Button located on the WYSIWYG Editor.<br><HR>');
define('TEXT_EMAIL_BUTTON_HTML', '<p><HR><b><font color="red">HTML is currently Disabled!</b></font><br><br>If you want to send HTML email, Enable WYSIWYG Editor for Email in: Admin-->Configuration-->WYSIWYG Editor-->Options<br>');
// EOF: MOD - WYSIWYG HTML Area
?>
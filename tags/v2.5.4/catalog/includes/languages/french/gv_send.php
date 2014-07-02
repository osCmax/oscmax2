<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Envoyer un ch&egrave;que cadeau');
define('NAVBAR_TITLE', 'Envoyer un ch&egrave;que cadeau');
define('EMAIL_SUBJECT', 'Envoyez par ' . STORE_NAME);
define('HEADING_TEXT','<br>Remplissez ci-dessous le formulaire pour envoyer un ch&egrave;que cadeau &agrave; un(e) ami(e) ou un membre de la famille. Pour plus d\'information, veuillez consulter notre ');
define('ENTRY_NAME', 'Nom du destinataire :');
define('ENTRY_EMAIL', 'Adresse email du destinataire :');
define('ENTRY_MESSAGE', 'Votre Message :');
define('ENTRY_AMOUNT', 'Valeur en ch&egrave;que cadeau :');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Formulaire non remplis ou sup&eacute;rieure à la valeur de votre solde en panier</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Adresse email invalide</span>');
define('MAIN_MESSAGE', 'Vous avez d&eacute;cid&eacute; d\'envoyer un ch&egrave;que cadeau d\'une valeur de <b>%s pour %s</b> &agrave; l\'adresse email <b>%s</b><br><br><u>Le texte accompagnant l\'email sera</u> : <br><br>%s<br><br>
                        Un ch&egrave;que cadeau d\'une valeur de %s vous a &eacute;t&eacute; envoy&eacute; par %s');

define('PERSONAL_MESSAGE', 'Voici le message de %s :');
define('TEXT_SUCCESS', 'F&eacute;licitations, votre ch&egrave;que cadeau a &eacute;t&eacute; envoy&eacute;');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Des f&eacute;licitations, vous avez reçu un bon de cadeau en valeur %s');
define('EMAIL_GV_TEXT_SUBJECT', 'Un cadeau de %s');
define('EMAIL_GV_FROM', 'Ce bon de cadeau vous a &eacute;t&eacute; envoy&eacute; pr&egrave;s %s');
define('EMAIL_GV_MESSAGE', 'Avec une &eacute;nonciation de message ');
define('EMAIL_GV_SEND_TO', 'Bonjour, %s');
define('EMAIL_GV_REDEEM', 'Pour racheter ce bon de cadeau, cliquetez svp dessus le lien ci-dessous. Veuillez noter &eacute;galement le code de rachat qui est' . "\n" . ' %s ' . "\n" . 'Au cas où vous auriez des probl&egrave;mes.');
define('EMAIL_GV_LINK', 'Pour racheter svp cliquetez ');
define('EMAIL_GV_VISIT', ' ou visite ');
define('EMAIL_GV_ENTER', ' et &eacute;crivez le code ');
define('EMAIL_GV_FIXED_FOOTER', 'Si vous êtes ayez les probl&egrave;mes racheter le bon de cadeau en utilisant le lien automatis&eacute; ci-dessus, ' . "\n" .
                                'vous pouvez &eacute;galement &eacute;crire le code de bon de cadeau pendant le proc&eacute;d&eacute; de contr&ocirc;le à notre magasin.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
?>
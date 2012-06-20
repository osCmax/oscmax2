<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// LINE ADDED: MOD - ORDER EDIT
define('TABLE_HEADING_EDIT_ORDERS', 'To modify the order');

define('HEADING_TITLE', 'Commandes');
define('HEADING_TITLE_SEARCH', 'ID commande:');
define('HEADING_TITLE_STATUS', 'Statut:');
//BOF: Orders search by customers info
define('HEADING_TITLE_SEARCH_ALL', 'Search (order id, customer or company name):');
//EOF: Orders search by customers info
define('TABLE_HEADING_ORDER_NUM', '#');
define('TABLE_HEADING_COMMENTS', 'Commentaires');
define('TABLE_HEADING_NEW_COMMENTS', 'Add New Comment');
define('TABLE_HEADING_CUSTOMERS', 'Clients');
define('TABLE_HEADING_ORDER_TOTAL', 'Total commande');
define('TABLE_HEADING_DATE_PURCHASED', 'Date d\'achat');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qt&eacute;.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_PRODUCTS', 'Produits');
define('TABLE_HEADING_TAX', 'Taxe');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prix (ht)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prix (ttc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ht)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (ttc)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Client notifi&eacute;');
define('TABLE_HEADING_DATE_ADDED', 'Date d\'ajouté');

define('ENTRY_CUSTOMER', 'Client:');
define('ENTRY_SOLD_TO', 'VENDU A:');
define('ENTRY_DELIVERY_TO', 'Livraison &agrave;:');
define('ENTRY_SHIP_TO', 'LIVRE A:');
define('ENTRY_SHIPPING_ADDRESS', 'Addresse d\'exp&eacute;dition:');
define('ENTRY_BILLING_ADDRESS', 'Addresse facturation:');
define('ENTRY_PAYMENT_METHOD', 'M&eacute;thode de paiement:');
define('ENTRY_CREDIT_CARD_TYPE', 'Type de carte de cr&eacute;dit:');
define('ENTRY_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la carte de cr&eacute;dit:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Num&eacute;ro de la carte de cr&eacute;dit:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Date d\'expiration de la carte de cr&eacute;dit:');
define('ENTRY_SUB_TOTAL', 'Sous-Total:');
define('ENTRY_TAX', 'Taxe:');
define('ENTRY_SHIPPING', 'Exp&eacute;dition:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Date d\'achat:');
define('ENTRY_STATUS', 'Statut:');
define('ENTRY_DATE_LAST_UPDATED', 'Derni&egrave;re date de mise &agrave; jour:');
define('ENTRY_NOTIFY_CUSTOMER', 'Informer client:');
define('ENTRY_NOTIFY_COMMENTS', 'Ajouer un commentaire:');
define('ENTRY_PRINTABLE', 'Imprimer la facture');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Supprimer la commande');
define('TEXT_INFO_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette commande?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restaurer la valeur de stock');
define('TEXT_DATE_ORDER_CREATED', 'Date de cr&eacute;ation:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Derni&egrave;re modification:');
define('TEXT_INFO_PAYMENT_METHOD', 'M&eacute;thode de paiement:');

define('TEXT_ALL_ORDERS', 'Toutes les commandes');
define('TEXT_NO_ORDER_HISTORY', 'Aucun historique de commande disponible');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Mise &agrave; jour de la commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'Num&eacute;ro de commande:');
define('EMAIL_TEXT_INVOICE_URL', 'Facture d&eacute;taill&eacute;e:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Le statut de votre commande a &eacute;t&eacute; mis &agrave; jour par le suivant.' . "\n\n" . 'Nouveau statut: %s' . "\n\n" . 'Merci de r&eacute;pondre &agrave; ce courrier &eacute;lectronique si vous avez des questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Les commentaires de votre commande sontS' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Erreur: La commande n\'existe pas.');
define('SUCCESS_ORDER_UPDATED', 'Succ&egrave;s: Commande mis &agrave; jour avec succ&egrave;s.');
define('WARNING_ORDER_NOT_UPDATED', 'Attention: Aucune modification n\'a &eacute;t&eacute; effectu&eacute;. La commande n\'a pas &eacute;t&eacute; mis &agrave; jour.');

define('HEADING_CANNED_COMMENTS_HELP', 'Premade Comments Help');
define('TEXT_CANNED_COMMENTS_HELP', 'In order to create new premade comments please go to <b>Localization --> Premade Comments</b> menu and follow the onscreen instructions.  If you need further help please read the <b>Wiki</b>.');

define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_CUSTOMER_COMMENTS', 'Customer Comments');
define('TEXT_ACTIVE', 'Active');
define('TABLE_HEADING_ORDER_COMMENTS', 'Order Comments');
define('TABLE_HEADING_NEW_ORDER_COMMENTS', 'Add New Order Comment');
define('TEXT_ORDER_SUMMARY', 'Order Summary');

define('TEXT_ORDER_ID', 'Order No:');
define('TEXT_ORDER_DATE_TIME', 'Order Date &amp; Time');

define('OPTION_SELECT_COMMENT', 'Select a comment ...');
define('OPTION_NAME_OF_CUSTOMER', 'Customer name');
?>
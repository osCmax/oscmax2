<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Editer la commande #%s du %s');
define('ADDING_TITLE', 'Ajouter un ou plusieurs produits &agrave; la commande #%s');

define('ENTRY_UPDATE_TO_CC', '(Update to ' . ORDER_EDITOR_CREDIT_CARD . ' to view CC fields.)');
define('TABLE_HEADING_COMMENTS', 'Commentaires :');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_NEW_STATUS', 'Nouveau statut');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_DELETE', 'Supprimer ?');
define('TABLE_HEADING_QUANTITY', 'Qt&eacute;');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_PRODUCTS', 'Produits');
define('TABLE_HEADING_TAX', 'Taxe');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_BASE_PRICE', 'Prix<br>(base)');
define('TABLE_HEADING_UNIT_PRICE', 'Prix<br>(HT)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Prix<br>(TTC)');
define('TABLE_HEADING_TOTAL_PRICE', 'Total<br>(HT)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total<br>(TTC)');
define('TABLE_HEADING_OT_TOTALS', 'Totaux :');
define('TABLE_HEADING_OT_VALUES', 'Valeur :');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Frais de port :');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Aucun module de frais de calcul de frais de port n\'est install&eacute;!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Client<br>Notifi&eacute;');
define('TABLE_HEADING_DATE_ADDED', 'Date d\'ajout');

define('ENTRY_CUSTOMER', 'Client');
define('ENTRY_NAME', 'Nom :');
define('ENTRY_CITY_STATE', 'Ville :');
define('ENTRY_SHIPPING_ADDRESS', 'Adresse de livraison :');
define('ENTRY_BILLING_ADDRESS', 'Adresse de facturation :');
define('ENTRY_PAYMENT_METHOD', 'Moyen de paiement :');
define('ENTRY_CREDIT_CARD_TYPE', 'Type de Carte :');
define('ENTRY_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la carte :');
define('ENTRY_CREDIT_CARD_NUMBER', 'Num&eacute;ro de carte :');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Date d\'expiration :');
define('ENTRY_SUB_TOTAL', 'Sous-Total :');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Taxe');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Frais de port :');
define('ENTRY_TOTAL', 'Total :');
define('ENTRY_STATUS', 'Statut :');
define('ENTRY_NOTIFY_CUSTOMER', 'Notifier le client :');
define('ENTRY_NOTIFY_COMMENTS', 'Envoyer les commentaires :');
define('ENTRY_CURRENCY_TYPE', 'Monnaie');
define('ENTRY_CURRENCY_VALUE', 'Indice de la monnaie :');

define('TEXT_INFO_PAYMENT_METHOD', 'Moyen de paiement :');
define('TEXT_NO_ORDER_PRODUCTS', 'Cette commande ne contient aucun produit');
define('TEXT_ADD_NEW_PRODUCT', 'Ajouter des produits');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Poid du colis : %s  |  Nombre de produits : %s');

define('TEXT_STEP_1', '<b>Etape 1 :</b>');
define('TEXT_STEP_2', '<b>Etape 2 :</b>');
define('TEXT_STEP_3', '<b>Etape 3 :</b>');
define('TEXT_STEP_4', '<b>Etape 4 :</b>');
define('TEXT_SELECT_CATEGORY', '- Choisir une cat&eacute;gorie dans la liste -');
define('TEXT_PRODUCT_SEARCH', '<b>- OU saisir un mot cl&eacute; &agrave; rechercher dans le catalogue -</b>');
define('TEXT_ALL_CATEGORIES', 'Toutes les cat&eacute;gories');
define('TEXT_SELECT_PRODUCT', '- Choisir un produit -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Choisir les options');
define('TEXT_BUTTON_SELECT_CATEGORY', 'S&eacute;lectionner cette cat&eacute;gorie');
define('TEXT_BUTTON_SELECT_PRODUCT', 'S&eacute;lectionner ce produit');
define('TEXT_SKIP_NO_OPTIONS', '<em>Aucunes options disponibles pour ce produit</em>');
define('TEXT_QUANTITY', 'Quantit&eacute; :');
define('TEXT_BUTTON_ADD_PRODUCT', 'Ajouter &agrave; la commande');
define('TEXT_CLOSE_POPUP', '<u>Fermer</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Ajouter autant de produits que n&eacute;cessaire.<br>Puis fermer cette fen&ecirc;tre, retouner à la fen&ecirc;tre principale et cliquer sur le bouton "update".');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Produit introuvable<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Livraison &agrave; l\'adresse de facturation');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Facturation &agrave; l\'adresse du client');

define('IMAGE_ADD_NEW_OT', 'Ins&eacute;rer une nouvelle ligne apr&egrave;s celle-ci.');
define('IMAGE_REMOVE_NEW_OT', 'Supprimer cette ligne');
define('IMAGE_NEW_ORDER_EMAIL', 'Envoyer un nouvel email de confirmation de commande');

define('TEXT_NO_ORDER_HISTORY', 'Aucun historique de commande n\'est disponible');

define('PLEASE_SELECT', 'Sélectionner ');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Traitement de votre commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'Num&eacute;ro de commande :');
define('EMAIL_TEXT_INVOICE_URL', 'Facture d&eacute;taill&eacute;e :');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de la commande :');
define('EMAIL_TEXT_STATUS_UPDATE', 'Nous vous remercions pour votre commande.' . "\n\n" . 'Le statut de votre commande a &eacute;t&eacute; mis &agrave; jour.' . "\n\n" . 'Nouveau statut : %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Si vous avez des questions, merci de r&eacute;pondre &agrave; cet email..' . "\n\n" . 'Cordialement, ' . "\n\n" . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Les commentaires associ&eacute;s &agrave; cette mise &agrave; jour sont :' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Erreur : cette commande n\'existe pas.');
define('SUCCESS_ORDER_UPDATED', 'Succ&egrave;s : La commande a bien &eacute;t&eacute; mise &agrave; jour.');
define('SUCCESS_EMAIL_SENT', 'Termin&eacute;: La commande a &eacute;t&eacute; mise à jour et un email a &eacute;t&eacute; envoy&eacute;.');

//the hints
define('HINT_UPDATE_TO_CC', 'Si vous choisissez le mode de paiement "' . ORDER_EDITOR_CREDIT_CARD . '", les champs de saisie des informations appa&icirc;trons automatiquement.');
define('HINT_UPDATE_CURRENCY', 'Changer la monnaie entraine le recalcul et le rechargement des frais de ports et des totaux.');
define('HINT_SHIPPING_ADDRESS', 'Si vous changez la zone g&eacute;ographique du client, il vous sera possible de recalculer ou non les frais de port.');
define('HINT_TOTALS', 'Vous pouvez faire des remises en indiquant des prix n&eacute;gatifs.');
define('HINT_PRESS_UPDATE', 'Cliquer sur "Update" pour sauver les modifications."');
define('HINT_BASE_PRICE', 'Prix (base) est le prix du produit sans options.');
define('HINT_PRICE_EXCL', 'Prix (HT) est le prix du produit HT avec les options &eacute;ventuelles');
define('HINT_PRICE_INCL', 'Prix (TTC)');
define('HINT_TOTAL_EXCL', 'Total (HT)');
define('HINT_TOTAL_INCL', 'Total (TTC)');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Nouvelle confirmation de commande :');
define('EMAIL_TEXT_SUBJECT', 'Notification de commande');
define('EMAIL_TEXT_DATE_MODIFIED', 'Date de modification :');
define('EMAIL_TEXT_PRODUCTS', 'Produit');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de livraison');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de facturation');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Moyen de paiement');

// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); 

// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'T&eacute;l&eacute;chargement #');
define('ENTRY_DOWNLOAD_FILENAME', 'Nom du fichier');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Jours avant expiration :');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'T&eacute;l&eacute;chargements restants');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Etes vous sure de vouloir supprimer ce produit ?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Etes vous sure de vouloir supprimer ce commentaire ?');
define('AJAX_MESSAGE_STACK_SUCCESS', 'Termin&eacute; ! \' + %s + \' a &eacute;t&eacute; mis &agrave; jour');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Vous avez modifier des informations concernant la livraison. Souhaitez vous recalculer les totaux ?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Impossible de cr&eacute;er une instance XMLHTTP');
define('AJAX_SUBMIT_COMMENT', 'Valider les commentaires et/ou le nouveau statut');
define('AJAX_NO_QUOTES', 'Il n\'y a aucun tarif de livraison &agrave; afficher.');
define('AJAX_SELECTED_NO_SHIPPING', 'Vous avez s&eacute;lectionn&eacute; un mode de livraison, mais celui-ci n est pas encore enregist&eacute; dans la base de donn&eacute;es. Soulaitez vous ajouter ces frais de port &egrave; la commande ?');
define('AJAX_RELOAD_TOTALS', 'Les nouveaux frais de port ont &eacute;t&eacute; enregistr&eacute;s mais le total est &Agrave; recalculer. Cliquer sur "ok" pour recalculer les totaux. Si votre connexion est lente, attendre que tous les composants soient charg&eacute;s avant de cliquer sur "ok".');
define('AJAX_NEW_ORDER_EMAIL', 'Etes vous sure de vouloir envoyer un nouvel email de confirmation de commande pour cette commande ?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Inscrire, si vous le souhaitez, vos commentaires ici.');
define('AJAX_SUCCESS_EMAIL_SENT', 'Termin&eacute; ! Un nouvel email de confirmation de commande a &eacute;t&eacute; envoy&eacute; &agrave; %s');
define('AJAX_WORKING', 'Veuillez patienter....');


?>
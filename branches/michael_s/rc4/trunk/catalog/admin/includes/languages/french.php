<?php
/*
  $Id: french.php,v 1.1 2005/05/04 20:09:41 tropic Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'fr_FR.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}


// translation by CRDD (coroidedroite@yahoo.fr)

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'Mon Compte');
define('HEADER_TITLE_LOGOFF', 'D&eacute;connexion');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mon Compte');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrateur');
define('BOX_ADMINISTRATOR_MEMBERS', 'Groupes de membres');
define('BOX_ADMINISTRATOR_MEMBER', 'Membres');
define('BOX_ADMINISTRATOR_BOXES', 'Acc&egrave;s Fichiers');

// images
define('IMAGE_FILE_PERMISSION', 'Autorisation Fichiers');
define('IMAGE_GROUPS', 'Liste des Groupes');
define('IMAGE_INSERT_FILE', 'Ins&eacute;rer Fichier');
define('IMAGE_MEMBERS', 'Listes des membres');
define('IMAGE_NEW_GROUP', 'Nouveau Groupe');
define('IMAGE_NEW_MEMBER', 'Nouveau Membre');
define('IMAGE_NEXT', 'Suivant');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> listes)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> membres)');
//Admin end

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Supporter le site');
define('HEADER_TITLE_ONLINE_CATALOG', 'Boutique');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');

// text for date of birth example
define('DOB_FORMAT_STRING', 'jj/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_MYSTORE', 'Mon magasin');
define('BOX_CONFIGURATION_LOGGING', 'Identification');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Paiement');
define('BOX_MODULES_SHIPPING', 'Livraisons');
define('BOX_MODULES_ORDER_TOTAL', 'Total Commandes');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Magasin');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Cat&eacute;gories/Produits');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Options de Produits');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricants');
define('BOX_CATALOG_REVIEWS', 'Commentaires');
define('BOX_CATALOG_SPECIALS', 'Promotions');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produits &agrave; venir');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clients');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clients');
define('BOX_CUSTOMERS_ORDERS', 'Commandes');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Lieux/Taxes');
define('BOX_TAXES_COUNTRIES', 'Pays');
define('BOX_TAXES_ZONES', 'R&eacute;gions');
define('BOX_TAXES_GEO_ZONES', 'Zones de taxation');
define('BOX_TAXES_TAX_CLASSES', 'Classes de taxation');
define('BOX_TAXES_TAX_RATES', 'Taux de taxation');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Rapports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produits consult&eacute;s');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produits achet&eacute;s');
define('BOX_REPORTS_ORDERS_TOTAL', 'Meilleures commandes');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Outils');
define('BOX_TOOLS_BACKUP', 'Sauvegarde');
define('BOX_TOOLS_BANNER_MANAGER', 'Gestion Banni&egrave;res');
define('BOX_TOOLS_CACHE', 'Gestion Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'D&eacute;finir langues');
define('BOX_TOOLS_FILE_MANAGER', 'Gestion Fichiers');
define('BOX_TOOLS_MAIL', 'Envoyer un mail');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gestion Newsletter');
define('BOX_TOOLS_SERVER_INFO', 'Infos Serveur');
define('BOX_TOOLS_WHOS_ONLINE', 'Qui est en ligne?');

// localization box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Pays');
define('BOX_LOCALIZATION_CURRENCIES', 'Devises');
define('BOX_LOCALIZATION_LANGUAGES', 'Langues');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Statut Commandes');

// javascript messages
define('JS_ERROR', 'Une erreur est survenue durant le traitement de votre formulaire!\nVeuillez effectuer les corrections suivantes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Un prix doit être défini pour la nouvelle option de produit\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Un préfixe de prix doit être défini pour la nouvelle option de produit\n');

define('JS_PRODUCTS_NAME', '* Un nom doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_DESCRIPTION', '* Une description doit être définie pour le nouveau produit\n');
define('JS_PRODUCTS_PRICE', '* Un prix doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_WEIGHT', '* Un poids doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_QUANTITY', '* Une quantité doit être définie pour le nouveau produit\n');
define('JS_PRODUCTS_MODEL', '* Un nom de modèle doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_IMAGE', '* Une image doit être défini pour le nouveau produit\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nouveau prix doit être défini pour ce produit\n');

define('JS_GENDER', '* Le \'Genre\' doit être sélectionné.\n');
define('JS_FIRST_NAME', '* Le \'Prénom\' doit avoir au moins ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractères.\n');
define('JS_LAST_NAME', '* Le \'Nom\' doit avoir au moins ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractères.\n');
define('JS_DOB', '* La \'Date de naissance\' doit être au format : xx/xx/xxxx (jour/mois/année).\n');
define('JS_EMAIL_ADDRESS', '* L \'Adresse email\' doit avoir au moins ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractères.\n');
define('JS_ADDRESS', '* L \'Adresse\' doit avoir au moins ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractères.\n');
define('JS_POST_CODE', '* Le \'Code postal\' doit avoir au moins ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractères.\n');
define('JS_CITY', '* La \'Ville\' doit avoir au moins ' . ENTRY_CITY_MIN_LENGTH . ' caractères.\n');
define('JS_STATE', '* L \'Etat\' doit être sélectionné.\n');
define('JS_STATE_SELECT', '-- Sélectionnez ci-dessus --');
define('JS_ZONE', '* La \'Zone\' doit être sélectionnée dans la liste selon le pays.');
define('JS_COUNTRY', '* Le \'Pays\' doit être sélectionné.\n');
define('JS_TELEPHONE', '* Le \'Téléphone\' doit avoir au moins ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caractères.\n');
define('JS_PASSWORD', '* Le \'Mot de passe\' et sa \'Confirmation\' doivent avoir au moins ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Le numéro de commande %s n\'existe pas&nbsp;!');

define('CATEGORY_PERSONAL', 'Personnel');
define('CATEGORY_ADDRESS', 'Addresse');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Soci&eacute;t&eacute;');
define('CATEGORY_OPTIONS', 'Options');

define('ENTRY_GENDER', 'Genre&nbsp;:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obligatoire</span>');
define('ENTRY_FIRST_NAME', 'Pr&eacute;nom&nbsp;:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_LAST_NAME', 'Nom&nbsp;:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance&nbsp;:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Adresse email&nbsp;:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">L\'adresse email ne semble pas valide&nbsp;!</span>');

define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Cette adresse email existe d&eacute;j&agrave;&nbsp;!</span>');
define('ENTRY_COMPANY', 'Soci&eacute;t&eacute;&nbsp;:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adresse&nbsp;:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_SUBURB', 'Comp. adresse&nbsp;:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Code postal&nbsp;:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_CITY', 'Ville&nbsp;:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_STATE', 'Etat&nbsp;:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obligatoire</span>');
define('ENTRY_COUNTRY', 'Pays&nbsp;:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'T&eacute;l&eacute;phone&nbsp;:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_FAX_NUMBER', 'Fax&nbsp;:');
define('ENTRY_FAX_NUMBER_ERROR', '');

define('ENTRY_NEWSLETTER', 'Newsletter&nbsp;:');
define('ENTRY_NEWSLETTER_YES', 's\'inscrire');
define('ENTRY_NEWSLETTER_NO', 'se d&eacute;sinscrire');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Envoyer un email');
define('IMAGE_BACK', 'Retour');
define('IMAGE_BACKUP', 'Sauvegarde');
define('IMAGE_CANCEL', 'Annuler');
define('IMAGE_CONFIRM', 'Valider');
define('IMAGE_COPY', 'Copier');
define('IMAGE_COPY_TO', 'Copier dans');
define('IMAGE_DEFINE', 'D&eacute;finir');
define('IMAGE_DELETE', 'Supprimer');
define('IMAGE_EDIT', 'Modifier');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Gestionnaire de fichiers');
define('IMAGE_ICON_STATUS_GREEN', 'Actif');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activer');
define('IMAGE_ICON_STATUS_RED', 'Inactif');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'D&eacute;sactiver');
define('IMAGE_ICON_INFO', 'Informamtion');
define('IMAGE_INSERT', 'Ins&eacute;rer');
define('IMAGE_LOCK', 'V&eacute;rouiller');
define('IMAGE_MODULE_INSTALL', 'Installer un module');
define('IMAGE_MODULE_REMOVE', 'Enlever un module');
define('IMAGE_MOVE', 'D&eacute;placer');
define('IMAGE_NEW_BANNER', 'Nouvelle banni&egrave;re');
define('IMAGE_NEW_CATEGORY', 'Nouvelle cat&eacute;gorie');
define('IMAGE_NEW_COUNTRY', 'Nouveau pays');
define('IMAGE_NEW_CURRENCY', 'Nouvelle devise');
define('IMAGE_NEW_FILE', 'Nouveau fichier');
define('IMAGE_NEW_FOLDER', 'Nouveau r&eacute;pertoire');
define('IMAGE_NEW_LANGUAGE', 'Nouvelle langue');
define('IMAGE_NEW_NEWSLETTER', 'Nouvelle newsletter');
define('IMAGE_NEW_PRODUCT', 'Nouveau produit');
define('IMAGE_NEW_TAX_CLASS', 'Nouvelle classe de taxation');
define('IMAGE_NEW_TAX_RATE', 'Nouveau taux de taxation');
define('IMAGE_NEW_TAX_ZONE', 'Nouvelle zone de taxation');
define('IMAGE_NEW_ZONE', 'Nouvelle r&eacute;gion');
define('IMAGE_ORDERS', 'Commandes');
define('IMAGE_ORDERS_INVOICE', 'Facture');
define('IMAGE_ORDERS_PACKINGSLIP', 'Bon d\'exp&eacute;dition');
define('IMAGE_PREVIEW', 'Aper&ccedil;u');
define('IMAGE_RESTORE', 'Restaurer');
define('IMAGE_RESET', 'Annuler');
define('IMAGE_SAVE', 'Enregistrer');
define('IMAGE_SEARCH', 'Rechercher');
define('IMAGE_SELECT', 'S&eacute;lectionner');
define('IMAGE_SEND', 'Envoyer');
define('IMAGE_SEND_EMAIL', 'Envoyer un email');
define('IMAGE_UNLOCK', 'D&eacute;verouiller');
define('IMAGE_UPDATE', 'Mettre &agrave; jour');
define('IMAGE_UPDATE_CURRENCIES', 'Mettre &agrave; jour le taux de change');
define('IMAGE_UPLOAD', 'T&eacute;l&eacute;charger');

define('ICON_CROSS', 'Faux');
define('ICON_CURRENT_FOLDER', 'R&eacute;pertoire courant');
define('ICON_DELETE', 'Supprimer');
define('ICON_ERROR', 'Erreur');
define('ICON_FILE', 'Fichier');
define('ICON_FILE_DOWNLOAD', 'T&eacute;l&eacute;chargement');
define('ICON_FOLDER', 'R&eacute;pertoire');
define('ICON_LOCKED', 'V&eacute;rouill&eacute;');
define('ICON_PREVIOUS_LEVEL', 'Niveau pr&eacute;c&eacute;dent');
define('ICON_PREVIEW', 'Aper&ccedil;u');
define('ICON_STATISTICS', 'Statistiques');
define('ICON_SUCCESS', 'Succ&egrave;s');
define('ICON_TICK', 'Vrai');
define('ICON_UNLOCKED', 'D&eacute;v&eacute;rouill&eacute;');
define('ICON_WARNING', 'Avertissement');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s sur %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> banni&egrave;res)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> pays)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> clients)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> devises)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> langues)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> fabricants)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> commandes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> &eacute;tats de commande)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits &agrave; venir)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> critiques de produit)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> promotions)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> classes de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> zones de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> taux de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> r&eacute;gions)');

//added missing instruction [www.wadaan.net]
define('TEXT_INFO_EDIT_GROUP_INTRO','Editer Introduction Groupe');
//end

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'd&eacute;faut');
define('TEXT_SET_DEFAULT', 'Par d&eacute;faut');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* obligatoire</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erreur&nbsp;: Il n\'y a encore aucune devise par d&eacute;faut de d&eacute;finie. Veuillez en d&eacute;finir une &agrave;&nbsp;: Administration Outils->Localisation->Devises');

define('TEXT_CACHE_CATEGORIES', 'Cadre des cat&eacute;gories');
define('TEXT_CACHE_MANUFACTURERS', 'Cadre des fabricants');
define('TEXT_CACHE_ALSO_PURCHASED', 'Module des achats');

define('TEXT_NONE', '--aucun--');
define('TEXT_TOP', 'Haut');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erreur&nbsp;: Le r&eacute;pertoire de destination n\'existe pas.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erreur&nbsp;: Le r&eacute;pertoire de destination n\'est pas accessible en &eacute;criture.');
define('ERROR_FILE_NOT_SAVED', 'Erreur&nbsp;: Le fichier &agrave; t&eacute;l&eacute;charger n\'a pas &eacute;t&eacute; enregistr&eacute;.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erreur&nbsp;: Le type du fichier &agrave; t&eacute;l&eacute;charger n\'est pas autoris&eacute;.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succ&egrave;s&nbsp;: Le fichier &agrave; t&eacute;l&eacute;charger a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s.');
define('WARNING_NO_FILE_UPLOADED', 'Attention&nbsp;: Aucun fichier t&eacute;l&eacute;charg&eacute;.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Attention&nbsp;: Le t&eacute;l&eacute;chargement de fichiers a &eacute;t&eacute; d&eacute;sactiv&eacute; dans le fichier de configuration de php&nbsp;: php.ini.');
?>
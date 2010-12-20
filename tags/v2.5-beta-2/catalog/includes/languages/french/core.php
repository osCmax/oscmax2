<?php
/*
$Id: french.php 2.0.15 2010-02-05 09:59:07Z ejsolutions.co.uk $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on Linux try 'fr_FR'
// on FreeBSD try 'fr_FR.ISO_8859-1'
// on Windows try 'fr', or 'French'
@setlocale(LC_TIME, 'fr_FR.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Retourne date au format brut
// $date doit etre au format dd/mm/yyyy (francais)
// Date au format burt est de la forme YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'utf-8');
// define('CHARSET', 'iso-8859-1');


// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Cr&eacute;er un compte');
define('HEADER_TITLE_MY_ACCOUNT', 'Mon compte');
define('HEADER_TITLE_CART_CONTENTS', 'Voir panier');
define('HEADER_TITLE_CHECKOUT', 'Commander');
define('HEADER_TITLE_CONTACT_US', 'Contactez-nous');
define('HEADER_TITLE_TOP', 'Accueil');
define('HEADER_TITLE_CATALOG', 'Catalogue');
define('HEADER_TITLE_LOGOFF', 'Déconnexion');
define('HEADER_TITLE_LOGIN', 'S\'identifier');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'requ&ecirc;tes depuis le');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');
define('MALE_ADDRESS', 'M.');
define('FEMALE_ADDRESS', 'Mme.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'jj/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Cat&eacute;gories');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricants');
define('BOX_MANUFACTURERS_SELECT_ONE', 'S&eacute;lectionner:');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Nouveaut&eacute;s?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Rechercher');
define('BOX_SEARCH_TEXT', 'Recherche rapide');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Recherche avanc&eacute;e');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Promotions');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Commentaires');
define('BOX_REVIEWS_WRITE_REVIEW', '&Eacute;crire un commentaire pour ce produit!');
define('BOX_REVIEWS_NO_REVIEWS', 'Il n\'y a pas encore de commentaire');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s sur 5 &Eacute;toiles!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Mon panier');
define('BOX_SHOPPING_CART_EMPTY', 'Aucun articles');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php 
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Mes souhaits'); 
define('TEXT_WISHLIST_COUNT', 'Actuellement, %s produits sur votre liste de souhaits.');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Historique commandes');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Meilleures ventes');
define('BOX_HEADING_BESTSELLERS_IN', 'Meilleures ventes dans<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Surveillance Produit');
define('BOX_NOTIFICATIONS_NOTIFY', 'M\'informer d\'un changement <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Ne pas m\'informer d\'un changement <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Information fabricant');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Page d\'accueil de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Autres articles');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Langues');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Devises');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informations');
define('BOX_INFORMATION_PRIVACY', 'Politique de Confidentialit&eacute;');
define('BOX_INFORMATION_CONDITIONS', 'Conditions G&eacute;n&eacute;rales');
define('BOX_INFORMATION_SHIPPING', 'Exp&eacute;ditions et retours');
define('BOX_INFORMATION_CONTACT', 'Contactez-nous');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Plan du site');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Faire conna&icirc;tre');
define('BOX_TELL_A_FRIEND_TEXT', 'Envoyer cet article &agrave; un ami(e).');

//LINE ADDED - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Regardez Tous les Articles');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Information livraison');
define('CHECKOUT_BAR_PAYMENT', 'Information paiement');
define('CHECKOUT_BAR_DELIVERY_ADDRESS', 'Adresse de Livraison');
define('CHECKOUT_BAR_PAYMENT_METHOD', 'M&eacute;thode de Paiement');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Fin!');

// pull down default text
define('PULL_DOWN_DEFAULT', '-- Votre choix? --');
define('TYPE_BELOW', '&Eacute;crire ci-dessous');

// javascript messages
define('JS_ERROR', 'Des erreurs sont survenues durant le traitement de votre formulaire.\n\nVeuillez effectuer les corrections suivantes:\n\n');

define('JS_REVIEW_TEXT', '* Le \'commentaire\' saisi doit comporter au moins ' . REVIEW_TEXT_MIN_LENGTH . ' caractères.\n');
define('JS_REVIEW_RATING', '* Vous devez mettre une appr&eacute;ciation pour cet article.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Veuillez choisir une m&eacute;thode de paiement pour votre commande.\n');

define('JS_ERROR_SUBMITTED', 'Ce formulaire a &eacute;t&eacute; d&eacute;j&agrave; soumis. Veuillez appuyer sur Ok et attendez jusqu\'&agrave; ce que le traitement soit fini.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Veuillez choisir une m&eacute;thode de paiement pour votre commande.');

define('CATEGORY_COMPANY', 'Soci&eacute;t&eacute;');
define('CATEGORY_PERSONAL', 'Vous');
define('CATEGORY_ADDRESS', 'Votre adresse');
define('CATEGORY_CONTACT', 'Vos informations personnelles');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Votre mot de passe');

define('ENTRY_COMPANY', 'Soci&eacute;t&eacute;:');
define('ENTRY_COMPANY_ERROR', ' <small><font color="#FF0000">min ' . ENTRY_COMPANY_LENGTH . ' caract&egrave;res</font></small>');
define('ENTRY_COMPANY_TEXT', ' <small><font color="#0000bb">requis</font></small>');
// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Num&eacute;ro de TVA intracom.:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF: MOD - Separate Pricing Per Customer
define('ENTRY_GENDER', 'Civilit&eacute;:');
define('ENTRY_GENDER_ERROR', 'S&eacute;lectionner un des champs Civilit&eacute;s');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Pr&eacute;nom:');
define('ENTRY_FIRST_NAME_ERROR', 'Votre prénom doit contenir un minimum de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractères.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nom :');
define('ENTRY_LAST_NAME_ERROR', 'Votre nom doit contenir un minimum de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractères.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Votre date de naissance doit avoir ce format: JJ/MM/AAAA (ex. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (ex. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Votre courriel doit contenir un minimum de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractères.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Votre courriel ne semble pas &ecirc;tre valide - veuillez effectuer toutes les corrections n&eacute;cessaires.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Votre courriel est d&eacute;j&agrave; enregistr&eacute;e sur notre site - Veuillez ouvrir une session avec ce courriel ou cr&eacute;ez un compte avec une adresse diff&eacute;rente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adresse :');
define('ENTRY_STREET_ADDRESS_ERROR', 'Votre adresse doit contenir un minimum de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractères.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Adresse 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Code postal :');
define('ENTRY_POST_CODE_ERROR', 'Votre code postal doit contenir un minimum de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractères.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ville: ');
define('ENTRY_CITY_ERROR', 'Votre ville doit contenir un minimum de ' . ENTRY_CITY_MIN_LENGTH . ' caractères.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'État/Département :');
define('ENTRY_STATE_ERROR', 'Votre état doit contenir un minimum de ' . ENTRY_STATE_MIN_LENGTH . ' caractères.');
define('ENTRY_STATE_ERROR_SELECT', 'Sélectionner un autre état ou département.');
define('ENTRY_STATE_TEXT', ' *');
define('ENTRY_COUNTRY', 'Pays:');
define('ENTRY_COUNTRY_ERROR', 'Veuillez choisir un pays à partir de la liste déroulante.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Num&eacute;ro de t&eacute;l&eacute;phone:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Votre numéro de téléphone doit contenir un minimum de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Num&eacute;ro de fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Lettre d\'information:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'S\'abonner');
define('ENTRY_NEWSLETTER_NO', 'Ne pas s\'abonner');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Mot de passe:');
define('ENTRY_PASSWORD_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre mot de passe.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Mot de passe actuel :');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_NEW', 'Nouveau mot de passe:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Votre nouveau mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre nouveau mot de passe.');
define('PASSWORD_HIDDEN', '--CACHE--');

define('FORM_REQUIRED_INFORMATION', '* Information requise');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Résultat:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> produits)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> commandes)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> Impressions)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> nouveaux produits)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Affichage de <b>%d</b> à <b>%d</b> (sur <b>%d</b> promotions)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Premi&egrave;re Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Page Pr&eacute;c&eacute;dente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Page Suivante');
define('PREVNEXT_TITLE_LAST_PAGE', 'Derni&egrave;re Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Ensemble pr&eacute;c&eacute;dent de %d pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Ensemble suivant de %d pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PREMIER');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Pr&eacute;c]');
define('PREVNEXT_BUTTON_NEXT', '[Suiv&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'DERNIER&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Ajouter adresse');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Carnet d\'adresses');
define('IMAGE_BUTTON_BACK', 'Retour ');
define('IMAGE_BUTTON_BUY_NOW', 'Acheter : ');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Changez l\'adresse');
define('IMAGE_BUTTON_CHECKOUT', 'Commander');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmer la commande');
define('IMAGE_BUTTON_CONTINUE', 'Continuer');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continuer vos achats');
define('IMAGE_BUTTON_DELETE', 'Supprimer');
define('IMAGE_BUTTON_EDIT_ACCOUNT', '&Eacute;diter Compte');
define('IMAGE_BUTTON_HISTORY', 'Historique des commandes');
define('IMAGE_BUTTON_LOGIN', 'Identifiant');
define('IMAGE_BUTTON_IN_CART', 'Ajouter au panier : ');
define('IMAGE_OUT_OF_STOCK', 'Indisponible');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Surveillance Produit');
define('IMAGE_BUTTON_QUICK_FIND', 'Recherche rapide');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Supprimer les surveillances produits');
define('IMAGE_BUTTON_REVIEWS', 'Impressions sur : ');
define('IMAGE_BUTTON_SEARCH', 'Rechercher');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Options d\'exp&eacute;dition');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Envoyer &agrave; un ami');
define('IMAGE_BUTTON_UPDATE', 'Mise &agrave; jour');
define('IMAGE_BUTTON_UPDATE_CART', 'Mise &agrave; jour du panier');
define('IMAGE_BUTTON_WRITE_REVIEW', '&Eacute;crire un commentaire : ');

define('SMALL_IMAGE_BUTTON_DELETE', 'Supprimer');
define('SMALL_IMAGE_BUTTON_EDIT', '&Eacute;diter');
define('SMALL_IMAGE_BUTTON_VIEW', 'Afficher');

define('ICON_ARROW_RIGHT', 'Plus');
define('ICON_CART', 'Panier');
define('ICON_ERROR', 'Erreur');
define('ICON_SUCCESS', 'Succ&egrave;s');
define('ICON_WARNING', 'Attention');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Catalogue imprimable');
define('IMAGE_BUTTON_UPSORT', 'Ordre croissant');
define('IMAGE_BUTTON_DOWNSORT', 'Ordre d&eacute;croissant');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTIFICATION:  Ce site web est en maintenance: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTIFICATION:  Ce site web est actuellement en maintenance');

define('TEXT_GREETING_PERSONAL', 'Bienvenue <span class="greetUser">%s!</span> Voudriez vous voir <a href="%s"><u>les nouveaut&eacute;s</u></a> disponibles?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Si vous n\'&ecirc;tes pas %s, merci de vous <a href="%s"><u>reconnecter</u></a> avec votre identifiant et mot de passe.</small>');
define('TEXT_GREETING_GUEST', 'Bienvenue <span class="greetUser">Madame, Monsieur</span>. Voulez vous vous <a href="%s"><u>identifier</u></a> ? Pr&eacute;f&eacute;rez vous <a href="%s"><u>cr&eacute;er un compte</u></a> ?');

define('TEXT_SORT_PRODUCTS', 'Trier les produits ');
define('TEXT_DESCENDINGLY', 'descendant');
define('TEXT_ASCENDINGLY', 'ascendant');
define('TEXT_BY', ' par ');

define('TEXT_REVIEW_BY', 'par %s');
define('TEXT_REVIEW_SUITE', '<i>(Lire la suite)</i>');
define('TEXT_REVIEW_WORD_COUNT', '%s mots');
define('TEXT_REVIEW_RATING', 'Classement: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date d\'ajout: %s');
define('TEXT_NO_REVIEWS', 'Il n\'y a pas encore de commentaire sur ce produit.');

define('TEXT_NO_NEW_PRODUCTS', 'Il n\'y a pour le moment aucun nouveau produit.');

define('TEXT_UNKNOWN_TAX_RATE', 'Taxe inconnue');

define('TEXT_REQUIRED', '<span class="errorText">Requis</span>');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '223');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERREUR:</small> Impossible d\'envoyer le courriel au travers du serveur SMTP spécifié. V&eacute;rifiez le fichier PHP.INI et corrigez le nom du serveur SMTP si n&eacute;cessaire.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Attention, le r&eacute;pertoire d\'installation existe à :' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Merci de supprimer ce répertoire pour des raisons de sécurité.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Attention: Il est possible d\'&eacute;crire sur le fichier de configuration: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Ceci est un risque potentiel - merci de mettre les bonnes permissions sur ce fichier.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Attention: Le r&eacute;pertoire de session n\'existe pas: ' . tep_session_save_path() . '. Les sessions ne fonctionneront pas tant que ce r&eacute;pertoire n\'aura pas &eacute;t&eacute; cr&eacute;&eacute;.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Attention: Il est impossible d\'&eacute;crire dans le r&eacute;pertoire de sessions ' . tep_session_save_path() . '. Celles-ci ne fonctionneront pas tant que les permissions n\'auront pas &eacute;t&eacute; corrig&eacute;es.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Attention: Votre serveur web est en cours d\'ex&eacute;cution ' . PHP_VERSION . ' qui n\'est pas suffisante pour pouvoir utiliser les SEO URLs. S\'il vous plaît désactiver ce module jusqu\'à ce que vous avez mis à niveau votre version de PHP.');
define('WARNING_SESSION_AUTO_START', 'Attention: session.auto_start est actif - d&eacute;sactiver cette fonctionnalit&eacute; dans php.ini et red&eacute;marrer le serveur.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Attention : Le r&eacute;pertoire de t&eacute;l&eacute;chargement n\'existe pas : ' . DIR_FS_DOWNLOAD . '. Le t&eacute;l&eacute;chargement de produits ne fonctionnera qu\'avec un r&eacute;pertoire valide.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La date d\'expiration entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide.<br>Veuillez v&eacute;rifier la date et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Le num&eacute; entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide.<br>Veuillez v&eacute;rifier le num&eacute;ro et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Le code &agrave; 4 chiffres que vous avez entr&eacute; est: %s<br>Si ce code est correcte, nous n\'acceptons pas ce type de carte cr&eacute;dit.<br>S\'il est erron&eacute;, veuillez r&eacute;essayer.');

define('FOOTER_TEXT_BODY', 'All content and Images Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCMax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');

// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Créer un compte');
define('NAV_ORDER_INFO', 'Info commande');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Articles');
define('BOX_ALL_ARTICLES', 'Tous les Articles');
define('BOX_NEW_ARTICLES', 'Nouveaux Articles');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Afficher <b>%d</b> à <b>%d</b> (de <b>%d</b> articles)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Afficher <b>%d</b> à <b>%d</b> (de <b>%d</b> nouveaux articles)');
define('TABLE_HEADING_AUTHOR', 'Auteur');
define('TABLE_HEADING_ABSTRACT', '');
define('BOX_HEADING_AUTHORS', 'Articles par auteur');
define('NAVBAR_TITLE_DEFAULT', 'Articles');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Se connecter');
define('BOX_LOGINBOX_EMAIL', 'Adresse e-mail :');
define('BOX_LOGINBOX_PASSWORD', '<br />Mot de passe :');
define('BOX_LOGINBOX_TEXT_NEW', 'Cr&eacute;er un compte');
define('BOX_LOGINBOX_NEW', 'Cr&eacute;er un compte');
define('BOX_LOGINBOX_FORGOT_PASSWORD', 'Mot de passe<br />');
define('IMAGE_BUTTON_LOGIN', 'Connexion');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Information compte');
define('LOGIN_BOX_ACCOUNT_EDIT','Éditer information compte.');
define('LOGIN_BOX_ACCOUNT_HISTORY','Historique compte');
define('LOGIN_BOX_ADDRESS_BOOK','Mon carnet d\'adresse');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Notifications produit');
define('LOGIN_BOX_MY_ACCOUNT','Information g&eacute;n&eacute;rale');
define('LOGIN_BOX_LOGOFF','Se déconnecter');
define('LOGIN_BOX_PRODUCTS_NEW','Nouveaux produits');
// EOF: WebMakers Added: Login Box My Account

//BOF: Wish List 2.3 box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Ma liste de souhaits');
define('BOX_WISHLIST_EMPTY', 'Pas de produit dans votre liste de souhaits');
define('IMAGE_BUTTON_ADD_WISHLIST', 'Ajouter à la liste de souhaits');
define('TEXT_WISHLIST_COUNT', 'Actuellement %s produits sur votre liste.');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Afficher <b>%d</b> à <b>%d</b> (de <b>%d</b> produits sur votre liste)');
define('BOX_HEADING_CUSTOMER_WISHLIST_HELP', 'Aide liste de souhaits');
define('BOX_HEADING_SEND_WISHLIST', 'Envoyer votre liste');
define('BOX_TEXT_MOVE_TO_CART', 'Mettre dans le panier');
define('BOX_TEXT_DELETE', 'Effacer');
define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', 'Paypal Express paiement'); 
//EOF Wish List 2.3
?>
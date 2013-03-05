<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

//texte recherche Banner top
define('TEXT_RECHERCHE','Recherche avanc&eacute;e');
define('TEXT_TOUS','Tous');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Cr&eacute;er un compte');
define('HEADER_TITLE_MY_ACCOUNT', 'Mon compte');
define('HEADER_TITLE_CONTACT_US', 'Contact');
define('HEADER_TITLE_CART_CONTENTS', 'Mon panier');
define('HEADER_TITLE_BASKET_CONTENTS', 'Mon panier');
define('HEADER_TITLE_CHECKOUT', 'Commander');
define('HEADER_TITLE_WISHLIST', 'Mes souhaits');
define('HEADER_TITLE_TOP', 'Accueil');
define('HEADER_TITLE_CATALOG', 'Catalogue');
define('HEADER_TITLE_LOGOFF', 'D&eacute;connexion');
define('HEADER_TITLE_LOGIN', 'S\'identifier');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'requ&ecirc;tes depuis le');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');
define('MALE_ADDRESS', 'M.');
define('FEMALE_ADDRESS', 'Mme.');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Cat&eacute;gories');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricants');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Nouveaut&eacute;s?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Recherche rapide');
define('BOX_SEARCH_TEXT', 'Recherche');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Recherche avanc&eacute;e');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Promotions');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Commentaires');
define('BOX_REVIEWS_WRITE_REVIEW', 'Ecrire un commentaire pour ce produit!');
define('BOX_REVIEWS_NO_REVIEWS', 'Il n\'y a pas encore de commentaire');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s sur 5 &eacute;toiles!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Mon panier');
define('BOX_HEADING_SHOPPING_BASKET', 'Mon panier');
define('BOX_SHOPPING_CART_EMPTY', 'Aucun articles');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Mes souhaits');
define('TEXT_WISHLIST_COUNT', 'Actuellement, %s produits sont sur votre liste de souhaits.');
define('BOX_TEXT_REMOVE', 'Enlever');
define('BOX_TEXT_PRICE', 'Prix');
define('BOX_TEXT_PRODUCT', 'Nom du produit');
define('BOX_TEXT_IMAGE', 'Image');
define('BOX_TEXT_SELECT', 'Selectioner');
define('BOX_TEXT_VIEW', 'Afficher');
define('BOX_TEXT_HELP', 'Aide');
define('BOX_WISHLIST_EMPTY', '0 article');
define('BOX_TEXT_NO_ITEMS', 'Il n\'y a aucun article dans votre liste de souhaits.');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Historique commandes');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Meilleures ventes');
define('BOX_HEADING_BESTSELLERS_IN', 'Meilleures ventes dans<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Alertes Produit');
define('BOX_NOTIFICATIONS_NOTIFY', 'M\'informer d\'une mise à jour <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Ne pas m\'informer d\'une mise à jour <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Information du fabricant');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Page d\'accueil de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Autres articles');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Langues');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Devises');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informations');
define('BOX_INFORMATION_PRIVACY', 'Politique de confidentialit&eacute;;');
define('BOX_INFORMATION_CONDITIONS', 'Conditions d\'utilisation');
define('BOX_INFORMATION_SHIPPING', 'Exp&eacute;ditions et retours');
define('BOX_INFORMATION_CONTACT', 'Contactez-nous');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Plan du site');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Informer un ami');
define('BOX_TELL_A_FRIEND_TEXT', '<Informer un ami a propos de ce produit.');

//MailChimp
define('BOX_HEADING_MAILCHIMP', 'Bulletin d\'information');
define('MAILCHIMP_INTRO_TEXT', 'Si vous souhaitez vous abonner à notre bulletin d\'information, nous vous prions d\'entrez votre adresse courriel ici:');
define('MAILCHIMP_INTRO_TEXT_SUBSCRIBED', 'Vous &ecirc;tes actuellement abonn&eacute; à notre bulletin d\'information');
define('MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED', 'Si vous souhaitez vous abonner à notre à notre bulletin d\'information nous vous prions d\'entrez votre adresse courriel ici: S\'il vous plaît, entrez votre adresse courriel ici:');
define('MAILCHIMP_EXISTING_USER_UNSUBSCRIBED', 'Vous <strong>n\'&ecirc;tes pas</strong> abonn&eacute;s à notre bulletin d\'information');
define('MAILCHIMP_HTML', 'HTML');
define('MAILCHIMP_TEXT', 'Text');
define('MAILCHIMP_MISSING_INTRO', 'Malheureusement, vous n\'avez pas saisi toutes les informations n&eacute;cessaires à votre configuration MailChimp. <br><br><b>Missing Settings:</b>');
define('MAILCHIMP_NEED_ENABLING', '<b>S\'il vous plaît activer le module</b>');
define('MAILCHIMP_MISSING_API', 'API Key');
define('MAILCHIMP_MISSING_ID', 'List identifiant');
define('MAILCHIMP_MISSING_URL', 'List URL');
define('MAILCHIMP_MISSING_U', 'U value');
define('IMAGE_BUTTON_UNSUBSCRIBE', 'D&eacute;sabonner');
define('IMAGE_BUTTON_SUBSCRIBE', 'S\'abonner');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Tous');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Information de livraison');
define('CHECKOUT_BAR_PAYMENT', 'Information de paiement');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Termin&eacute;!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Faite votre choix');
define('PULL_DOWN_DEFAULT_DOTS', 'Faite votre choix... ');
define('PULL_DOWN_NA', 'Non sp&eacute;cifi&eacute;');
define('TYPE_BELOW', 'Ecrire ci-dessous');

// javascript messages
define('JS_ERROR', 'Des erreurs sont survenues durant le traitement de votre formulaire. Veuillez effectuer les corrections suivantes:');

define('JS_REVIEW_TEXT', ' Le \'commentaire\' saisi doit comporter au moins ' . REVIEW_TEXT_MIN_LENGTH . ' caract&egrave;res.');
define('JS_REVIEW_RATING', ' Vous devez mettre une appr&eacute;ciation pour cet article.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', 'Veuillez choisir une mode de paiement pour votre commande.\n');

define('JS_ERROR_SUBMITTED', 'Ce formulaire a &eacute;t&eacute; d&eacute;j&agrave; soumis. Veuillez appuyer sur Ok et attendez jusqu\'&agrave; ce que le traitement soit fini.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Veuillez choisir une mode de paiement pour votre commande.');

define('CATEGORY_COMPANY', 'Infos de la soci&eacute;t&eacute');
define('CATEGORY_PERSONAL', 'Vos infos personnels');
define('CATEGORY_ADDRESS', 'Votre adresse');
define('CATEGORY_CONTACT', 'Vos infos de contact');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Votre mot de passe');

define('ENTRY_COMPANY', 'Nom de la soci&eacute;t&eacute;:');
define('ENTRY_COMPANY_ERROR', 'S\'il vous plaît entrer votre nom de la soci&eacute;t&eacute');
define('ENTRY_COMPANY_TEXT', '');
//define('ENTRY_COMPANY_TEXT', '*');
define('ENTRY_COMPANY_TAX_ID', 'Num&eacute;ro intracommunataire:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
//define('ENTRY_COMPANY_TAX_ID_ERROR', 'S\'il vous plaît entrer votre Num&eacute;ro intracommunataire IBLC');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
//define('ENTRY_COMPANY_TAX_ID_TEXT', '*');
define('ENTRY_GENDER', 'Sexe;:');
define('ENTRY_GENDER_ERROR', 'S&eacute;lectionner votre sexe.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Pr&eacute;nom:');
define('ENTRY_FIRST_NAME_ERROR', 'Votre pr&eacute;nom doit contenir un minimum de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nom:');
define('ENTRY_LAST_NAME_ERROR', 'Votre nom doit contenir un minimum de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance:');
// if you are looking for the DOB error message and * - look in locale.php
define('ENTRY_EMAIL_ADDRESS', 'Adresse courriel:');
define('ENTRY_EMAIL_CONFIRMATION', 'E-Mail Confirmation:');
define('ENTRY_EMAIL_CONFIRMATION_TEXT', '*');
define('ENTRY_EMAIL_ERROR_NOT_MATCHING', 'The E-Mail Confirmation must match your E-Mail Address.');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Votre courriel doit contenir un minimum de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Votre courriel ne semble pas &ecirc;tre valide - veuillez effectuer toutes les corrections n&eacute;cessaires.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Votre courriel est d&eacute;j&agrave; enregistr&eacute;e sur notre site - Veuillez ouvrir une session avec cette adresse courriel ou cr&eacute;ez un compte avec une adresse diff&eacute;rente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adresse :');
define('ENTRY_STREET_ADDRESS_ERROR', 'Votre adresse doit contenir un minimum de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_CITY', 'Ville:');
define('ENTRY_CITY_ERROR', 'Votre nom de ville doit contenir un minimum de ' . ENTRY_CITY_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_TEXT', '* (Page sera actualis&eacute;e lors d\'un changement)');
define('ENTRY_COUNTRY', 'Pays:');
define('ENTRY_COUNTRY_ERROR', 'Veuillez choisir un pays &agrave; partir de la liste d&eacute;roulante.');
define('ENTRY_COUNTRY_TEXT', '* (S&eacute;lectionez dabord un pays)');
define('ENTRY_TELEPHONE_NUMBER', 'Num&eacute;ro de t&eacute;l&eacute;phone:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Votre num&eacute;ro de t&eacute;l&eacute;phone doit contenir un minimum de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chiffre.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Num&eacute;ro de fax:');
define('ENTRY_FAX_NUMBER_ERROR', 'S\'il vous plaît entrer votre num&eacute;ro de fax');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Bultin d\'information:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'S\'abonner');
define('ENTRY_NEWSLETTER_NO', 'Ne pas s\'abonner');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Mot de passe:');
define('ENTRY_PASSWORD_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre mot de passe.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmation mot de passe:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Mot de passe actuel:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Votre mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_NEW', 'Nouveau mot de passe:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Votre nouveau mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract&egrave;res.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le mot de passe de confirmation doit &ecirc;tre identique &agrave; votre nouveau mot de passe.');
define('PASSWORD_HIDDEN', '--CACHE--');

define('FORM_REQUIRED_INFORMATION', '* Information requise');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pages:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Affichage de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Affichage de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> commandes)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Affichage de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> comentaire)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Affichage de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> nouveaux produits)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Affichage de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> promotions)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Premi&egrave;re Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Page Pr&eacute;c&eacute;dente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Page Suivante');
define('PREVNEXT_TITLE_LAST_PAGE', 'Derni&egrave;re Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Ensemble pr&eacute;c&eacute;dent de %d pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Ensemble suivant de %d pages');
define('PREVNEXT_BUTTON_FIRST', 'Premi&egrave;re');
define('PREVNEXT_BUTTON_PREV', 'Pr&eacute;c&eacute;dente');
define('PREVNEXT_BUTTON_NEXT', 'Suivante');
define('PREVNEXT_BUTTON_LAST', 'Derni&egrave;re');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Ajouter une adresse');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Carnet d\'adresses');
define('IMAGE_BUTTON_BACK', 'Retour');
define('IMAGE_BUTTON_BUY_NOW', 'Acheter');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Changez l\'adresse');
define('IMAGE_BUTTON_CHECKOUT', 'Commander');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmer la commande');
define('IMAGE_BUTTON_CONTINUE', 'Continuer');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continuer vos achats');
define('IMAGE_BUTTON_DELETE', 'Supprimer');
define('IMAGE_BUTTON_EDIT_ACCOUNT', '&eacute;diter votre Compte');
define('IMAGE_BUTTON_HISTORY', 'Historique des commandes');
define('IMAGE_BUTTON_LOGIN', 'S\'identifier');
define('IMAGE_BUTTON_IN_CART', 'Ajouter au panier');
define('IMAGE_BUTTON_IN_BASKET', 'Ajouter au panier');
define('IMAGE_OUT_OF_STOCK', 'Indisponible');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notification de Produit');
define('IMAGE_BUTTON_QUICK_FIND', 'Recherche rapide');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Supprimer les notifications produits');
define('IMAGE_BUTTON_REVIEWS', 'Commentaire sur: ');
define('IMAGE_BUTTON_SEARCH', 'Rechercher');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Options d\'exp&eacute;dition');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Envoyer &agrave; un ami');
define('IMAGE_BUTTON_UPDATE', 'Mise &agrave; jour');
define('IMAGE_BUTTON_UPDATE_CART', 'Mise &agrave; jour du panier');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Ecrire un commentaire');
define('IMAGE_BUTTON_CFP', 'Contactez-nous pour un prix');
define('IMAGE_BUTTON_AAQ', 'Poser une question sur ce produit');
define('IMAGE_BUTTON_MORE_INFO', 'Plus d\'infos');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Suprimer le produit');
define('IMAGE_BUTTON_SEND', 'Envoyer');
define('IMAGE_BUTTON_WISHLIST_HELP', 'Aide pour la liste de souhaits');
define('IMAGE_BUTTON_WISHLIST', 'Liste de souhaits');

define('SMALL_IMAGE_BUTTON_DELETE', 'Supprimer');
define('SMALL_IMAGE_BUTTON_EDIT', '&eacute;diter');
define('SMALL_IMAGE_BUTTON_VIEW', 'Afficher');

define('ICON_ARROW_RIGHT', 'Plus');
define('ICON_CLEAR_HISTORY', 'Effacer l\'historique');
define('ICON_CART', 'Panier');
define('ICON_ERROR', 'Erreur');
define('ICON_SUCCESS', 'Succ&egrave;s');
define('ICON_WARNING', 'Attention');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Catalogue imprimable');
define('IMAGE_BUTTON_UPSORT', 'Ordre croissant');
define('IMAGE_BUTTON_DOWNSORT', 'Ordre d&eacute;croissant');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTIFICATION: Ce site sera ferm&eacute; pour maintenance le: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTIFICATION: Ce site web est actuellement en maintenance et ferm&eacute; au public');

define('TEXT_SORT_PRODUCTS', 'Trier les produits ');
define('TEXT_DESCENDINGLY', 'descendant');
define('TEXT_ASCENDINGLY', 'ascendant');
define('TEXT_BY', ' par ');

define('TEXT_REVIEW_BY', 'par %s');
define('TEXT_REVIEW_WORD_COUNT', '%s mots');
define('TEXT_REVIEW_RATING', 'Classement: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date d\'ajout: %s');
define('TEXT_NO_REVIEWS', 'Il n\'y a pas encore de commentaire sur ce produit.');

define('TEXT_NO_NEW_PRODUCTS', 'Il n\'y a pour le moment aucun nouveau produit.');

define('TEXT_UNKNOWN_TAX_RATE', 'TVA inconnue');

define('TEXT_REQUIRED', '<span class="errorText">Requis</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERREUR:</small> Impossible d\'envoyer le courriel au travers du serveur SMTP sp&eacute;cifi&eacute;. V&eacute;rifiez le fichier PHP.INI et corrigez le nom du serveur SMTP si n&eacute;cessaire.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Attention, le r&eacute;pertoire d\'installation existe &agrave; :' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Il est vinement conseill&eacute; de supprimer ce r&eacute;pertoire pour des raisons de s&eacute;curit&eacute;.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Attention: Il est possible d\'&eacute;crire sur le fichier de configuration: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Ceci est un risque potentiel - merci de mettre les bonnes permissions sur ce fichier.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Attention: Le r&eacute;pertoire de session n\'existe pas: ' . tep_session_save_path() . '. Les sessions ne fonctionneront pas tant que ce r&eacute;pertoire n\'aura pas &eacute;t&eacute; cr&eacute;&eacute;.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Attention: Il est impossible d\'&eacute;crire dans le r&eacute;pertoire de sessions ' . tep_session_save_path() . '. Celles-ci ne fonctionneront pas tant que les permissions n\'auront pas &eacute;t&eacute; corrig&eacute;es.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Attention: Votre serveur web est en cours d\'ex&eacute;cution ' . PHP_VERSION . ' qui n\'est pas suffisante pour pouvoir utiliser les SEO URLs. S\'il vous pla&icirc;t d&eacute;sactiver ce module jusqu\'&agrave; ce que vous avez mis &agrave; niveau votre version de PHP.');
define('WARNING_SESSION_AUTO_START', 'Attention: session.auto_start est actif - d&eacute;sactiver cette fonctionnalit&eacute; dans php.ini et red&eacute;marrer le serveur.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Attention : Le r&eacute;pertoire de t&eacute;l&eacute;chargement n\'existe pas : ' . DIR_FS_DOWNLOAD . '. Le t&eacute;l&eacute;chargement de produits ne fonctionnera qu\'avec un r&eacute;pertoire valide.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La date d\'expiration entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide.<br>Veuillez v&eacute;rifier la date et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Le num&eacute; entr&eacute;e pour cette carte de cr&eacute;dit n\'est pas valide.<br>Veuillez v&eacute;rifier le num&eacute;ro et r&eacute;essayez.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Le code &agrave; 4 chiffres que vous avez entr&eacute; est: %s<br>Si ce code est correcte, nous n\'acceptons pas ce type de carte cr&eacute;dit.<br>S\'il est erron&eacute;, veuillez r&eacute;essayer.');
define('WARNING_JAVASCRIPT_DISABLED', 'Attention: Nous avons d&eacute;tect&eacute; que vous avez d&eacute;sactiv&eacute; Javascript. Pour une bonne utuilisation de ce site, vous devez l\'aciver. Si vous avez besoin d\'aide, <b>cliquez ici.</b>');
define('WARNING_IE6_DETECTED', 'Attention: Nous avons d&eacute;tect&eacute; que vous utilisez Internet Explorer 6 qui est instable. Nous vous recommandons vivement de <b>mettre à jour votre navigateur</b>. Pourquoi ne pas essayer <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx"><b>IE</b></a>, <a href="http://www.mozilla.com/"><b>Firefox</b></a> ou <a href="http://www.google.co.uk/chrome/"><b>Chrome</b></a>');

define('FOOTER_TEXT_BODY', 'Tous drois r&eacute;serv&eacute;, textes et images Placebo S&agrave;rl et aux fabricants respectis &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');

// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Cr&eacute;er un compte');
define('NAV_ORDER_INFO', 'Info de la commande');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Articles');
define('BOX_ALL_ARTICLES', 'Tous les Articles');
define('BOX_NEW_ARTICLES', 'Nouveaux Articles');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (de <b>%d</b> articles)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Afficher <b>%d</b> &agrave; <b>%d</b> (de <b>%d</b> nouveaux articles)');
define('TABLE_HEADING_AUTHOR', 'Auteur');
define('TABLE_HEADING_ABSTRACT', 'Sommaire');
define('BOX_HEADING_AUTHORS', 'Articles par auteur');
define('NAVBAR_TITLE_DEFAULT', 'Articles');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Se connecter');
define('BOX_LOGINBOX_EMAIL', 'Adresse couriel:');
define('BOX_LOGINBOX_PASSWORD', 'Mot de passe:');
define('BOX_LOGINBOX_TEXT_NEW', 'Cr&eacute;er un compte');
define('BOX_LOGINBOX_NEW', 'cr&eacute;er un compte');
define('BOX_LOGINBOX_FORGOT_PASSWORD', 'Mot de passe');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT', 'Information de mon compte');
define('LOGIN_BOX_ACCOUNT_EDIT', 'Editer mon compte.');
define('LOGIN_BOX_ACCOUNT_HISTORY', 'Historique compte');
define('LOGIN_BOX_ADDRESS_BOOK', 'Mon carnet d\'adresse');
define('LOGIN_BOX_PASSWORD', 'Mon mot de passe');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS', 'Notifications produit');
define('LOGIN_BOX_MY_ACCOUNT', 'Information g&eacute;n&eacute;rale');
define('LOGIN_BOX_LOGOFF', 'Se d&eacute;connecter');
define('LOGIN_BOX_PRODUCTS_NEW', 'Nouveaux produits');
define('LOGIN_BOX_SPECIALS', 'Offers promotionelles');
define('LOGIN_BOX_WISHLIST', 'List de souhaits');
define('LOGIN_BOX_NEWSLETTERS', 'Bulletins d\'information');
// EOF: MOD - Login Box My Account

// BOF: QPBPP for SPPC
define('MINIMUM_ORDER_NOTICE', 'Montant minimum de commande pour %s is %d. Le contenu de votre panier d\'achat a &eacute;t&eacute; ajust&eacute; en cons&eacute;quence.');
define('QUANTITY_BLOCKS_NOTICE', '%s ne peuvent &ecirc;tre command&eacute;s par multiple de %d. Le contenu de votre panier d\'achat a &eacute;t&eacute; ajust&eacute; en cons&eacute;quence.');
// EOF: QPBPP for SPPC

// BOF: Customer Comments contrib
define('SUCCESS_ORDER_UPDATED', 'Succ&egrave;s: Votre commande a &eacute;t&eacute; correctement mis &agrave; jour.');
define('WARNING_ORDER_NOT_UPDATED', 'Attention: Rien &agrave; changer. La commande n\'a pas &eacute;t&eacute; mis &agrave; jour.');
// EOF: Customer Comments contrib

// BOF: Open Featured Sets
define('OPEN_FEATURED_BOX_HEADING', 'Produits recommand&eacute;s');
define('OPEN_FEATURED_BOX_CATEGORY_HEADING', 'Categories recommand&eacute;es');
define('OPEN_FEATURED_BOX_MANUFACTURERS_HEADING', '&Agrave; l\'affiche');
define('OPEN_FEATURED_BOX_MANUFACTURER_HEADING', '&Agrave; l\'affiche');
define('OPEN_FEATURED_TABLE_HEADING_PRICE', ''); //Prix:
define('TEXT_MORE_INFO', 'plus...');
// EOF: Open Featured Sets

// BOF: Extra Product Fields
define('TEXT_ANY_VALUE', 'Toute valeur');
define('TEXT_RESTRICT_TO', 'Restriction <b>%s</b> to: %s et cette sous valeur (if any).');
// EOF: Extra Product Fields

// LINE ADDED: MOD - EASY CALL FOR PRICE v1.4
define('TEXT_CALL_FOR_PRICE', 'Contactez-nous pour un prix!');

// BOF: MSRP
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Our&nbsp;Prix:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;PRECEDENT:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;Vous&nbsp;&eacute;conomisez:&nbsp;');
define('TEXT_PRODUCTS_PRICENOW', '&nbsp;MAINTENANT:&nbsp;');
define('TEXT_PRODUCTS_USUALPRICE', '&nbsp;Prix&nbsp;conseill&eacute;:&nbsp;');
// EOF: MSRP

define('TEXT_LATEST_PRODUCTS', 'Latest Products');
define('TEXT_SPECIALS', 'Promotions');
define('TEXT_READ_MORE', ' ... lire plus ... ');

define('TEXT_MISSING_IMAGE', 'D&eacute;sol&eacute;, l\'image du produit n\'est pas disponible actuellement');
define('TEXT_PAGE', 'Page: ');

// Review Ratings
define('TEXT_RATING', 'Evaluation: ');
define('TEXT_POOR', 'Faible');
define('TEXT_FAIR', 'Convenable');
define('TEXT_AVERAGE', 'Moyenne');
define('TEXT_GOOD', 'Bonne');
define('TEXT_EXCELLENT', 'Excellente');

// Password Text
define('PW_TOO_WEAK', 'Mot de passe trop simple/trop court');
define('PW_WEAK', 'Mot de passe faible');
define('PW_NORMAL', 'Mot de passe convenable');
define('PW_STRONG', 'Bon mot de passe');
define('PW_VERY_STRONG', 'Mot de passe excelent');

// Product listing
define('TEXT_PRODUCT_NAME_AZ', 'Nom de produit de A &agrave; Z');
define('TEXT_PRODUCT_NAME_ZA', 'Non de produits de Z &agrave; A');
define('TEXT_PRICE_LOW_HIGH', 'Prix (Bas - Elev&eacute;)');
define('TEXT_PRICE_HIGH_LOW', 'Prix (Elev&eacute; - Bas)');
define('TEXT_SHOW_ALL', 'Afficher tout');
define('TEXT_VIEW_AS_LIST', 'Afficher comme list');
define('TEXT_VIEW_AS_GRID', 'Affficher comme grille');
define('TEXT_RESULTS_PAGE', 'R&eacute;sultats/Page: ');
define('TEXT_SORT_ORDER', 'Ordre de tri: ');
define('TEXT_PRICE_BESTSELLER', 'Meilleures ventes');

// Recent History
define('TEXT_LAST_VISITED_PRODUCTS', 'Vos produits consult&eacute;s');

// Question links to contact form - %20 = space - needed to maintain W3C compliance in URLs
define('TEXT_QUESTION_ABOUT', 'Question%20sur:%20');
define('TEXT_QUESTION_MODEL', 'Model:');
define('TEXT_QUESTION_PRODUCT_ID', 'ID%20produit:');
define('TEXT_QUESTION_TYPE', 'Tapez%20votre%20question%ci-dessous:');
define('TEXT_QUESTION_PRICE_ENQUIRY', 'Demande%20de%20prix');
define('TEXT_QUESTION_PRODUCT_NAME', 'Nom%20du%20produits:');

define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG', 'NOTE: Les t&eacute;l&eacute;chargements ne sont pas disponibles tant que le paiement a &eacute;t&eacute; confirm&eacute;.');

define('TEXT_REPLACEMENT_SUGGESTION', 'Vouliez-vous dire: ');

// BOF qpbpp
define('TEXT_PRICE_BREAKS', 'De ');
define('TEXT_ON_SALE', '');
// EOF qpbpp

// BOF Show tax and Shipping near price
define('TAX_RATE_NEAR_PRICE_INC', 'TVA inc. de ');
define('TAX_RATE_NEAR_PRICE_EX', 'HTVA de ');
define('TEXT_SHIPPING_NEAR_PRICE', 'Exp&eacute;dition');
// EOF Show tax and Shipping near price

// text for last update
define('TEXT_LAST_UPDATE', 'Derni&egrave;re mise &agrave; jour:');

define('IMAGE_BUTTON_MAT','S\'il vous plaît accepter les conditions');
?>
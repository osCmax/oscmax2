<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  One Page Checkout, Version: 1.08

  I.T. Web Experts
  http://www.itwebexperts.com

  Copyright (c) 2009 I.T. Web Experts
*/

define('NAVBAR_TITLE', 'Finaliser votre achat');
define('NAVBAR_TITLE_1', 'Finaliser votre achat');

define('HEADING_TITLE', 'Finaliser votre achat');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Addresse de livraison');
define('TABLE_HEADING_BILLING_ADDRESS', 'Addresse de facturation');

define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS_NAME', 'Nom de produits');
define('TABLE_HEADING_PRODUCTS_QTY', 'Quantité');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Prix par piece');
define('TABLE_HEADING_PRODUCTS_FINAL_PRICE', 'Prix total');
define('TABLE_HEADING_PRODUCTS_REMOVE_ITEM', 'Supprimer article');

define('TABLE_HEADING_PRODUCTS', 'Panier');
define('TABLE_HEADING_TAX', 'TVA');
define('TABLE_HEADING_TOTAL', 'Total');

define('ENTRY_TELEPHONE', 'Téléphone: ');

define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'S\'il vous plaît choisissez dans votre carnet l\'adresse de livraison.');
define('TEXT_SELECTED_BILLING_DESTINATION', 'S\'il vous plaît choisissez dans votre carnet l\'adresse de facturation.');

define('TITLE_SHIPPING_ADDRESS', 'Adresse de livraison:');
define('TITLE_BILLING_ADDRESS', 'Adresse de facturation:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Mode de livraison');
define('TABLE_HEADING_PAYMENT_METHOD', 'Moyent de payement');

define('TEXT_CHOOSE_SHIPPING_METHOD', 'S\'il vous plaît sélectionner le mode de livraison préférer pour votre commande.');
define('TEXT_SELECT_PAYMENT_METHOD', 'S\'il vous plaît sélectionner le moyen de payement préférer pour votre commande.');

define('TITLE_PLEASE_SELECT', 'Sélectioner s\'il vous plaît');

define('TEXT_ENTER_SHIPPING_INFORMATION', 'C\'est actuellement le seul mode de livraison disponibles pour votre commande.');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'C\'est actuellement le seul moyen de payement disponibles pour votre commande.');

define('TABLE_HEADING_COMMENTS', 'Ajouter des commentaires sur votre commande');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continuer la procédure de votre commande');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'pour confirmer votre commande.');

define('TEXT_EDIT', 'Editer');

define('TEXT_SELECTED_SHIPPING_DESTINATION', 'Ceci est l\'adresse de livraison sélectionné où les produits de votre commande seront livrées.');
define('TABLE_HEADING_NEW_ADDRESS', 'Nouvelle addresse');
define('TABLE_HEADING_EDIT_ADDRESS', 'Editer l\'address');
define('TEXT_CREATE_NEW_SHIPPING_ADDRESS', 'S\'il vous plaît utiliser le formulaire suivant pour créer une nouvelle adresse de livraison à utiliser pour cette commande.');
define('TABLE_HEADING_ADDRESS_BOOK_ENTRIES', 'Les adresse de votre carnet');

define('EMAIL_SUBJECT', 'Bien venu à ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Monsieur, %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Madame, %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Bonjour %s' . "\n\n");
define('EMAIL_WELCOME', 'Bien venu au <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Nous vous offrons <b>différents services</b>. Certains de ces services incluent:' . "\n\n" . '<li><b>un panier permanent:</b> - Tout les produits ajoutés à votre panier en ligne  y restent jusqu\'à ce que vous les supprimiez, ou passer commande.' . "\n" . '<li><b>Carnet d\'adresses</b> - Nous pouvons maintenant livrer vos commande à une autre adresse que la vôtre! C\'est parfait pour envoyer des cadeaux d\'anniversaire par exemple, directement à vos proche.' . "\n" . '<li><b>Historique de commande</b> - Consulter l\'historique de vos achats que vous avez éfectué chez nous.' . "\n" . '<li><b>Commentaire produit</b> - Partagez vos opinions sur les produits avec d\'autres clients.' . "\n\n");
define('EMAIL_CONTACT', 'Vous avez besoin d\'aider avec un de nos services en ligne, contacter nous par courriel, nous nous ferons un plaisir de vous répondre: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> Cette adresse mail nous a été donné par l\'un de nos clients. Si vous ne vous avez pas inscrire comme membre, envoyez nous un courriel à ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// Start - CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Comme cadeau de bienvenu pour nos nouveaux client nous vous offrons un chèque cadeaux de %s');
define('EMAIL_GV_REDEEM', 'Le code du chèque cadeau est %s, vous pouvez encaisser votre chèque cadeau à la finalisation de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Félicitations, pour votre première visite à notre boutique en ligne, pour une expérience plus enrichissante nous vous faisons parvenir ce bon de réduction.' . "\n" .
										' Voici les détails dû coupon de réduction uniquement créé pour vous' . "\n");
define('EMAIL_COUPON_REDEEM', 'Pour utiliser votre coupon entré votre code cde réduction %s pendant la finalistion de votre achat');
// End - CREDIT CLASS Gift Voucher Contribution

define('TEXT_AGREE_TO_TERMS', 'J\'accepte les termes et conditions');

define('WINDOW_BUTTON_CANCEL', 'Annuler');
define('WINDOW_BUTTON_CONTINUE', 'Continuer');
define('WINDOW_BUTTON_NEW_ADDRESS', 'Nouvelle address');
define('WINDOW_BUTTON_EDIT_ADDRESS', 'Editer l\'address');

define('TEXT_PLEASE_SELECT', 'Selectioner s\'il vous plait ');
define('TEXT_PASSWORD_FORGOTTEN', 'Mot de pass pérdu? Clicez ici.');
define('IMAGE_UPDATE_CART', 'Mise à jour du panier');
define('IMAGE_LOGIN', 'Connectez-vous');
define('TEXT_PAYMENT_METHOD_UPDATE_ERROR', 'S\'il vous plaît essayer à nouveau et si des problèmes persistent, essayer une autre mode de paiement.');
define('TEXT_HAVE_COUPON_CCGV', 'Aimeriez-vous échanger un bon de réduction?');
define('TEXT_HAVE_COUPON_KGT', 'Aimeriez-vous échanger un bon de réduction?');
define('TEXT_EXISTING_CUSTOMER_LOGIN', 'Vous avez déjà un compte?');
define('TEXT_DIFFERENT_SHIPPING', 'Adresse de facturation différente?');
define('TEXT_SHIPPING_NO_ADDRESS', 'S\'il vous plaît remplissez <b>au moins</b> votre adresse de facturation pour obtenir un devis du prix du transport.');
define('TEXT_CHECKOUT_UPDATE_VIEW_ORDER', 'de mettre à jour / visualiser votre commande.');
define('CHECKOUT_BAR_CONFIRMATION', 'Finaliser votre commande');
// Points/Rewards Module V2.1rc2a BOF
define('TABLE_HEADING_REDEEM_SYSTEM', 'Ecaisser vos point de fidélité ');
define('TABLE_HEADING_REFERRAL', 'Transférer des points de fidélité');
define('TEXT_REDEEM_SYSTEM_START', 'Vous avez un solde créditeur de %s ,souhaitez-vous l\'utiliser pour payer cette commande?<br />Le total estimé de votre achat est: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Cochez ici pour utiliser le maximum points autorisé pour cette commande. (%s points %s)&nbsp;&nbsp;->');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">La total de votre achat est supérieur au maximum de points autorisé, vous devrez également choisir une mode de paiement</span>');
define('TEXT_REFERRAL_REFERRED', 'Si un de vos ami nous à recommander, s\'il vous plaît entrer son adresse e-mail ici. ');
// Points/Rewards Module V2.1rc2a EOF
define('TERMS_PART_1', 'S\'il vous plaît confirmer que vous avez lu nos ');
define('TERMS_PART_2', '<b><u>Termes et Conditions</u></b>');

define('TEXT_NO_JAVASCRIPT', 'Nous avons détecté que vous avez désactivé JavaScript.');
define('TEXT_ENABLE_JAVSCRIPT_INSTRUCTIONS', '<p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold">S\'il vous plaît suivez les instructions pour votre navigateur Web afin de compléter votre commande:<br /><br />Internet Explorer</p>
<ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>Dans les&nbsp;<strong>Outiles</strong>&nbsp;cliquez&nbsp;<strong>Options Internet</strong>,  puis cliquez sur l\'onglet&nbsp;<strong>Securité</strong>.</li>
  <li>Cliquez sur&nbsp;<strong>Internet</strong>.</li>
  <li>Si vous n\'avez pas à personnaliser vos paramètres de sécurité d\'Internet Exporer, cliquez simplement sur&nbsp;<strong>Rétablir toutes les zones au niveau par défaut</strong>. Ensuite, passer l\'étape 4<blockquote>Si vous avez de personnaliser vos paramètres de sécurité, procédez comme suit:<br />
	a. Cliquez&nbsp;<strong>Personaliser le niveau</strong>.<br />
	b. Dans la boite de dialogue &nbsp;<strong>Parametre de sécurité &ndash; Internet Zone</strong>&nbsp;cliquez&nbsp;<strong>Activez</strong>&nbsp;pour&nbsp;<strong>Skripting</strong>&nbsp;dans la section&nbsp;<strong>Scripting</strong>.</blockquote></li>
  <li><span id="result_box" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Cliquez sur le bouton</span></span>&nbsp;<strong>Retour</strong>&nbsp;<span id="result_box2" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">pour revenir à</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">la page précédente</span><span title="Zur Anzeige alternativer Übersetzungen klicken">, puis cliquez sur</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">le bouton</span></span>&nbsp;<span id="result_box3" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken"><strong>Actualise</strong>r</span></span>&nbsp;<span id="result_box4" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">pour</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">exécuter les scripts</span></span>.</li>
 </ol>
<p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Firefox</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li><span id="result_box5" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Dans le menu <strong>Outils</strong>, cliquez sur <strong>Options</strong>.</span></span>.</li>
  <li><span id="result_box6" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Dans l\'onglet</span> <span title="Zur Anzeige alternativer Übersetzungen klicken"><strong>Contenu</strong>, cliquez sur</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">pour sélectionner la case</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">à cocher <strong>Activer</strong></span> <strong><span title="Zur Anzeige alternativer Übersetzungen klicken">Javascript</span></strong><span title="Zur Anzeige alternativer Übersetzungen klicken">.</span></span></li>
  <li><span id="result_box7" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Cliquez sur le</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">bouton Retour</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">de la </span> <span title="Zur Anzeige alternativer Übersetzungen klicken">page pour retourner à</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">la page précédente</span><span title="Zur Anzeige alternativer Übersetzungen klicken">, puis cliquez sur</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">le bouton</span> <strong><span title="Zur Anzeige alternativer Übersetzungen klicken">Recharger la page</span> <span title="Zur Anzeige alternativer Übersetzungen klicken">actuelle</span></strong> <span title="Zur Anzeige alternativer Übersetzungen klicken">pour exécuter des scripts.</span></span></li>
 </ol>
<p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Safari</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li><span id="result_box8" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Cliquez sur le menu</span> <span title="Zur Anzeige alternativer Übersetzungen klicken"><strong>Safari</strong>.</span></span></li>
  <li>Selectionez <strong>Preferences</strong>.</li>
  <li><span id="result_box9" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Cliquez sur l\'onglet <strong>Sécurité</strong>.</span></span></li>
  <li><span id="result_box10" lang="fr"><span title="Zur Anzeige alternativer Übersetzungen klicken">Cochez la case</span> <span title="Zur Anzeige alternativer Übersetzungen klicken"><strong>Activer JavaScript</strong>.</span></span></li>
 </ol>
 <p>&nbsp;</p>');

 define('TEXT_CHECKOUT_CREATE_ACCOUNT', 'Si vous voulez créer un compte s\'il vous plaît entrer un mot de passe ci-dessous: ');
?>
<?php

/*
  $Id:Batch_print.php, hpdl Exp $
*/

define('HEADING_TITLE', 'Batch Order Center');
define('TABLE_HEADING_COMMENTS', 'Commentaires');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modéle');
define('TABLE_HEADING_PRODUCTS', 'Produits');
define('TABLE_HEADING_TAX', 'Taxe en %');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prix (HT)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prix (TTC)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (HT)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (TTC)');
define('ENTRY_SOLD_TO', 'VENDU A :');
define('ENTRY_SHIP_TO', 'LIVRE A :');
define('ENTRY_PAYMENT_METHOD', 'Méthode de paiement :');
define('ENTRY_PAYMENT_TYPE', 'Credit Card:');
define('PAYMENT_TYPE', 'Credit Card');
define('ENTRY_CC_OWNER', 'Credit Card Owner:');
define('ENTRY_CC_NUMBER', 'Credit Card Number:');
define('ENTRY_CC_EXP', 'Expiration Date:');
define('ENTRY_SUB_TOTAL', 'Sous-Total :');
define('ENTRY_PHONE', 'Téléphone:');
define('ENTRY_EMAIL', 'E-Mail:');
define('ENTRY_TAX', 'Taxe :');
define('ENTRY_SHIPPING', 'Exp&eacute;dition :');
define('ENTRY_TOTAL', 'Total:');
define('TEXT_ORDER_NUMBER','Numéro de Commande:');
define('TEXT_ORDER_DATE','Date de La commande:');
define('TEXT_ORDER_FORMAT', 'd/m/Y H:i:s'); 
define('TEXT_CHOOSE_TEMPLATE','Choisissez le calibre de fichier (template ) que vous voulez imprimer');
define('TEXT_ORDER_NUMBERS_RANGES','Entrez le n° de commande que vous voulez extrait /ou la série au format PDF : <br> (par exemple : 2577,2580-2585,2588)');
define('TEXT_DATES_ORDERS_EXTRACTRED','Ou écrivez les dates des ordres que vous voulez extrait au format pdf :<br>(écrivez la date dans le format: YYYY-MM-DD)');
define('TEXT_FROM','Du: ');
define('TEXT_TO','A: ');
define('TEXT_PRINTING_LABELS_BILLING_DELIVERY','En Imprimant l\'étiquettes:- employez l\'adresse de facturation ou l\'adresse de livraison ?');
define('TEXT_DELIVERY','Livraison: ');
define('TEXT_BILLING','Facturation: ');
define('TEXT_POSITION_START_PRINTING', 'La position pour Commencer a imprimer de :<br>(0 est laposition de l\'&eacute;tiquette en haut &agrave; gauche, ils augmentent de gauche &agrave; droite et de haut en bas)');
define('TEXT_INCLUDE_ORDERS_STATUS', 'Seulement les ordres avec le statut :<br>(Si NONE, tous les ordres seront inclus)');
define('TEXT_SHOW_ORDER','Montrez la  date de l\'ordre ?');
define('TEXT_SHOW_PHONE_NUMBER','Montrez le numéro de téléphone du client ?');
define('TEXT_SHOW_EMAIL_CUSTOMER','Montrez l\'adresse e-mail du client ?');
define('TEXT_PAYMENT_INFORMATION','Montrez l\'information de paiement ?');
define('TEXT_SHOW_CREDIT_CARD_NUMBER','Montrez le numéro de carte de crédit ? (Pour la carte de crédit (de la commande) seulement)');
define('TEXT_AUTOMACILLLY_CHANGE_ORDER','Changez automatiquement les statuts d\'ordre en :<br>(si None, aucun statut ne sera changé.)');
define('TEXT_SHOW_OREDERS_COMMENTS','Montrez les ordres sans commentaires ?<br>(ne montrera pas l\'ordre avec des commentaires placés par le client à la période de l\'ordre.)');
define('TEXT_NOTIFY_CUSTOMER','Informez le client par l\'intermédiaire d\'un E-mail ?<br>(ceci informera le client par l\'intermédiaire d\'un E-mail avec les commentaires dans le dossier de langue d\'impression par lots.)');
define('TEXT_BANK','Banque: ');
define('TEXT_POST','Poste: ');
define('TEXT_SALES','Vente: ');
define('TEXT_PACKED_BY','Emballé Par:  ______________________');
define('TEXT_VERIFIED_BY','Vérifié Par:  ______________________');
define('TEXT_DEAR','Cher ');
define('TEXT_THX_CHRISMAS','Thanks for your continued support MODIFIER DANS admin\includes\languages');
define('TEXT_RETURNS_LABEL', 'Etiquette de retours de commande: ');
define('TEXT_SHIPPING_LABEL', 'Etiquette d\'expédition de commande: ');
define('SHIP_FROM_COUNTRY', '');  //eg. 'United Kingdom'
define('WEBSITE', 'www.Your site.com');
define('TEXT_RETURNS', 'Nous espérons que vous n\'en aurez pas besoin, mais nous vous avons fourni une étiquette de retours à tout hasard.Politique de retours sur www.Your site.com/shipping.php');
define('TEXT_TO', 'To:');

// Change this to a general comment that you would like
define('BATCH_COMMENTS','Avis de mise à jour d\'ordre automatique.');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Mise à jour de la commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'Num&eacute;ro de commande :');
define('EMAIL_TEXT_INVOICE_URL', 'Détail de votre commande');  //def en francais
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande :');
define('EMAIL_TEXT_STATUS_UPDATE', 'Le statut de votre commande a &eacute;t&eacute; mis &agrave; jour par le suivant.' . "\n\n" . 'Nouveau statut: %s' . "\n\n" . 'Merci de r&eacute;pondre &agrave; ce courrier &eacute;lectronique si vous avez des questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Les commentaires de votre commande sont' . "\n\n%s\n\n");

// RGB Colors
define('BLACK', '0,0,0');
define('GREY', '0.9,0.9,0.9');
define('DARK_GREY', '0.7,0.7,0.7');

// Error and Messages
$error['ERROR_INVALID_INPUT'] = 'Internal Error: Unrecognized or invalid script input.';
$error['ERROR_BAD_DATE'] =  'Invalid date, Please enter a valid date in Year-Month-Day (0000-00-00) format.';
$error['ERROR_BAD_INVOICENUMBERS'] =  'Invalid Invoice numbers, Please enter a valid format. (eg. 2577,2580-2585,2588)';
$error['NO_ORDERS'] =  'There were no orders selected for export, try changing your order options.';
$error['SET_PERMISSIONS'] = 'Can\'t write to directory!  Please set the permissions of your temp_pdf folder to CHMOD 0777';
$error['FAILED_TO_OPEN'] = 'Could not open file for writing, make sure correct permissions are set';

// PDF FONT SIZES
define('COMPANY_HEADER_FONT_SIZE','14');
define('SUB_HEADING_FONT_SIZE','11');
define('GENERAL_FONT_SIZE', '11');
define('GENERAL_LEADING', '12');
define('PRODUCT_TOTALS_LEADING', '11');
define('PRODUCT_TOTALS_FONT_SIZE', '10');
define('PRODUCT_ATTRIBUTES_FONT_SIZE', '8');
define('GENERAL_FONT_COLOR', BLACK);

// Margins and Page Size

// This works best with A4, could work with diffferent page sizes,
// However it would require playing with the table values and font values to fit properly
//define('PAGE','A4');
//define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
//define('TEXT_BLOCK_INDENT', '5');
//define('SHIP_TO_COLUMN_START','300');
// This changes the 'Total', 'Sub-Total', 'Tax', and 'Shipping Method' text block
// position, for example if you choose to make the text a bigger font size you need to 
// tweak this value in order to prevent the text from clashing together
//define('PRODUCT_TOTAL_TITLE_COLUMN_START','400');
//define('RIGHT_MARGIN','30');

// Batch Print Misc Vars
define('BATCH_PRINT_INC', DIR_WS_MODULES . 'batch_print/');
define('BATCH_PDF_DIR', BATCH_PRINT_INC . 'temp_pdf/');
//define('LINE_LENGTH', '552');
// If you have attributes for certain products, you can have the text wrap
// or just be written completely on one line, with the text wrap disabled
// it makes the tables smaller appear much better, of course that is only my opinion
// so I made this variable if anyone would like it to wrap.
//define('PRODUCT_ATTRIBUTES_TEXT_WRAP', false);
// This sets the space size between sections
//define('SECTION_DIVIDER', '15');
// Main File
define('BATCH_PRINT_FILE', 'batch_print.php');
// TEMP PDF FILE
define('BATCH_PDF_FILE', 'batch_orders.pdf');

// Product table Settings
//define('TABLE_HEADER_FONT_SIZE', '9');
//define('TABLE_HEADER_BKGD_COLOR', DARK_GREY);
//define('PRODUCT_TABLE_HEADER_WIDTH', '552');
// This is more like cell padding, it moves the text the number
// of points specified to make the rectangle appear padded
//define('PRODUCT_TABLE_BOTTOM_MARGIN', '2');
// Tiny indent right before the product name, again more like
// the cell padding effect
//define('PRODUCT_TABLE_LEFT_MARGIN', '2');
// Height of the product listing rectangles
//define('PRODUCT_TABLE_ROW_HEIGHT', '11');

// The column sizes are where the product listing columns start on the
// PDF page, if you make the TABLE HEADER FONT SIZE any larger you will
// need to tweak these values to prevent text from clashing together
//define('PRODUCTS_COLUMN_SIZE', '172');
//define('PRODUCT_LISTING_BKGD_COLOR',GREY);
//define('MODEL_COLUMN_SIZE', '37');
//define('PRICING_COLUMN_SIZES', '67');

?>
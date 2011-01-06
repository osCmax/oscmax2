<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Editar Pedido  #%s of %s');
define('ADDING_TITLE', 'Añadir un producto al pedido  #%s');

define('ENTRY_UPDATE_TO_CC', '(Update to ' . ORDER_EDITOR_CREDIT_CARD . ' to view CC fields.)');
define('TABLE_HEADING_COMMENTS', 'Comentarios');
define('TABLE_HEADING_STATUS', 'Nuevo estado');
define('TABLE_HEADING_NEW_STATUS', 'New status');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_DELETE', 'Delete?');
define('TABLE_HEADING_QUANTITY', 'Cant.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Producto');
define('TABLE_HEADING_TAX', '% IVA');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_BASE_PRICE', 'Price (base)');
define('TABLE_HEADING_UNIT_PRICE', 'Precio (excl.)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Precio (incl.)');
define('TABLE_HEADING_TOTAL_PRICE', 'Total (excl.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total (incl.)');
define('TABLE_HEADING_OT_TOTALS', 'Order Totals:');
define('TABLE_HEADING_OT_VALUES', 'Value:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Shipping Quotes:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'There are no shipping quotes to display!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Notificación al cliente');
define('TABLE_HEADING_DATE_ADDED', 'Fecha de pedido');

define('ENTRY_CUSTOMER', 'Nombre');
define('ENTRY_NAME', 'Nombre:');
define('ENTRY_CITY_STATE', 'Población, Estado:');
define('ENTRY_SHIPPING_ADDRESS', 'Dirección de envío');
define('ENTRY_BILLING_ADDRESS', 'Dirección de facturación');
define('ENTRY_PAYMENT_METHOD', 'Forma de pago:');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo de tarjeta:');
define('ENTRY_CREDIT_CARD_OWNER', 'Titular de la tarjeta:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Número de tarjeta:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Caducidad tarjeta:');
define('ENTRY_SUB_TOTAL', 'Sub Total:');
define('ENTRY_TYPE_BELOW', 'Type below');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'IVA:');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_STATUS', 'Estado del pedido:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notificar al cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Enviar comentarios:');
define('ENTRY_CURRENCY_TYPE', 'Currency');
define('ENTRY_CURRENCY_VALUE', 'Currency Value');

define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');
define('TEXT_NO_ORDER_PRODUCTS', 'This order contains no products');
define('TEXT_ADD_NEW_PRODUCT', 'Add products');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Package Weight: %s  |  Product Qty: %s');

define('TEXT_STEP_1', '<b>Step 1:</b>');
define('TEXT_STEP_2', '<b>Step 2:</b>');
define('TEXT_STEP_3', '<b>Step 3:</b>');
define('TEXT_STEP_4', '<b>Step 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Choose a Category from the list -');
define('TEXT_PRODUCT_SEARCH', '<b>- OR enter a search term in the box below to see potential matches -</b>');
define('TEXT_ALL_CATEGORIES', 'All Categories/All Products');
define('TEXT_SELECT_PRODUCT', '- Choose a Product -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Select These Options');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Select This Category');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Select This Product');
define('TEXT_SKIP_NO_OPTIONS', '<em>No Options - Skipped...</em>');
define('TEXT_QUANTITY', 'Quantity:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Add to Order');
define('TEXT_CLOSE_POPUP', '<u>Close</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Keep adding products until you are done.<br>Then close this tab/window, return to the main tab/window, and press the "update" button.');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Product not found<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Shipping same as billing address');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Billing same as customer address');

define('IMAGE_ADD_NEW_OT', 'Insert new custom order total after this one');
define('IMAGE_REMOVE_NEW_OT', 'Remove this order total component');
define('IMAGE_NEW_ORDER_EMAIL', 'Send new order confirmation email');

define('TEXT_NO_ORDER_HISTORY', 'Pedido no existe');

define('PLEASE_SELECT', 'Please Select');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Su pedido ha sido actualizado');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice URL:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha de pedido:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Muchas gracias por su pedido!' . "\n\n" . 'El estado de su pedido ha sido actualizado.' . "\n\n" . 'Nuevo estado: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Si tiene cualquier pregunta, por favor, esponda a este correo.' . "\n\n" . 'Reciba un saludo de sus amigos de ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Estos son los comentarios sobre su pedido:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: No existe el pedido.');
define('ERROR_NO_ORDER_SELECTED', 'You have not selected an order to edit, or the order ID variable has not been set.');
define('SUCCESS_ORDER_UPDATED', 'Completado: El pedido ha sido actualizado correctamente.');
define('SUCCESS_EMAIL_SENT', 'Completed: The order was updated and an email with the new information was sent.');

//the hints
define('HINT_UPDATE_TO_CC', 'Set payment method to ' . ORDER_EDITOR_CREDIT_CARD . ' and the other fields will be displayed automatically.  CC fields are hidden if any other payment method is selected.  The name of the payment method that, when selected, will display the CC fields is configurable in the Order Editor area of the Configuration section of the Administration panel.');
define('HINT_UPDATE_CURRENCY', 'Changing the currency will cause the shipping quotes and order totals to recalculate and reload.');
define('HINT_SHIPPING_ADDRESS', 'If you change the shipping state, postcode, or country you will be given the option of whether or not to recalculate the totals and reload the shipping quotes.');
define('HINT_TOTALS', 'Feel free to give discounts by adding negative values. Subtotal, tax total, and grand total fields are not editable. When adding in custom order total components via AJAX make sure you enter the title first or the code will not recognize the entry (ie, a component with a blank title is deleted from the order).');
define('HINT_PRESS_UPDATE', 'Please click on "Update" to save all changes.');
define('HINT_BASE_PRICE', 'Price (base) is the products price before products attributes (ie, the catalog price of the item)');
define('HINT_PRICE_EXCL', 'Price (excl) is the base price plus any product attributes prices that may exist');
define('HINT_PRICE_INCL', 'Price (incl) is Price (excl) times tax');
define('HINT_TOTAL_EXCL', 'Total (excl) is Price (excl) times qty');
define('HINT_TOTAL_INCL', 'Total (incl) is Price (excl) times tax and qty');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'New order confirmation:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Date Modified:');
define('EMAIL_TEXT_PRODUCTS', 'Products');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #');
define('ENTRY_DOWNLOAD_FILENAME', 'Filename');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Expiry days');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Downloads remaining');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Are you sure you want to delete this product from the order?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Are you sure you want to delete this comment from the orders status history?');
define('AJAX_MESSAGE_STACK_SUCCESS', 'Success! \' + %s + \' has been updated');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'You have changed some shipping information. Would you like to recalculate the order totals and shipping quotes?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Cannot create XMLHTTP instance');
define('AJAX_SUBMIT_COMMENT', 'Submit new comments and/or status');
define('AJAX_NO_QUOTES', 'There are no shipping quotes to display.');
define('AJAX_SELECTED_NO_SHIPPING', 'You have selected a shipping method for this order but it appears there is not one already stored in the database.  Would you like to add this shipping charge to the order?');
define('AJAX_RELOAD_TOTALS', 'The new shipping component has been written to the database but the totals have not yet been re-calculated.  Click ok now to re-calculate the order totals.  If your connection is slow wait for all components to load before clicking ok.');
define('AJAX_NEW_ORDER_EMAIL', 'Are you sure you want to send a new order confirmation email for this order?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Please input any comments you may have here.  It is ok to leave this blank if you do not wish to include comments.  Please remember as you type that hitting the "enter" key will result in submitting the comments as they appear.  It is not yet possible to include line breaks.');
define('AJAX_SUCCESS_EMAIL_SENT', 'Success!  A new order confirmation email was sent to %s');
define('AJAX_WORKING', 'Working, please wait....');
?>

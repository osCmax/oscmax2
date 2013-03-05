<?php
/**
 * @version sofortueberweisung.de 2.1.3 - $Date: 2010-04-09 17:33:42 +0200 (Fr, 09 Apr 2010) $
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 - 2007 Henri Schmidhuber (http://www.in-solution.de)
  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
  
  $Id: pn_sofortueberweisung.php 120 2010-04-09 15:33:42Z thoma $
  
*/

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_TITLE', 'www.payment-network.com');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_PUBLIC_TITLE', 'www.payment-network.com');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Zones autorisé');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Entrez les différentes zones <b>une par une</b>, qui doivent être autorisées pour ce module.');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_TITLE', 'Activez payment-network.com');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_DESC', 'Vouslez-vous accepter des payement par payment-network.com?');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_TITLE', 'Numméroclient');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_DESC', 'Votre numméro chez payement-network.com');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_TITLE', 'Numméro de projet');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_DESC', 'Le numméro de projet responsable chez payment-network.com, à la quell le payement corespond');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_TITLE', 'Mot de pass de project:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_DESC', 'Le mot de pass du projet (sous règlage étendue en  Input-controle")');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_NOTIF_PASSWORD_TITLE', 'Berichten-paswoord:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_NOTIF_PASSWORD_DESC', 'Het Berichten-paswoord (via "Mijn project/Uitvoerige instellingen/Project-paswoord en  Input-controle")');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_TITLE', 'Hashing algorithm:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_DESC', 'The hashing algorithm (via "Mijn project/Uitvoerige instellingen/Project-paswoord en  Input-controle")');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_TITLE', 'Mededelingsvolgorde');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Kleinste cijfer wordt als eerste getoond');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_TITLE', 'Hashing algorithm: MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM<br /><br />Betaalzone');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_DESC', 'Als een zone uitgekozen is, geldt de betaalmethode alleen voor deze zone');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_TITLE', 'Bevestigde bestelstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_DESC', 'Orderstatus na ingang van een bestelling, waarbij door DIRECTebanking.nl een succesvolle betaalbevestiging doorgegeven werd');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_TITLE', 'Tijdelijke bestelstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_DESC', 'Bestelstatus voor nog niet afgesloten transacties');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_TITLE', 'Onbevestigde bestelstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_DESC', 'Orderstatus na het binnenkomen van een bestelling, waarvan geen of een foutieve betaalbevestiging doorgegeven werd');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_TITLE', 'Mededeling regel 1');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_DESC', 'Mededeling regel 1');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_TITLE', 'Mededeling regel 2');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_DESC', 'In de mededeling 2 (maximaal 27 tekens) werden de volgende plaatshouders vervangen:<br /> {{order_id}}<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_TITLE', 'Betaalkeuze grafiek / tekst');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_DESC', 'Weergegeven grafiek / tekst bij de keuze van de betaalmogelijkheden');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'Le payement avec www.payement-network.com est gratuit, les services de paiement sont certifiées TÜV de Payment Network AG. Avantages: Pas d\'registrement supplémentaire, débit direct de votre compte bancaire en ligne, avec plus haute norme de sécurité et de l\'envoyer direct des marchandises du magasin en ligne. Vous avez que besoin de vos données d\'accès pour votre e-banking càd votre numéro de compte et notre mot de passe. Vous trouverez plus d\information ici: <a href="https://www.payment-network.com/deb_com_fr/demo/home" target="_blank">sofort banking');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'Le payement avec www.payement-network.com est gratuit, les services de paiement sont certifiées TÜV de Payment Network AG. Avantages: Pas d\'registrement supplémentaire, débit direct de votre compte bancaire en ligne, avec plus haute norme de sécurité et de l\'envoyer direct des marchandises du magasin en ligne. Vous avez que besoin de vos données d\'accès pour votre e-banking càd votre numéro de compte et notre mot de passe. Vous trouverez plus d\information ici: <a href="https://www.payment-network.com/deb_com_fr/demo/home" target="_blank">sofort banking');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_ERROR_HEADING', 'De volgende fout werd door DIRECTebanking.nl gedurende het proces gemeld:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_ERROR_MESSAGE', 'Betaling via DIRECTebanking.nl is helaas niet mogelijk of werd op klantenwens afgebroken. Kies alstublieft een andere betaalwijze.');
  
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION', (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS != 'True' ? 
	'<form action="'.tep_href_link(FILENAME_MODULES, '', 'SSL').'" method="get"><input type="hidden" name="set" value="payment">
	<input type="hidden" name="module" value="pn_sofortueberweisung"><input type="hidden" name="action" value="install">
	<input type="hidden" name="autoinstall" value="1"><input type="submit" value="Autoinstaller (aanbevolen)" /></form><br />' : '').'<br />
	<b>sofort&uuml;berweisung.de</b><br>DIRECTebanking.nl</b><br>Zodra de klant DIRECTebanking.nl heeft uitgekozen en op bestellen klikt, wordt een tijdelijke bestelling gecreÃ«erd. Als de betaling succesvol is, wordt de bestelling in de database geregistreerd. Als de bestelling afgebroken wordt, wordt de bestelling terug gedraaid en het bestelnummer afgewezen, zodat bij de volgende bestelling het bestelnummer met 1 verhoogd wordt. Daarom dienen de bestelnummers niet als rekeningnummers gebruikt te worden, aangezien deze niet doorlopend genummerd zijn.');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><a href="https://www.payment-network.com/deb_com_fr/demo/home" target="_blank">{{image}}</a></td>
      </tr>
      <tr>
      	<td class="main"><br />%s</td>
      	</tr>	
    </table>');

  define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_CONFIRMATION', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main"><p>Le payement avec www.payement-network.com est gratuit, les services de paiement sont certifiées TÜV de Payment Network AG. Avantages: Pas d\'registrement supplémentaire, débit direct de votre compte bancaire en ligne, avec plus haute norme de sécurité et de l\'envoyer direct des marchandises du magasin en ligne. Vous avez que besoin de vos données d\'accès pour votre e-banking càd votre numéro de compte et notre mot de passe. Vous trouverez plus d\information ici: <a href="https://www.payment-network.com/deb_com_fr/demo/home" target="_blank">sofort banking</p></td>
      </tr>
    </table>');
  
//see also /includes/languages/dutch/checkout_process.php
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_EMAIL_HTML_TEXT', '  <table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:small" width="100%"><tr><td>
    <p></p>
    <table style="border-top:1px solid; border-bottom:1px solid; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:small" width="100%" border="0">
      <tr bgcolor="#F1F1F1">
        <td width="50%">
            <strong>{{EMAIL_TEXT_DELIVERY_ADDRESS}}:</strong>
        </td>
        <td>
            <strong>{{EMAIL_TEXT_BILLING_ADDRESS}}:</strong>
        </td>
      </tr>
      <tr>
        <td>
          {{DELIVERY_ADRESS}}
        </td>
        <td>
          {{BILLING_ADRESS}}
        </td>
      </tr>
    </table>
	<p>
		{{EMAIL_TEXT_ORDER_NUMBER}} <strong>{{ORDER_ID}}</strong>
	</p>
	<p>
	{{EMAIL_TEXT_DATE_ORDERED}} <strong>{{DATE_ORDERED}}</strong>
	</p>
	<p>
	Comment: <strong>{{CUSTOMER_COMMENT}}</strong>
	</p>
	<p>
		{{EMAIL_TEXT_INVOICE_URL}} 
	  <strong><a href="{{INVOICE_URL}}">{{INVOICE_URL}}</a></strong>
	</p>
    <table style="border-bottom:1px solid; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:small" width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr bgcolor="#F1F1F1">
			<td class="c3" align="left">
			  <div style="text-align: left">
				<strong>{{EMAIL_TEXT_PRODUCTS}}:</strong>
			  </div>
			</td>
		</tr>
		<tr>
			<td>
			  {{Item_List}}
			</td>
		</tr>
    </table>
    <div style="text-align: right">
      {{List_Total}}
    </div><br /><br />
    <p>{{EMAIL_TEXT_PAYMENT_METHOD}}: {{Payment_Modul_Text}}</p>
    {{Payment_Modul_Text_Footer}}
</td></tr></table>');

//see also /includes/languages/german/checkout_process.php
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_EMAIL_TEXT', '{{STORE_NAME}}
{{EMAIL_SEPARATOR}}
{{EMAIL_TEXT_ORDER_NUMBER}} {{ORDER_ID}}
{{EMAIL_TEXT_INVOICE_URL}} {{INVOICE_URL}}
{{EMAIL_TEXT_DATE_ORDERED}} {{DATE_ORDERED}}

{{EMAIL_TEXT_PRODUCTS}}:
{{EMAIL_SEPARATOR}}
{{Item_List}}
{{EMAIL_SEPARATOR}}
{{List_Total}}

{{EMAIL_TEXT_BILLING_ADDRESS}}:
{{EMAIL_SEPARATOR}}
{{BILLING_ADRESS}}

{{EMAIL_TEXT_DELIVERY_ADDRESS}}:
{{EMAIL_SEPARATOR}}
{{DELIVERY_ADRESS}}

{{EMAIL_TEXT_PAYMENT_METHOD}}
{{EMAIL_SEPARATOR}}
{{Payment_Modul_Text}}

{{Payment_Modul_Text_Footer}}'); 
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_EMAIL_FOOTER', ' ');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_EMAIL_SUBJECT', '{{EMAIL_TEXT_SUBJECT}}: {{ORDER_ID}}');  

?>
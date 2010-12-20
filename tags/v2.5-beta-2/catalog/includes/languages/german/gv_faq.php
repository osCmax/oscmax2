<?php
/*
$Id: gv_faq.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Gutscheine - Fragen und Antworten');
define('HEADING_TITLE', 'Gutscheine - Fragen und Antworten');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Gutscheine kaufen</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Wie man Gutscheine versendet</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Mit Gutscheinen Einkaufen</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Gutscheine verbuchen</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Falls es zu Problemen kommen sollte :</a><br>
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','Gutscheine kaufen');
define('SUB_HEADING_TEXT','Gutscheine k÷nnen, falls sie im Shop angeboten werden, wie normale Artikel gekauft werden.
  Sobald Sie einen Gutschein gekauft haben und dieser nach erfolgreicher Zahlung freigeschaltet wurde, erscheint der Betrag unter Ihrem Warenkorb. Nun k÷nnen Sie nber den Link " Gutschein versenden " den gewnnschten Betrag per E-Mail versenden.');
  break;
  case '2':
define('SUB_HEADING_TITLE','Wie man Gutscheine versendet');
define('SUB_HEADING_TEXT','Um einen Gutschein zu versenden, klicken Sie bitte auf den Link" Gutschein versenden " in Ihrem Einkaufskorb.
  Um einen Gutschein zu versenden, ben÷tigen wir folgende Angaben von Ihnen:
  Vor- und Nachname des EmpfSngers.
  Eine gnltige E-Mail Adresse des EmpfSngers.
  Den gewnnschten Betrag ( Dieser Betrag kann auch unter Ihrem Guthaben liegen ).)
  Eine kurze Nachricht an den EmpfSnger.
  Bitte nberprnfen Sie Ihre Angaben noch einmal vor dem versenden, Sie haben vor dem Versenden jederzeit die M÷glichkeit Ihre Angaben zu korrigieren.');
  break;
  case '3':
  define('SUB_HEADING_TITLE','Mit Gutscheinen Einkaufen.');
  define('SUB_HEADING_TEXT','Sobald Sie nber ein Guthaben verfngen, k÷nnen Sie dieses zum Bezahlen Ihrer Bestellung verwenden. WShrend des Bestellvorganges haben Sie die M÷glichkeit Ihr Guthaben einzul÷sen.
  Falls das Guthaben unter dem Warenwert liegt mnssen Sie Ihre bevorzugte Zahlungsweise fnr den Differenzbetrag wShlen.
  _bersteigt Ihr Guthaben den Warenwert, steht Ihnen das Restguthaben selbstverstSndlich fnr Ihre nSchste Bestellung zur Verfngung.');
  break;
  case '4':
  define('SUB_HEADING_TITLE','Gutscheine verbuchen.');
  define('SUB_HEADING_TEXT','Wenn Sie einen Gutschein per E-Mail erhalten haben, k÷nnen Sie den Betrag wie folgt verbuchen:.<br>
  1. Klicken Sie auf den in der E-Mail angegebenen Link. Falls Sie noch nicht nber ein pers÷nliches Kundenkonto verfngen, haben Sie die M÷glichkeit ein Konto zu er÷ffnen.<br>
  2. WShrend des Bestellvorganges k÷nnen Sie den Code auf der Seite " Zahlungsweise " manuell eingeben. Bitte verbuchen Sie zuerst Ihren Gutschein und wShlen dann die gewnnschte Zahlungsweise.');
  break;
  case '5':
  define('SUB_HEADING_TITLE','Falls es zu Problemen kommen sollte:');
  define('SUB_HEADING_TEXT','Falls es wider Erwarten zu Problemen mit einem Gutschein kommen sollte, kontaktieren Sie uns bitte
  per E-Mail : '. STORE_OWNER_EMAIL_ADDRESS . '. Bitte beschreiben Sie m÷glichst genau das Problem, wichtige Angaben sind unter anderem : Ihre Kundennummer, der Gutscheincode, Fehlermeldungen des Systems sowie der von Ihnen benutzte Browser. ');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','Bitte wShlen Sie aus den obigen Fragen.');

  }
?>

<?php
/*
$Id: admin_members.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['gID']) {
  define('HEADING_TITLE', 'Admin Gruppen');
} elseif ($HTTP_GET_VARS['gPath']) {
  define('HEADING_TITLE', 'Definieren Sie Gruppen');
} else {
  define('HEADING_TITLE', 'Admin Mitglieder');
}

define('TEXT_COUNT_GROUPS', 'Gruppen: ');

define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_EMAIL', 'Email Address');
define('TABLE_HEADING_PASSWORD', 'Kennwort');
define('TABLE_HEADING_CONFIRM', 'Bestätigen Sie Kennwort');
define('TABLE_HEADING_GROUPS', 'Gruppen Ebnen');
define('TABLE_HEADING_CREATED', 'Konto Verursacht');
define('TABLE_HEADING_MODIFIED', 'Konto Verursacht');
define('TABLE_HEADING_LOGDATE', 'Letztes Erreicht');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Maschinenbordbuch-Zahl');
define('TABLE_HEADING_ACTION', 'Tätigkeit');

define('TABLE_HEADING_GROUPS_NAME', 'Gruppen Name');
define('TABLE_HEADING_GROUPS_DEFINE', 'Kästen und Akten Vorwähler');
define('TABLE_HEADING_GROUPS_GROUP', 'Niveau');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Kategorien Erlaubnis');


define('TEXT_INFO_HEADING_DEFAULT', 'Admin Mitglied ');
define('TEXT_INFO_HEADING_DELETE', 'Löschung-Erlaubnis ');
define('TEXT_INFO_HEADING_EDIT', 'Redigieren Sie Kategorie / ');
define('TEXT_INFO_HEADING_NEW', 'Neues Admin Mitglied ');

define('TEXT_INFO_DEFAULT_INTRO', 'Mitgliedsgruppe');
define('TEXT_INFO_DELETE_INTRO', 'Entfernen Sie <nobr><b>%s</b></nobr> von den <nobr>Admin Mitgliedern?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Sie können nicht <nobr>%s Gruppe löschen!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Stellen Sie Erlaubnis waagerecht ausgerichtet hier ein: ');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Vorname: ');
define('TEXT_INFO_LASTNAME', 'Letzter Name: ');
define('TEXT_INFO_EMAIL', 'Email Address: ');
define('TEXT_INFO_PASSWORD', 'Kennwort: ');
define('TEXT_INFO_CONFIRM', 'Bestätigen Sie Kennwort: ');
define('TEXT_INFO_CREATED', 'Konto Verursacht: ');
define('TEXT_INFO_MODIFIED', 'Konto Änderte: ');
define('TEXT_INFO_LOGDATE', 'Letzter Zugang: ');
define('TEXT_INFO_LOGNUM', 'Maschinenbordbuch-Zahl: ');
define('TEXT_INFO_GROUP', 'Gruppe Niveau: ');
define('TEXT_INFO_ERROR', '<font color="red">Email address ist bereits verwendet worden! Bitte Versuch wieder.</font>');

define('JS_ALERT_FIRSTNAME', '- Erfordert: Vorname \n');
define('JS_ALERT_LASTNAME', '- Erfordert: Letzter Name \n');
define('JS_ALERT_EMAIL', '- Erfordert: Email address \n');
define('JS_ALERT_EMAIL_FORMAT', '- Email address format ist unzulässig! \n');
define('JS_ALERT_EMAIL_USED', '- Email address ist bereits verwendet worden! \n');
define('JS_ALERT_LEVEL', '- Erfordert: Gruppe Mitglied \n');

define('ADMIN_EMAIL_SUBJECT', 'Neues Admin Mitglied');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Sie können die Leitung Verkleidung mit dem folgenden Kennwort zugänglich machen. Sobald Sie die Verkleidung zugänglich machen, ändern Sie bitte Ihr Kennwort!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatisierte Antwort, bitte antworten Sie nicht!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Admin Mitgliedsprofil Redigieren');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre persönlichen Informationen sind von einem Verwalter aktualisiert worden.' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatisierte Antwort, bitte antworten Sie nicht!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Admin Gruppe ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Löschung-Gruppe ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>ANMERKUNG:</b><li><b>redigieren Sie:</b> redigieren Sie Gruppe Namen.</li><li><b>löschung:</b> löschunggruppe..</li><li><b>definieren Sie:</b> definieren Sie Gruppe Zugang.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Dieses löscht auch Mitglieder dieser Gruppe. Sind Sie sicher möchten löschen <nobr><b>%s</b> Gruppe?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Sie können nicht diese Gruppe löschen!');
define('TEXT_INFO_GROUPS_INTRO', 'Verwenden Sie einen einzigartigen Gruppe Namen. Klicken nahe bei reicht ein.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Verwenden Sie einen einzigartigen Gruppe Namen. Klicken nahe bei reicht ein.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Admin Gruppe');
define('TEXT_INFO_HEADING_GROUPS', 'Neue Gruppe');
define('TEXT_INFO_GROUPS_NAME', ' <b>Gruppe Name:</b><br>Verwenden Sie einen einzigartigen Gruppe Namen. Klicken nahe bei reicht ein.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>STÖRUNG:</b> Der Gruppe Name muß mehr als 5 Buchstaben haben!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>STÖRUNG:</b> Der Gruppe Name bereits verwendet worden ist!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Gruppe Niveau: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Kasten-Erlaubnis:</b><br>Geben Sie Zugang zu vorgewählten Kästen.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Schließen Sie die Akten mit ein, die innen gespeichert werden: ');

define('TEXT_INFO_HEADING_DEFINE', 'Definieren Sie Gruppe');
if ($HTTP_GET_VARS['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Sie können nicht Akte Erlaubnis für diese Gruppe ändern.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Ändern Sie Erlaubnis für diese Gruppe, indem Sie Kästen und Akten vorwählen oder unselecting. Klicken speichert, um Ihre Änderungen einzureichen.<br><br>');
}
?>

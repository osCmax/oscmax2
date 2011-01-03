<?php
/* 
  $Page Id$
  http://www.gowebtools.com

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TOP_BAR_TITLE', 'Statistiques Visiteurs'); 
define('NAVBAR_TITLE', 'Statistiques Visiteurs'); 
define('HEADING_TITLE', 'Statistiques Visiteurs'); 
define('CHART_BOX_TITLE', 'Graphique'); 
define('CHART_TITLE', 'Derniere visite:'); 
define('HEADING_TITLE_SEARCH', 'Search:');

define('TABLE_HEADING_NUMBER', 'Id.'); 
define('TABLE_HEADING_DATE', 'Derniers Clics'); 
define('TABLE_HEADING_TRACE_DATE', 'Date');
define('TABLE_HEADING_TRACE_TIME', 'Time');
define('TABLE_HEADING_ONLINE', 'Temps sur site H:M:S');
define('TABLE_HEADING_COUNTER', 'accès'); 
define('TABLE_HEADING_CUSTOMER', 'Client ID');
define('TABLE_HEADING_IP', 'Addresse IP'); 
define('TABLE_HEADING_BLANGUAGE', 'Langue du Navigateur'); 
define('TABLE_HEADING_LANGUAGE', 'Langue du site'); 
define('TABLE_HEADING_REFERER', 'Adresse d\'arrivée'); 
define('TABLE_HEADING_URI', 'Adresse de provenance'); 
define('TABLE_HEADING_KEYWORD_NAME', 'Mot-Clés'); 
define('TABLE_HEADING_KEYWORD_NUMBER', 'Temps d\'Utilisation'); 
define('TABLE_HEADING_FOOTER_COUNT', 'Nombre d\'acces'); 

define('STATISTICS_TYPE_REPORT_A', 'Visites');
define('STATISTICS_TYPE_REPORT_B', 'Hits');
define('STATISTICS_TYPE_REPORT_C', 'Autres');

define('STATISTICS_HEADING_HOURS', 'Heures');
define('STATISTICS_HEADING_DAYS', 'Jours');
define('STATISTICS_HEADING_OTHER_DATE', 'Autre date / Heure');
define('STATISTICS_HEADING_OTHER_VALUE', 'Autre valeur');
define('STATISTICS_HEADING_X', 'Graphique Axe des absisses');
define('STATISTICS_HEADING_Y', 'Axe des ordonées');

define('STATISTICS_TYPE_REPORT_1', 'Dernières 24 Hours');
define('STATISTICS_TYPE_REPORT_2', 'Par jours ce mois'); 
define('STATISTICS_TYPE_REPORT_3', 'Par mois cette année'); 
define('STATISTICS_TYPE_REPORT_4', 'Visite par année');
define('STATISTICS_TYPE_REPORT_5', 'Visite par heure');
define('STATISTICS_TYPE_REPORT_6', 'Par jour du mois de l\'année en cours');

define('STATISTICS_TYPE_REPORT_7', 'Moyenne de toutes les IP par jour');
define('STATISTICS_TYPE_REPORT_8', 'Hits via un langage d\'un navigateur');
define('STATISTICS_TYPE_REPORT_9', 'Hits par minute');
define('STATISTICS_TYPE_REPORT_10', 'Recherche par mots clefs pour les ' . KEYWORD_DURATION . ' derniers jours');
define('STATISTICS_TYPE_REPORT_11', 'Hits par IP et par pays');
define('STATISTICS_TYPE_REPORT_12', 'Visite via un langage d\'un navigateur');
define('STATISTICS_TYPE_REPORT_13', 'Visite par IP et par pays');

define('STATISTICS_TYPE_REPORT_20', 'Hier par heure');
define('STATISTICS_TYPE_REPORT_21', 'Même jour de la semaine dernière');
define('STATISTICS_TYPE_REPORT_22', 'Par jour ces 2 derniers mois');

define('STATISTICS_TYPE_REPORT_23', 'Dernières 24 Heures');
define('STATISTICS_TYPE_REPORT_24', 'Par jour ce mois');
define('STATISTICS_TYPE_REPORT_25', 'Par mois cette année');
define('STATISTICS_TYPE_REPORT_28', 'Par jour du mois de l\'année en cours');
define('STATISTICS_TYPE_REPORT_27', 'Visite par Heure');
define('STATISTICS_TYPE_REPORT_28', 'Par jour du mois de l\'année en cours');

define('STATISTICS_TYPE_REPORT_29', 'Hier par heure');
define('STATISTICS_TYPE_REPORT_30', 'Même jour de la semaine dernière');
define('STATISTICS_TYPE_REPORT_31', 'Par jour sur les 2 derniers mois');
define('STATISTICS_TYPE_REPORT_32', 'Tendance cette année');
define('STATISTICS_TYPE_REPORT_33', 'Tendance cette année');

define('STATISTICS_TYPE_REPORT_34', 'Visite par minute');
define('STATISTICS_TYPE_REPORT_35', 'Par jour de la semaine de l\'année en cours');
define('STATISTICS_TYPE_REPORT_36', 'Par jour de la semaine de l\'année en cours');
define('STATISTICS_TYPE_REPORT_37', 'Visite par trimestre cette année');
define('STATISTICS_TYPE_REPORT_38', 'Hits par trimestre cette année');

define('STATISTICS_TYPE_REPORT_39', 'Visite par semaine cette année');
define('STATISTICS_TYPE_REPORT_40', 'Hits par semaine cette année');
define('STATISTICS_TYPE_REPORT_41', 'Toutes les moyennes par heure');
define('STATISTICS_TYPE_REPORT_42', 'Par mois l\'année dernière');
define('STATISTICS_TYPE_REPORT_43', 'Par jour le mois dernier');
define('STATISTICS_TYPE_REPORT_44', 'Par jour le mois dernier');
define('STATISTICS_TYPE_REPORT_45', 'Par mois l\'année dernière');

define('HEADING_TYPE_DAILY', 'Un Mois'); 
define('HEADING_TYPE_MONTHLY', 'Un An'); 
define('HEADING_TYPE_YEARLY', 'Toutes les Années'); 

define('TITLE_TYPE', 'Sur:'); 
define('TITLE_YEAR', 'Année:'); 
define('TITLE_MONTH', 'Mois:'); 

define('TOTAL_HITS', 'Nombre de visites:'); 
define('BUTTON_REFRESH', 'Rafraichir les données');
define('RANGE_TO', 'De:');
define('RANGE_FROM', 'A:');

// Combien de pays doivent etre montrés dans les statistiques sans compter les robots (moteur de recherches et Autres) ? 
// Par defaut le nombre est 19 , vous pouvez le changer a la ligne en dessous 
define('NO_COUNTRIES_FOR_CHART', '19'); 

$GEOIP_COUNTRY_NAMES = array(
"Unknown/LAN", "Asia/Pacific Region", "Europe", "Andorra", "United Arab Emirates",
"Afghanistan", "Antigua and Barbuda", "Anguilla", "Albania", "Armenia",
"Netherlands Antilles", "Angola", "Antarctica", "Argentina", "American Samoa",
"Austria", "Australia", "Aruba", "Azerbaijan", "Bosnia and Herzegovina",
"Barbados", "Bangladesh", "Belgium", "Burkina Faso", "Bulgaria", "Bahrain",
"Burundi", "Benin", "Bermuda", "Brunei Darussalam", "Bolivia", "Brazil",
"Bahamas", "Bhutan", "Bouvet Island", "Botswana", "Belarus", "Belize",
"Canada", "Cocos (Keeling) Islands", "Congo, The Democratic Republic of the",
"Central African Republic", "Congo", "Switzerland", "Cote D'Ivoire", "Cook
Islands", "Chile", "Cameroon", "China", "Colombia", "Costa Rica", "Cuba", "Cape
Verde", "Christmas Island", "Cyprus", "Czech Republic", "Germany", "Djibouti",
"Denmark", "Dominica", "Dominican Republic", "Algeria", "Ecuador", "Estonia",
"Egypt", "Western Sahara", "Eritrea", "Spain", "Ethiopia", "Finland", "Fiji",
"Falkland Islands (Malvinas)", "Micronesia, Federated States of", "Faroe
Islands", "France", "France, Metropolitan", "Gabon", "United Kingdom",
"Grenada", "Georgia", "French Guiana", "Ghana", "Gibraltar", "Greenland",
"Gambia", "Guinea", "Guadeloupe", "Equatorial Guinea", "Greece", "South Georgia
and the South Sandwich Islands", "Guatemala", "Guam", "Guinea-Bissau",
"Guyana", "Hong Kong", "Heard Island and McDonald Islands", "Honduras",
"Croatia", "Haiti", "Hungary", "Indonesia", "Ireland", "Israel", "India",
"British Indian Ocean Territory", "Iraq", "Iran, Islamic Republic of",
"Iceland", "Italy", "Jamaica", "Jordan", "Japan", "Kenya", "Kyrgyzstan",
"Cambodia", "Kiribati", "Comoros", "Saint Kitts and Nevis", "Korea, Democratic
People's Republic of", "Korea, Republic of", "Kuwait", "Cayman Islands",
"Kazakstan", "Lao People's Democratic Republic", "Lebanon", "Saint Lucia",
"Liechtenstein", "Sri Lanka", "Liberia", "Lesotho", "Lithuania", "Luxembourg",
"Latvia", "Libyan Arab Jamahiriya", "Morocco", "Monaco", "Moldova, Republic
of", "Madagascar", "Marshall Islands", "Macedonia, the Former Yugoslav Republic
of", "Mali", "Myanmar", "Mongolia", "Macau", "Northern Mariana Islands",
"Martinique", "Mauritania", "Montserrat", "Malta", "Mauritius", "Maldives",
"Malawi", "Mexico", "Malaysia", "Mozambique", "Namibia", "New Caledonia",
"Niger", "Norfolk Island", "Nigeria", "Nicaragua", "Netherlands", "Norway",
"Nepal", "Nauru", "Niue", "New Zealand", "Oman", "Panama", "Peru", "French
Polynesia", "Papua New Guinea", "Philippines", "Pakistan", "Poland", "Saint
Pierre and Miquelon", "Pitcairn", "Puerto Rico", "Palestinian Territory,
Occupied", "Portugal", "Palau", "Paraguay", "Qatar", "Reunion", "Romania",
"Russian Federation", "Rwanda", "Saudi Arabia", "Solomon Islands",
"Seychelles", "Sudan", "Sweden", "Singapore", "Saint Helena", "Slovenia",
"Svalbard and Jan Mayen", "Slovakia", "Sierra Leone", "San Marino", "Senegal",
"Somalia", "Suriname", "Sao Tome and Principe", "El Salvador", "Syrian Arab
Republic", "Swaziland", "Turks and Caicos Islands", "Chad", "French Southern
Territories", "Togo", "Thailand", "Tajikistan", "Tokelau", "Turkmenistan",
"Tunisia", "Tonga", "East Timor", "Turkey", "Trinidad and Tobago", "Tuvalu",
"Taiwan", "Tanzania, United Republic of", "Ukraine",
"Uganda", "United States Minor Outlying Islands", "United States", "Uruguay",
"Uzbekistan", "Holy See (Vatican City State)", "Saint Vincent and the
Grenadines", "Venezuela", "Virgin Islands, British", "Virgin Islands, U.S.",
"Vietnam", "Vanuatu", "Wallis and Futuna", "Samoa", "Yemen", "Mayotte",
"Yugoslavia", "South Africa", "Zambia", "Zaire", "Zimbabwe"
);

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erreur: Le Repertoire des Graphique n\'existe pas. Créer un répertoire \'graphs\' dans le dossier \'images\'.'); 
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erreur: Le Repertoire des Graphique est en lecture seule.'); 

define('SORT_UP', 'tri ascendant');
define('SORT_DOWN', 'Tri descendant');
define('TOP', 'Retour');

define('DISPLAY_HITS', 'Pages vues');
define('CHART_TITLE', 'Web Stats - ' . DISPLAY_HITS);
define('TABLE_HEADING_TABLE', DISPLAY_HITS);
define('CHART_X', TABLE_HEADING_NUMBER);
define('CHART_Y', 'Actuellement');

define('TEXT_HEADING_DELETE', 'Effacer les Options');
define('TEXT_FOOTER_DELETE', 'Sélectionner l\option ci dessous et confirmer sur la prochaine page');

define('TEXT_HEADING_EMPTY', 'Tout supprimer');
define('TEXT_HEADING_ROBOTS', 'Supprimer tous les Robots');
define('TEXT_HEADING_GUESTS', 'Supprimer tous les Guests');
define('TEXT_HEADING_DATE', 'Supprimer par date');
define('TEXT_HEADING_BY_ID', 'Supprimer par ID');

define('TEXT_EDIT_EMPTY', 'Confirmer la suppression de toutes les données:');
define('TEXT_EDIT_ROBOTS', 'Confirmer la suppression de toutes les données faites via un Robots:');
define('TEXT_EDIT_GUESTS', 'Confirmer la suppression de toutes les données faites via un Guests:');
define('TEXT_EDIT_DATE', 'Confirmer la suppression de toutes les données par date montrées ci dessous:');
define('TEXT_EDIT_BY_ID', 'Confirmer la suppression des données par ID ci dessous:');

define('TITLE_DAY', 'Avant hier');
define('TITLE_MONTH', 'Mois précédent');
define('TITLE_YEAR', 'Année précédente');

define('IMAGE_DELETE_BY_ID', 'Supprimer par ID');
define('IMAGE_DELETE_DATE', 'Supprimer par Date');
define('IMAGE_DELETE_ROBOTS', 'Supprimer tous les Robots');
define('IMAGE_DELETE_GUESTS', 'Supprimer tous les guests');

define('ROBOT_SWITCH_LIMITED', 'Cliquer sur le rouge pour exclure un robot');
define('ROBOT_SWITCH_FULL', 'Cliquer sur le vert pour inclure un robot');
define('VISITOR_ICON_FULL_ACTIVE', 'Robots inclus');
define('VISITOR_ICON_LIMITED', 'Cliquer pour exclure un robot');
define('VISITOR_ICON_FULL', 'Cliquer pour inclure un robot');
define('VISITOR_ICON_LIMITED_ACTIVE', 'Robot exclus');

define('GUEST', 'Invité');
define('BUTTON_REFRESH_CHART', 'Actualiser le graphique');
define('BUTTON_REFRESH_TEXT', '<font class="smalltext" color="#FF0000">Cliquer ici pour mettre à jour l\'image du graphique</font>');

define('ERROR_NO_DATA', 'Rien à supprimer!');
define('POPUP_CLOSE', 'Add more items or <a href="Javascript:close()">[Close Window]</a>');
define('BOX_TITLE_TRACE', 'Visitor Trace');

define('TABLE_ROOT', 'Root Directory');
define('TABLE_DIRECT', 'Direct');
define('TABLE_HEADING_HOST', 'Host');

?>

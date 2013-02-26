<?php
/*
$Id: http_error.php 982 2011-01-06 02:53:12Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Erreur HTTP');
define('HEADING_TITLE', 'Erreur %s');
define('TEXT_INFORMATION', 'Nous sommes d&eacute;sol&eacute;s mais la page que vous avez demand&eacute; a rencontr&eacute; l\'erreur suivante:
<br><br><b>%s</b><br><br>S\'il vous pla&icirc;t n\'h&eacute;sitez pas &agrave; parcourir le reste de notre boutique en ligne. Vous pouvez &eacute;galement utiliser la fonction \'Recherche avanc&eacute;e\' ci-dessous pour trouver le produit que vous recherchez. Nous nous excusons pour les d&eacute;sagr&eacute;ments.');

define('EMAIL_BODY', 
'------------------------------------------------------' . "\n" .
'Site: %s.' . "\n" .
'Error Code: %s - %s' . "\n" .
'Occurred: %s' . "\n" .
'Requested URL: %s' . "\n" .
'User Address: %s' . "\n" .
'User Agent: %s' . "\n" .
'Referer: %s' . "\n" .
'------------------------------------------------------'
);

define('EMAIL_TEXT_SUBJECT', 'Un client a eu une erreur HTTP');

//Client Error Codes 
define('ERROR_400_DESC', 'La syntaxe de la requête est erronée 400');
define('ERROR_401_DESC', 'Une authentification est nécessaire pour accéder à la ressource 401');
define('ERROR_403_DESC', 'L’authentification est refusée. Contrairement à l’erreur 401, aucune demande d’authentification ne sera faite 403');
define('ERROR_404_DESC', 'Document non trouvé 404');
define('ERROR_405_DESC', 'Méthode de requête non autorisée 405');
define('ERROR_408_DESC', 'emps d’attente d’une réponse du serveur écoulé 408.');
define('ERROR_415_DESC', 'Le contenu de la demande a été présentée avec le type de média non valide ou non autorisé 415.');
define('ERROR_416_DESC', 'La ressource demandée est invalide ou d\'une partie n\'est pas disponible sur le serveur 416.');
define('ERROR_417_DESC', '&Comportement attendu et défini dans l’en-tête de la requête insatisfaisable 417');

//Server Error Codes
define('ERROR_500_DESC', 'Erreur interne du serveur 500');
define('ERROR_501_DESC', 'Fonctionnalité réclamée non supportée par le serveur 501');
define('ERROR_502_DESC', 'Mauvaise réponse envoyée à un serveur intermédiaire par un autre serveur 502.');
define('ERROR_503_DESC', 'Service temporairement indisponible ou en maintenance 503');
define('ERROR_504_DESC', 'Temps d’attente d’une réponse d’un serveur à un serveur intermédiaire écoulé 504');
define('ERROR_505_DESC', 'Version HTTP non gérée par le serveur 505');
define('UNKNOWN_ERROR_DESC', 'Erreur ind&eacute;finni');
?>
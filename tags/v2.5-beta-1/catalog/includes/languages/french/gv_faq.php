<?php
/*
  $Id: gv_faq.php,v 1.1.1.1.2.2 2003/05/04 12:24:25 wilt Exp $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'FAQ - Ch&egrave;ques cadeaux');
define('HEADING_TITLE', 'FAQ - Ch&egrave;ques cadeaux');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">1 - Pourquoi acheter des ch&egrave;ques cadeaux ?</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">2 - Comment envoyer des ch&egrave;ques cadeaux &agrave; vos proches ?</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">3 - Comment effectuer des achats &agrave; l\'aide de ch&egrave;que cadeau ?</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">4 - Comment valider un ch&egrave;que cadeau ?</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">5 - En cas de probl&egrave;mes !</a><br>
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','<br><br>Pourquoi acheter des ch&egrave;ques cadeaux ?<br><br>');
define('SUB_HEADING_TEXT','Tr&egrave;s utile, les ch&egrave;ques cadeaux peuvent servir pour faire plaisir &agrave; l\'un de vos proches, pour qui vous ne savez pas quoi lui offrir. Ils s\'ach&egrave;tent sur le site comme un article.<br><br>Si vous avez actuellement des ch&egrave;ques cadeaux sur votre compte, le solde appara&icirc;tra dans la bo&icirc;te panier en haut de la colonne de droite.<br><br>Vous pouvez utiliser ce solde au moment de passer une commande sur notre boutique ou bien en faire b&eacute;n&eacute;ficier vos proches par simple email.<br><br>');
  break;
  case '2':
define('SUB_HEADING_TITLE','<br><br>Pour envoyer un ch&egrave;que cadeau &agrave vos proches ?<br><br>');
define('SUB_HEADING_TEXT','Vous pouvez y acc&eacute;der par la bo&icirc;te affichant le contenu de votre panier qui se trouve en haut de la colonne de  droite (Le solde de ch&egrave;que s\'affiche seulement si vous poss&eacute;dez des ch&egrave;ques cadeaux sur votre compte).<br><br><u>Pour faire b&eacute;n&eacute;ficier un ch&egrave;que cadeau &agrave; un proche veuillez sp&eacute;cifier</u> :<br><br>&nbsp;&nbsp;&nbsp;&nbsp;- Le nom de la personne.<br>&nbsp;&nbsp;&nbsp;&nbsp;- Son adresse email.<br>&nbsp;&nbsp;&nbsp;&nbsp;- Le montant que vous d&eacute;sirez lui faire parvenir (Vous n\'&ecirc;tes pas obliger de mettre la totalit&eacute; du montant qui est dans votre compte.).<br>&nbsp;&nbsp;&nbsp;&nbsp;- Et si vous le d&eacute;sirez laisser lui un message qui appara&icirc;tra dans l\'email.<br><br>Veuillez-vous assurer que toutes les informations inscrites sont correctes, elles sont changeables autant que vous le d&eacute;sirez avant l\'envoie d&eacute;finitif de l\'email.<br><br>');
  break;
  case '3':
  define('SUB_HEADING_TITLE','<br><br>Comment effectuer des achats &agrave; l\'aide de ch&egrave;que cadeau ?<br><br>');
  define('SUB_HEADING_TEXT','Librement faite vos achats sur le site et ensuite au moment de la commande utiliser vos ch&egrave;ques cadeaux comme un mode de paiement.<br><br>Si l\'un  des articles choisi d&eacute;passe le montant du ch&egrave;que cadeau, vous devez choisir une m&eacute;thode de paiement suppl&eacute;mentaire pour r&eacute;gler la diff&eacute;rence. En outre, si le montant des articles est &eacute;gal ou inf&eacute;rieur &agrave; la somme de vos ch&egrave;ques cadeaux, le paiement suppl&eacute;mentaire sera ignor&eacute; et/ou le reste de la somme de vos ch&egrave;ques cadeaux sera libre pour effectuer vos futurs achats.<br><br>');
  break;
  case '4':
  define('SUB_HEADING_TITLE','<br><br>Comment valider un ch&egrave;que cadeau ?<br><br>');
  define('SUB_HEADING_TEXT','Si vous recevez un ch&egrave;que cadeau par email, celui-ci contiendra des informations sur la personne qui vous l&agrave; fait parvenir, ainsi qu\'un court message de sa part. Cet email indiquera aussi le code du ch&egrave;que cadeau, que vous pouvez imprimer.<br><br>Pour utiliser votre ch&egrave;que cadeau, cliquer sur le lien fournit dans l\'email, cr&eacute;er votre compte qui est obligatoire, si vous n\'&ecirc;tes pas encore client. Apr&egrave;s validation de notre part, vous pouvez effectuer vos achats sur le site. Un lien est disponible &agrave; tout moments pour valider votre ch&egrave;que cadeau dans la rubrique information se trouvant dans la colonne de gauche.<br><br>Nous vous rappelons, pour la validation d\'un ch&egrave;que cadeau, vous &ecirc;tes dans l\'obligation d\'ouvrir un compte.<br><br>');
  break;
  case '5':
  define('SUB_HEADING_TITLE','<br><br>En cas de probl&egrave;mes !<br><br>');
  define('SUB_HEADING_TEXT','Pour tous autres renseignements ou en cas de probl&egrave;mes avec les ch&egrave;ques cadeaux, n\'h&eacute;siter pas &agrave; prendre contact avec nous par email root@localhost et assurez-vous que vous nous avez fournit le maximum d\'informations pour vous r&eacute;pondre et vous satisfaire dans les plus bref d&eacute;lais.<br><br>');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','Choisissez une question ci-dessus.');

  }
?>
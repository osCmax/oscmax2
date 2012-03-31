<?php
/*
$Id: gv_faq.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Gift Voucher FAQ');
define('HEADING_TITLE', 'Gift Voucher FAQ');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Purchasing Gift Vouchers</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">How to send Gift vouchers</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Buying with Gift Vouchers</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Redeeming Gift Vouchers</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">When problems occur</a><br>
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','Purchasing Gift Vouchers.');
define('SUB_HEADING_TEXT','Gift Vouchers are purchased just like any other item in our store. You can 
  pay for them using the store\'s standard payment method(s).
  Once purchased the value of the Gift Voucher will be added to your own personal 
  Gift Voucher Account. If you have funds in your Gift Voucher Account, you will 
  notice that the amount now shows in the Shopping Cart box, and also provides a 
  link to a page where you can send the Gift Voucher to someone via email.');
  break;
  case '2':
define('SUB_HEADING_TITLE','How to Send Gift Vouchers.');
define('SUB_HEADING_TEXT','To send a Gift Voucher that you have purchased, you need to go to our Send Gift Voucher Page. You can
  find the link to this page in the Shopping Cart Box in the right hand column of 
  each page.
  When you send a Gift Voucher, you need to specify the following:<br> <br>
  The name of the person you are sending the Gift Voucher to.<br>
  The email address of the person you are sending the Gift Voucher to.<br>
  The amount you want to send. (Note you don\'t have to send the full amount that 
  is in your Gift Voucher Account.) <br>
  A short message which will appear in the email.<br><br>
  Please ensure that you have entered all of the information correctly, although 
  you will be given the opportunity to change this as much as you want before 
  the email is actually sent.');  
  break;
  case '3':
  define('SUB_HEADING_TITLE','Buying with Gift Vouchers.');
  define('SUB_HEADING_TEXT','If you have funds in your Gift Voucher Account, you can use those funds to 
  purchase other items in our store. At the checkout stage, an extra box will
  appear. Clicking this box will apply those funds in your Gift Voucher Account.
  Please note, you will still have to select another payment method if there 
  is not enough in your Gift Voucher Account to cover the cost of your purchase. 
  If you have more funds in your Gift Voucher Account than the total cost of 
  your purchase the balance will be left in your Gift Voucher Account for the
  future.');
  break;
  case '4':
  define('SUB_HEADING_TITLE','Redeeming Gift Vouchers.');
  define('SUB_HEADING_TEXT','If you receive a Gift Voucher by email it will contain details of who sent 
  you the Gift Voucher, along with possibly a short message from them. The Email 
  will also contain the Gift Voucher Number. It is probably a good idea to print 
  out this email for future reference. You can now redeem the Gift Voucher in 
  two ways.<br>
  1. By clicking on the link contained within the email for this express purpose.
  This will take you to the store\'s Redeem Voucher page. you will then be requested 
  to create an account, before the Gift Voucher is validated and placed in your 
  Gift Voucher Account ready for you to spend it on whatever you want.<br>
  2. During the checkout process, on the same page that you select a payment method 
there will be a box to enter a Redeem Code. Enter the code here, and click the redeem button. The code will be
validated and added to your Gift Voucher account. You can then use the amount to purchase any item from our store');
  break;
  case '5':
  define('SUB_HEADING_TITLE','When problems occur.');
  define('SUB_HEADING_TEXT','For any queries regarding the Gift Voucher System, please contact the store 
  by email at '. STORE_OWNER_EMAIL_ADDRESS . '. Please make sure you give 
  as much information as possible in the email. ');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','Please choose from one of the questions above.');

  }
?>
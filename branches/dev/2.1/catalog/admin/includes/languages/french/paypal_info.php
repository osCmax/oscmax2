<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Accept Payments and Credit Cards through PayPal');
define('NAVBAR_TITLE', 'Securely apply for your Paypal account right from this page');
define('TEXT_MAIN', '<style type="text/css">
<!--
.style7 {
	color: #0033CC;
	font-style: italic;
}
-->
</style>
<tr><td valign=\'top\' class=\'main\'>
            <p>osCMax now offers you free signup for a PayPal account. This will allow you to accept direct PayPal payments from customers who prefer not to use a credit card, and will allow you to accept all major credit cards too.</p>
            <p>Application is free, and best of all, PayPal payment processing is fully integrated into osCMax so that you can begin processing orders immediately.</p>
<a href=\'https://www.paypal.com/us/mrb/pal=CDCRNFVMQRHTC\' target=\'blank\'><img src=\'images/apply_now_34.gif\' alt=\'Apply for your free PayPal account now - click here\' width=\'97\' height=\'17\' border=\'0\'></a><br>
<span class="style7">note: A new window will open when you click the<strong> Apply Now</strong> button. This is the secure Paypal application page. If a new window does not open, allow pop-ups and try again</span></td></tr>

<tr class=main><td><p><br>Once your application has been approved, return to this page and read the Paypal module setup instructions below:
    <ol>
      <li>In the osCMax admin, go to the <strong>Modules &gt;&gt; Payment</strong> section. You will see a list of payment modules. Click on the module named <strong>Paypal (Credit Card / Debit) </strong></li>
      <li>Click on the install button that appears in the right column. This will open a new box in the right column with many different configuration options and two buttons at the top = Remove and Edit. Click the <strong>Edit</strong> button </li>
      <li>Next, you will need to edit the actual settingd for this module. See Below:
        <ul>
          <li>Set


          <strong>Do you want to accept PayPal IPN payments?</strong> to True by clicking on the <strong>True</strong> radio button. </li>
          <li>Enter the email address that is connected to your Paypal account (the one you used when you applied for the account) in the <strong>EMail Address</strong> box.</li>
          <li><strong>Select a transaction currency</strong>. If you your store uses multiple currency types and you want this to switch based on the selected currency in your shop, set it to Selected Currecy. If you want to force all transactions to use a certain currency, select that instead.</li>
          <li> <strong>Payment Zone </strong>- If you have set up payment zones, they will be listed in this dropdown box. If you only want to use Paypal as a payment method for a single zone, select it here. Otherwise, leave it set to None and it will be used for all transactions, regardless of zone.</li>
          <li> <strong>Set Preparing Order Status </strong>- Select the preparing order status of new Paypal transactions. Select from the list.</li>
          <li> <strong>Set PayPal Acknowledged Order Status </strong>- Set the the order status for orders that have been processed and acknowledged by paypal. Select from the list.</li>
          <li> <strong>Gateway Server </strong>- Select whether to use the live payment server or the sandbox (test server). In order to use the sandbox, you need a developers key from Paypal. </li>
          <li> <strong>Transaction Type </strong> - Set the transaction type. This can be a per item or aggregate. If you set this to per item, Gift Vouchers and coupons will not work correctly. If you do not use gift vouchers and coupons, feel free to set this to Per Item. If you also use Gift Vouchers and coupons in your shop, you must set this to Aggregate.</li>
          <li> <strong>Page Style </strong> -


 The page style to use for the transaction procedure (defined at your PayPal Profile page)</li>
          <li> <strong>Debug E-Mail Address </strong> -


 All parameters of an Invalid IPN notification will be sent to this email address if one is entered.</li>
          <li> <strong>Sort order of display </strong> - This determines where the Paypal module will display on your order checkout page. Lower numbers will appear nearer to the top of the checkout page, and before Payment modules with a higher sort order number.</li>
          <li> <strong>Enable Encrypted Web Payments </strong>- Set this to true to enable payment url encryption.</li>
          <li> <strong>Your Private Key </strong>- If encryption is enabled, you will need to enter the location/path of your private key.</li>
          <li> <strong>Your Public Certificate </strong> - If encryption is enabled, you will need to enter the location/path of your public key.</li>
          <li> <strong>PayPal\'s Public Certificate </strong> - If encryption is enabled, you will need to enter the location/path of PayPal\'s public key.</li>
          <li> <strong>Your PayPal Public Certificate ID </strong> - If encryption is enabled, enter the


 the Certificate ID to use from your PayPal Encrypted Payment Settings Profile.</li>
          <li> <strong>Working Directory </strong> - If encryption is enabled, enter the location/path to your temporary working directory. </li>
          <li> <strong>OpenSSL Location </strong>- If encryption is enabled, enter the location/path to your servers openSSL binary file.</li>
        </ul>
      </li>
      <li>Once all the information is entered, click the Update button. Your PayPal payment module is now enabled and you shoud run a test order through your shop to make sure it is working.</li>
    </ol>
    <p>&nbsp;</p>    <p>&nbsp;</p></td>
</tr>');
define('TEXT_BACK', 'back');
?>

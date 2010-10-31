<?php
/*
$Id: localization.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  function quote_oanda_currency($code, $base = DEFAULT_CURRENCY) {

// BOF: FIX OANDA.COM Forgen currency exhange
//    $page = file('http://www.oanda.com/convert/fxdaily?value=1&redirected=1&exch=' . $code .  '&format=CSV&dest=Get+Table&sel_list=' . $base);
//  ALTe START
   $alte_url = "http://www.oanda.com/convert/fxdaily";
   $alte_params = 'value=1&redirected=1&exch=' . $code .  '&format=CSV&dest=Get+Table&sel_list=' . $base;
   $alte_user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

   $alte_ch = curl_init();
   curl_setopt($alte_ch, CURLOPT_POST,1);
   curl_setopt($alte_ch, CURLOPT_POSTFIELDS,$alte_params);
   curl_setopt($alte_ch, CURLOPT_URL,$alte_url);
   curl_setopt($alte_ch, CURLOPT_SSL_VERIFYHOST, 2);
   curl_setopt($alte_ch, CURLOPT_USERAGENT, $alte_user_agent);
   curl_setopt($alte_ch, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($alte_ch, CURLOPT_SSL_VERIFYPEER, FALSE);

   $alte_page=curl_exec ($alte_ch);
   curl_close ($alte_ch);

   $page = explode("\n",$alte_page);
//  ALTe STOP    
// EOF: FIX OANDA.COM Forgen currency exhange

    $match = array();

    preg_match('/(.+),(\w{3}),([0-9.]+),([0-9.]+)/i', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[3];
    } else {
      return false;
    }
  }

  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
// BOF: FIX XE.NET Forgen currency exhange
//    $page = file('http://www.xe.net/ucc/convert.cgi?Amount=1&From=' . $from . '&To=' . $to);

//  ALTe START
   $alte_url = "http://www.xe.net/ucc/convert.cgi";
   $alte_params = 'Amount=1&From=' . $from . '&To=' . $to;
   $alte_user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

   $alte_ch = curl_init();
   curl_setopt($alte_ch, CURLOPT_POST,1);
   curl_setopt($alte_ch, CURLOPT_POSTFIELDS,$alte_params);
   curl_setopt($alte_ch, CURLOPT_URL,$alte_url);
   curl_setopt($alte_ch, CURLOPT_SSL_VERIFYHOST, 2);
   curl_setopt($alte_ch, CURLOPT_USERAGENT, $alte_user_agent);
   curl_setopt($alte_ch, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($alte_ch, CURLOPT_SSL_VERIFYPEER, FALSE);

   $alte_page=curl_exec ($alte_ch);
   curl_close ($alte_ch);

   $page = explode("\n",$alte_page);
//  ALTe STOP    
// EOF: FIX XE.NET Forgen currency exhange
    $match = array();

    preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[1];
    } else {
      return false;
    }
  }
?>

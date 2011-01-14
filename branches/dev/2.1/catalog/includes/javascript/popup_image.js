<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<script language="javascript" type="text/javascript"><!--
var i=0;
function resize() {
  if (navigator.appName == 'Netscape') i=10;
  if (document.images[0]) {
  imgHeight = document.images[0].height+65-i;
  imgWidth = document.images[0].width+30;
  var height = screen.height;
  var width = screen.width;
  var leftpos = width / 2 - imgWidth / 2;
  var toppos = height / 2 - imgHeight / 2; 
  window.moveTo(leftpos, toppos);  
  window.resizeTo(imgWidth, imgHeight);
  }
  self.focus();
}
//--></script>
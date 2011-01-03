<?php
/*
  $Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Domain Registration Page');
define('NAVBAR_TITLE', 'Register your domain name today, starting at just $9.99');
define('TEXT_MAIN', '<tr class=main><td>
		    <p> Check to see if your domain name is available by typing it into
              the search box directly below (choose from 28 different TLD types). There is no charge to check availability of
              domains, but if you decide to purchase your domain name now, our
              pricing starts at only $9.99/year</p>

            <table class=main width=\'100%\' border=\'0\' cellspacing=\'2\' cellpadding=\'0\'>
              <tr valign=\'top\'>
                <td width=\'51%\' bgcolor=\'F9F6F0\' style=\'border:solid 2px E6DDCB;\'>

                  <form method=post action=\'https://billing.aabox.com/order/orderwiz.php\' target=\'_self\'>
                    <div align=\'left\'>
                      <table  width=\'198\' border=\'0\' align=\'center\' cellpadding=\'0\' cellspacing=\'0\'>
                        <tr>
                          <td colspan=\'2\' valign=\'top\'><img src=\'images/spc.gif\' width=\'1\' height=\'3\'></td>
                        </tr>
                        <tr valign=\'top\'>
                          <td colspan=\'2\'><img src=\'images/gst.gif\' alt=\'\' width=\'121\' height=\'26\'></td>
                        </tr>
                        <tr>
                          <td colspan=\'2\' valign=\'top\'><img src=\'images/spc.gif\' width=\'1\' height=\'5\'></td>
                        </tr>
                        <tr>
                          <td width=\'71%\'> <div align=\'center\'>
                              <input type=hidden name=submit_domain value=register>
                              <input type=text name=domain value=\'Type domain here\' class=\'box1\'size=20 maxlength=63 onblur=\'if(this.value==\'\') this.value=\'Type domain here\';\'
			        onfocus=\'if(this.value==\'Type domain here\') this.value=\'\';\'>
                            </div></td>
                          <td width=\'29%\'> <div align=\'right\'>
                              <select name=\'tld_extension\' class=\'box2\'>
                                <option selected>com</option>
                                <option>net</option>
                                <option>org</option>
                                <option>us</option>
                                <option>biz</option>
                                <option>info</option>
                                <option>name</option>
								<option>ca</option>
								<option>cn</option>
								<option>cc</option>
								<option>tv</option>
								<option>bz</option>
								<option>nu</option>
								<option>ws</option>
								<option>kids.us</option>
								<option>de</option>
								<option>tc</option>
								<option>vg</option>
								<option>ms</option>
								<option>gs</option>
								<option>jp</option>
								<option>in</option>
								<option>com.tw</option>
								<option>org.tw</option>
								<option>idv.tw</option>
								<option>com.cn</option>
								<option>net.cn</option>
								<option>org.cn</option>
						     </select>
                            </div></td>
                        </tr>
                        <tr>
                          <td colspan=\'2\' valign=\'top\'><img src=\'images/spc.gif\' width=\'1\' height=\'4\'></td>
                        </tr>
                        <tr>
                          <td colspan=\'2\' class=\'sub\'> <div align=\'right\'>
                              <input name=\'submit\' type=\'submit\' value=\'Check Domain\' class=\'submit\'>
                            </div></td>
                        </tr>
                      </table>
                      <table width=\'80%\' border=\'0\' align=\'center\' cellpadding=\'0\' cellspacing=\'0\'>
                        <tr>
                          <td valign=\'top\'><div align=\'right\'><img src=\'images/prd.gif\' alt=\'\' width=\'111\' height=\'22\'></div></td>
                        </tr>
                      </table>
                    </div>
                  </form></td>
                <td width=\'49%\' bgcolor=\'EFFBFF\' style=\'padding:10px; border:solid 2px C7E7FF\'>
                  <p>When you register a domain with AABox, you get state of the
                    art DNS management, optional POP3/Webmail, optional web based
                    nameserver management, and full control over the domain. </p>
                </td>
              </tr>
            </table>

            <p><strong><font color=\'#CC0000\'>* </font></strong>You are not required
              to host your domain at AABox, and can host anywhere you like. You
              have full control over your domain name, DNS, Whois information, email, etc...</p>
            <table class=main width=\'100%\' border=\'0\' cellpadding=\'0\' cellspacing=\'3\' bgcolor=\'EFFBFF\'>
              <tr valign=\'top\' bgcolor=\'#FFFFFF\'>
                <td width=\'50%\'>
                  <table class=main width=\'99%\' border=\'0\' cellspacing=\'1\' cellpadding=\'2\'>
                    <tr valign=\'top\' bgcolor=\'#CC3300\'>
                      <td width=\'60%\'><font color=\'#FFFFFF\'><strong><img src=\'images/spc.gif\' alt=\'\' width=\'8\' height=\'8\'>TLD</strong></font></td>
                      <td width=\'40%\'><font color=\'#FFFFFF\'><strong>Price/year</strong></font></td>
                    </tr>
                    <tr valign=\'top\'>
                      <td>.com</td>
                      <td>$9.99</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.net</td>
                      <td>$9.99</td>
                    </tr>
                    <tr>
                      <td>.org</td>
                      <td>$9.99</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.us</td>
                      <td>$9.99</td>
                    </tr>
                    <tr>
                      <td>.info</td>
                      <td>$9.99</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.biz</td>
                      <td>$9.99</td>
                    </tr>
                    <tr>
                      <td>.com.tw</td>
                      <td>$49.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.org.tw</td>
                      <td>$49.95</td>
                    </tr>
                    <tr>
                      <td>.idv.tw</td>
                      <td>$49.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.ca</td>
                      <td>$19.95</td>
                    </tr>
                    <tr>
                      <td>.cn</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.name</td>
                      <td>$9.99</td>
                    </tr>
                    <tr>
                      <td>.cc</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.tv</td>
                      <td>$65.00</td>
                    </tr>
                  </table></td>
                <td width=\'50%\'>
                  <table class=main width=\'100%\' border=\'0\' cellspacing=\'1\' cellpadding=\'2\'>
                    <tr bgcolor=\'#CC3300\'>
                      <td width=\'60%\'><strong><font color=\'#FFFFFF\'><strong><img src=\'images/spc.gif\' alt=\'\' width=\'8\' height=\'8\'></strong>TLD</font></strong></td>
                      <td width=\'40%\'><font color=\'#FFFFFF\'><strong>Price/year</strong></font></td>
                    </tr>
                    <tr>
                      <td>.bz</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.nu</td>
                      <td>$33.95</td>
                    </tr>
                    <tr>
                      <td>.ws</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.kids.us</td>
                      <td>$125.00</td>
                    </tr>
                    <tr>
                      <td>.com.cn</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.net.cn</td>
                      <td>$33.95</td>
                    </tr>
                    <tr>
                      <td>.org.cn</td>
                      <td>$33.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td> .de</td>
                      <td>$16.95</td>
                    </tr>
                    <tr>
                      <td>.tc</td>
                      <td>$65.00</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.vg</td>
                      <td>$65.00</td>
                    </tr>
                    <tr>
                      <td>.ms</td>
                      <td>$65.00</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td>.gs</td>
                      <td>$65.00</td>
                    </tr>
                    <tr>
                      <td valign=\'top\'>.jp</td>
                      <td>$99.95</td>
                    </tr>
                    <tr bgcolor=\'fafafa\'>
                      <td valign=\'top\'> .in</td>
                      <td>$20.00</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
</td></tr>			');
define('TEXT_BACK', 'back');
?>

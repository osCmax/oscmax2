<?php
/*
$Id: affiliate_validcats.tpl.php 1026 2011-01-07 18:18:43Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
	<table width="580" class="infoBoxContents">
<tr>
<td colspan="2" class="infoBoxHeading" align="center"><?php echo TEXT_VALID_CATEGORIES_LIST; ?></td>
</tr>
<?php
    echo "<tr><td><b>". TEXT_VALID_CATEGORIES_ID . "</b></td><td><b>" . TEXT_VALID_CATEGORIES_NAME . "</b></td></tr><tr>";
    $result = mysql_query("SELECT * FROM categories, categories_description WHERE categories.categories_id = categories_description.categories_id and categories_description.language_id = '" . $languages_id . "' ORDER BY categories_description.categories_name");
    if ($row = mysql_fetch_array($result)) {
        do {
            echo "<td class='infoBoxContents'>&nbsp".$row["categories_id"]."</td>\n";
            echo "<td class='infoBoxContents'>".$row["categories_name"]."</td>\n";
            echo "</tr>\n";
        }
        while($row = mysql_fetch_array($result));
    }
    echo "</table>\n";
?>
<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?>&nbsp;&nbsp;&nbsp;</p>
<br>
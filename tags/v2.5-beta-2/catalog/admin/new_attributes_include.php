<tr>
  <td class="pageHeading" colspan="3"><?php echo $pageTitle; ?></td>
</tr>
<tr>
  <td>
  <form action="<?php echo $PHP_SELF ?>" method="post" name="submit_attributes">
  <input type="hidden" name="current_product_id" value="<?php echo $current_product_id; ?>">
  <input type="hidden" name="action" value="change">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
<?php

if ( $cPath ) echo "<input type=\"hidden\" name=\"cPathID\" value=\"" . $cPath . "\">";

require( 'new_attributes_functions.php');

// Temp id for text input contribution.. I'll put them in a seperate array.
$tempTextID= "1999043";

// Lets get all of the possible options
$query = "SELECT * FROM products_options where products_options_id LIKE '%' AND language_id = '$languageFilter'";
$result = mysql_query($query) or die(mysql_error());
$matches = mysql_num_rows($result);
if ($matches) {
  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $current_product_option_name = $line['products_options_name'];
    $current_product_option_id = $line['products_options_id'];

// Print the Option Name
        echo "<tr class=\"dataTableHeadingRow\">";
        echo "<td class=\"dataTableHeadingContent\"><b>" . $current_product_option_name . "</b></td>";
        echo "<td class=\"dataTableHeadingContent\"><b>Value Price</b></td>";
        echo "<td class=\"dataTableHeadingContent\"><b>Price Prefix</b></td>";
        
        if ( $optionTypeInstalled == "1" ) {
                
                echo "<td class=\"dataTableHeadingContent\"><b>Option Type</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>Quantity</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>Order</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>Linked Attr.</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>ID</b></td>";
                
        }
        
        if ( $optionSortCopyInstalled == "1" ) {
                                               	
                echo "<td class=\"dataTableHeadingContent\"><b>Weight</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>Weight Prefix</b></td>";
                echo "<td class=\"dataTableHeadingContent\"><b>Sort Order</b></td>";
                
        }

        echo "</tr>";
        
// Find all of the Current Option's Available Values
        $query2 = "SELECT * FROM products_options_values_to_products_options WHERE products_options_id = '$current_product_option_id' ORDER BY products_options_values_id DESC";
        $result2 = mysql_query($query2) or die(mysql_error());
        $matches2 = mysql_num_rows($result2);
        if ($matches2) {
           $i = "0";
           while ($line = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                $i++;
                $rowClass = rowClass( $i );
                $current_value_id = $line['products_options_values_id'];
                $isSelected = checkAttribute( $current_value_id, $current_product_id, $current_product_option_id );
                if ($isSelected) { $CHECKED = " CHECKED"; } else { $CHECKED = ""; }
                $query3 = "SELECT * FROM products_options_values WHERE products_options_values_id = '$current_value_id' AND language_id = '$languageFilter'";
                $result3 = mysql_query($query3) or die(mysql_error());
                while($line = mysql_fetch_array($result3, MYSQL_ASSOC)) {
                        $current_value_name = $line['products_options_values_name'];
// Print the Current Value Name
                        echo "<tr class=\"" . $rowClass . "\">";
                        echo "<td class=\"main\">";

// Add Support for multiple text input option types (for Chandra's contribution).. and using ' to begin/end strings.. less of a mess.
                        if ( $optionTypeTextInstalled == "1" && $current_value_id == $optionTypeTextInstalledID ) {

                                $current_value_id_old = $current_value_id;
                                $current_value_id = $tempTextID;

                                echo '<input type="checkbox" name="optionValuesText[]" value="' . $current_value_id . '"' . $CHECKED . '>&nbsp;&nbsp;' . $current_value_name . '&nbsp;&nbsp;';
                                echo '<input type="hidden" name="' . $current_value_id . '_options_id" value="' . $current_product_option_id . '">';
                                
                        } else {

                        echo "<input type=\"checkbox\" name=\"optionValues[]\" value=\"" . $current_value_id . "\"" . $CHECKED . ">&nbsp;&nbsp;" . $current_value_name . "&nbsp;&nbsp;";
                        
                        }

                        echo "</td>";
                        echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_price\" value=\"" . $attribute_value_price . "\" size=\"10\"></td>";

                        if ( $optionTypeInstalled == "1" ) {
                                extraValues( $current_value_id, $current_product_id );

                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_prefix\" value=\"" . $attribute_prefix . "\" size=\"4\"></TD>";
                                echo "<td class=\"main\" align=\"left\"><select name=\"" . $current_value_id . "_type\">";
                                displayOptionTypes( $attribute_type );
                                echo "</select></td>";
                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_qty\" value=\"" . $attribute_qty . "\" size=\"4\"></td>";
                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_order\" value=\"" . $attribute_order . "\" size=\"4\"></td>";
                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_linked\" value=\"" . $attribute_linked . "\" size=\"4\"></td>";
                                echo "<td class=\"main\" align=\"left\">" . $current_value_id . "</td>";
                                
                        } else {

                                echo "<td class=\"main\" align=\"left\"><select name=\"" . $current_value_id . "_prefix\"> <option value=\"+\"" . $posCheck . ">+<OPTION value=\"-\"" . $negCheck . ">-</select></td>";
                                
                        if ( $optionSortCopyInstalled == "1" ) {
                                                               	
                                getSortCopyValues( $current_value_id, $current_product_id );

                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_weight\" value=\"" . $attribute_weight . "\" size=\"10\"></TD>";
                                echo "<td class=\"main\" align=\"left\"><select name=\"" . $current_value_id . "_weight_prefix\">";
                                sortCopyWeightPrefix( $attribute_weight_prefix );
                                echo "</select></td>";
                                echo "<td class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_sort\" value=\"" . $attribute_sort . "\" size=\"4\"></td>";
                                
                        }

                        }

                        echo "</tr>";

                        if ( $optionTypeTextInstalled == "1" && $current_value_id_old == $optionTypeTextInstalledID ) {

                           $tempTextID++;

                        }

                }
                
                if( $i == $matches2 ) { $i = "0"; }

           }

        } else {
          echo "<tr>";
          echo "  <td class=\"main\"><small>No values under this option.</small></td>";
          echo "</tr>";


   }

}
}

?>
      <tr>
        <td colspan="10" class="main"><br><?php echo tep_image_submit('button_save.gif', IMAGE_SAVE); ?>&nbsp;<?php echo $backLink; ?><img src="<?php echo $adminImages; ?>button_cancel.gif" border="0" alt=""></a></td>
      </tr>
    </table>
  </form></td>
</tr>

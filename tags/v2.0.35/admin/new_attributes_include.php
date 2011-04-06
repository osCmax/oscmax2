<TR>
<TD class="pageHeading" colspan="3"><?=$pageTitle?></TD>
</TR>
<FORM ACTION="<?php echo $PHP_SELF ?>" METHOD="POST" NAME="SUBMIT_ATTRIBUTES">
<INPUT TYPE="HIDDEN" NAME="current_product_id" VALUE="<?php echo $current_product_id ?>">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="change">
<?php

if ( $cPath ) echo "<INPUT TYPE=\"HIDDEN\" NAME=\"cPathID\" VALUE=\"" . $cPath . "\">";

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
        echo "<TR class=\"dataTableHeadingRow\">";
        echo "<TD class=\"dataTableHeadingContent\"><B>" . $current_product_option_name . "</B></TD>";
        echo "<TD class=\"dataTableHeadingContent\"><B>Value Price</B></TD>";
        echo "<TD class=\"dataTableHeadingContent\"><B>Price Prefix</B></TD>";
        
        if ( $optionTypeInstalled == "1" ) {
                
                echo "<TD class=\"dataTableHeadingContent\"><B>Option Type</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>Quantity</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>Order</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>Linked Attr.</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>ID</B></TD>";
                
        }
        
        if ( $optionSortCopyInstalled == "1" ) {
                                               	
                echo "<TD class=\"dataTableHeadingContent\"><B>Weight</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>Weight Prefix</B></TD>";
                echo "<TD class=\"dataTableHeadingContent\"><B>Sort Order</B></TD>";
                
        }

        echo "</TR>";
        
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
                        echo "<TR class=\"" . $rowClass . "\">";
                        echo "<TD class=\"main\">";

// Add Support for multiple text input option types (for Chandra's contribution).. and using ' to begin/end strings.. less of a mess.
                        if ( $optionTypeTextInstalled == "1" && $current_value_id == $optionTypeTextInstalledID ) {

                                $current_value_id_old = $current_value_id;
                                $current_value_id = $tempTextID;

                                echo '<input type="checkbox" name="optionValuesText[]" value="' . $current_value_id . '"' . $CHECKED . '>&nbsp;&nbsp;' . $current_value_name . '&nbsp;&nbsp;';
                                echo '<input type="hidden" name="' . $current_value_id . '_options_id" value="' . $current_product_option_id . '">';
                                
                        } else {

                        echo "<input type=\"checkbox\" name=\"optionValues[]\" value=\"" . $current_value_id . "\"" . $CHECKED . ">&nbsp;&nbsp;" . $current_value_name . "&nbsp;&nbsp;";
                        
                        }

                        echo "</TD>";
                        echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_price\" value=\"" . $attribute_value_price . "\" size=\"10\"></TD>";

                        if ( $optionTypeInstalled == "1" ) {
                                
                                extraValues( $current_value_id, $current_product_id );

                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_prefix\" value=\"" . $attribute_prefix . "\" size=\"4\"></TD>";
                                echo "<TD class=\"main\" align=\"left\"><SELECT name=\"" . $current_value_id . "_type\">";
                                displayOptionTypes( $attribute_type );
                                echo "</SELECT></TD>";
                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_qty\" value=\"" . $attribute_qty . "\" size=\"4\"></TD>";
                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_order\" value=\"" . $attribute_order . "\" size=\"4\"></TD>";
                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_linked\" value=\"" . $attribute_linked . "\" size=\"4\"></TD>";
                                echo "<TD class=\"main\" align=\"left\">" . $current_value_id . "</TD>";
                                
                        } else {

                                echo "<TD class=\"main\" align=\"left\"><SELECT name=\"" . $current_value_id . "_prefix\"> <OPTION value=\"+\"" . $posCheck . ">+<OPTION value=\"-\"" . $negCheck . ">-</SELECT></TD>";
                                
                        if ( $optionSortCopyInstalled == "1" ) {
                                                               	
                                getSortCopyValues( $current_value_id, $current_product_id );

                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_weight\" value=\"" . $attribute_weight . "\" size=\"10\"></TD>";
                                echo "<TD class=\"main\" align=\"left\"><SELECT name=\"" . $current_value_id . "_weight_prefix\">";
                                sortCopyWeightPrefix( $attribute_weight_prefix );
                                echo "</SELECT></TD>";
                                echo "<TD class=\"main\" align=\"left\"><input type=\"text\" name=\"" . $current_value_id . "_sort\" value=\"" . $attribute_sort . "\" size=\"4\"></TD>";
                                
                        }

                        }

                        echo "</TR>";

                        if ( $optionTypeTextInstalled == "1" && $current_value_id_old == $optionTypeTextInstalledID ) {

                           $tempTextID++;

                        }

                }
                
                if( $i == $matches2 ) { $i = "0"; }

           }

        } else {
          echo "<TR>";
          echo "<TD class=\"main\"><SMALL>No values under this option.</SMALL></TD>";
          echo "</TR>";


   }

}
}

?>
<TR>
<TD colspan="10" class="main"><BR><INPUT TYPE="image" src="<?php echo $adminImages ?>button_save.gif">&nbsp;&nbsp;&nbsp;<?=$backLink?><img src="<?php echo $adminImages ?>button_cancel.gif" border="0"></A></TD>
</TR>
</FORM>


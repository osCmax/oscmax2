<?php
// A simple little function to determine if the current value is already selected for the current product.
function checkAttribute( $current_value_id, $current_product_id, $current_product_option_id ) {
  global $attribute_value_price, $attribute_value_prefix, $posCheck, $negCheck;
  $query = "SELECT * FROM products_attributes where options_values_id = '$current_value_id' AND products_id = '$current_product_id' AND options_id = '$current_product_option_id'";
  $result = mysql_query($query) or die(mysql_error());
  $isFound = mysql_num_rows($result);
  if ($isFound) {
    while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $attribute_value_price = $line['options_values_price'];
      $attribute_value_prefix = $line['price_prefix'];
      if ($attribute_value_prefix == "+") { $posCheck = " selected";
                                            $negCheck = "";
                                              
      } else {                              $posCheck = "";
                                            $negCheck = " selected";
      } // end if
    } // end while
    return true; 


    } else {
    
    $attribute_value_price = ""; 
    $attribute_value_prefix = "";
    $posCheck = "";
    $negCheck = "";
    return false; 
  } // end if
} // end function

function rowClass($i){
    $class1 = "attributes-odd";
    $class2 = "attributes-even";

    if ( $i%2 ) {
        return $class1;
    } else {
        return $class2;
    } 
}

// For Options Type Contribution
function extraValues( $current_value_id, $current_product_id )
{
 global $attribute_qty, $attribute_order, $attribute_linked, $attribute_prefix, $attribute_type, $isSelected;

 if ( $isSelected ) {
                    	
        $query = "SELECT * FROM products_attributes where options_values_id = '$current_value_id' AND products_id = '$current_product_id'";

        $result = mysql_query($query) or die(mysql_error());

        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                	
                $attribute_qty = $line['options_values_qty'];
                $attribute_order = $line['attribute_order'];
                $attribute_linked = $line['collegamento'];
                $attribute_prefix = $line['price_prefix'];
                $attribute_type = $line['options_type_id'];

        }
        
 } else {
        	
        	$attribute_qty = "1";
        	$attribute_order = "100";
        	$attribute_linked = "0";
        	$attribute_prefix = "";
        	$attribute_type = "";
 }
 
}

function displayOptionTypes( $attribute_type )
{
 global $isSelected;

 $availableTypes = array( 'Disabled' => '0', 'Select' => '1', 'Checkbox' => '2', 'Radio' => '3', 'Select Multiple' => '4', 'Text' => '5' );
 
 foreach( $availableTypes as $name => $id ){
                                            	
        if ( $isSelected && $attribute_type == $id ) { $SELECT = " SELECTED"; }

        else { $SELECT = ""; }
                                                                                              	
        echo "<OPTION VALUE=\"" . $id . "\"" . $SELECT . ">" . $name;
        
 }

}

// Get values for Linda McGrath's contribution
function getSortCopyValues( $current_value_id, $current_product_id )
{
 global $attribute_sort, $attribute_weight, $attribute_weight_prefix, $isSelected;

 if ( $isSelected ) {
                    	
        $query = "SELECT * FROM products_attributes where options_values_id = '$current_value_id' AND products_id = '$current_product_id'";

        $result = mysql_query($query) or die(mysql_error());

        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                	
                $attribute_sort = $line['products_options_sort_order'];
                $attribute_weight = $line['products_attributes_weight'];
                $attribute_weight_prefix = $line['products_attributes_weight_prefix'];

        }
        
 } else {
        	
        	$attribute_sort = "0";
        	$attribute_weight = "";
        	$attribute_weight_prefix = "";
 }
 
}

function sortCopyWeightPrefix( $attribute_weight_prefix ) {
  global $isSelected;
  $availablePrefixes = array( '+', '-' );
  foreach( $availablePrefixes as $prefix ) {                                   	
    if ( $isSelected && $prefix == $attribute_weight_prefix ) {                                                           	
      $SELECT = " selected";         
    } else { 
      $SELECT = "";
    } // end if
  echo "<option value=\"" . $prefix . "\"" . $SELECT . ">" . $prefix;   
  } // end for      
} // end function
?>
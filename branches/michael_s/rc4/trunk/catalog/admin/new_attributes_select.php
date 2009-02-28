<tr>
  <td class="pageHeading" colspan="3"><?php $pageTitle ?></td>
</tr>
<form ACTION="<?php $PHP_SELF?>" NAME="SELECT_PRODUCT" METHOD="POST">
  <input TYPE="HIDDEN" NAME="action" VALUE="select">
    <tr>
    <td class=\"main\"><br><b>Please select a product to edit:<br></td>
    </tr>
    <tr>
    <td class=\"main\"><select NAME=\"current_product_id\">

<?php
  $query = "SELECT * FROM products_description where products_id LIKE '%' AND language_id = '$languageFilter' ORDER BY products_name ASC";
  $result = mysql_query($query) or die(mysql_error());
  $matches = mysql_num_rows($result);

  if ($matches) {

    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                           	
      $title = $line['products_name'];
      $current_product_id = $line['products_id'];

      echo "<OPTION VALUE=\"" . $current_product_id . "\">" . $title;

    }
  } else { echo "You have no products at this time."; }
  
?>
    </td></tr>
  </select>

  <tr>
    <td class=\"main\"><input type=\"image\" src=\"" . $adminImages . "button_edit.gif\"></td>
  </tr>
</form>


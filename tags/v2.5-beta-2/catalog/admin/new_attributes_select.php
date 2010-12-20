  <tr>
    <td class="pageHeading" colspan="3"><?php echo $pageTitle; ?></td>
  </tr>
<?php 
$query = tep_db_query("SELECT * FROM products_description where products_id LIKE '%' AND language_id = '$languageFilter' ORDER BY products_name ASC");
if (tep_db_num_rows($query) > 0) {
?>
  <tr>
    <td class="main"><b>Please select a product to edit:</b></td>
  </tr>
  <tr>
    <td class="main"><form action="<?php echo $PHP_SELF ?>" name="select_product" method="post"><input type="hidden" name="action" value="select">
    <?php
    echo "<select name=\"current_product_id\">";
    while ($line = tep_db_fetch_array($query)) {                            	
      echo "<option value=\"" . $line['products_id'] . "\">" . $line['products_name'];
    }
    echo "</select><br><br>";  
	echo tep_image_submit('button_edit.gif', IMAGE_EDIT); 
	?>
  </form></td>
</tr>

<?php } else { ?>
  <tr>
    <td> 
      <table width="100%">
        <tr>
          <td class="messageStackAlert">You do not have any products in your store at present.  <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>"><u>Click here</u></a> to create some.</td>
        </tr>
      </table>
    </td>
  </tr> 
<?php } ?>

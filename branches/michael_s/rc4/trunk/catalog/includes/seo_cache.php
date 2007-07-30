<?php
/*=======================================================================*\
|| #################### //-- SCRIPT INFO --// ########################## ||
|| #	Script name: includes/seo_cache.php
|| #	Contribution: Ultimate SEO URLs
|| #	Version: 2.0
|| #	Date: 30 January 2005
|| # ------------------------------------------------------------------ # ||
|| #################### //-- COPYRIGHT INFO --// ######################## ||
|| #	Copyright 2006 osCMax2005 Bobby Easland								# ||
|| #	Internet moniker: Chemo											# ||	
|| #	Contact: chemo@mesoimpact.com									# ||
|| #	Commercial Site: http://gigabyte-hosting.com/					# ||
|| #	GPL Dev Server: http://mesoimpact.com/							# ||
|| #																	# ||
|| #	This script is free software; you can redistribute it and/or	# ||
|| #	modify it under the terms of the GNU General Public License		# ||
|| #	as published by the Free Software Foundation; either version 2	# ||
|| #	of the License, or (at your option) any later version.			# ||
|| #																	# ||
|| #	This script is distributed in the hope that it will be useful,	# ||
|| #	but WITHOUT ANY WARRANTY; without even the implied warranty of	# ||
|| #	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the	# ||
|| #	GNU General Public License for more details.					# ||
|| #																	# ||
|| #	Script is intended to be used with:								# ||
|| #	osCMax Power E-Commerce					# ||
|| #	http://oscdox.com										# ||
|| #	Copyright 2006 osCMax									# ||
|| ###################################################################### ||
\*========================================================================*/

# strip functon
# if anyone can help with international translations please correct the file and upload
  function strip($convert_me) {
	$strip_array = array("&#39",chr(33),chr(34),chr(35),chr(36),chr(37),chr(38),chr(39),chr(40),chr(41),chr(42),chr(43),chr(44),chr(45),chr(46),chr(47),chr(58),chr(59),chr(60),chr(61),chr(62),chr(63),chr(91),chr(92),chr(93),chr(94),chr(95),chr(96),chr(123),chr(124),chr(125),chr(126) );  
	$convert_me = str_replace($strip_array, '', $convert_me);
	$convert_me = str_replace(array(' ', '  ', '__', '--'), '-', $convert_me);
	$convert_me = strtolower($convert_me);
	return $convert_me;
  }

	# Set the cache name
	$cache_file = $cache_dir . 'seo_urls_';	
	
	# if the cache is not stored in the database
	$cache->is_cached($cache_file . 'products', $is_cached, $is_expired);  	
	if ( !$is_cached || $is_expired ) { // it's not cached so create it
	# Query for the products
	$product_query = tep_db_query("select p.products_id, pd.products_name from products p left join products_description pd on p.products_id=pd.products_id and pd.language_id='".(int)$languages_id."' where p.products_status='1'");
	# Initialize the product array
	$prod_array = array();
	# Loop the returned rows
	while ($product = tep_db_fetch_array($product_query)) {
		$prod_array[$product['products_id']] = array('name' => strip($product['products_name']),
													 'id' => $product['products_id']);
	}
	# Free the memory - could be large, clean as we go!
	tep_db_free_result($product_query);
	# Initialize the container used to check for duplicate names
	$prod_container = array();
	# Loop the product array
	$prod_cache = '';
	foreach($prod_array as $record){
		$id = $record['id'];
		# If the product name hasn't been set		
		if ( !isset($prod_container[ $record['name'] ]) ){
			$name = $record['name'];
		} else { # This is a duplicate - get the counter and append
			# Increase the counter
			$prod_container[ $record['name'] ]['counter']++;
			$prod_counter = $prod_container[ $record['name'] ]['counter'];
			# Append the counter to the product name
			$name = $record['name'] . '-' . $prod_counter;
		}
		# Add the defines to the output string		
		$prod_cache .= 'define(\'PRODUCT_NAME_' . $id . '\', \'' . $name . '\'); ' . "\n";
		$prod_cache .= 'define(\'' . $name  . '\', \'products_id=' . $id . '\'); ' . "\n";
		# Add the product name to the container array
		$prod_container[$name] = array('name' => $name, 'counter' => 1);
	}
	# Save the cached data to database
	# Params: [ cache name, cache data, compressed, global ]
	$cache->save_cache($cache_file . 'products', $prod_cache, 'EVAL', 1 , 1);
	# Unset the variables used - could be large, clean as we go!
	unset($prod_array, $prod_container, $prod_cache);
	} # end if products is not cached

/************************************************************\
	End of the product definitions - start of the manufacturers
\************************************************************/	

	# if the cache is not stored in the database
	$cache->is_cached($cache_file . 'manufacturers', $is_cached, $is_expired);  	
	if ( !$is_cached || $is_expired ) { // it's not cached so create it
	# Query for the manufacturers
	$manufacturers_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name from manufacturers m left join manufacturers_info md on m.manufacturers_id=md.manufacturers_id and md.languages_id='".(int)$languages_id."'");
	# Initialize the product array
	$man_array = array();
	# Loop the returned rows
	while ($manufacturer = tep_db_fetch_array($manufacturers_query)) {
		$man_array[$manufacturer['manufacturers_id']] = array('name' => strip($manufacturer['manufacturers_name']),
													 'id' => $manufacturer['manufacturers_id']);
	}
	# Free the memory - could be large, clean as we go!
	tep_db_free_result($manufacturers_query);
	# Initialize the container used to check for duplicate names
	$man_container = array();
	# Loop the product array
	$man_cache = '';
	foreach($man_array as $record){
		$id = $record['id'];
		# If the product name hasn't been set		
		if ( !isset($man_container[ $record['name'] ]) ){
			$name = $record['name'];
		} else { # This is a duplicate - get the counter and append
			# Increase the counter
			$man_container[ $record['name'] ]['counter']++;
			$man_counter = $man_container[ $record['name'] ]['counter'];
			# Append the counter to the product name
			$name = $record['name'] . '-' . $man_counter;
		}
		# Add the defines to the output string		
		$man_cache .= 'define(\'MANUFACTURER_NAME_' . $id . '\', \'' . $name . '\'); ' . "\n";
		$man_cache .= 'define(\'' . $name  . '\', \'manufacturers_id=' . $id . '\'); ' . "\n";
		# Add the manufacturer name to the container array
		$man_container[$name] = array('name' => $name, 'counter' => 1);
	}
	# Save the cached data to database
	# Params: [ cache name, cache data, compressed, global ]
	$cache->save_cache($cache_file . 'manufacturers', $man_cache, 'EVAL', 1 , 1);
	# Unset the variables used - could be large, clean as we go!
	unset($man_array, $man_container, $man_cache);
	} # end if manufacturers is not cached

/************************************************************\
	End of the manufacturers definitions - start of the categories
\************************************************************/	
	
	# if the cache is not stored in the database
	$cache->is_cached($cache_file . 'categories', $is_cached, $is_expired);  	
	if ( !$is_cached || $is_expired ) { // it's not cached so create it
	# Query for the categories
	$category_query = tep_db_query("select c.categories_id, c.parent_id, c.sort_order, cd.categories_name from categories c left join categories_description cd on c.categories_id=cd.categories_id and cd.language_id='".(int)$languages_id."' order by c.parent_id, c.sort_order ASC");
	# Initialize the cat array
	$cat_array = array();
	# Loop the returned rows
	while ($category = tep_db_fetch_array($category_query)) {	
		$cat_array[$category['categories_id']] = array('name' => strip($category['categories_name']),
												  'id' => $category['categories_id'],
												  'parent' => $category['parent_id']);
	}
	# Free the memory - could be large, clean as we go!
	tep_db_free_result($category_query);
	# Initialize the container used to check for duplicate names
	$cat_container = array();
	# Loop the cat array
	$cat_cache = '';
	foreach ($cat_array as $record){
		$name = $record['name'];
		$id = $record['id'];
		# If the category name hasn't been set
		if ( !isset($cat_container[ $cat_array[$record['parent']]['name'] .'-'.$name ]) ){
			$parent_name = ($record['parent']=='0' ? '' : $cat_array[$record['parent']]['name'].'-');
		} else { # This is a duplicate category - get the counter and append
			# Increase the counter
			$cat_container[ $cat_array[$record['parent']]['name'] .'-'.$name ]['counter']++;
			$parent_counter = $cat_container[ $cat_array[$record['parent']]['name'] .'-'.$name ]['counter'];
			# Append the counter to the parent name
			$parent_name = ($record['parent']=='0' ? '' : $cat_array[$record['parent']]['name'].'-'.$parent_counter.'-');
		}
		# Initialize the array to hold the category path
		$c = array();
		# Get the category path
		tep_get_parent_categories($c, $record['id']);
		# For some reason it seems to return in reverse order so reverse the array
		$c = array_reverse($c);
		# Implode the array to get the full category path
		$id = (implode('_', $c) ? implode('_', $c) . '_' . $record['id'] : $record['id']);
		# Add the defines to the output string		
		$cat_cache .= 'define(\'CATEGORY_NAME_' . $id . '\', \'' . $parent_name . $name . '\'); ' . "\n";
		$cat_cache .= 'define(\'' . $parent_name . $name . '\', \'cPath=' . $id . '\'); ' . "\n";		
		# Add the category name to the container array 
		$cat_container[$parent_name . $name] = array('id' => $id, 'counter' => 1);
	}
	# Save the cached data to the database
	# Params: [ cache name, cache data, compressed, global ]
	$cache->save_cache($cache_file . 'categories', $cat_cache, 'EVAL', 1 , 1);
	# Unset the arrays used - could be large, clean as we go!
	unset($cat_array, $cat_container, $cat_cache);
	}# end if categories is not cached
?>
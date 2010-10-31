<?php

/**
 * The Feedmachine Solution
 *
 * Generate feeds for any product search engine, e.g. Google Product Search, PriceGrabber, BizRate,
 * DealTime, mySimon, Shopping.com, Yahoo! Shopping, PriceRunner.
 * @package the-feedmachine-solution
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 5.02
 * @link http://www.osc-solutions.co.uk/ osCommerce Solutions
 * @copyright Copyright 2005-, Lech Madrzyk
 * @author Lech Madrzyk
 */

/*
Google Product Search simple feed configuration for The Feedmachine Solution
----------------------------
This is quite a basic feed configuration and can be used to learn how to configure new feeds.

This should produce a valid Google Product Search feed, however you might require one that
is more sophistcated, in which case you should search "Feedmachine Configuration"
in the osCommerce Add-ons section (http://addons.oscommerce.com/)

Since configuring feeds is mostly intuative, without further ado here is the configuration followed
by some notes.
*/

$feed_config = array('name' => 'Google Product Search Simple Configuration',
                     'authors' => 'Lech', //list of authors
                     'filename' => 'google-product-search.txt', //default feed filename (this can be over-ridden by the user in the admin section)
                     'schema_version' => '2.0', //always set as '2.0' - this is set just to future-proof configurations in case the schema ever changes
                     //the following section of the feed configuration is the most important. It determines the fields that are output.
                     'fields' => array('id'               =>   array('output' => 'products_id',
                                                                     'type' => 'DB'
                                                                    ),
                                       'title'            =>   array('output' => 'products_name',
                                                                     'type' => 'DB',
                                                                     'options' => array('STRIP_HTML', 'HTML_ENTITIES', 'STRIP_CRLF')
                                                                    ),
                                       'price'            =>   array('output' => 'FINAL_PRICE',
                                                                     'type' => 'KEYWORD'
                                                                    ),
                                       'brand'            =>   array('output' => 'manufacturers_name',
                                                                     'type' => 'DB',
                                                                     'options' => array('STRIP_HTML', 'HTML_ENTITIES', 'STRIP_CRLF')
                                                                    ),
                                       'mpn'              =>   array('output' => 'products_model',
                                                                     'type' => 'DB'
                                                                    ),
                                       'product_type'     =>   array('output' => 'CATEGORY_TREE',
                                                                     'type' => 'KEYWORD',
                                                                     'options' => array('STRIP_HTML', 'STRIP_CRLF')
                                                                    ),
                                       'link'             =>   array('output' => 'PRODUCTS_URL',
                                                                     'type' => 'KEYWORD'
                                                                    ),
                                       'image_link'       =>   array('output' => 'IMAGE_URL',
                                                                     'type' => 'KEYWORD'
                                                                    ),
                                       'condition'        =>   array('output' => 'new',
                                                                     'type' => 'VALUE'
                                                                    ),
                                       'description'      =>   array('output' => 'products_description',
                                                                     'type' => 'DB',
                                                                     'options' => array('STRIP_HTML', 'HTML_ENTITIES', 'STRIP_CRLF')
                                                                    )
                                      ),
                     'add_field_names' => true, //whether to add header row in the feed with the field names
                     'seperator' => "\t", //the field separator in the feed. (For tab-delimited feeds this should be "\t". For csv feeds this should be ",")
                     'text_qualifier' => '', //the character with which to encapsulate field values. (For tab-delimited feeds this should usually be empty, i.e. ''. For csv feeds this should usually be '"')
                     'category_tree_seperator' => ' ', //the separator to use for the 'CATEGORY_TREE' KEYWORD (see the 'KEYWORD Field Type' section in the notes below)
                     //usually you will not need to worry about the following settings and can leave them as they are
                     'newline' => "\n",
                     'encoding' => 'utf8', //'utf8' or false for standard encoding
                     'currency_decimal_override' => false,
                     'currency_thousands_override' => '',
                     'include_record_function' => '' //(optional) specify a function that determines whether the product should be included in the feed
                    );

//FEED FUNCTIONS BEGIN

/*
The following include function (see explaination below) checks whether the product's quantity is greater than 0
This function is not used by default because many people do no have their stores configured for stock
To use this function, set include_record_function in feed configuration above to 'FM_UF_lm_stock_check'
*/
function FM_UF_lm_stock_check($product) {
  return $product['products_quantity'] > 0;
}

//FEED FUNCTIONS END

/*
Some notes about configuring feeds
----------------------------

You can start to create a new feed configuration by copying and modifying this file.

Field Output Types:

DB - A field from the database. You can specify any field from the products or products_description table as the output.
VALUE - A constant value. For example all of your products might be 'new', so you would want to output 'new' under 'condition' for every product
KEYWORD - See below
FUNCTION - Specify a user function for the output (see below)
     
KEYWORD Field Type:

When 'type' is set to 'KEYWORD'...

Keywords are used to generate important product information

PRODUCTS_URL - URL generation is done by osC, so you get to keep your SEO urls!
IMAGE_URL
CATEGORY - The name of the category in which the product resides
CATEGORY_PARENT - The name of the parent category of the product's category, or if there is no parent, the name of the product's category
CATEGORY_ROOT - The name of the root (i.e. top) category
CATEGORY_TREE - Nested category path (e.g. TopCat > SubCat > SubSubCat, etc) - The seperator (' > ' in this example) is determined by 'category_tree_seperator' in the feed configuration
BLANK
PRICE *
PRICE_WITH_TAX
PRICE_WITHOUT_TAX
FINAL_PRICE * (the product's price or if the product is in specials, it's special price)
FINAL_PRICE_WITH_TAX
FINAL_PRICE_WITHOUT_TAX
SPECIAL_PRICE * (returns the special price if it exists, otherwise returns blank)
SPECIAL_PRICE_WITH_TAX
SPECIAL_PRICE_WITHOUT_TAX

* Tax is added depending on whether osC is set to display product prices with tax and whether tax is configured. 99% of the time these
are the keywords to use for price since they will handle tax according to the store set-up.

User Functions:

For custom field output, you can define your own functions that take an array (called $product)
containing all database fields for a product (e.g. $product['products_name'] is the product's name') as their parameter.
The function should return the output you want.

To set one of the fields to use a user defined function do the following in the field's configuration:

      'title'            =>   array('name' => 'FM_UF_lm_product_title',  // where 'FM_UF_lm_product_title' is the name of the user function
                                    'type' => 'FUNCTION'
                                   ),

You should define user functions specific to a feed in that feed's configuration file with a name that
will be unique (Note: Two different functions are not allowed to have the same name).

It is recommended that all user functions begin with "FM_UF_[author_initials]".

Example user function definition:

function FM_UF_lm_product_title($product) {
  return $product['products_name'] . ' by CoolBrand';
}


Include Record Function (a type of "User Function"):

Set using 'include_record_function' in the feed configuration...

If set, Feedmachine will use this function to decide whether a product should be included.
The "Include Record Function" takes the $product array (as described above) as its parameter and should return true or false.


Filters (optional)

Setting the filters array for a field runs the function preg_replace (a PHP function that replaces strings matching patterns) with
the patterns and replacements arrays on the field's output. E.g.

       'title'            =>   array('output' => 'products_name',
                                     'type' => 'DB',
                                     'options' => array('STRIP_HTML', 'HTML_ENTITIES', 'STRIP_CRLF'),
                                     'filters' => array('patterns' => array('#badword#i'),
                                                        'replacements' => array('goodword'))
                                    ),

You can read about preg_replace here:
http://uk.php.net/manual/en/function.preg-replace.php

and about the pattern syntax here:

http://uk.php.net/manual/en/reference.pcre.pattern.syntax.php

--------------------
*/

?>
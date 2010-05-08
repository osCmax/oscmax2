<?php
// FILE: meta_tags.php
// USE : This file controls the title, meta description,
//       and meta keywords of every page on your web site.
//       See the install docs for instructions.

// define META_TEXT_PRICE in your includes/languages/english/index.php file if you want a price prefix
// so for example add: "define('META_TEXT_PRICE', 'Price: ');" to this index.php file (without the outer double quotes)
if(!defined('META_TEXT_PRICE')) define ('META_TEXT_PRICE', '');
// Define Primary Section Output
define('PRIMARY_SECTION', ' : ');
// Define Secondary Section Output
define('SECONDARY_SECTION', ' - ');
// Define Tertiary Section Output
define('TERTIARY_SECTION', ',  ');

// Optional customization options for each language
switch ($languages_id) {
// English language
  case '1':
    //Extra keywords that will be outputted on every page
    $mt_extra_keywords = '';
  	//Descriptive tagline of your web site
  	$web_site_tagline = TERTIARY_SECTION . '';
  	break;
  // German language
  case '2':
    //Extra keywords that will be outputted on every page
    $mt_extra_keywords = '';
  	//Descriptive tagline of your web site
  	$web_site_tagline = TERTIARY_SECTION . '';
  	break;
  // Spanish language
  case '3':
    //Extra keywords that will be outputted on every page
    $mt_extra_keywords = '';
  	//Descriptive tagline of your web site
  	$web_site_tagline = TERTIARY_SECTION . '';
  	break;
  }
  // Clear web site tagline if not customized
  if ($web_site_tagline == TERTIARY_SECTION) {
    $web_site_tagline = '';
  }
  // Get all top category names for use with web site keywords
  $mt_keywords_string ='';
  $mt_categories_query = tep_db_query("select cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."'");
  while ($mt_categories = tep_db_fetch_array($mt_categories_query))  {
    $mt_keywords_string .= $mt_categories['categories_name'] . ',';
  }
  define('WEB_SITE_KEYWORDS', $mt_keywords_string . $mt_extra_keywords);

  switch ($content) {
    case CONTENT_ADVANCED_SEARCH:
      define('META_TAG_TITLE', NAVBAR_TITLE_1 . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ADVANCED_SEARCH_RESULT:
      define('META_TAG_TITLE', NAVBAR_TITLE_2 . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_2 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_2);
    	break;
  //START UPDATE
    case CONTENT_ACCOUNT_EDIT:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ACCOUNT_HISTORY:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ACCOUNT_HISTORY_INFO:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ACCOUNT_NEWSLETTERS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ACCOUNT_NOTIFICATIONS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ACCOUNT_PASSWORD:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ADDRESS_BOOK:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ADDRESS_BOOK_PROCESS:
      define('META_TAG_TITLE', NAVBAR_TITLE_2 . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ADDRESS_BOOK_PROCESS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
// END UPDATE
    case CONTENT_ARTICLES:
      $mt_articles_query = tep_db_query("select articles_id, language_id, articles_head_title_tag from " . TABLE_ARTICLES_DESCRIPTION . " where articles_id = '" . (int)$_GET['articles_id'] . "' and language_id = '" . (int)$languages_id . "'");
      $mt_articles = tep_db_fetch_array($mt_articles_query);

      define('META_TAG_TITLE', $mt_articles['articles_head_title_tag'] . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $mt_articles['articles_head_title_tag'] . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_articles['articles_head_title_tag']);
      break;
    case CONTENT_ARTICLES_MAIN:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ARTICLES_REVIEWS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ARTICLES_REVIEWS_INFO:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ARTICLES_REVIEWS_WRITE:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_ARTICLES_NEW:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    	break;
    case CONTENT_CHECKOUT_CONFIRMATION:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_CHECKOUT_PAYMENT:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_CHECKOUT_PAYMENT_ADDRESS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_CHECKOUT_SHIPPING:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_CHECKOUT_SUCCESS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_CREATE_ACCOUNT_SUCCESS:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
    	break;
    case CONTENT_INDEX_DEFAULT:
      define('META_TAG_TITLE', TITLE . PRIMARY_SECTION . HEADING_TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
      break;
    case CONTENT_PASSWORD_FORGOTTEN:
      define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
      define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
      define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_TITLE);
      break;
    case CONTENT_INDEX_NESTED:
      $mt_category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$current_category_id . "' and language_id = '" . (int)$languages_id . "'");
      $mt_category = tep_db_fetch_array($mt_category_query);

      define('META_TAG_TITLE', $mt_category['categories_name'] . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $mt_category['categories_name'] . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_category['categories_name']);
      break;
    case CONTENT_INDEX_PRODUCTS:
      if (isset($_GET['manufacturers_id'])) {
    	  $mt_manufacturer_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
        $mt_manufacturer = tep_db_fetch_array($mt_manufacturer_query);

    	  define('META_TAG_TITLE', $mt_manufacturer['manufacturers_name'] . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	  define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $mt_manufacturer['manufacturers_name'] . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	  define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_manufacturer['manufacturers_name']);
    	} else {
        $mt_category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$current_category_id . "' and language_id = '" . (int)$languages_id . "'");
        $mt_category = tep_db_fetch_array($mt_category_query);

  	  define('META_TAG_TITLE', $mt_category['categories_name'] . PRIMARY_SECTION . TITLE . $web_site_tagline);
  	  define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $mt_category['categories_name'] . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
  	  define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_category['categories_name']);
      }
      break;
    case CONTENT_POPUP_IMAGE:
      define('META_TAG_TITLE', $products['products_name'] . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $products['products_name'] . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $products['products_name']);
      break;
    case CONTENT_POPUP_SEARCH_HELP:
      define('META_TAG_TITLE', HEADING_SEARCH_HELP . PRIMARY_SECTION . TITLE . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . HEADING_SEARCH_HELP . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . HEADING_SEARCH_HELP);
      break;
    case CONTENT_PRODUCT_INFO:
//BOF - SPPC
      if (tep_session_is_registered('sppc_customer_group_id')){
        $mt_product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, pg.customers_group_price as products_price, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd , " . TABLE_PRODUCTS_GROUPS . " pg where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and p.products_id = pg.products_id and pg.customers_group_id = '" . $sppc_customer_group_id . "' and pd.language_id = '" . (int)$languages_id . "'");
      }
      $mt_product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_price, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
//EOF - SPPC
      $mt_product_info = tep_db_fetch_array($mt_product_info_query);

      if ($mt_new_price = tep_get_products_special_price($mt_product_info['products_id'])) {
        // $mt_products_price = $currencies->display_price($mt_product_info['products_price'], tep_get_tax_rate($mt_product_info['products_tax_class_id'])) . $currencies->display_price($mt_new_price, tep_get_tax_rate($mt_product_info['products_tax_class_id']));
        // only display special price in meta tag title if it's a special
        $mt_products_price = $currencies->display_price($mt_new_price, tep_get_tax_rate($mt_product_info['products_tax_class_id']));
      } else {
        $mt_products_price = $currencies->display_price($mt_product_info['products_price'], tep_get_tax_rate($mt_product_info['products_tax_class_id']));
      }

      if (tep_not_null($mt_product_info['products_model'])) {
        $mt_products_name = $mt_product_info['products_name'] . ' [' . $mt_product_info['products_model'] . ']';
      } else {
        $mt_products_name = $mt_product_info['products_name'];
      }

    	$mt_products_description = substr(strip_tags(stripslashes($mt_product_info['products_description'])), 0, 100);
      $mt_products_price = META_TEXT_PRICE . strip_tags($mt_products_price);

      define('META_TAG_TITLE', TITLE . PRIMARY_SECTION . $mt_products_name . SECONDARY_SECTION . $mt_products_price . $web_site_tagline);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . $mt_products_name . SECONDARY_SECTION . $mt_products_description . '...');
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_products_name);
      break;
    case CONTENT_PRODUCT_REVIEWS:
      $mt_review_query = tep_db_query("select p.products_id, pd.products_name, p.products_model, p.products_price, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
      $mt_review = tep_db_fetch_array($mt_review_query);

      if ($mt_new_price = tep_get_products_special_price($mt_review['products_id'])) {
        $mt_products_price = $currencies->display_price($mt_review['products_price'], tep_get_tax_rate($mt_review['products_tax_class_id'])) . $currencies->display_price($mt_new_price, tep_get_tax_rate($mt_review['products_tax_class_id']));
      } else {
        $mt_products_price = $currencies->display_price($mt_review['products_price'], tep_get_tax_rate($mt_review['products_tax_class_id']));
      }

      if (tep_not_null($mt_review['products_model'])) {
        $mt_products_name = $mt_review['products_name'] . ' [' . $mt_review['products_model'] . ']';
      } else {
        $mt_products_name = $mt_review['products_name'];
      }

      $mt_products_price = META_TEXT_PRICE . strip_tags($mt_products_price);
      define('META_TAG_TITLE', TITLE . PRIMARY_SECTION . $mt_products_name . SECONDARY_SECTION . $mt_products_price . TERTIARY_SECTION . NAVBAR_TITLE);
    	define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE . SECONDARY_SECTION . $mt_products_name . SECONDARY_SECTION . $mt_products_price);
    	define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_products_name);
      break;
    case CONTENT_PRODUCT_REVIEWS_INFO:
      $mt_review_query = tep_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, p.products_id, p.products_price, p.products_tax_class_id, p.products_model, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and r.products_id = p.products_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '". (int)$languages_id . "'");
      $mt_review = tep_db_fetch_array($mt_review_query);

      if ($mt_new_price = tep_get_products_special_price($mt_review['products_id'])) {
        $mt_products_price = $currencies->display_price($mt_review['products_price'], tep_get_tax_rate($mt_review['products_tax_class_id'])) . $currencies->display_price($mt_new_price, tep_get_tax_rate($mt_review['products_tax_class_id']));
      } else {
        $mt_products_price = $currencies->display_price($mt_review['products_price'], tep_get_tax_rate($mt_review['products_tax_class_id']));
      }

      if (tep_not_null($mt_review['products_model'])) {
        $mt_products_name = $mt_review['products_name'] . ' [' . $mt_review['products_model'] . ']';
      } else {
        $mt_products_name = $mt_review['products_name'];
      }

      $mt_review_text = substr(strip_tags(stripslashes($mt_review['reviews_text'])), 0, 60);
      $mt_reviews_rating = SUB_TITLE_RATING . ' ' . sprintf(TEXT_OF_5_STARS, $mt_review['reviews_rating']);

      $mt_products_price = META_TEXT_PRICE . strip_tags($mt_products_price);
      define('META_TAG_TITLE', $mt_products_name . SECONDARY_SECTION . $mt_products_price . PRIMARY_SECTION . TITLE . TERTIARY_SECTION . NAVBAR_TITLE);
      define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE . SECONDARY_SECTION . $mt_products_name . SECONDARY_SECTION . $mt_review['customers_name'] . SECONDARY_SECTION . $mt_review_text . '...' . SECONDARY_SECTION . $mt_reviews_rating);
      define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . $mt_products_name . ' ' . $mt_products_price . ' ' . $mt_review['customers_name'] . ' ' . $mt_reviews_rating);
      break;
    default:
      define('META_TAG_TITLE', NAVBAR_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
      define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
      define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE);
  case CONTENT_WISHLIST:
    define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    break;
  case CONTENT_WISHLIST_HELP:
    define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    break;
  case CONTENT_WISHLIST_SEND:
    define('META_TAG_TITLE', HEADING_TITLE . PRIMARY_SECTION . TITLE . $web_site_tagline);
    define('META_TAG_DESCRIPTION', TITLE . PRIMARY_SECTION . NAVBAR_TITLE_1 . SECONDARY_SECTION . WEB_SITE_KEYWORDS);
    define('META_TAG_KEYWORDS', WEB_SITE_KEYWORDS . NAVBAR_TITLE_1);
    break;
}

// BOF: Remove & Prevent duplicate content with the canonical tag V1.3.2
CanonicalLink( $xhtml = false, 'SSL' ); 
// EOF: Remove & Prevent duplicate content with the canonical tag V1.3.2

?>

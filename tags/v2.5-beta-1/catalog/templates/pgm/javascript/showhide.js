jQuery(document).ready(function() {
 // hides the slickbox as soon as the DOM is ready
 // (a little sooner than page load)
  jQuery('#slickbox').hide();
  jQuery('#hideb').hide();


 // shows the slickbox on clicking the noted link  
  jQuery('a#slick-show').click(function() {
    jQuery('#showb').hide();
    jQuery('#hideb').show();
    jQuery('#slickbox').slideDown('slow');
    return false;
  });

 // hides the slickbox on clicking the noted link  
  jQuery('a#slick-hide').click(function() {
    jQuery('#showb').show();
    jQuery('#hideb').hide();
    jQuery('#slickbox').slideUp('slow');
    return false;
  });
});
<!--// SHOW HIDE BASKET v2-->
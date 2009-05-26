
Graphic Customization of your osCMax AABox template
######################################
Please note:
This explanation only applies to OSC stores running the Template
Contribution - standard on OSCMAX.

*****BACK UP! BACK UP! BACK UP!*****
Ensure you back up your database before starting and where files are overwritten
with new ones - keep a copy of the originals by renaming the original files like this:
stylesheet.css > rename as stylesheetTODAYS_DATE.css
so you have a copy and can readily identify it if ever required.


The graphics customization consists of the following files:

GRAPHIC FILES:
catalog/images/OSCMAX_bg.gif [page backround used by stylesheet]
catalog/images/OSCMAX_box_bg.jpg [background of central area]
catalog/images/OSCMAX_footer.jpg [footer graphic]
catalog/images/OSCMAX_infobox-bg.gif [infobox backgrounds used by stylesheet]
catalog/images/OSCMAX_top.jpg [single large graphic at in header area]
catalog/images/OSCMAX_top_low.jpg [grpahic under breadcrumb trail]

By simply replacing OSCMAX_top.jpg & OSCMAX_top_low.jpg you can already
customize your store.

Buttons are tucked away in:
catalog/includes/language/english/images/buttons

TEMPLATE:
catalog/templates/main_page.tpl.php [Back up old one!]
This one file controls the width of the whole store and contains the HTML code for the
tables that include the header, footer and body of every page.
You will see commented lines like this:
<!--- comment //--> within 'main_page.tpl.php' explaining changes made such as
restricting the size of the store to 750 pixels width - remove those lines to have a
100% wide store (but the standard graphics will no longer fit and you will need to supply
new graphics).

STYLESHEET:
catalog/stylesheet.css [Back up old one!]

KNOWN ISSUES:
The product in the default osc database 'Microsoft IntelliMouse' in the 'Notifications'
infobox in right column forces the width of the right column beyond the default 125 pixels.
Remedy for your own products 1) keep names short 2) remove 'Notifications' infobox from store
(in catalog/includes/column_right.php change line:
     include(DIR_WS_BOXES . 'product_notifications.php');
to:
//     include(DIR_WS_BOXES . 'product_notifications.php');
3) make notifications image smaller/remove it
4) amend product_notications.php to make the image above text

The three images
catalog/images/infobox/corner_left.gif
catalog/images/infobox/corner_right.gif
catalog/images/infobox/corner_right_left.gif
are for the square or curved corners of the infobox and are grey in the standard setup.
You can remake these in the color of your choice, but the spacing is best controlled in the
stylesheet by adding 'padding-left : 4px;' to TD.infoBoxHeading and replacing the 3 corner images
with a 1pixel x 1 pixel transparent gif (this saves removing the reference in each infobox).
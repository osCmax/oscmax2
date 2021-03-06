/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

function SetFocus() {
  if (document.forms.length > 0) {
    isNotAdminLanguage:
    for (f=0; f<document.forms.length; f++) {
      if ( (document.forms[f].name != "languages") && (document.forms[f].name != "search_customers") && (document.forms[f].name != "search_products") && (document.forms[f].name != "search_orders") ) {
        var field = document.forms[f];
        for (i=0; i<field.length; i++) {
          if ( (field.elements[i].type != "image") &&
               (field.elements[i].type != "hidden") &&
               (field.elements[i].type != "reset") &&
               (field.elements[i].type != "submit") ) {

            document.forms[f].elements[i].focus();

            if ( (field.elements[i].type == "text") || (field.elements[i].type == "password") )
              document.forms[f].elements[i].select();

            break isNotAdminLanguage;
          }
        }
      }
    }
  }
}

function rowOverEffect(object) {
  if (object.className == 'dataTableRow') object.className = 'dataTableRowOver';
  if (object.className == 'dataTableRowAlert') object.className = 'dataTableRowOverAlert';
  if (object.className == 'dataTableRowWarning') object.className = 'dataTableRowOverWarning';
}

function rowOutEffect(object) {
  if (object.className == 'dataTableRowOver') object.className = 'dataTableRow';
  if (object.className == 'dataTableRowOverAlert') object.className = 'dataTableRowAlert';
  if (object.className == 'dataTableRowOverWarning') object.className = 'dataTableRowWarning';
}
function toggleDivBlock(id) {
  if (document.getElementById) {
    itm = document.getElementById(id);
  } else if (document.all){
    itm = document.all[id];
  } else if (document.layers){
    itm = document.layers[id];
  }

  if (itm) {
    if (itm.style.display != "none") {
      itm.style.display = "none";
    } else {
      itm.style.display = "block";
    }
  }
}

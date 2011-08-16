/**
 * osCommerce: JS OSCFieldSuggest
 *
 * File: includes/class.OSCFieldSuggestjs
 * Version: 1.0
 * Date: 2007-03-28 17:49
 * Author: Timo Kiefer - timo.kiefer_(at)_kmcs.de
 * Organisation: KMCS - www.kmcs.de
 * Licence: General Public Licence 2.0
 */

/**
 * The field gots a suggestlist..
 *
 * @param id please give your fields an ID
 * @param file_layout the xslt document
 * @param file_data the xml document, that will be generated
 * @example
 *   var myFieldSuggestion = new OSCFieldSuggest('search_field_id', 'includes/search_suggest.xsl', 'searchsuggest.php');
 *   //params will be automatically added like searchsuggest.php?myformfieldname=myformfieldvalue
 */

function OSCFieldSuggest(id, file_layout, file_data) {
  base = this;
  base.FILE_XSLT_LAYOUT = file_layout;
  base.FILE_XML_DATA = file_data;
  base._OBJ = document.getElementById(id);
  if(base._OBJ) {
    //define the functions..
    base.createXmlHttpRequest = function() {
      var requestInstance = false;
      if (window.XMLHttpRequest) { //FE
        requestInstance = new XMLHttpRequest();
        if (requestInstance.overrideMimeType) {
          requestInstance.overrideMimeType('text/xml');
        }
      } else if (window.ActiveXObject) { // IE
        try {
          requestInstance = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try { //last chance..
            requestInstance = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e) {}
        }
      }
      if(!requestInstance) {
        alert("Sorry, your browser don't support a little bit of AJAX");
      }
      return(requestInstance);
    };
    base.loadDocument = function(file, funcAfterDocumentLoaded) {
      var myRequest = base.createXmlHttpRequest();
      myRequest.open('GET', file, true);
      myRequest.onreadystatechange = function(e) {
        if(myRequest.readyState == 4 && myRequest.status == 200) {
          funcAfterDocumentLoaded(myRequest);
        } else if(myRequest.readyState == 4) {
          //error file isn't loaded.. 
          //alert("Sorry, the file " + file + " couldn't loaded!");
        }
      };
      myRequest.send(null);
    };
    base.parseXmlDocument = function(xsltLayout, xmlData) {
      if(document.all) {
        return(xmlData.transformNode(xsltLayout));
      } else {
        var processor = new XSLTProcessor();
        processor.importStylesheet(xsltLayout);
        var result = processor.transformToDocument(xmlData);
        var xmls = new XMLSerializer();
        return(xmls.serializeToString(result));
      }
    };
    base.getDocumentOffsetTop = function(obj) {
      return(parseInt(obj.offsetTop) + ((obj.offsetParent) ? base.getDocumentOffsetTop(obj.offsetParent) : 0));
    };
    base.getDocumentOffsetLeft = function(obj) {
      return(parseInt(obj.offsetLeft) + ((obj.offsetParent) ? base.getDocumentOffsetLeft(obj.offsetParent) : 0));
    };
    base.show = function() {
      base._OBJ_panel.style.visibility = 'visible';
    };
    base.hide = function() {
      base._OBJ_panel.style.visibility = 'hidden';
    };
    base.suggestList = function() {
      base.loadDocument(base.FILE_XML_DATA + "?" + base._OBJ.name + "=" + base._OBJ.value, function(request) {
        base._OBJ_panel.innerHTML = base.parseXmlDocument(base._xsltSheet, request.responseXML);
        base._OBJ_panel.style.top = (base.getDocumentOffsetTop(base._OBJ) + base._OBJ.offsetHeight) + "px";
        base._OBJ_panel.style.left = base.getDocumentOffsetLeft(base._OBJ) + "px";
        base.show();
      }); 
    };
    //load xslt layout
    base.loadDocument(base.FILE_XSLT_LAYOUT, function(request) {
      base._xsltSheet = request.responseXML;
    });
    //create html panel to show
    base._OBJ_panel = document.createElement('div');
    base._OBJ_panel.style.visibility = 'hidden';
    base._OBJ_panel.style.position = 'absolute';
    base._OBJ_panel.style.overflow = 'auto';
    base._OBJ_panel.style.height = '';
    base._OBJ_panel.style.border = '1px solid #333333';
    base._OBJ_panel.style.top = 0 + "px";
    base._OBJ_panel.style.left = 0 + "px";
    base._OBJ.parentNode.appendChild(base._OBJ_panel);
    //set the events
    base._OBJ.onkeyup = function(e) {
      if(base._OBJ.value.length > 0) {
        base.suggestList();
      }
    };
    base._OBJ.onblur = function(e) { //lost focus
      //waiting a few milli sec. .. before hide the clicked panel ;)
      setTimeout(function() {
        base.hide();
      }, 500);
    };
    base._OBJ.onfocus = function(e) { //got focus
      if(base._OBJ.value.length > 0) {
        base.suggestList();
      }
    };
  } else {
    //no field found..
    alert("Field with ID " + id + " couldn't found!");
  }
};
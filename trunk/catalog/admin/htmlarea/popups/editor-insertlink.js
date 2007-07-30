 replace the whatever you have between the comment lines:
 
 // insert link (modified) 
 	
 	{current createlink function}
 
 // insert image
    
 with the code below:
  
 ======================================================= 
    
    if (cmdID.toLowerCase() == 'createlink') {
    	var theRange = editdoc.selection.createRange();
    	
    	var highlightedText = "";
	var linkText = '';
    	
    	var href_attribute = '';
    	var tar_attribute = '';
    	
    	var elmSelectedImage;
    	var htmlSelectionControl = "Control";
    	if (editdoc.selection.type == htmlSelectionControl) {
    		// actully we have an image.
    		elmSelectedImage = theRange.item(0);
    		highlightedText = elmSelectedImage.outerHTML;
    		
    		//convert the ControlRange to a TextRange
    		theRange = editdoc.body.createTextRange();
		theRange.moveToElementText(elmSelectedImage);
    		theRange.select();
    		
    		fullElement = theRange.htmlText;
    	} else {
    		highlightedText = theRange.htmlText;
    		fullElement = theRange.parentElement().outerHTML;
	}
	
	//in case we happen to select the link itself!
	if (highlightedText.search(/^\<[A|a]/) != -1) {
		fullElement = highlightedText;
	}
	
	//extrect attributes from HTML
	if (fullElement.search(/^\<[A|a]/) != -1) {

		fullElement = fullElement.replace(/\"/g, "");
		fullElement = fullElement.replace(/\'/g, "");

		// here, we have an <a> tag. Now let's extract... 
		// 1. the href attribute
		var href_value = fullElement.split(/href=/);
		href_value2 = href_value[1].split(/\s|>/);
		href_attribute = href_value2[0];

		// 2. the target attribute
		if (fullElement.search(/target=/) != -1) {
			var tar = fullElement.split(/target=/);
			tar2 = tar[1].split(/\s|>/);
			tar_attribute = tar2[0];
		}

		// 3. the link text (more robust as includes all html code aswell)
		pos1 = fullElement.indexOf(">");
		pos2 = fullElement.lastIndexOf("<");
		linkText = fullElement.substring(pos1+1,pos2);
	}
    	
    	var myValues = new Object();
    	myValues.highlightedText = highlightedText;
    	myValues.tar_attribute = tar_attribute;
    	myValues.href_attribute = href_attribute;
    	myValues.linkText = linkText;
    
    	var myText = showModalDialog(_editor_url + "popups/insert_link.html", myValues, "status=no; scroll=no");
    
    	if (linkText != '') { 
    		if (myText) { 
    			theRange.parentElement().outerHTML = '';
    			editor_insertHTML(objname, unescape( myText) );
    		}
    	} else {
    		if (myText) { 
    			//if (editdoc.selection.type == htmlSelectionControl) {
    			//	theRange.execCommand('Delete');
    			//}
    			editor_insertHTML(objname, unescape(myText) ); // this function ALWAYS puts in an absolute link 
    		} 
    	}
    
    }


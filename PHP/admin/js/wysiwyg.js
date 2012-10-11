function insertTag(startTag, endTag, textareaId, tagType) {
	var field = document.getElementById(textareaId);
	var scroll = field.scrollTop;
	field.focus();
	
	
	if (window.ActiveXObject) {
		var textRange = document.selection.createRange();            
		var currentSelection = textRange.text;
	} else {
		var startSelection   = field.value.substring(0, field.selectionStart);
		var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
		var endSelection     = field.value.substring(field.selectionEnd);
	}
	
	if (tagType) {
		switch (tagType) {
			case "link":
					endTag = "</a>";
					if (currentSelection) {
							if (currentSelection.indexOf("http://") == 0 || currentSelection.indexOf("https://") == 0 || currentSelection.indexOf("ftp://") == 0 || currentSelection.indexOf("www.") == 0) {
									var label = prompt("What is the text of the link ?") || "";
									startTag = "<a href=\"" + currentSelection + "\">";
									currentSelection = label;
							} else {
									var URL = prompt("What is the url ?");
									startTag = "<a href=\"" + URL + "\">";
							}
					} else {
							var URL = prompt("What is the url ?") || "";
							var label = prompt("What is the text of the link ?") || "";
							startTag = "<a href=\"" + URL + "\">";
							currentSelection = label;                     
					}
			break;
			case "image":
					endTag = "\" />";
							var addressemail = prompt("What is the image URL ?") || "";
							startTag = "<img src=\"" + addressemail;
			break;
			
			case "email":
					endTag = "[/mail]";
							var addressemail = prompt("What is the address email ?") || "";
							var label = prompt("What is the text of the email ?") || "";
							startTag = "[mail=" + addressemail + "]";
							currentSelection = label; 
			break;
		}
	}
	
	if (window.ActiveXObject) {
		textRange.text = startTag + currentSelection + endTag;
		textRange.moveStart('character', -endTag.length-currentSelection.length);
		textRange.moveEnd('character', -endTag.length);
		textRange.select();  
	} else { // Ce n'est pas IE
		field.value = startSelection + startTag + currentSelection + endTag + endSelection;
		field.focus();
		field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
	}  
	
	field.scrollTop = scroll;   
}
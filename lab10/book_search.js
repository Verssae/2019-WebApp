window.onload = function() {
	
    $("b_xml").onclick=function(){
			//construct a Prototype Ajax.request object
		new Ajax.Request("books.php", {
			method: "get",
			parameters: {category: getCheckedRadio($$('input'))},
			onSuccess: showBooks_XML,
			onFailure: ajaxFailed
		});

    }
    $("b_json").onclick=function(){
			//construct a Prototype Ajax.request object
		new Ajax.Request("books_json.php", {
			method: "get",
			parameters: {category: getCheckedRadio($$('input'))},
			onSuccess: showBooks_JSON,
			onFailure: ajaxFailed
		});
	
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var books = ajax.responseXML.getElementsByTagName("book");
	var ul =  $("books")
	ul.innerHTML = ""
	for (var i=0; i<books.length; i++) {
		var title = books[i].getElementsByTagName("title")[0].firstChild.nodeValue;
		var author = books[i].getElementsByTagName("author")[0].firstChild.nodeValue;
		var year = books[i].getElementsByTagName("year")[0].firstChild.nodeValue;
		ul.innerHTML +=  '<li>' + title + ', '+ author + ', '+ year + ', ' + '</li>'
	}
}

function showBooks_JSON(ajax) {
	var data = JSON.parse(ajax.responseText);
	var ul =  $("books")
	ul.innerHTML = ""
	for (var i=0; i<data.books.length; i++) {
		ul.innerHTML += "<li>" + data.books[i].title + ", by " + data.books[i].author + " (" + data.books[i].year + ") </li>";
	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}

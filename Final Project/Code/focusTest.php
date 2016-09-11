<!DOCTYPE html>
<html>
<body onload="checkFocus()">

<input type="text" id="myText" value="" onload="checkFocus()">

<p>Click the buttons to give focus and/or remove focus from the text field.</p>

<button type="button" onclick="getFocus()">Get focus</button>
<button type="button" onclick="loseFocus()">Lose focus</button>

<script>
function getFocus() {
    document.getElementById("myText").focus();
    alert(document.getElementById("myText").value);
    //alert("extesrfsdagf");
}

function loseFocus() {
    document.getElementById("myText").blur();
}
function checkFocus() {
    document.getElementById("myText").focus();
    while(True){
	if(document.getElementById("myText").value != ""){
		document.getElementById("myText").value = "Hello";
		alert(document.getElementById("myText").value);
		break;
	}
    }
    document.getElementById("myText").blur();
}
function poll(){
    var dfd = new Deferred();
    interval
}
</script>

</body>
</html>


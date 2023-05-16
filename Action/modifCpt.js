document.getElementById('modiForm').addEventListener('submit', function(e){
	validation=true
    if(! document.getElementById("1").value.match(/^[^"'`<>]+$/)){
		validation=false;
		alert("message: caractères interdits '`<>"+'"');
	}
    if(!validation){
		e.preventDefault()
	}
});
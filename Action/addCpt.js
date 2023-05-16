document.getElementById('addForm').addEventListener('submit', function(e){
	validation=true
    if(! document.getElementById("1").value.match(/^[^"'`<>]+$/)){
		validation=false;
		alert("message: caractères interdits '`<>"+'"');
		}
    if(! document.getElementById("2").value.match(/^[^"'`<>]+$/)){
		validation=false;
		alert("message: caractères interdits '`<>"+'"');
	}
    if(! document.getElementById("3").value.match(/^[^"'`<>]([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/)){
		validation=false;
		alert("message: indiquez une addresse mail");
	}
    if(! document.getElementById("4").value.match(/^[^"'`<>]+$/)){
		validation=false;
		alert("message: caractères interdits '`<>"+'"');
	}
    if(!validation){
		e.preventDefault()
	}
});
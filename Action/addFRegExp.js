document.getElementById('ff').addEventListener('submit', function(e){
	validation=true
    if(! document.getElementById("1").value.match(/^\d+$/) && ! document.getElementById("1").value.match(/^$/)){
		validation=false;
		alert("message: indiquez un nombre entier");
		}
    if(! document.getElementById("2").value.match(/^\d+$/) && ! document.getElementById("2").value.match(/^$/)){
		validation=false;
		alert("message: indiquez un nombre entier");
	}
    if(! document.getElementById("3").value.match(/^\d+$/) && ! document.getElementById("3").value.match(/^$/)){
		validation=false;
		alert("message: indiquez un nombre entier");
	}
    if(! document.getElementById("4").value.match(/^\d+$/) && ! document.getElementById("4").value.match(/^$/)){
		validation=false;
		alert("message: indiquez un nombre entier");
	}
    if(!validation){
		e.preventDefault()
	}
});
document.getElementById('hf').addEventListener('submit', function(e){
	validation=true
    if(! document.getElementById("5").value.match(/^[^"'`<>]+$/) && ! document.getElementById("5").value.match(/^$/)){
		validation=false;
		alert("message: caractères interdits '`<>"+'"');
	}
    if(! document.getElementById("6").value.match(/^\d+$/) && ! document.getElementById("6").value.match(/^$/)){
		validation=false;
		alert("message: indiquez un nombre entier");
	}
    if(! document.getElementById("7").value.match(/^\d{2}\/\d{2}\/\d{4}$/) && ! document.getElementById("7").value.match(/^$/)){
		validation=false;
		alert("message: date au format jj/mm/YYYY");
	}
    if(!validation){
		e.preventDefault()
	}
});
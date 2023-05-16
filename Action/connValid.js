document.getElementById('form1').addEventListener('submit', function(e){
	validation=true
    if(! document.getElementById("login").value.match(/^[^"'`<>]([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/)){
		validation=false
		document.getElementById("erreurLogin").style.visibility = 'visible';
	}else{
		document.getElementById("erreurLogin").style.visibility = 'hidden';
	}
    if(! document.getElementById("mdp").value.match(/^[^"'`<>]+$/)){
		validation=false
		document.getElementById("erreurMdp").style.visibility = 'visible';
	}else{
		document.getElementById("erreurMdp").style.visibility = 'hidden';
	}

    if(!validation){
		e.preventDefault()
	}
});
function loadContent(content) {
    $(document).ready(function(){
        //Charge les éléments depuis la page "une/url" et les insère dans #ajaxReceiver
        console.log("request for "+content);
        $("#ajaxReceiver").load("Views/"+content+".php");
    });
}
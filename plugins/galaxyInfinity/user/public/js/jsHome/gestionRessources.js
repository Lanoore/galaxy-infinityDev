class ressources{

    constructor(){
        this.afficheAllRessources();

    }



    afficheAllRessources(){

        setInterval(function(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {   
                    var allRessources = JSON.parse(this.responseText);
                    allRessources.forEach(function(objet){

                    var ressource = document.getElementById(objet.idRessource).innerHTML = objet.nomRessource+' : '+objet.nombreRessource;
                    })
                }
            };
            xmlhttp.open("GET", "index.php?galaxyInfinity=getAllRessources", true);
            xmlhttp.send(); 
        
        },2000);
    }   


}
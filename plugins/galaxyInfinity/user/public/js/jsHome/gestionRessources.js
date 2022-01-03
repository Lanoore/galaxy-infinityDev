class ressources{

    constructor(){
        this.afficheAllRessources();

    }



    afficheAllRessources(){

        var tierSelect = this.$_GET('tierSelect');


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

            xmlhttp.open("GET", "index.php?galaxyInfinity=getAllRessources&tierSelect="+tierSelect, true);
            xmlhttp.send(); 
        
        },2000);
    }   


    $_GET(param) {
        var vars = {};
        window.location.href.replace( location.hash, '' ).replace( 
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );
    
        if ( param ) {
            return vars[param] ? vars[param] : null;	
        }
        return vars;
    }

}
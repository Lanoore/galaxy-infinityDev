class bat{

    constructor(){

        this.afficheBatEnCours();
        
        this.timeId;
    }

    afficheBatEnCours(){
        var that = this;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var construEnCours = JSON.parse(this.responseText);

                if(construEnCours[0].idBat != null){
                    var dateFin = construEnCours[0].finBatActuel;
                    var dateActuel = new Date();
                    dateActuel = dateActuel.getTime() /1000;
                    that.tempsRestant = Math.round(dateFin - dateActuel);
                    that.nomBat = construEnCours[0].nomBat;
                    that.niveauBat = construEnCours[0].niveauBat;
                    if(dateFin != null && that.tempsRestant > 0){
                        that.timeId = setTimeout(that.decompteConstru.bind(that),1000);
                    }
                }
            }
        
        };
        xmlhttp.open("GET", "index.php?galaxyInfinity=getConstruBatJs", true);
        xmlhttp.send(); 
        
    }


    decompteConstru(){


        if (this.tempsRestant > 0) {
            var textDecompte = this.decompte(this.tempsRestant);
            this.tempsRestant = this.tempsRestant - 1;

            pTempsRestant = textDecompte + '('+ this.niveauBat +')';
            var pTempsRestant = document.getElementById('tempsRestantBatEnCours').innerHTML = pTempsRestant;

            this.timeId = setTimeout(this.decompteConstru.bind(this),1000);
        }	
        else{
            document.location.reload();

        }
    }


    decompte(seconde){

	    if (seconde > 0) {

	        var heure = Math.floor(seconde/3600);
	        seconde -= heure*3600;

	        var minute = Math.floor(seconde/60);
	        seconde -= minute*60;

	        if (heure > 0) {
	            var textDecompte = heure+' h ';
	        }else{
	            textDecompte = '';
	        }
	        if (minute > 0) {
	            textDecompte += minute+' m ';        
	        }else{
	            textDecompte += '';
	        }

	        textDecompte += seconde+' s ';
	    }
	    return textDecompte;
	}


}
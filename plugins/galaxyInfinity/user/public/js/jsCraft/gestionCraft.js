class craft{

    constructor(){

        this.afficheCraftEnCours();
        this.descrCraftVisible();
        
        this.timeId;
    }

    afficheCraftEnCours(){
        var that = this;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var construEnCours = JSON.parse(this.responseText);

                if(construEnCours[0].idCraft != null){
                    var dateFin = construEnCours[0].finCraftActuel;
                    var dateActuel = new Date();
                    dateActuel = dateActuel.getTime() /1000;
                    that.tempsRestant = Math.round(dateFin - dateActuel);
                    that.nomCraft = construEnCours[0].nomCraft;
                    that.nombreCraft = construEnCours[0].nombreCraft;
                    if(dateFin != null && that.tempsRestant > 0){
                        that.timeId = setTimeout(that.decompteConstru.bind(that),1000);
                    }
                }
            }
        
        };
        xmlhttp.open("GET", "index.php?galaxyInfinity=getConstruCraftJs", true);
        xmlhttp.send(); 
        
    }


    decompteConstru(){


        if (this.tempsRestant > 0) {
            var textDecompte = this.decompte(this.tempsRestant);
            this.tempsRestant = this.tempsRestant - 1;
            pTempsRestant = textDecompte + '('+ this.nombreCraft +')';
            var pTempsRestant = document.getElementById('tempsRestantCraftEnCours').innerHTML = pTempsRestant;
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
	            var textDecompte = heure+'h ';
	        }else{
	            textDecompte = '';
	        }
	        if (minute > 0) {
	            textDecompte += minute+'m ';        
	        }else{
	            textDecompte += '';
	        }

	        textDecompte += seconde+'s ';
	    }
	    return textDecompte;
    }
    

    descrCraftVisible(){
       
        var imgCraftX = document.getElementsByClassName('imgCraftX');

        for(var i =0;i < imgCraftX.length;i++){
            imgCraftX[i].addEventListener('mouseover',function(){
                var divDescrX =this.parentNode.parentNode.lastElementChild;
                divDescrX.style.display = 'block';
            });
            imgCraftX[i].addEventListener('mouseout', function(){
                var divDescrX =this.parentNode.parentNode.lastElementChild;
                divDescrX.style.display = 'none'; 
            });
            imgCraftX[i].addEventListener('mousemove',function(event){
                var divDescrX =this.parentNode.parentNode.lastElementChild;

                divDescrX.style.top = event.clientY+1+'px';
                divDescrX.style.left = event.clientX+1+'px';

            });
        }
    }


}
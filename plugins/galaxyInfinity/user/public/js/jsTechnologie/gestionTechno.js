class techno{

    constructor(){

        this.afficheTechnoEnCours();
        this.descrTechnoVisible();
        
        this.timeId;
    }

    afficheTechnoEnCours(){
        var that = this;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var construEnCours = JSON.parse(this.responseText);
                if(construEnCours !=0){
                    if(construEnCours[0].idTechno != null){
                        var dateFin = construEnCours[0].finTechnoActuel;
                        var dateActuel = new Date();
                        dateActuel = dateActuel.getTime() /1000;
                        that.tempsRestant = Math.round(dateFin - dateActuel);
                        that.nomTechno = construEnCours[0].nomTechno;
                        that.niveauTechno = construEnCours[0].niveauTechno;

                        if(dateFin != null && that.tempsRestant > 0){
                            
                            that.timeId = setTimeout(that.decompteConstru.bind(that),1000);
                        }
                    }
                }
            }
        
        };
        xmlhttp.open("GET", "index.php?galaxyInfinity=getConstruTechnoJs", true);
        xmlhttp.send(); 
        
    }


    decompteConstru(){


        if (this.tempsRestant > 0) {
            var textDecompte = this.decompte(this.tempsRestant);
            this.tempsRestant = this.tempsRestant - 1;
            var pTempsRestant = textDecompte + '('+ this.niveauTechno +')';
            pTempsRestant = document.getElementById('tempsRestantTechnoEnCours').innerHTML = pTempsRestant;


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


    descrTechnoVisible(){
       
        var imgTechnoX = document.getElementsByClassName('imgTechnoX');

        for(var i =0;i < imgTechnoX.length;i++){
            imgTechnoX[i].addEventListener('mouseover',function(){
                var divDescrX =this.parentNode.lastElementChild;
                divDescrX.style.display = 'block';
            });
            imgTechnoX[i].addEventListener('mouseout', function(){
                var divDescrX =this.parentNode.lastElementChild;
                divDescrX.style.display = 'none'; 
            });
            imgTechnoX[i].addEventListener('mousemove',function(event){
                var divDescrX =this.parentNode.lastElementChild;

                divDescrX.style.top = event.clientY+1+'px';
                divDescrX.style.left = event.clientX+1+'px';

            });
        }
    }


}
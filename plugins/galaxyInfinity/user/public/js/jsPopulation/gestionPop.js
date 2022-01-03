class population{

    constructor(){

        this.affichePopEnCours();
        this.descrPopVisible();
        
        this.timeId;
    }

    affichePopEnCours(){
        var that = this;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var formationEnCours = JSON.parse(this.responseText);
                console.log(formationEnCours);
                if(formationEnCours != 0){

                    if(formationEnCours[0].idPop != null){
                        var dateFin = formationEnCours[0].finFormActuel;
                        var dateActuel = new Date();
                        dateActuel = dateActuel.getTime() /1000;
                        that.tempsRestant = Math.round(dateFin - dateActuel);
                        that.nomPop = formationEnCours[0].nomPop;
                        that.nombrePopForm = formationEnCours[0].nombrePopForm;
                        if(dateFin != null && that.tempsRestant > 0){
                            that.timeId = setTimeout(that.decompteFormation.bind(that),1000);
                        }
                    }
                }
            }
        
        };
        xmlhttp.open("GET", "index.php?galaxyInfinity=getFormationPopJs", true);
        xmlhttp.send(); 
        
    }


    decompteFormation(){


        if (this.tempsRestant > 0) {
            var textDecompte = this.decompte(this.tempsRestant);
            this.tempsRestant = this.tempsRestant - 1;
            pTempsRestant = textDecompte + '('+ this.nombrePopForm +')';
            var pTempsRestant = document.getElementById('tempsRestantFormEnCours').innerHTML = pTempsRestant;
            this.timeId = setTimeout(this.decompteFormation.bind(this),1000);
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
    

    descrPopVisible(){
       
        var imgPopX = document.getElementsByClassName('imgPopX');

        for(var i =0;i < imgPopX.length;i++){
            imgPopX[i].addEventListener('mouseover',function(){
                var divDescrX =this.parentNode.parentNode.lastElementChild;
                divDescrX.style.display = 'block';
            });
            imgPopX[i].addEventListener('mouseout', function(){
                var divDescrX =this.parentNode.parentNode.lastElementChild;
                divDescrX.style.display = 'none'; 
            });
            imgPopX[i].addEventListener('mousemove',function(event){
                var divDescrX =this.parentNode.parentNode.lastElementChild;

                divDescrX.style.top = event.clientY+1+'px';
                divDescrX.style.left = event.clientX+1+'px';

            });
        }
    }


}
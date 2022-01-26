class missionTextuel{

    constructor(){
        this.getMission();
        
        
    }

    getMission(){
        var idMission = this.$_GET('idMission');
        var that = this;
        var requestURL = 'index.php?galaxyInfinity=getMissionJs&idMission='+idMission;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var getMission = JSON.parse(this.responseText);
                that.missionBase = getMission[0].mission;
                that.missionTexteQ = getMission[0].missionTexteQ;
                that.missionTexteR = getMission[0].missionTexteR;
                that.missionActive = that.missionBase[0].id;
                that.afficheFirstQR();
            }
        
        };
        xmlhttp.open("GET", requestURL, true);
        xmlhttp.send();
    }

    afficheFirstQR(){
        var missionDiv = document.getElementById('missionDiv');
        var reponseDiv = document.getElementById('reponseDiv');
        this.missionTexteQ.forEach(elementQ => {
            if(elementQ.first_question == 1){
                this.questionActive = elementQ.id;
                var pTexteQ = document.createElement('p');
                pTexteQ.className = 'pTexteQ';
                pTexteQ.id = 'pTexteQ';
                pTexteQ.textContent = elementQ.texte;
                missionDiv.prepend(pTexteQ);
                
                this.missionTexteR.forEach(elementR => {
                    if(elementR.id_question == elementQ.id){

                        var pTexteR = document.createElement('button');
                        pTexteR.className ='pTexteR';
                        pTexteR.textContent = elementR.texte;
                        pTexteR.id = elementR.id;
                        reponseDiv.append(pTexteR);
                    }
                });
            }
        });

        this.verifieActionSurReponse();
    }


    verifieActionSurReponse(){
        var allButtonsReponse = document.getElementsByClassName('pTexteR');
        var that = this;
        for(var i =0;i<allButtonsReponse.length;i++){
            allButtonsReponse[i].addEventListener('click', function(){
                that.missionTexteR.forEach(element => {
                    if(this.id == element.id && element.id_question == that.questionActive){
                        that.nextQuestion = element.id_texte_q_cible;
                        that.afficheProchaineQR();
                    }
                });
            });
        }
    }

    afficheProchaineQR(){
        var that = this;
        //Supprime la question et les reponses précédentes//
        var missionQ = document.getElementById('pTexteQ');
        missionQ.remove();
        var reponseDiv = document.getElementById('reponseDiv')
        while(reponseDiv.firstChild){
            reponseDiv.removeChild(reponseDiv.firstChild);
        }
        //Affiche la nouvelle question et les nouvelles réponses//
        var missionDiv = document.getElementById('missionDiv');
        var reponseDiv = document.getElementById('reponseDiv');
        this.missionTexteQ.forEach(elementQ => {
            if(elementQ.id == that.nextQuestion){
                if(elementQ.last_question == 1){
                    console.log('fin');
                }else{
                    this.questionActive = elementQ.id;
                    var pTexteQ = document.createElement('p');
                    pTexteQ.className = 'pTexteQ';
                    pTexteQ.id = 'pTexteQ';
                    pTexteQ.textContent = elementQ.texte;
                    missionDiv.prepend(pTexteQ);
                    
                    this.missionTexteR.forEach(elementR => {
                        if(elementR.id_question == elementQ.id){
    
                            var pTexteR = document.createElement('button');
                            pTexteR.className ='pTexteR';
                            pTexteR.textContent = elementR.texte;
                            pTexteR.id = elementR.id;
                            reponseDiv.append(pTexteR);
                        }
                    });
                }
                
            }
        });

    }



    afficheLastQ(){

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
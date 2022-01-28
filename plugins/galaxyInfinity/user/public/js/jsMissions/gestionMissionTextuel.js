class missionTextuel{

    constructor(){

        this.verifSauvegarde();
        

        
    }

    verifSauvegarde(){
        var requestURL = 'index.php?galaxyInfinity=getSauvegardeJsMissionTextuel';
        var that = this;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var verifSauvegarde = JSON.parse(this.responseText);
                if(verifSauvegarde[0].getSauvegardeMissionTextuel.length == 0){
                    var urlGI = that.$_GET('galaxyInfinity');
                    if(urlGI == 'lancementMissionTextuel'){
                        that.getMission();
                    }
                    else{
                        window.location.href='index.php?galaxyInfinity=afficheMissionsUser'
                    }
                    
                }
                else{
                    that.reprendreMission(verifSauvegarde);
                }
                
            }
        
        };
        xmlhttp.open("GET", requestURL, true);
        xmlhttp.send();
    }

    getMission(){
        this.idMission = this.$_GET('idMission');
        var that = this;
        var requestURL = 'index.php?galaxyInfinity=getMissionJs&idMission='+this.idMission;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var getMission = JSON.parse(this.responseText);
                that.missionBase = getMission[0].mission;
                that.missionTexteQ = getMission[0].missionTexteQ;
                that.missionTexteR = getMission[0].missionTexteR;
                that.missionActive = that.missionBase[0].id;
                that.planeteActive = getMission[0].planeteActive;
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
                this.sauvegardeMission();
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

    reprendreMission(sauvegarde){
        var that = this;
        this.idMission = sauvegarde[0].getSauvegardeMissionTextuel[0].id_mission;
        var requestURL = 'index.php?galaxyInfinity=getMissionJs&idMission='+this.idMission;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var getMission = JSON.parse(this.responseText);
                that.missionBase = getMission[0].mission;
                that.missionTexteQ = getMission[0].missionTexteQ;
                that.missionTexteR = getMission[0].missionTexteR;
                that.missionActive = that.missionBase[0].id;
                that.planeteActive = getMission[0].planeteActive;
                that.nextQuestion = sauvegarde[0].getSauvegardeMissionTextuel[0].id_question;
                
                that.afficheProchaineQR();
                that.verifieActionSurReponse();
            }
        
        };
        xmlhttp.open("GET", requestURL, true);
        xmlhttp.send();

        
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
        if(missionQ != null){
            missionQ.remove();
        }
        
        var reponseDiv = document.getElementById('reponseDiv')
        while(reponseDiv.firstChild){
            reponseDiv.removeChild(reponseDiv.firstChild);
        }
        //Affiche la nouvelle question et les nouvelles réponses//
        var missionDiv = document.getElementById('missionDiv');
        var reponseDiv = document.getElementById('reponseDiv');
        this.missionTexteQ.forEach(elementQ => {
            if(elementQ.id == that.nextQuestion){
                this.questionActive = elementQ.id;
                this.modifSauvegardeMission();
                if(elementQ.last_question == 1){
                    console.log('fin');
                }else{
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

    sauvegardeMission(){

        var requestURL = 'index.php?galaxyInfinity=sauvegardeMissionTextuelJs&idMission='+this.idMission+'&idQuestionActive='+this.questionActive+'&idPlaneteActive='+this.planeteActive;
        var that = this;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var sauvegardeMission = JSON.parse(this.responseText);
                that.idSauvegarde = sauvegardeMission[0].getSauvegardeMissionTextuel[0].id;  
            }
        
        };
        xmlhttp.open("GET", requestURL, true);
        xmlhttp.send();
    }

    modifSauvegardeMission(){

        var requestURL = 'index.php?galaxyInfinity=modifSauvegardeJsMissionTextuel&idQuestionActive='+this.questionActive+'&idPlaneteActive='+this.planeteActive+'&idSauvegarde='+this.idSauvegarde;
        var that = this;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var sauvegardeMission = JSON.parse(this.responseText);
                that.idSauvegarde = sauvegardeMission[0].getSauvegardeMissionTextuel[0].id;  
            }
        
        };
        xmlhttp.open("GET", requestURL, true);
        xmlhttp.send();
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
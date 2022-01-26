class missions{

    constructor(){
        this.afficheInfosMissionsDiplo();
        this.lancerMissionTextuel();
    }

    afficheInfosMissionsDiplo(){
        

        var allButtonsMissionDiplo = document.getElementsByClassName("buttonMissionDiplo");
        var allButtonsCloseInfoMissionDiplo = document.getElementsByClassName('closeMissionDiplo');

        for(var i =0;i < allButtonsMissionDiplo.length;i++){
            allButtonsMissionDiplo[i].addEventListener('click',function(){
                var boxInfoMissionDiplo = this.parentNode.parentNode.lastElementChild;
                boxInfoMissionDiplo.style.display = "block";
                
            });

        }
        for(var i =0;i < allButtonsCloseInfoMissionDiplo.length;i++){
            allButtonsCloseInfoMissionDiplo[i].addEventListener('click', function(){
                var closeBoxInfoMissionDiplo = this.parentNode.parentNode;
                closeBoxInfoMissionDiplo.style.display = "none";
            });
        }

        window.onclick = function(event){
          if(event.target.classList[0] == 'missionDiploInfo'){
            event.target.style.display = "none";
          }
        }
    }


    lancerMissionTextuel(){
        var allButtonsMissionTextuels = document.getElementsByClassName('lancerMissionTextuel');
        var that = this;
        for(var i =0;i<allButtonsMissionTextuels.length;i++){
            allButtonsMissionTextuels[i].addEventListener('click', function(){
                var idMission = this.id;
                var intIdMission = that.isInt(idMission);
                if(idMission !== '' && intIdMission === true){
                    window.location.href = 'index.php?galaxyInfinity=lancementMissionTextuel&idMission='+idMission;
                }
                
            });
        }
    }



    isInt(variable) {
        if (!Number.isNaN(Number.parseInt(variable))) {
          return true
        }
        else {
          return false
        }
      }

    





}
class missions{

    constructor(){
        this.afficheInfosMissionsDiplo();
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

    





}
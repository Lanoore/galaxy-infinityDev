class home {

    constructor(){
        this.tierSelect();
        this.changerNomPlanete();

    }

    tierSelect(){
        var form = document.querySelector('form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            var tierSelect = form.elements.tierSelect.value;
            document.location.href='index.php?galaxyInfinity=afficheHomeUser&tierSelect='+tierSelect;
        });
    }


    changerNomPlanete(){
        var buttonChangerNom = document.getElementsByClassName('nomPlanete');
        for(var i = 0; i<buttonChangerNom.length; i++){
            buttonChangerNom[i].addEventListener('click', function(){
                var changerTexte = this.parentNode.children[0];
                var getIdPlanete = this.parentNode.children[0].id;

                changerTexte.innerHTML = '<form action="index.php?galaxyInfinity=changerNomPlanete&idPlanete='+getIdPlanete+'" method="post" id="formChangerNomPlanete>"  <label for"nouveauNom">Nouveau nom:</label> <input id="nouveauNom" name="nouveauNom"></input> <input type="submit" value="Changer"></form>';
            });
        }
        
    }


}



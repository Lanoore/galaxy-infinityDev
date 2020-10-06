class galaxie {

    constructor(){
        this.directionSysteme();

    }

    directionSysteme(){
        var form = document.querySelector('form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            var systeme = form.elements.systeme.value;
            document.location.href='index.php?galaxyInfinity=afficheGalaxieUser&systeme='+systeme;
        });
    }


}
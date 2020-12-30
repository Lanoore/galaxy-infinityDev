class home {

    constructor(){
        this.tierSelect();

    }

    tierSelect(){
        var form = document.querySelector('form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            var tierSelect = form.elements.tierSelect.value;
            document.location.href='index.php?galaxyInfinity=afficheHomeUser&tierSelect='+tierSelect;
        });
    }


}
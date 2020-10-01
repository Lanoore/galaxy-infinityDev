class user{

    constructor(){
        this.verifFormInscription();
    }


    verifFormInscription(){
        var regexCouriel = /.+@.+\..+/;
        document.getElementById('email').addEventListener('blur', function(e){
            
            if(!regexCouriel.test(e.target.value)){
                document.getElementById('verifEmailJs').textContent = 'Adresse invalide';
                document.getElementById('verifEmailJs').style.color ='red';
            }
        });

        document.getElementById('password').addEventListener('blur', function(e){
            var mdp = e.target.value;
            var longueurMdp = "faible";
            var couleurMsg = "red";
            if(mdp.length >= 8){
                longueurMdp = 'suffisante';
                couleurMsg = 'green';
            }
            else if(mdp.length >=4){
                longueurMdp = 'moyenne';
                couleurMsg = 'orange';
            }

            var verifMdp = document.getElementById('verifPasswordJs');
            verifMdp.textContent ='Longeur : ' + longueurMdp;
            verifMdp.style.color = couleurMsg;
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function(e){


            var count = 0;
            if(form.elements.pseudo.value == ''){
                count++;
            }
            if(form.elements.email.value =='' && !regexCouriel.test(form.elements.email.value)){
                count++;
            }
            if(form.elements.password.value ==''){
                count++;
            }
            if(form.elements.repeatPassword.value ==''){
                count++;
            }

            if(count >=1){
                document.getElementById('verifFormJs').textContent = 'Veuillez remplir tout les champs correctement';
                document.getElementById('verifFormJs').style.color ='red';
                e.preventDefault();
            }
            


        });
    }



}
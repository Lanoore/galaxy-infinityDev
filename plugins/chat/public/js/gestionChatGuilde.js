class chatGuilde{

    constructor(){
        this.afficheChatGuilde();
    }



    afficheChatGuilde(){

        setInterval(function(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {


            var chat = document.getElementById("messagesChatGuilde");
                while (chat.firstChild) {
                    chat.removeChild(chat.firstChild);
                }

            var addChat = JSON.parse(this.responseText);

            addChat.forEach(function(objet){
                var div = document.createElement('div');
                div.className = 'messageChat';
                div.id = objet.id;
                var divInfo = document.createElement('div');
                divInfo.className = 'messageInfo';
                var pPseudo = document.createElement('p');
                pPseudo.textContent = objet.pseudo;
                var pDate = document.createElement('p');
                pDate.className = 'dateMessage';
                pDate.textContent = objet.dateMessage;
                var pMessage = document.createElement('p');
                pMessage.textContent = objet.message;
                divInfo.prepend(pPseudo);
                divInfo.append(pDate);
                div.prepend(divInfo);
                div.append(pMessage);
                
                chat.append(div);

            })

          }
        };
        xmlhttp.open("GET", "index.php?chat=getChatGuildeJs", true);
        xmlhttp.send(); 


        },5000);

        
        
    }

    




}

  


<div>
<link rel="stylesheet" href="../plugins/chat/public/css/afficheChatCss.css">

<div class='divChat'>
    <p>Chat</p>
    <form action="index.php?chat=addMessage" method="POST">
        <input class='messageInput' type="text" id="message" name="message" placeholder="Entrez votre message">
        <input type="submit">
    </form>
    <div class='messagesChat' id='messagesChat'>
    <?php
        
        foreach ($data as $message) {?>
            <div class='messageChat'>
                <div class="messageInfo">
                    <p><?=$message['pseudo']?></p>
                    <p class='dateMessage'><?=$message['dateMessage']?></p>
                </div>
                <p><?=$message['message']?></p>
            </div>
       <?php }
    ?>
    </div>


</div>

<script type='text/javascript' src='../plugins/chat/public/js/gestionChat.js'></script>
<script type='text/javascript' src='../plugins/chat/public/js/mainChat.js'></script>




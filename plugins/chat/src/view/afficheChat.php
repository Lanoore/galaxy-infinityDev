
<div>
<link rel="stylesheet" href="../plugins/chat/public/css/afficheChatCss.css">

<div class='divChat'>
    <p>Chat</p>
    <form action="index.php?chat=addMessage" method="POST">
        <input class='messageInput' type="text" id="message" name="message" placeholder="Entrez votre message">
        <input type="submit">
    </form>
    <div class='messagesChat'>
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


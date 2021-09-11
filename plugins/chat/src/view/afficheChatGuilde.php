


<?php
if($_SESSION['idGuilde'] == null){?>
    <p>Rejoignez une guilde pour avoir accès au chat de la guilde!</p>
<?php }else{ ?>
    <div class='divChatGuilde'>

        <p>Chat Guilde</p>
        <form action="index.php?chat=addMessageGuilde" method="POST">
            <input class='messageInput' type="text" id="message" name="message" placeholder="Entrez votre message">
            <input type="submit" id='envoi'>
        </form>
        <div class='messagesChatGuilde' id='messagesChatGuilde'>
        <?php
            
            foreach ($data as $message) {?>
                <div class='messageChat' id='<?=$message['id']?>'>
                    <div class="messageInfo">
                        <p><?=$message['pseudo']?></p>
                        <p class='dateMessage'><?=$message['dateMessage']?></p>
                    </div>
                    <p><?=htmlspecialchars($message['message']) ?></p>
                </div>
        <?php }
        ?>
    </div>  
<?php }
?>



<script type='text/javascript' src='plugins/chat/public/js/gestionChatGuilde.js'></script>
<script type='text/javascript' src='plugins/chat/public/js/mainChatGuilde.js'></script>

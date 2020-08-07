
<link rel="stylesheet" href="../plugins/forum/public/css/user/createTopicView.css" type='text/css'>
 
<div>
    <form action="index.php?forum=createTopic&idCategorie=<?=$idCategorie?>" method="POST">
        <div>
            <label for="nomTopic">Nom du Topic</label>
            <input type="text" name='nomTopic'>
        </div>

        <div class='topicMessage'>
            <label for="messageTopic">Contenu du topic</label>
            <textarea name="messageTopic" id="messageTopic" ></textarea>
        </div>
        
        <input type="submit">

    </form>

</div>


<script src="https://cdn.tiny.cloud/1/amz2qjsjr01macp4mb7y8pp67yd2hezik8v80zu2a2v8rww6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script><script>tinymce.init({selector: '#messageTopic'});</script>

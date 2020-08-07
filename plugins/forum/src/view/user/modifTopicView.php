
<link rel="stylesheet" href="../plugins/forum/public/css/user/modifTopicView.css" type='text/css'> 

<div>
    <form action='index.php?forum=modifTopic&idTopic=<?=$topic['id']?>' method='post'>
        <div >
            <?='<label for="nomTopic">Nom du topic</label><br/>
            <input type="text" name="nomTopic" value = "',htmlspecialchars($topic['nom'], ENT_QUOTES, 'UTF-8'),'"></input>'?>
        </div>
        
        <div>
            <label for="messageTopic">Contenu du topic</label>
            <textarea id='messageTopic' name ='messageTopic'><?=$topic['message']?></textarea>
        </div>   
            <input type='submit'></input>
         
    </form>
</div>





<script src="https://cdn.tiny.cloud/1/amz2qjsjr01macp4mb7y8pp67yd2hezik8v80zu2a2v8rww6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script><script>tinymce.init({selector: '#messageTopic'});</script>
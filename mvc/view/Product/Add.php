<?php
    $title = isset($_POST['title']) ? $_POST['title'] : "";
    $text = isset($_POST['text']) ? $_POST['text'] : "";   
    $image = isset($_POST['image']) ? $_POST['image'] : "";

?>
<div>
    <h1><?php echo $data["title"]; ?></h1>	
	
    <form method="post">
        <label>Titel:</label>
        <input type="text" class="text" name="title" value="<?php echo $title; ?>" />
        <span class="error"><?php echo $validator->displayFor("title"); ?></span>
               
        <label>Tekst</label>
	<textarea name="text" class="text"><?php echo $text; ?></textarea>
	<span class="error"><?php echo $validator->displayFor("text"); ?></span>
        
        <!--
        <label>Afbeelding:</label>        
        <select class="image_select" name="image">
            <?php                
            foreach($data['images'] as $i)
            {                              
                echo "<option data-img-src=".Url::getRoot().$i['link']." value=".$i['id'].">".$i['title'].'</option>';
            }
            ?>            
        </select> 
        <span class="error"><?php echo $validator->displayFor("image"); ?></span>  
        -->        
	<input type="submit" class="submit" value="toevoegen" />
    </form>	
</div>
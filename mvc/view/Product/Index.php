<div>
    <h1><?php echo $data["title"]; ?></h1>
    <!--    
    <table>
        <tr>
            <th>Nr.</th>
            <th>Naam</th>
            <th>Afbeelding</th>            
            <th></th>
        </tr>
        <?php
        foreach($data["rows"] as $row ) 
        {
            echo "<tr>"            
            . "<td>".($row['active']=='yes'?'ja':'nee')."</td>"
            . "<td>".$row['title']."</td>"
            . '<td><img src='.  Url::getRoot().$row['image'].' style="background: #e3e5e5;" width="50%" height="50%" ></td>'                        
            . "<td><a href=\"".Url::build("admin/Partner", "Edit", array("id" => $row['id']))."\">wijzig</a></td>"
            . "</tr>";                        
        }
        ?>
    </table>   
    -->
    <a href="<?php echo Url::build("Product", "Add"); ?>">toevoegen</a>    
    
</div>
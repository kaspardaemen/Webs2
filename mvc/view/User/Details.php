<div class="centerWrap">
    <div class="center">
        <div id="content">
            <?php 
            if(isset($_SESSION['user']['id'], $_SESSION['user']['username'], $_SESSION['user']['loginstring'], $data["user"]))
            { ?>
            <h1>
                <?php echo $data["user"]->firstname." ".$data["user"]->surname; ?>
            </h1> 
            
            <section>
                <form method="post" accept-charset="utf-8">                    
                    <p>Beste <b><?php echo $data["user"]->firstname; ?></b>,</p>
                    <p>Deze pagina is bedoeld om je accountgegevens te bekijken en eventueel te wijzigen;)!</p>
                    
                    <?php
                        echo '<h2>Overzicht deelwijken en rollen</h2>';                                                
                        
                        if(isset($_SESSION['user']['roles']) && $_SESSION['user']['roles'] != NULL)
                        {
                            echo '<ul>';                        
                            foreach(($_SESSION['user']['roles']) as $neighbourhood => $roles)
                            {
                                echo '<li>'.$neighbourhood.'</li>';
                                echo '<ul>';
                                foreach($roles as $key => $role)
                                {
                                    echo '<li>'.$role.'</li>';
                                }    
                                echo '</ul>';
                            }
                            echo '</ul>'; 
                        }
                        else
                        {
                            echo '<p>U heeft nog geen rollen voor deelwijken!</p>';
                        }
                    ?>
                    <input type="submit" value="Opslaan" />   
                </form>                          
            </section>
        </div>
            <?php } ?>
        <span class="clear"></span>
    </div>
</div>

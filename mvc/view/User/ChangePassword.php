<?php
if(isset($data["user"]) && $data["user"] != null)
{
?>
    <div id="content">            
        <h1>
            <?php echo $data["title"]; ?>
        </h1> 
        
        <?php 
        if(isset($data["password_changed"]) && $data["password_changed"] == true)
        { ?>
            <p>U wachtwoord is gewijzigd en u kunt nu <a href="<?php echo Url::build("User", "Login") ?>">inloggen</a></p>
        <?php        
        }
        else
        { ?>
        <section>
            <form method="post">    
                <!-- New password input field -->
                <div class="label">Nieuw wachtwoord</div>
                <input id="password" type="password" name="password" pattern=".{6,}" autocomplete="off"/>
                <!-- Repeat password input field -->
                <div class="label">Bevestig nieuw wachtwoord</div>
                <input id="password_repeat" class="login_input" type="password" name="password_repeat" pattern=".{6,}" autocomplete="off" /><br>
                <span class="error"><?php echo $validator->displayFor("ChangePassword"); ?></span></br>                    
                <input type="submit" value="Opslaan" />   
            </form>                          
        </section>
        <?php 
        }  ?>
    </div>            
    <span class="clear"></span>
<?php
}
?>
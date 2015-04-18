
        <div id="content">
            <h1>
                <?php echo $data["title"]; ?>
            </h1>
            
            <section>
                <form method="post" accept-charset="utf-8">                   
                    <div class="label">Gebruikersnaam</div><input name="username" type="text" required /><br>
                    <div class="label">Wachtwoord</div><input name="password" type="password" required  /><br>
                    <span class="error"><?php echo $validator->displayFor("login"); ?></span><br>
                    <input type="submit" value="inloggen" />                                              
                </form>                
                <a href="<?php echo Url::build("User", "Register") ?>">Registreren</a>
                |
                <a href="<?php echo Url::build("User", "RequestPassword") ?>">Wachtwoord vergeten</a>                    
            </section>           
        </div>

        <span class="clear"></span>


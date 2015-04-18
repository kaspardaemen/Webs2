<?php
$username = isset($_POST['username']) ? $_POST['username'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
?>
        <div id="content">
            <h1>Registreren</h1>

            <form method="post">
                <!-- Username input field -->
                <div class="label">Gebruikersnaam</div><input id="username" type="text" maxlength="60" name="username" value="<?php echo $username ?>" />
                <span class="error"><?php echo $validator->displayFor("username"); ?></span></br>
                <!-- Email input field uses a HTML5 email type check -->
                <div class="label">Email</div> <input id="email" type="email" maxlength="45" name="email" value="<?php echo $email ?>" />
                <span class="error"><?php echo $validator->displayFor("email"); ?></span></br>
                <!-- New password input field -->
                <div class="label">Wachtwoord</div><input id="password" type="password" name="password" pattern=".{6,}" autocomplete="off"/>
                <span class="error"><?php echo $validator->displayFor("password"); ?></span></br>
                <!-- Repeat password input field -->
                <div class="label">Wachtwoord bevestiging</div><input id="password_repeat" class="login_input" type="password" name="password_repeat" pattern=".{6,}" autocomplete="off" />
                <span class="error"><?php echo $validator->displayFor("password_repeat"); ?></span></br>

                <input type="submit"  name="register" value="Registreer" />
            </form>

            <!--            <a href="--><?php //echo Url::build("User", "CreateAccount"); ?><!--">Registreren</a>-->

            <a href="<?php echo Url::build("User", "Index"); ?>">Inloggen</a>
        </div>


        <span class="clear"></span>
<div id="content">
<?php if(isset($data["email_sent_to"]) && $data["email_sent_to"] != null)
{
    ?>
    <h1> 
        <?php echo $data["email_sent_to"]; ?>
    </h1>
    <p>Over enkele ogenblikken krijgt u een e-mail toegestuurd met daarin informatie hoe u een nieuw wachtwoord kunt instellen.</p>
    <p>Neem bij aanhoudende problemen contact op met de <a href="mailto:wijkplatformdebunders@gmail.com" title="wijkplatformdebunders@gmail.com">beheerder</a>.</p>
    <?php
}
else
{
?>
    <h1>
        <?php echo $data["title"]; ?>
    </h1> 
            
    <section>
        <form method="post">
            <p>U wachtwoord vergeten?</p>            
            <div class="label">Vul hier uw e-mailadres in om uw wachtwoord te wijzigen:</div>
            <input name="email" type="email" required /><br>           
            <span class="error"><?php echo $validator->displayFor("RequestPassword"); ?></span><br>
            <input type="submit" value="Verder" />   
        </form>                          
    </section>
 </div>            
 <span class="clear"></span>
<?php
}
?>
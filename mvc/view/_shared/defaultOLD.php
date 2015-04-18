<!doctype html>

<html>

<head>
	<title><?php echo $page->getTitle(); ?></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<!--<link rel="shortcut icon" href="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/img/icon64x64.png">-->
        <link rel="shortcut icon" href="http://placehold.it/64x64">

	<!-- styles -->	
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,700,600,400' rel='stylesheet' type='text/css'>
	<link href="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/css/style.php<?php if(isset($data['themeColor'])) { echo "?color=".$data['themeColor']; } ?>" rel="stylesheet" type="text/css">

	<!-- apple -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/img/icon57x57.png">
</head>

<body>

<div id="header">
    
	<div class="center">
            <!--
		<form action="#" method="post">
			<input type="text" class="text" name="searchterm">
			<input type="submit" class="submit" value="zoek">
		</form>
            -->
	</div>
    
</div>

<div id="nav">
	<div class="center">
		<div class="hideForScreen" id="menuOpen">menu</div>
		<div class="left hideForTablet" id="menu">
			<div id="menuClose"></div>
			<?php $page->part("menu"); ?>
		</div>
		<ul class="right">
			<?php

				if(User::isValid())
				{
					echo '<li><a href="'. Url::build("User", "Details") .'">'. $_SESSION['user']['username'].'</a></li>';
					echo '<li><a href="' . Url::build('User', 'Logout') . '" id="loginButton">uitloggen</a></li>';
				}
				else {
					if ($page->getController() == "User" && $page->getView() == "Login") {
						echo '<li class="active"><a href="' . Url::build('User', 'Login') . '" id="loginButton">inloggen</a></li>';
					} else {
						echo '<li><a href="' . Url::build('User', 'Login') . '" id="loginButton">inloggen</a></li>';
					}

					if ($page->getController() == "User" && $page->getView() == "Register") {
						echo '<li class="active"><a href="' . Url::build('User', 'Register') . '" id="registerButton">registreren</a></li>';
					} else {
						echo '<li><a href="' . Url::build('User', 'Register') . '" id="registerButton">registreren</a></li>';
					}
				}
			?>
		</ul>
	
		<span class="clear"></span>
	</div>
</div>

<div id="colorBackground"></div>

<div id="container">
	<div class="center">

		<?php $page->part("view"); ?>

	</div>
</div>

<div id="footer">
	<div id="footerTop">
		<div id="maps">
			<div id="gradient"></div>
		</div>
		<div id="contacts">
			<div class="contact">
				<h6>1. Wijkraad De Bunders</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<div class="contact">
				<h6>2. Gemeente Veghel</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<div class="contact">
				<h6>3. Politie Veghel</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<div class="contact">
				<h6>4. Wijkraad De Bunders</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<div class="contact">
				<h6>1. Wijkraad De Bunders</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<div class="contact">
				<h6>1. Wijkraad De Bunders</h6>
				Stadhuisplein 1<br/>
				5461 KN Veghel<br/>
				Telefoon: 0123 14 0413<br/>
				E-mail: info@veghel.nl
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	<div id="footerBottom">
		<p class="left">
			&copy; 2015 Wijkraad De Bunders
		</p>
		<div class="right">
			<a href="#" class="social twitter" target="_blank">
				<span class="icon"></span>
				Twitter
			</a>
			<a href="#" class="social facebook" target="_blank">
				<span class="icon"></span>
				Facebook
			</a>
		</div>
		<span class="clear"></span>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/js/jquery.cycle.all.js"></script>
<script src="<?php echo Url::getRoot(); ?>/theme/<?php echo $page->getTheme(); ?>/js/main.js"></script>

</body>

</html>
<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
	<?php wp_head(); ?>

</head>
<body>
	<div class="wrapper img-rounded">
		<header>
			<div class="header_title">
			<span class="header_words"><?php echo 'A SPECTRE IN SENSARA' ?><!--<span class="getting_pwned">--><span>
			</div>
			<div class="sub_header">
			<span class="sub_header"><?php echo 'CISCO CCNA/CCNP CERTIFIED NETWORK ENGINEER & SOFTWARE DEVELOPER IN PHP/PYTHON/JAVA/C++/ASSEMBLY'; ?></span>
			<div>
		</header>
		<?php 			
			//THIS IS THE MENU
			wp_nav_menu(
				//container means should it be enclosed in a ul tag
				//REASON FOR 
				array(
					'theme_location' => 'primary_menu',
					'container' => false,

					'walker' => new MenuWalker() 
				)
			);
		?>
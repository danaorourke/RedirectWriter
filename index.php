<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="I take wordpress exports and make them into redirects you can copy and paste into your .htaccess file.">
    <title>Redirects from Wordpress Export</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" media="all" href="style.css">
</head>
	
<body lang="en">
	<header id="header">
		<h1>Redirect Generator</h1>
	</header>
	<section id="content">
		<?php
		
			$fields = array('export','origin','structure_old','structure_new','site_url','redirect_type','generator');
			$reqFields = true;
			try {
				// get the base file
				if (file_exists('writer.php')) {
					require_once('writer.php');
					$form = new formMe($fields,$reqFields);
				} else {
					throw new Exception('Could not find writer.');
				}
			} catch (Exception $e) {
				echo '<p><strong>An error occurred with the following message:</strong> ', $e->getMessage(), '</p>';
			}
		?>
	</section>
	<footer id="footer"><p>Made by Dana O'Rourke at Cup of Tea Creations</p></footer>
</body>
</html>
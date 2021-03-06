<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="../css/ledenadmin.css" rel="stylesheet" type="text/css">
		<link href="../css/select.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
		 <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Capriola&family=Delius&family=Exo+2:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
		<script type="text/javascript" src="../js_lib/copyright.js"></script>

		<title>Leden administratie</title>
	</head>

	<body>
		<div id="mainbox">
			<header>
				<img src="../images/web-development.png" alt="webontwikkeling"/>
				<h2>- ontwikkeling</h2>
			</header>

			<nav>
				<ul>
				{section name=teller loop=$menu}
					<li><a href="{$menu[teller].d_link}">{$menu[teller].d_item}
						</a>
					</li>
				{/section}
				</ul> 
			</nav>
		
			<main>
				<article id="artleft">
					{$commentaar|default:"<h1>leden-admin</h1>"}
				</article>

				<article id="artright">
					{$inhoud}
				</article>
			</main>
		
			<footer>
				<div class="copyright"> 
					<script>
						document.write(copyRight());
					</script>
				</div>	
			</footer>		
		</div>
	</body>
</html>

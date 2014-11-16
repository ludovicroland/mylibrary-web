<!DOCTYPE html>
<html>
	<head>
		<title>Bibliothèque</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex, nofollow" />
		
		<!-- CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="/css/library.min.css" rel="stylesheet" media="screen">
		
		<!-- JS -->
		<script src="/js/jquery-1.9.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</head>

	<body>	
		<!-- admin nav bar -->
		<?php if($user->isAuthenticated()) { ?>
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="/">Bibliothèque</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
					</div>
          
					<div id="navbar-main" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="/genres.html">Les genres</a></li>
							<li><a href="/auteurs.html">Les auteurs</a></li>
							<li><a href="/livres-a.html">Les livres</a></li>
							<li><a href="/listes.html">Mes listes</a></li>
							<li><a href="/recherche.html"><span class="glyphicon glyphicon-search"></span></a></li>
              <li><a href="/livres-export-all.html" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a></li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							<li><a href="/compte.html">Mon compte</a></li>
							<li><a href="/deconnexion.html">Déconnexion</a></li>
						</ul>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="/">Bibliothèque</a>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<div class="container margin-top-70">
			<?php echo $content; ?>
		</div>
		
		<div class="footer">
			<div class="container">
				<p>v 1.4&nbsp;-&nbsp;Site réalisé par <a href="http://www.rolandl.fr" target="_blank">Ludovic ROLAND</a>&nbsp;-&nbsp;Design par <a href="http://bootswatch.com/" target="_blank">Bootswatch</a></p>
			</div>
		</div>
	</body>
</html>
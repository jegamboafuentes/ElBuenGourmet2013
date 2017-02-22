<?php require_once("res/x5engine.php"); ?>
<!DOCTYPE html><!-- HTML5 -->
<html lang="es" dir="ltr">
	<head>
		<title>Buscar - el buen GOURMET</title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv="ImageToolbar" content="False" /><![endif]-->
		<meta name="author" content="Raquel Marquez Gonzalez, Jorge Enrique Gamboa Fuentes" />
		<meta name="generator" content="Incomedia WebSite X5 Free 10.0.8.35 - www.websitex5.com" />
		<meta name="viewport" content="width=1011" />
		<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="style/reset.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="style/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="style/style.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="style/template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style/menu.css" media="screen" />
		<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="style/ie.css" media="screen" /><![endif]-->
		
		<script type="text/javascript" src="res/jquery.js?35"></script>
		<script type="text/javascript" src="res/x5engine.js?35"></script>
		<script type="text/javascript">
			x5engine.boot.push(function () { x5engine.utils.imPreloadImages(['menu/index_h.png','menu/menu-de-hoy_h.png','menu/ordenar_h.png','menu/sobre-nosotros_h.png','menu/loging_h.png','res/imLoad.gif','res/imClose.png']); });
		</script>
		
		<script type="text/javascript">x5engine.boot.push('x5engine.imSearch.Load()')</script>
	</head>
	<body>
		<div id="imHeaderBg"></div>
		<div id="imFooterBg"></div>
		<div id="imPage">
			<div id="imHeader">
				<h1 class="imHidden">Buscar - el buen GOURMET</h1>
				
			</div>
			<a class="imHidden" href="#imGoToCont" title="Salta el menu principal">Vaya al Contenido</a>
			<a id="imGoToMenu"></a><p class="imHidden">Menu Principal:</p>
			<div id="imMnMn" class="auto">
				<ul class="auto">
					<li id="imMnMnNode0">
						<a href="index.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Página de inicio</span>
							</span>
						</a>
					</li><li id="imMnMnNode3">
						<a href="menu-de-hoy.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Menú de hoy</span>
							</span>
						</a>
					</li><li id="imMnMnNode4">
						<a href="ordenar.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Ordenar</span>
							</span>
						</a>
					</li><li id="imMnMnNode5">
						<a href="sobre-nosotros.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Sobre nosotros</span>
							</span>
						</a>
					</li><li id="imMnMnNode6">
						<a href="loging.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Loging</span>
							</span>
						</a>
					</li>
				</ul>
			</div>
			<div id="imContentGraphics"></div>
			<div id="imContent">
				<a id="imGoToCont"></a>
				<h2 id="imPgTitle">Resultados de búsqueda</h2><?php
$search = new imSearch();
$search->search(@$_GET['search'], @$_GET['page']);
?>				  
				<div class="imClear"></div>
			</div>
			<div id="imFooter">
				
			</div>
		</div>
		<span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
	</body>
</html>

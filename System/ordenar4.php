<?php require_once('Connections/COnexionGourmet.php');
date_default_timezone_set("Mexico/General");
$ordenes = ""; ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Orden = "-1";
if (isset($_GET['id_ordenes'])) {
  $colname_Orden = $_GET['id_ordenes'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Orden = sprintf("SELECT * FROM ordenes WHERE id_ordenes = %s", GetSQLValueString($colname_Orden, "int"));
$Orden = mysql_query($query_Orden, $COnexionGourmet) or die(mysql_error());
$row_Orden = mysql_fetch_assoc($Orden);
$totalRows_Orden = mysql_num_rows($Orden);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_detalle_orden = "SELECT * FROM detalle_ordenes";
$detalle_orden = mysql_query($query_detalle_orden, $COnexionGourmet) or die(mysql_error());
$row_detalle_orden = mysql_fetch_assoc($detalle_orden);
$totalRows_detalle_orden = mysql_num_rows($detalle_orden);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_detalle_menu = sprintf("select       case platillo.especial
							  when 1 then detalle_menu.nombre_especial 
                              when 0 then platillo.nombre_plat end as nombre,
			                  platillo.precio, detalle_ordenes.cantidad, detalle_ordenes.id_detalleordenes,      detalle_ordenes.id_ordenes, detalle_ordenes.id_plat
from 		platillo, detalle_ordenes, detalle_menu, ordenes, menu
where 		detalle_ordenes.id_plat = platillo.id_plat and
			detalle_ordenes.id_ordenes = ordenes.id_ordenes and
			detalle_menu.id_menu = menu.id_menu and
			platillo.id_plat = detalle_menu.id_plat and ordenes.id_ordenes = %s and
			menu.fecha = %s",
			GetSQLValueString($colname_Orden, "int"),
			GetSQLValueString(date("d/m/Y"), "text"));
$detalle_menu = mysql_query($query_detalle_menu, $COnexionGourmet) or die(mysql_error());
$row_detalle_menu = mysql_fetch_assoc($detalle_menu);
$totalRows_detalle_menu = mysql_num_rows($detalle_menu);
?>
<!DOCTYPE html><!-- HTML5 -->
<html lang="es" dir="ltr">
	<head>
		<title>Ordenar - el buen GOURMET</title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv="ImageToolbar" content="False" /><![endif]-->
		<meta name="author" content="Jorge Enrique Gamboa Fuentes" />
		<meta name="generator" content="Incomedia WebSite X5 Evolution 10.0.6.31 - www.websitex5.com" />
		<meta name="viewport" content="width=972" />
		<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="style/reset.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="style/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="style/style.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="style/template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style/menu.css" media="screen" />
		<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="style/ie.css" media="screen" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="pcss/ordenar.css" media="screen" />
		<script type="text/javascript" src="res/jquery.js?31"></script>
		<script type="text/javascript" src="res/x5engine.js?31"></script>
		<script type="text/javascript">
			x5engine.boot.push(function () { x5engine.utils.imPreloadImages(['menu/home_h.png','menu/menu-de-hoy_h.png','menu/ordenar_h.png','menu/ubicacion_h.png','menu/contactanos_h.png','menu/sobre-nosotros_h.png','res/imLoad.gif','res/imClose.png']); });
		</script>
		
	</head>
	<body>
		<div id="imHeaderBg"></div>
		<div id="imFooterBg"></div>
		<div id="imPage">
			<div id="imHeader">
				<h1 class="imHidden">Ordenar - el buen GOURMET</h1>
				
				<div onclick="x5engine.utils.location('home.html'); return false;" style="position: absolute; top: 112px; left: 348px; width: 280px; height: 131px; cursor: pointer;"></div>
			</div>
			<a class="imHidden" href="#imGoToCont" title="Salta el menu principal">Vaya al Contenido</a>
			<a id="imGoToMenu"></a><p class="imHidden">Menu Principal:</p>
			<div id="imMnMn" class="auto">
				<ul class="auto">
					<li id="imMnMnNode0">
						<a href="home.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Página de inicio</span>
							</span>
						</a>
					</li><li id="imMnMnNode8" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 1</span>
						</span>
					</li><li id="imMnMnNode3">
						<a href="menu-de-hoy.php">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Menu de hoy</span>
							</span>
						</a>
					</li><li id="imMnMnNode9" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 2</span>
						</span>
					</li><li id="imMnMnNode4" class="imMnMnCurrent">
						<a href="ordenar.php">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Ordenar</span>
							</span>
						</a>
					</li><li id="imMnMnNode10" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 3</span>
						</span>
					</li><li id="imMnMnNode5">
						<a href="ubicacion.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Ubicacion</span>
							</span>
						</a>
					</li><li id="imMnMnNode11" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 4</span>
						</span>
					</li><li id="imMnMnNode6">
						<a href="contactanos.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Contactanos</span>
							</span>
						</a>
					</li><li id="imMnMnNode12" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 5</span>
						</span>
					</li><li id="imMnMnNode7">
						<a href="sobre-nosotros.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Sobre nosotros</span>
							</span>
						</a>
					</li>
				</ul>
			</div>
			<div id="imContentGraphics"></div>
			<div id="imContent">
				<a id="imGoToCont"></a>
				<h2 id="imPgTitle">Ordenar</h2>
				<p>&nbsp;</p>
				<div style="float: left;">
				  <div style="height: 30px;">&nbsp;</div>
				</div>
				<div id="imFooPad" style="height: 350px; float: left;">&nbsp;</div>
				<div align="center">
				  <p>Ordena lo que se te antoje y paga en tu domicilio. </p>
				  <p>&nbsp;</p>
				  <p><img src="Img/llamaremos.JPG" width="852" height="523"></p>
                  <!-- Aqui va el codigo para enviar el mail -->
                  <?php 
			  $fecha = $row_Orden['fecha_ordenes'];
			  $hora_ordenes = $row_Orden['hora_ordenes'];
			  $nombre = $row_Orden['nombre'];
			  $apellido = $row_Orden['apellido'];
			  $tel = $row_Orden['tel'];
			  $direccion = $row_Orden['direccion'];
			  $cp = $row_Orden['cod_postal'];
			  $ciudad = $row_Orden['ciudad'];
			  $destino = "pedidos@elbuengourmet.mx";
			  $desde = "From:"."Ordenes";
			  $asunto = "Pedido numero ".$row_Orden['id_ordenes'];
			  $separador = "
--------------------------------
";
			  $encabezado = $fecha."      ,     ".$hora_ordenes;
			  $datos = 
"Nombre = ".$nombre." ".$apellido."  			            
Telefono = ".$tel."					
Direccion = ".$direccion."					
Codigo postal = ".$cp."						
Ciudad = ".$ciudad;	 
		      do{
				 $ordenes = $ordenes."
".$row_detalle_menu['cantidad']." | ".$row_detalle_menu['nombre']."
"; 
			    }
		      while($row_detalle_menu = mysql_fetch_assoc($detalle_menu));
			  $subtotal = $row_Orden['subtotal']." <-- Pedido";
			  $envio = $row_Orden['envio']." <-- Envio";
			  $total = $row_Orden['total'];
			  $pagara = $row_Orden['moneda'];
			  $cambio = $pagara-$total;
			  $total_fin = "Subtotal = $".$subtotal."
Envio = $".$envio."
Total = $".$total."
							
Pagara con $".$pagara."
Cambio $".$cambio;
			  		          
			  $mensajefinal = $encabezado.$separador.$datos.$separador."Ordenes".$ordenes.$separador."Total".$total_fin;
			  if (mail($destino,$asunto,$mensajefinal,$desde)){  
			  } else {
				echo "Problemas al enviar";
			  }
			  
		          ?>
				</div>
				<div id="imBtMn"><a href="home.html">Página de inicio</a> | <a href="menu-de-hoy.html">Menu de hoy</a> | <a href="ordenar.html">Ordenar</a> | <a href="ubicacion.html">Ubicacion</a> | <a href="contactanos.html">Contactanos</a> | <a href="sobre-nosotros.html">Sobre nosotros</a> | <a href="imsitemap.html">Mapa general del sitio</a></div>				  
				<div class="imClear"></div>
			</div>
			<div id="imFooter"></div>
		</div>
		<span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
	</body>
</html>
<?php
mysql_free_result($Orden);

mysql_free_result($detalle_orden);
?>

<?php date_default_timezone_set("Mexico/General"); 
?>
<?php require_once('../Connections/COnexionGourmet.php'); 
$fecha = $_GET['fecha'] ;
$hora = $_GET['hora'];
$nombre = $_GET['nombre'];
$subtotal = 0;
$precio = 0;
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registro")) {
  $insertSQL = sprintf("INSERT INTO detalle_ordenes (id_ordenes, id_plat, cantidad) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_orden'], "int"),
                       GetSQLValueString($_POST['id_plat'], "text"),
                       GetSQLValueString($_POST['cantidad'], "int"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($insertSQL, $COnexionGourmet) or die(mysql_error());

  $insertGoTo = "ordenar20.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_idorden = sprintf("SELECT id_ordenes FROM ordenes WHERE fecha_ordenes=%s and hora_ordenes=%s and nombre=%s",GetSQLValueString($fecha, "text"), GetSQLValueString($hora, "text"),GetSQLValueString($nombre, "text"));
$idorden = mysql_query($query_idorden, $COnexionGourmet) or die(mysql_error());
$row_idorden = mysql_fetch_assoc($idorden);
$totalRows_idorden = mysql_num_rows($idorden);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_detalle_menu = sprintf("select       case platillo.especial
							  when 1 then detalle_menu.nombre_especial 
                              when 0 then platillo.nombre_plat end as nombre,
			                  platillo.precio, detalle_ordenes.cantidad, detalle_ordenes.id_detalleordenes, detalle_ordenes.      	                              id_ordenes and detalle_ordenes.id_plat
from 		platillo, detalle_ordenes, detalle_menu, ordenes, menu
where 		detalle_ordenes.id_plat = platillo.id_plat and
			detalle_ordenes.id_ordenes = ordenes.id_ordenes and
			detalle_menu.id_menu = menu.id_menu and
			platillo.id_plat = detalle_menu.id_plat and ordenes.id_ordenes = %s and
			menu.fecha = %s",
			GetSQLValueString($row_idorden['id_ordenes'], "int"),
			GetSQLValueString($fecha, "text"));
$detalle_menu = mysql_query($query_detalle_menu, $COnexionGourmet) or die(mysql_error());
$row_detalle_menu = mysql_fetch_assoc($detalle_menu);
$totalRows_detalle_menu = mysql_num_rows($detalle_menu);

$colname_quiere_nombre = "-1";
if (isset($_GET['id'])) {
  $colname_quiere_nombre = $_GET['id'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_quiere_nombre = sprintf("SELECT case platillo.especial
								when 1 then detalle_menu.nombre_especial
								when 0 then platillo.nombre_plat end as nombre 
								FROM platillo, detalle_menu, menu
								WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and                                platillo.id_plat = %s and menu.fecha = %s"	
								, GetSQLValueString($colname_quiere_nombre, "text"),GetSQLValueString(date("d/m/Y"), "text"));
$quiere_nombre = mysql_query($query_quiere_nombre, $COnexionGourmet) or die(mysql_error());
$row_quiere_nombre = mysql_fetch_assoc($quiere_nombre);
$totalRows_quiere_nombre = mysql_num_rows($quiere_nombre);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_sopas =sprintf("SELECT case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Sopa' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$sopas = mysql_query($query_sopas, $COnexionGourmet) or die(mysql_error());
$row_sopas = mysql_fetch_assoc($sopas);
$totalRows_sopas = mysql_num_rows($sopas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_ensaldas = sprintf("SELECT case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Ensalada' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$ensaldas = mysql_query($query_ensaldas, $COnexionGourmet) or die(mysql_error());
$row_ensaldas = mysql_fetch_assoc($ensaldas);
$totalRows_ensaldas = mysql_num_rows($ensaldas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_antojitos = sprintf("SELECT case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Antojito' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$antojitos = mysql_query($query_antojitos, $COnexionGourmet) or die(mysql_error());
$row_antojitos = mysql_fetch_assoc($antojitos);
$totalRows_antojitos = mysql_num_rows($antojitos);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_guisados = sprintf("SELECT case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Guisado' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$guisados = mysql_query($query_guisados, $COnexionGourmet) or die(mysql_error());
$row_guisados = mysql_fetch_assoc($guisados);
$totalRows_guisados = mysql_num_rows($guisados);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_postres = sprintf("SELECT case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Postre' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$postres = mysql_query($query_postres, $COnexionGourmet) or die(mysql_error());
$row_postres = mysql_fetch_assoc($postres);
$totalRows_postres = mysql_num_rows($postres);


 
;?>
<!DOCTYPE html><!-- HTML5 -->
<html lang="es" dir="ltr">
	<head>
		<title>Ordenar - el buen GOURMET</title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv="ImageToolbar" content="False" /><![endif]-->
		<meta name="author" content="Jorge Enrique Gamboa Fuentes" />
		<meta name="generator" content="Incomedia WebSite X5 Evolution 10.0.6.31 - www.websitex5.com" />
		<meta name="viewport" content="width=972" />
		<link rel="icon" href="../favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="../style/reset.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="../style/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="../style/template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../style/menu.css" media="screen" />
		<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="style/ie.css" media="screen" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="../pcss/ordenar.css" media="screen" />
		<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../res/jquery.js?31"></script>
		<script type="text/javascript" src="../res/x5engine.js?31"></script>
		<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
						<a href="../home.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Página de inicio</span>
							</span>
						</a>
					</li><li id="imMnMnNode8" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 1</span>
						</span>
					</li><li id="imMnMnNode3">
						<a href="../menu-de-hoy.php">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Menu de hoy</span>
							</span>
						</a>
					</li><li id="imMnMnNode9" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 2</span>
						</span>
					</li><li id="imMnMnNode4" class="imMnMnCurrent">
						<a href="../ordenar.php">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Ordenar</span>
							</span>
						</a>
					</li><li id="imMnMnNode10" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 3</span>
						</span>
					</li><li id="imMnMnNode5">
						<a href="../ubicacion.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Ubicacion</span>
							</span>
						</a>
					</li><li id="imMnMnNode11" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 4</span>
						</span>
					</li><li id="imMnMnNode6">
						<a href="../contactanos.html">
							<span class="imMnMnFirstBg">
								<span class="imMnMnTxt"><span class="imMnMnImg"></span>Contactanos</span>
							</span>
						</a>
					</li><li id="imMnMnNode12" class="imMnMnSeparator">
						<span class="imMnMnFirstBg">
							<span class="imMnMnTxt"><span class="imMnMnImg"></span>Separador 5</span>
						</span>
					</li><li id="imMnMnNode7">
						<a href="../sobre-nosotros.html">
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
				  <p>&nbsp;</p>
				  <p>
				    <label for="id_orden"><span class="alert-green"><strong>Cantidad de  <?php echo $row_quiere_nombre['nombre']; ?>  ?</strong></span> </label>
			      </p>
				  <form action="<?php echo $editFormAction; ?>" method="POST" name="registro" id="registro">
				    <h2>
				      <label for="cantidad"></label>
				      <span id="sprytextfield1">
			          <input name="cantidad" type="text" id="cantidad" value="1" size="2">
			          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
				      <label for="id_orden">
				        <input type="submit" name="button" id="button" value="Ok">
				        <br>
				        <br>
			          </label>
			        </h2>
				    <h3><label for="id_orden"> </label>
				    <input name="id_orden" type="hidden" id="id_orden" value="<?php echo $row_idorden['id_ordenes']; ?>">
			        <label for="fecha"></label>
			        <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha?>" >
				    <label for="hora"></label>
				    <input type="hidden" name="hora" id="hora" value="<?php echo $hora;?>" >
				    <label for="id_plat"></label>
				    <input type="hidden" name="id_plat" id="id_plat" value="<?php echo $_GET['id'];?>">
				    <input type="hidden" name="MM_insert" value="registro">
				  </h3></form>
				  <p>&nbsp;</p>
				  <p>&nbsp;</p>
				</div>
				<div id="imBtMn"><h3><a href="../home.html">Página de inicio</a> | <a href="../menu-de-hoy.html">Menu de hoy</a> | <a href="../ordenar.html">Ordenar</a> | <a href="../ubicacion.html">Ubicacion</a> | <a href="../contactanos.html">Contactanos</a> | <a href="../sobre-nosotros.html">Sobre nosotros</a> | <a href="../imsitemap.html">Mapa general del sitio</a></h3></div>				  
				<div class="imClear"></div>
			</div>
			<div class="text-center" id="imFooter">
				
			</div>
		</div>
		<h3><span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
        </script>
	</h3></body>
</html>
<?php
mysql_free_result($detalle_menu);

mysql_free_result($quiere_nombre);

mysql_free_result($sopas);

mysql_free_result($ensaldas);

mysql_free_result($antojitos);

mysql_free_result($guisados);

mysql_free_result($postres);

mysql_free_result($idorden);
?>

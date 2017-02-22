<?php require_once('Connections/COnexionGourmet.php'); ?>
<?php require_once('Connections/COnexionGourmet.php'); ?>
<?php date_default_timezone_set("Mexico/General"); ?>
<?php require_once('Connections/COnexionGourmet.php'); 
$bandera = 0;
$subtotal = 0;
$precio = 0;?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ordenes (moneda, subtotal, total) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['subtotal'], "double"),
                       GetSQLValueString($_POST['total'], "double"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($insertSQL, $COnexionGourmet) or die(mysql_error());

  $insertGoTo = "ordenar4.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "total_form")) {
  $updateSQL = sprintf("UPDATE ordenes SET moneda=%s, envio=%s, subtotal=%s, total=%s WHERE id_ordenes=%s",
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['envio'], "double"),
                       GetSQLValueString($_POST['subtotal'], "double"),
                       GetSQLValueString($_POST['total'], "double"),
                       GetSQLValueString($_POST['orden'], "int"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($updateSQL, $COnexionGourmet) or die(mysql_error());

  $updateGoTo = "ordenar4.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_datos = "-1";
if (isset($_GET['id_ordenes'])) {
  $colname_datos = $_GET['id_ordenes'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_datos = sprintf("SELECT * FROM ordenes WHERE id_ordenes = %s", GetSQLValueString($colname_datos, "int"));
$datos = mysql_query($query_datos, $COnexionGourmet) or die(mysql_error());
$row_datos = mysql_fetch_assoc($datos);
$totalRows_datos = mysql_num_rows($datos);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Codigo_Postal = sprintf("SELECT * FROM cat_cp where cp=%s", GetSQLValueString($row_datos['cod_postal'], "text"));
$Codigo_Postal = mysql_query($query_Codigo_Postal, $COnexionGourmet) or die(mysql_error());
$row_Codigo_Postal = mysql_fetch_assoc($Codigo_Postal);
$totalRows_Codigo_Postal = mysql_num_rows($Codigo_Postal);

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
			GetSQLValueString($row_datos['id_ordenes'], "int"),
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
		<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
		<style type="text/css">
		#apDiv1 {
	position: absolute;
	left: 332px;
	top: 496px;
	width: 109px;
	height: 76px;
	z-index: 1;
}
        </style>
		<script type="text/javascript" src="res/jquery.js?31"></script>
		<script type="text/javascript" src="res/x5engine.js?31"></script>
		<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
				  <p><img src="Img/paso3.JPG" width="597" height="109" alt="Pasos"></p>
				  <p>&nbsp;</p>
				  <table width="688" border="1" cellspacing="35">
				    <tr>
				      <td><h3>Platillos ----&gt;<a href="ordenes/ordenar20.php?fecha=<?php echo $row_datos['fecha_ordenes'];?>&hora=<?php echo $row_datos['hora_ordenes'];?>&nombre=<?php echo $row_datos['nombre'];?>"><img src="Img/modif.png" width="35" height="35" alt="modificar"></a>(Modificar)</h3></td>
				      <td><h3 align="center">Total</h3></td>
			        </tr>
				    <tr>
				      <td><table width="360" border="1">
				        <tr class="cartTable">
				          <td width="197">Platillo				            </td>
				          <td width="69">$</td>
				          <td width="80">Cantidad</td>
			            </tr>
				        <?php do { ?>
				        <tr class="cartTable">
				          <td><?php echo $row_detalle_menu['nombre']; ?></td>
				          <td><?php echo $row_detalle_menu['precio']; ?></td>
				          <td><p><?php echo $row_detalle_menu['cantidad']; ?></p></td>
			            </tr>
				        <?php 
						$precio = $row_detalle_menu['precio'] * $row_detalle_menu['cantidad'];;
						$subtotal = $subtotal + $precio;  ?>
				        <?php } while ($row_detalle_menu = mysql_fetch_assoc($detalle_menu)); ?>
			          </table>
			          <p>&nbsp;</p></td>
				      <td><table width="352" border="1">
				        <tr>
				          <td><div align="right">Precio de envio </div></td>
				          <td><div align="center">$ 
				          <?php if(isset($row_Codigo_Postal['precio'])){echo $envio = $row_Codigo_Postal['precio'];$bandera=0;}
						        else {echo $envio = 0;$bandera=1;} ?>
				          </div></td>
				          <td><?php if($bandera==0){echo "";} else{echo "Los precios no estan disponibles";}
							   ?></td>
			            </tr>
				        <tr>
				          <td><div align="right">Subtotal </div></td>
				          <td><div align="center">
				            <p>$    <?php echo $subtotal?></p>
				            <p>&nbsp;</p>
				          </div></td>
				          <td>&nbsp;</td>
			            </tr>
				        <tr>
				          <td><div align="right"></div></td>
				          <td><div align="center" class="alert-green"><u><strong>$<?php echo $total =  $subtotal+$row_Codigo_Postal['precio']; ?></strong></u></div></td>
				          <td>&nbsp;</td>
			            </tr>
				        <tr>
				          <td><div align="right"></div></td>
				          <td><p align="center" class="alert-red">				            Total</p>				          </td>
				          <td>&nbsp;</td>
			            </tr>
			          </table></td>
			        </tr>
				    <tr>
				      <td><h3>Datos ----&gt;<a href="ordenes/ordenar1_edit.php?id_ordenes=<?php echo $row_datos['id_ordenes'] ?>"><img src="Img/modif.png" width="35" height="35" alt="modificar">(Modificar)</a></h3></td>
				      <td>&nbsp;</td>
			        </tr>
				    <tr>
				      <td><table width="371" border="1">
				        <tr>
				          <td><span class="imSearchVideoDuration">Nombre:</span></td>
				          <td><p><span class="imSearchVideoDuration"><?php echo $row_datos['nombre']; ?> <?php echo $row_datos['apellido']; ?></span></p>
			              <p>&nbsp;</p></td>
			            </tr>
				        <tr>
				          <td><span class="imSearchVideoDuration">Telefono:</span></td>
				          <td><p><span class="imSearchVideoDuration"><?php echo $row_datos['tel']; ?></span></p>
			              <p>&nbsp;</p></td>
			            </tr>
				        <tr>
				          <td><span class="imSearchVideoDuration">Direccion:</span></td>
				          <td><span class="imSearchVideoDuration"><?php echo $row_datos['direccion']; ?></span></td>
			            </tr>
			          </table></td>
				      <td><form action="<?php echo $editFormAction; ?>" method="POST" name="total_form" id="total_form">
				        <label for="cantidad">
				        <div align="right">Con que cantidad pagara $</div>
				        </label>
				        <div align="right">
				          <p>
				            <label for="envio"></label>
				            <input type="hidden" name="envio" id="envio" value="<?php echo $envio  ?>">
				            <label for="orden"></label>
				            <input name="orden" type="hidden" id="orden" value="<?php echo $row_datos['id_ordenes']; ?>">
				            <input type="hidden" name="total" id="total" value="<?php echo $total;?>">
				            <label for="subtotal"></label>
				            <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>">
				            <span id="sprytextfield1">
                          <input name="cantidad" type="text" id="cantidad" size="4">
                          <span class="textfieldRequiredMsg">Se necesita saber con cuanto pagara</span><span class="textfieldInvalidFormatMsg">$.</span></span></p>
				          <p><input type="image" src="Img/ordenar.JPG" width="219" height="110" alt="Ordenar"></p>
			            </div>
				        <input type="hidden" name="MM_update" value="total_form">
				      </form></td>
			        </tr>
			      </table>
				  <form name="form2" method="post" action="">
				  </form>
				  <p>&nbsp;</p>
				  <p>&nbsp;</p>
				</div>
				<div id="imBtMn"><a href="home.html">Página de inicio</a> | <a href="menu-de-hoy.html">Menu de hoy</a> | <a href="ordenar.html">Ordenar</a> | <a href="ubicacion.html">Ubicacion</a> | <a href="contactanos.html">Contactanos</a> | <a href="sobre-nosotros.html">Sobre nosotros</a> | <a href="imsitemap.html">Mapa general del sitio</a></div>				  
				<div class="imClear"></div>
			</div>
			<div id="imFooter">
				
			</div>
		</div>
		<div id="apDiv1"></div>
		<span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "currency", {format:"dot_comma", validateOn:["blur"]});
        </script>
	</body>
</html>
<?php
mysql_free_result($datos);

mysql_free_result($Codigo_Postal);
?>

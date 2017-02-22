<?php date_default_timezone_set("Mexico/General"); ?>
<?php require_once('../Connections/COnexionGourmet.php'); ?>
<?php
$fecha = $_GET['fecha'];
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

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_idorden = sprintf("SELECT id_ordenes FROM ordenes WHERE fecha_ordenes=%s and hora_ordenes=%s and nombre=%s",GetSQLValueString($fecha, "text"), GetSQLValueString($hora, "text"),GetSQLValueString($nombre, "text"));
$idorden = mysql_query($query_idorden, $COnexionGourmet) or die(mysql_error());
$row_idorden = mysql_fetch_assoc($idorden);
$totalRows_idorden = mysql_num_rows($idorden);

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
			GetSQLValueString($row_idorden['id_ordenes'], "int"),
			GetSQLValueString($fecha, "text"));
$detalle_menu = mysql_query($query_detalle_menu, $COnexionGourmet) or die(mysql_error());
$row_detalle_menu = mysql_fetch_assoc($detalle_menu);
$totalRows_detalle_menu = mysql_num_rows($detalle_menu);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_sopas =sprintf("SELECT platillo.id_plat, case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Sopa' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$sopas = mysql_query($query_sopas, $COnexionGourmet) or die(mysql_error());
$row_sopas = mysql_fetch_assoc($sopas);
$totalRows_sopas = mysql_num_rows($sopas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_ensaldas = sprintf("SELECT platillo.id_plat, case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Ensalada' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$ensaldas = mysql_query($query_ensaldas, $COnexionGourmet) or die(mysql_error());
$row_ensaldas = mysql_fetch_assoc($ensaldas);
$totalRows_ensaldas = mysql_num_rows($ensaldas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_antojitos = sprintf("SELECT platillo.id_plat, case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Antojito' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$antojitos = mysql_query($query_antojitos, $COnexionGourmet) or die(mysql_error());
$row_antojitos = mysql_fetch_assoc($antojitos);
$totalRows_antojitos = mysql_num_rows($antojitos);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_guisados = sprintf("SELECT platillo.id_plat, case platillo.especial
                                      when 1 then detalle_menu.nombre_especial
                                      when 0 then platillo.nombre_plat 
                                      end as nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'Guisado' and menu.fecha = %s",GetSQLValueString(date("d/m/Y"),"text"));
$guisados = mysql_query($query_guisados, $COnexionGourmet) or die(mysql_error());
$row_guisados = mysql_fetch_assoc($guisados);
$totalRows_guisados = mysql_num_rows($guisados);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_postres = sprintf("SELECT platillo.id_plat, case platillo.especial
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
		<script type="text/javascript" src="../res/jquery.js?31"></script>
		<script type="text/javascript" src="../res/x5engine.js?31"></script>
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
				  <p>Hola <?php echo $nombre; ?> que se te antoja ?</p>
				  <p>&nbsp;</p>
				  <form name="form1" method="post" action="">
				    <label for="id_orden"></label>
				    <input name="id_orden" type="hidden" id="id_orden" value="<?php echo $row_idorden['id_ordenes']; ?>">
			        <label for="fecha"></label>
			        <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha?>" >
				    <label for="hora"></label>
				    <input type="hidden" name="hora" id="hora" value="<?php echo $hora;?>" >
				    <input type="hidden" name="id_plat" id="id_plat" value="<?php echo $_GET['id'];?>">
				  </form>
				  <p>&nbsp;</p>
				  <table width="350" border="1">
				    <tr class="alert-red">
				      <td class="alert-red">Menu</td>
				      <td class="alert-red">Mi Menu</td>
			        </tr>
				    <tr>
				      <td><p>&nbsp;</p>
				        <table width="350" border="1">
				          <tr>
				            <td><h3>Sopas</h3></td>
				            <td><h3>$</h3></td>
				            <td>&nbsp;</td>
			              </tr>
                          <?php do { ?>
				          <tr>
				            <td><?php echo $row_sopas['nombre_plat']; ?></td>
				            <td><?php echo $row_sopas['precio']; ?></td>
				            <td><a href="ordenar21.php?fecha=<?php echo $fecha; ?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>&id=<?php echo $row_sopas['id_plat'];?>"><img src="../Img/seleccionar.JPG" alt="Seleccionar" width="80" height="29" align="top"></a></td>
			              </tr>
                          <?php } while ($row_sopas = mysql_fetch_assoc($sopas)); ?>
				          <tr>
				            <td><h3>&nbsp;</h3>
			                <h3>Ensaladas</h3></td>
				            <td>&nbsp;</td>
				            <td>&nbsp;</td>
			              </tr>
                          <?php do { ?>
				          <tr>
				            <td><?php echo $row_ensaldas['nombre_plat']; ?></td>
				            <td><?php echo $row_ensaldas['precio']; ?></td>
				            <td><a href="ordenar21.php?fecha=<?php echo $fecha; ?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>&id=<?php echo $row_ensaldas['id_plat'];?>"><img src="../Img/seleccionar.JPG" alt="Seleccionar" width="80" height="29" align="top"></a></td>
			              </tr>
                          <?php } while ($row_ensaldas = mysql_fetch_assoc($ensaldas)); ?>
				          <tr>
				            <td><h3>&nbsp;</h3>
			                <h3>Antojitos</h3></td>
				            <td>&nbsp;</td>
				            <td>&nbsp;</td>
			              </tr>
                          <?php do { ?>
				          <tr>
				            <td><?php echo $row_antojitos['nombre_plat']; ?></td>
				            <td><?php echo $row_antojitos['precio']; ?></td>
				            <td><a href="ordenar21.php?fecha=<?php echo $fecha; ?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>&id=<?php echo $row_antojitos['id_plat'];?>"><img src="../Img/seleccionar.JPG" alt="Seleccionar" width="80" height="29" align="top"></a></td>
			              </tr>
                          <?php } while ($row_antojitos = mysql_fetch_assoc($antojitos)); ?>
				          <tr>
				            <td><h3>&nbsp;</h3>
			                <h3>Guisados</h3></td>
				            <td>&nbsp;</td>
				            <td>&nbsp;</td>
			              </tr>
                          <?php do { ?>
				          <tr>
				            <td><?php echo $row_guisados['nombre_plat']; ?></td>
				            <td><?php echo $row_guisados['precio']; ?></td>
				            <td><a href="ordenar21.php?fecha=<?php echo $fecha; ?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>&id=<?php echo $row_guisados['id_plat'];?>"><img src="../Img/seleccionar.JPG" alt="Seleccionar" width="80" height="29" align="top"></a></td>
			              </tr>
                          <?php } while ($row_guisados = mysql_fetch_assoc($guisados)); ?>
				          <tr>
				            <td><h3>&nbsp;</h3>
			                <h3>Postres</h3></td>
				            <td>&nbsp;</td>
				            <td>&nbsp;</td>
			              </tr>
                          <?php do { ?>
				          <tr>
				            <td><?php echo $row_postres['nombre_plat']; ?></td>
				            <td><?php echo $row_postres['precio']; ?></td>
				            <td><a href="ordenar21.php?fecha=<?php echo $fecha; ?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>&id=<?php echo $row_postres['id_plat'];?>"><img src="../Img/seleccionar.JPG" alt="Seleccionar" width="80" height="29" align="top"></a></td>
			              </tr>
                          <?php } while ($row_postres = mysql_fetch_assoc($postres)); ?>
			            </table>
				        <p>&nbsp;</p>
			          <p>&nbsp;</p></td>
				      <td><p>&nbsp;</p>
				        <table width="360" border="1">
				        <tr>
				          <td width="197"><h3>Platillo</h3>
				            <h3>&nbsp;</h3></td>
				          <td width="69"><h3>$</h3></td>
				          <td width="80"><h3>Cantidad</h3></td>
				          <td width="80">&nbsp;</td>
			            </tr>
				        <?php do { ?>
				        <tr>
				          <td><?php echo $row_detalle_menu['nombre']; ?> </td>
				          <td><?php echo $row_detalle_menu['precio']; ?></td>
				          <td><p><?php echo $row_detalle_menu['cantidad']; ?></p>
			              <p>&nbsp;</p>
			              <p>&nbsp;</p></td>
				          <td><a href="elimina2.php?id_detalleordenes=<?php echo $row_detalle_menu['id_detalleordenes'];?>&id_ordenes=<?php echo $row_detalle_menu['id_ordenes'];?>&id_plat=<?php echo $row_detalle_menu['id_plat'];?>&fecha=<?php echo $fecha;?>&hora=<?php echo $hora;?>&nombre=<?php echo $nombre;?>"><img src="../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Eliminar"></a></td>
			            </tr>
                        <?php 
						$precio = $row_detalle_menu['precio'] * $row_detalle_menu['cantidad'];;
						$subtotal = $subtotal + $precio;  ?>
				        <?php } while ($row_detalle_menu = mysql_fetch_assoc($detalle_menu)); ?>
			          </table>
				        <div align="center">
				          <table width="350" border="1">
				            <tr> 
				              <td><div align="center">$<?php echo $subtotal ?></div></td>
			                </tr>
				            <tr>
				              <td><div align="center">--------------------------------------------Subtotal</div></td>
			                </tr>
				            <tr>
				              <td><div align="center"><a href="../ordenar3.php?id_ordenes=<?php echo $row_idorden['id_ordenes']?>"><img src="../Img/confirma.png" width="214" height="92" alt="Confirma" longdesc="../ordenar3.php"></a></div></td>
			                </tr>
			              </table>
		              </div></td>
			        </tr>
			      </table>
				  <p>&nbsp;</p>
				  <p>&nbsp;</p>
				  <p>&nbsp;</p>
				</div>
				<div id="imBtMn"><a href="../home.html">Página de inicio</a> | <a href="../menu-de-hoy.html">Menu de hoy</a> | <a href="../ordenar.html">Ordenar</a> | <a href="../ubicacion.html">Ubicacion</a> | <a href="../contactanos.html">Contactanos</a> | <a href="../sobre-nosotros.html">Sobre nosotros</a> | <a href="../imsitemap.html">Mapa general del sitio</a></div>				  
				<div class="imClear"></div>
			</div>
			<div id="imFooter">
				
			</div>
		</div>
		<span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
	</body>
</html>
<?php
mysql_free_result($sopas);

mysql_free_result($ensaldas);

mysql_free_result($antojitos);

mysql_free_result($guisados);

mysql_free_result($postres);

mysql_free_result($idorden);
?>

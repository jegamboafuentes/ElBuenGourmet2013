<?php date_default_timezone_set("Mexico/General"); ?>
<?php require_once('../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../Connections/COnexionGourmet.php'); ?>
<?php global $id_plat ?>
<?php require_once('../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../Connections/COnexionGourmet.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO detalle_menu (id_menu, id_plat) VALUES (%s, %s)",
                       GetSQLValueString($_POST['id_menu'], "int"),
                       GetSQLValueString($_POST['id_plat'], "text"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($insertSQL, $COnexionGourmet) or die(mysql_error());

  $insertGoTo = "Seleccionar Platillo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_IdMenu_porFecha = "SELECT id_menu FROM menu ORDER BY id_menu DESC";
$IdMenu_porFecha = mysql_query($query_IdMenu_porFecha, $COnexionGourmet) or die(mysql_error());
$row_IdMenu_porFecha = mysql_fetch_assoc($IdMenu_porFecha);
$totalRows_IdMenu_porFecha = mysql_num_rows($IdMenu_porFecha);

$colname_verplatillos = "-1";
if (isset($_GET['nombre'])) {
  $colname_verplatillos = $_GET['nombre'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_verplatillos = sprintf("SELECT id_plat, nombre_plat, precio, tipo FROM platillo WHERE nombre_plat LIKE %s", GetSQLValueString("%" . $colname_verplatillos . "%", "text"));
$verplatillos = mysql_query($query_verplatillos, $COnexionGourmet) or die(mysql_error());
$row_verplatillos = mysql_fetch_assoc($verplatillos);
$totalRows_verplatillos = mysql_num_rows($verplatillos);

$colname_detalle_menu = "-1";
if (isset($_GET['id_menu'])) {
  $colname_detalle_menu = $_GET['id_menu'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_detalle_menu = sprintf("SELECT detalle_menu.id_plat, platillo.nombre_plat, detalle_menu.id_menu FROM platillo, detalle_menu  WHERE platillo.id_plat = detalle_menu.id_plat and id_menu = %s", GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$detalle_menu = mysql_query($query_detalle_menu, $COnexionGourmet) or die(mysql_error());
$row_detalle_menu = mysql_fetch_assoc($detalle_menu);
$totalRows_detalle_menu = mysql_num_rows($detalle_menu);

$colname_quiereplatillo = "-1";
if (isset($_GET['id'])) {
  $colname_quiereplatillo = $_GET['id'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_quiereplatillo = sprintf("SELECT nombre_plat FROM platillo WHERE id_plat = %s", GetSQLValueString($colname_quiereplatillo, "text"));
$quiereplatillo = mysql_query($query_quiereplatillo, $COnexionGourmet) or die(mysql_error());
$row_quiereplatillo = mysql_fetch_assoc($quiereplatillo);
$totalRows_quiereplatillo = mysql_num_rows($quiereplatillo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seleccionar Platillo</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Selectores de elemento/etiqueta ~~ */
ul, ol, dl { /* Debido a las diferencias existentes entre los navegadores, es recomendable no añadir relleno ni márgenes en las listas. Para lograr coherencia, puede especificar las cantidades deseadas aquí o en los elementos de lista (LI, DT, DD) que contienen. Recuerde que lo que haga aquí se aplicará en cascada en la lista .nav, a no ser que escriba un selector más específico. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* la eliminación del margen superior resuelve un problema que origina que los márgenes escapen de la etiqueta div contenedora. El margen inferior restante lo mantendrá separado de los elementos de que le sigan. */
	padding-right: 15px;
	padding-left: 15px; /* la adición de relleno a los lados del elemento dentro de las divs, en lugar de en las divs propiamente dichas, elimina todas las matemáticas de modelo de cuadro. Una div anidada con relleno lateral también puede usarse como método alternativo. */
}
a img { /* este selector elimina el borde azul predeterminado que se muestra en algunos navegadores alrededor de una imagen cuando está rodeada por un vínculo */
	border: none;
}

/* ~~ La aplicación de estilo a los vínculos del sitio debe permanecer en este orden (incluido el grupo de selectores que crea el efecto hover -paso por encima-). ~~ */
a:link {
	color:#414958;
	text-decoration: underline; /* a no ser que aplique estilos a los vínculos para que tengan un aspecto muy exclusivo, es recomendable proporcionar subrayados para facilitar una identificación visual rápida */
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* este grupo de selectores proporcionará a un usuario que navegue mediante el teclado la misma experiencia de hover (paso por encima) que experimenta un usuario que emplea un ratón. */
	text-decoration: none;
}

/* ~~ este contenedor rodea a todas las demás divs, lo que les asigna su anchura basada en porcentaje ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* puede que sea conveniente una anchura máxima (max-width) para evitar que este diseño sea demasiado ancho en un monitor grande. Esto mantiene una longitud de línea más legible. IE6 no respeta esta declaración. */
	min-width: 780px;/* puede que sea conveniente una anchura mínima (min-width) para evitar que este diseño sea demasiado estrecho. Esto permite que la longitud de línea sea más legible en las columnas laterales. IE6 no respeta esta declaración. */
	background-color: #FFF;
	margin: 0; /* el valor automático de los lados, unido a la anchura, centra el diseño. No es necesario si establece la anchura de .container en el 100%. */
}

/* ~~no se asigna una anchura al encabezado. Se extenderá por toda la anchura del diseño. Contiene un marcador de posición de imagen que debe sustituirse por su propio logotipo vinculado~~ */
.header {
	background-color: #6F7D94;
}

/* ~~ Esta es la información de diseño. ~~ 

1) El relleno sólo se sitúa en la parte superior y/o inferior de la div. Los elementos situados dentro de esta div tienen relleno a los lados. Esto le ahorra las "matemáticas de modelo de cuadro". Recuerde que si añade relleno o borde lateral a la div propiamente dicha, éste se añadirá a la anchura que defina para crear la anchura *total*. También puede optar por eliminar el relleno del elemento en la div y colocar una segunda div dentro de ésta sin anchura y el relleno necesario para el diseño deseado.

*/
.content {
	padding: 10px 0;
}

/* ~~ Este selector agrupado da espacio a las listas del área de .content ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* este relleno reproduce en espejo el relleno derecho de la regla de encabezados y de párrafo incluida más arriba. El relleno se ha colocado en la parte inferior para que el espacio existente entre otros elementos de la lista y a la izquierda cree la sangría. Estos pueden ajustarse como se desee. */
}

/* ~~ El pie de página ~~ */
.footer {
	padding: 10px 0;
	background-color: #6F7D94;
}

/* ~~ clases float/clear varias ~~ */
.fltrt {  /* esta clase puede utilizarse para que un elemento flote en la parte derecha de la página. El elemento flotante debe preceder al elemento junto al que debe aparecer en la página. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* esta clase puede utilizarse para que un elemento flote en la parte izquierda de la página. El elemento flotante debe preceder al elemento junto al que debe aparecer en la página. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* esta clase puede situarse en una <br /> o div vacía como elemento final tras la última div flotante (dentro de #container) si #footer se elimina o se saca fuera de #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div>
  <div class="header"><img src="../../Img/logox.jpg" width="244" height="125" /><!-- end .header --></div>
  <div class="content">
    <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
      <p>
        <label for="id_menu"></label>
        <input name="id_menu" type="hidden" id="id_menu" value="<?php echo $row_IdMenu_porFecha['id_menu']; ?>" />
        <label for="id_plat"></label>
        <input type="hidden" name="id_plat" id="id_plat" value="<?php echo $_GET['id']?>" />
        <input type="hidden" name="MM_insert" value="form1" />
      </p>
      <p>&nbsp;</p>
    </form>
    <table width="886" border="0">
      <tr>
        <th width="880" nowrap="nowrap">&nbsp;
          <table border="1">
            <tr>
              <td bgcolor="#FFFFFF">&nbsp;</td>
              <td bgcolor="#FFFFFF">id_plat</td>
              <td bgcolor="#FFFFFF">nombre_plat</td>
              <td bgcolor="#FFFFFF">precio</td>
              <td bgcolor="#FFFFFF">tipo</td>
            </tr>
            <?php do { ?>
              <tr>
                <td bgcolor="#FFFFFF"><a href="Seleccionar Platillo.php?id=<?php echo $row_verplatillos['id_plat']; ?>"">Seleccionar</a></td>
                <td bgcolor="#FFFFFF"><?php echo $row_verplatillos['id_plat']; ?></td>
                <td bgcolor="#FFFFFF"><?php echo $row_verplatillos['nombre_plat']; ?></td>
                <td bgcolor="#FFFFFF"><?php echo $row_verplatillos['precio']; ?></td>
                <td bgcolor="#FFFFFF"><?php echo $row_verplatillos['tipo']; ?></td>
              </tr>
              <?php } while ($row_verplatillos = mysql_fetch_assoc($verplatillos)); ?>
        </table>        </th>
      </tr>
    </table>
    <!-- end .content --></div>
  <div class="footer">
    <p>&nbsp;</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($IdMenu_porFecha);

mysql_free_result($detalle_menu);

mysql_free_result($verplatillos);

mysql_free_result($quiereplatillo);
?>

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

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_TablaComidas = sprintf("SELECT platillo.nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'comida' and menu.fecha = %s",GetSQLValueString($_GET['fecha'],"text"));
$TablaComidas = mysql_query($query_TablaComidas, $COnexionGourmet) or die(mysql_error());
$row_TablaComidas = mysql_fetch_assoc($TablaComidas);
$totalRows_TablaComidas = mysql_num_rows($TablaComidas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_TablaBebidas = sprintf( "select		platillo.nombre_plat, platillo.precio, platillo.tipo from		platillo, menu, detalle_menu  where menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and platillo.tipo = 'bebida' and menu.fecha = %s",GetSQLValueString($_GET['fecha'],"text"));;
$TablaBebidas = mysql_query($query_TablaBebidas, $COnexionGourmet) or die(mysql_error());
$row_TablaBebidas = mysql_fetch_assoc($TablaBebidas);
$totalRows_TablaBebidas = mysql_num_rows($TablaBebidas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_TablaEnsaladas = sprintf("SELECT platillo.nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and menu.fecha = %s and platillo.tipo = 'ensalada' ",GetSQLValueString($_GET['fecha'],"text"));
$TablaEnsaladas = mysql_query($query_TablaEnsaladas, $COnexionGourmet) or die(mysql_error());
$row_TablaEnsaladas = mysql_fetch_assoc($TablaEnsaladas);
$totalRows_TablaEnsaladas = mysql_num_rows($TablaEnsaladas);

$maxRows_TablaPostres = 10;
$pageNum_TablaPostres = 0;
if (isset($_GET['pageNum_TablaPostres'])) {
  $pageNum_TablaPostres = $_GET['pageNum_TablaPostres'];
}
$startRow_TablaPostres = $pageNum_TablaPostres * $maxRows_TablaPostres;

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_TablaPostres = sprintf("SELECT platillo.nombre_plat, platillo.precio FROM platillo, menu, detalle_menu WHERE menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and menu.fecha = %s and platillo.tipo = 'postre' ",GetSQLValueString($_GET['fecha'],"text"));
$query_limit_TablaPostres = sprintf("%s LIMIT %d, %d", $query_TablaPostres, $startRow_TablaPostres, $maxRows_TablaPostres);
$TablaPostres = mysql_query($query_limit_TablaPostres, $COnexionGourmet) or die(mysql_error());
$row_TablaPostres = mysql_fetch_assoc($TablaPostres);

if (isset($_GET['totalRows_TablaPostres'])) {
  $totalRows_TablaPostres = $_GET['totalRows_TablaPostres'];
} else {
  $all_TablaPostres = mysql_query($query_TablaPostres);
  $totalRows_TablaPostres = mysql_num_rows($all_TablaPostres);
}
$totalPages_TablaPostres = ceil($totalRows_TablaPostres/$maxRows_TablaPostres)-1;

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_TablaOtros = sprintf("select		platillo.nombre_plat, platillo.precio from		platillo, menu, detalle_menu  where menu.id_menu = detalle_menu.id_menu and detalle_menu.id_plat = platillo.id_plat and menu.fecha = %s and platillo.tipo = 'x' ",GetSQLValueString($_GET['fecha'],"text"));
$TablaOtros = mysql_query($query_TablaOtros, $COnexionGourmet) or die(mysql_error());
$row_TablaOtros = mysql_fetch_assoc($TablaOtros);
$totalRows_TablaOtros = mysql_num_rows($TablaOtros);
 date_default_timezone_set("Mexico/General"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	margin: 0;
	padding: 0;
	color: #000;
	width: auto;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 100%;
	line-height: 1.4;
	background-image: url(Imagenes/madera.jpg);
}

/* ~~ Selectores de elemento/etiqueta ~~ */
ul, ol, dl { /* Debido a las diferencias existentes entre los navegadores, es recomendable no añadir relleno ni márgenes en las listas. Para lograr coherencia, puede especificar las cantidades deseadas aquí o en los elementos de lista (LI, DT, DD) que contienen. Recuerde que lo que haga aquí se aplicará en cascada en la lista .nav, a no ser que escriba un selector más específico. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;
	height: 80px;
	width: 768px;
	padding: 15px;
	
/*	background-image: url(Imagenes/Menu.png);*/
	background-image:url(Imagenes/Titulo.png);
	background-size:auto;
}
a img { /* este selector elimina el borde azul predeterminado que se muestra en algunos navegadores alrededor de una imagen cuando está rodeada por un vínculo */
	border: none;
}

/* ~~ La aplicación de estilo a los vínculos del sitio debe permanecer en este orden (incluido el grupo de selectores que crea el efecto hover -paso por encima-). ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* a no ser que aplique estilos a los vínculos para que tengan un aspecto muy exclusivo, es recomendable proporcionar subrayados para facilitar una identificación visual rápida */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* este grupo de selectores proporcionará a un usuario que navegue mediante el teclado la misma experiencia de hover (paso por encima) que experimenta un usuario que emplea un ratón. */
	text-decoration: none;
}

/* ~~ este contenedor de anchura fija rodea a las demás divs~~ */
.container {
	width: 900px;
/*	background-image:url(Imagenes/row-bot-2.jpg);  el valor automático de los lados, unido a la anchura, centra el diseño */
	background-image:url(Imagenes/madera.jpg);
	overflow: hidden; /* esta declaración hace que .container conozca dónde terminan las columnas flotantes incluidas y las contenga */
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
	position: static;
	height: auto;
	font-size: 12px;
}

/* ~~ Estas son las columnas para el diseño. ~~ 

1) El relleno sólo se sitúa en la parte superior y/o inferior de las divs. Los elementos situados dentro de estas divs tienen relleno a los lados. Esto le ahorra las "matemáticas de modelo de cuadro". Recuerde que si añade relleno o borde lateral a la div propiamente dicha, éste se añadirá a la anchura que defina para crear la anchura *total*. También puede optar por eliminar el relleno del elemento en la div y colocar una segunda div dentro de ésta sin anchura y el relleno necesario para el diseño deseado.

2) No se asigna margen a las columnas, ya que todas ellas son flotantes. Si es preciso añadir un margen, evite colocarlo en el lado hacia el que se produce la flotación (por ejemplo: un margen derecho en una div configurada para flotar hacia la derecha). En muchas ocasiones, puede usarse relleno como alternativa. En el caso de divs para las que deba incumplirse esta regla, deberá añadir una declaración "display:inline" a la regla de la div para evitar un error que provoca que algunas versiones de Internet Explorer dupliquen el margen.

3) Dado que las clases se pueden usar varias veces en un documento (y que también se pueden aplicar varias clases a un elemento), se ha asignado a las columnas nombres de clases en lugar de ID. Por ejemplo, dos divs de barra lateral podrían apilarse si fuera necesario. Si lo prefiere, éstas pueden cambiarse a ID fácilmente, siempre y cuando las utilice una sola vez por documento.

4) Si prefiere que la navegación esté a la derecha en lugar de a la izquierda, simplemente haga que estas columnas floten en dirección opuesta (todas a la derecha en lugar de todas a la izquierda) y éstas se representarán en orden inverso. No es necesario mover las divs por el código fuente HTML.

*/
.sidebar1 {
	float: left;
	width: 100px;
	background-color: #EADCAE;
	padding-bottom: 10px;
}
.content {
	width: auto;
	float: left;
	height: auto;
	clear: none;
	font-family: Tahoma, Geneva, sans-serif;
	background-color: #F90;
	padding: 10px;
}
.sidebar2 {
	float: left;
	width: 100px;
	background-color: #EADCAE;
	padding-top: 10px;
	padding-right: 0;
	padding-bottom: 10px;
	padding-left: 0;
}

/* ~~ Este selector agrupado da espacio a las listas del área de .content ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* este relleno reproduce en espejo el relleno derecho de la regla de encabezados y de párrafo incluida más arriba. El relleno se ha colocado en la parte inferior para que el espacio existente entre otros elementos de la lista y a la izquierda cree la sangría. Estos pueden ajustarse como se desee. */
}

/* ~~ Los estilos de lista de navegación (pueden eliminarse si opta por usar un menú desplegable predefinido como el de Spry) ~~ */
ul.nav {
	list-style: none; /* esto elimina el marcador de lista */
	border-top: 1px solid #666; /* esto crea el borde superior de los vínculos (los demás se sitúan usando un borde inferior en el LI) */
	margin-bottom: 15px; /* esto crea el espacio entre la navegación en el contenido situado debajo */
}
ul.nav li {
	border-bottom: 1px solid #666; /* esto crea la separación de los botones */
}
ul.nav a, ul.nav a:visited { /* al agrupar estos selectores, se asegurará de que los vínculos mantengan el aspecto de botón incluso después de haber sido visitados */
	padding: 5px 5px 5px 15px;
	display: block; /* esto asigna propiedades de bloque al vínculo, lo que provoca que llene todo el LI que lo contiene. Esto provoca que toda el área reaccione a un clic de ratón. */
	width: 160px;  /*esta anchura hace que se pueda hacer clic en todo el botón para IE6. Puede eliminarse si no es necesario proporcionar compatibilidad con IE6. Calcule la anchura adecuada restando el relleno de este vínculo de la anchura del contenedor de barra lateral. */
	text-decoration: none;
	background-color: #C6D580;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* esto cambia el color de fondo y del texto tanto para usuarios que naveguen con ratón como para los que lo hagan con teclado */
	background-color: #ADB96E;
	color: #FFF;
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
.clearfloat { /* esta clase puede situarse en una <br /> o div vacía como elemento final tras la última div flotante (dentro de #container) si se elimina overflow:hidden en .container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
.container div h1 {
	font-family: "Palace Script MT";
}
h1 {
	font-size: 200%;
}
h1 {
	font-size: 800%;
}
.container div div div table tr td {
	font-family: Edwardian Script ITC;
	font-size: 700%;
	font-weight: bold;
	color: inherit;
}
.container div div div table tr td table {
	font-size: 10px;
}
.container div div div table tr td div table tr td {
	color:#FFF;
}
.container div div div table tr td div table tr td {
	font-family: "Arial Black", Gadget, sans-serif;
	font-size: 300%;
	color: #666;
}
.container div div div table tr td div table {
	font-size: 24px;
}
.container div div div table tr td div table {
	font-size: 12px;
}
.container div div div table tr td div table {
	font-size: 9px;
}
-->
</style></head>

<body>
<div class="container">
  <div>
    <h1 align="center">&nbsp;</h1>
    <div>	
      <div align="center" >
        <br />
        <br />
        <table width="700" border="0">
          <tr>
            <td width="604" height="123"><div align="left">Comidas:<br />              
                <table width="692" border="0">
                  <?php do { ?>
                    <tr>
                      <td class="container"><?php echo $row_TablaComidas['nombre_plat']; ?></td>
                      <td width="344"> <div align="right">$ <?php echo $row_TablaComidas['precio']; ?></div></td>
                    </tr>
                    <?php } while ($row_TablaComidas = mysql_fetch_assoc($TablaComidas)); ?>
                </table>
            </div></td>
          </tr>
          <tr>
            <td height="123"><div align="left">Bebidas:<br />
                <table width="1046" border="0">
                  <?php do { ?>
                    <tr>
                      <td width="415"><div align="left"><?php echo $row_TablaBebidas['nombre_plat']; ?></div></td>
                      <td width="621"><div align="right">$<?php echo $row_TablaBebidas['precio']; ?></div></td>
                    </tr>
                    <?php } while ($row_TablaBebidas = mysql_fetch_assoc($TablaBebidas)); ?>
                </table>
            </div></td>
          </tr>
          <tr>
            <td><div align="left">Ensaladas:<br />
                <table width="692" border="0">
                  <?php do { ?>
                    <tr>
                      <td height="108"><div align="left"><?php echo $row_TablaEnsaladas['nombre_plat']; ?></div></td>
                      <td><div align="right">$ <?php echo $row_TablaEnsaladas['precio']; ?></div></td>
                    </tr>
                    <?php } while ($row_TablaEnsaladas = mysql_fetch_assoc($TablaEnsaladas)); ?>
                </table>
            </div></td>
          </tr>
          <tr>
            <td><div align="left">Postres:<br />
                <table width="682" border="0">
                  <?php do { ?>
                    <tr>
                      <td><div align="left"><?php echo $row_TablaPostres['nombre_plat']; ?></div></td>
                      <td><div align="right">$<?php echo $row_TablaPostres['precio']; ?></div></td>
                    </tr>
                    <?php } while ($row_TablaPostres = mysql_fetch_assoc($TablaPostres)); ?>
                </table>
            </div></td>
          </tr>
          <tr>
            <td><div align="left">Otros:<br />
                <table width="682" height="120" border="0">
                  <?php do { ?>
                    <tr>
                      <td><div align="left"><?php echo $row_TablaOtros['nombre_plat']; ?><br />
                      </div></td>
                      <td><div align="right">$<?php echo $row_TablaOtros['precio']; ?><br />
                      </div></td>
                    </tr>
                    <?php } while ($row_TablaOtros = mysql_fetch_assoc($TablaOtros)); ?>
                </table>
                <br />
            </div></td>
          </tr>
        </table>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
      </div>
    </div>
  </div>
  <div align="center"><!-- end .container --></div>
</div>
</body>
</html>
<?php
mysql_free_result($TablaComidas);

mysql_free_result($TablaBebidas);

mysql_free_result($TablaEnsaladas);

mysql_free_result($TablaPostres);

mysql_free_result($TablaOtros);
?>

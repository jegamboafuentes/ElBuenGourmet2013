<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); $fecha = $_GET['fecha']?>
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
$query_sopa = sprintf("SELECT id_plat, nombre_plat, precio FROM platillo where tipo='Antojito' and id_plat = %s", GetSQLValueString($_GET['clave'],"text"));
$sopa = mysql_query($query_sopa, $COnexionGourmet) or die(mysql_error());
$row_sopa = mysql_fetch_assoc($sopa);
$totalRows_sopa = mysql_num_rows($sopa);

$colname_especial = "-1";
if (isset($_GET['id'])) {
  $colname_especial = $_GET['id'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_especial = sprintf("SELECT especial FROM platillo WHERE id_plat = %s", GetSQLValueString($colname_especial, "text"));
$especial = mysql_query($query_especial, $COnexionGourmet) or die(mysql_error());
$row_especial = mysql_fetch_assoc($especial);
$totalRows_especial = mysql_num_rows($especial);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_SopaActual = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Antojito' and id_menu = %s ",GetSQLValueString($_GET['id_menu'], "text"));
$SopaActual = mysql_query($query_SopaActual, $COnexionGourmet) or die(mysql_error());
$row_SopaActual = mysql_fetch_assoc($SopaActual);
if ($row_especial['especial'] == 1){header ("Location: 3_1 especial.php?id=".$_GET['id']."&id_menu=".$_GET['id_menu']."&fecha=".$_GET['fecha']);}
$totalRows_SopaActual = mysql_num_rows($SopaActual);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla Admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="http://elbuengourmet.mx/Img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar los antojitos</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
}
/* --------------- BOTONES --------------- */

.button, .button:visited { /* botones genéricos */
	background: #222 url(http://sites.google.com/site/zavaletaster/Home/overlay.png) repeat-x;
	display: inline-block;
	padding: 5px 10px 6px;
	color: #000;
	text-decoration: none;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	border-top: 0px;
	border-left: 0px;
	border-right: 0px;
	border-bottom: 1px solid rgba(0,0,0,0.25);
	position: relative;
	cursor: pointer;
}

button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner {
border: none;
}

.button:hover { /* el efecto hover */
background-color: #111
color: #FFF;
}

.button:active{ /* el efecto click */
top: 1px;
}

/* botones pequeños */
.small.button, .small.button:visited {
font-size: 11px ;
}

/* botones medianos */
.button, .button:visited,.medium.button, .medium.button:visited {
font-size: 13px;
font-weight: bold;
line-height: 1;
text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
}

/* botones grandes */
.large.button, .large.button:visited {
font-size:14px;
padding: 8px 14px 9px;
}

/* botones extra grandes */
.super.button, .super.button:visited {
font-size: 34px;
padding: 8px 14px 9px;
}

.pink.button { background-color: #E22092; }
.pink.button:hover{ background-color: #C81E82; }

.green.button, .green.button:visited { background-color: #91BD09; }
.green.button:hover{ background-color: #749A02; }

.red.button, .red.button:visited { background-color: #E62727; }
.red.button:hover{ background-color: #CF2525; }

.orange.button, .orange.button:visited { background-color: #FF5C00; }
.orange.button:hover{ background-color: #D45500; }

.blue.button, .blue.button:visited { background-color: #2981E4; }
.blue.button:hover{ background-color: #2575CF; }

.yellow.button, .yellow.button:visited { background-color: #FFB515; }
.yellow.button:hover{ background-color: #FC9200; }


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
	color: #414958; /* a no ser que aplique estilos a los vínculos para que tengan un aspecto muy exclusivo, es recomendable proporcionar subrayados para facilitar una identificación visual rápida */
}
a:visited {
	color: #000000;
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
	margin: 0 auto; /* el valor automático de los lados, unido a la anchura, centra el diseño. No es necesario si establece la anchura de .container en el 100%. */
}

/* ~~ no se asigna una anchura al encabezado. Se extenderá por toda la anchura del diseño. Contiene un marcador de posición de imagen que debe sustituirse por su propio logotipo vinculado ~~ */
.header {
	background-color: #6F7D94;
}

/* ~~ Estas son las columnas para el diseño. ~~ 

1) El relleno sólo se sitúa en la parte superior y/o inferior de las divs. Los elementos situados dentro de estas divs tienen relleno a los lados. Esto le ahorra las "matemáticas de modelo de cuadro". Recuerde que si añade relleno o borde lateral a la div propiamente dicha, éste se añadirá a la anchura que defina para crear la anchura *total*. También puede optar por eliminar el relleno del elemento en la div y colocar una segunda div dentro de ésta sin anchura y el relleno necesario para el diseño deseado.

2) No se asigna margen a las columnas, ya que todas ellas son flotantes. Si es preciso añadir un margen, evite colocarlo en el lado hacia el que se produce la flotación (por ejemplo: un margen derecho en una div configurada para flotar hacia la derecha). En muchas ocasiones, puede usarse relleno como alternativa. En el caso de divs para las que deba incumplirse esta regla, deberá añadir una declaración "display:inline" a la regla de la div para evitar un error que provoca que algunas versiones de Internet Explorer dupliquen el margen.

3) Dado que las clases se pueden usar varias veces en un documento (y que también se pueden aplicar varias clases a un elemento), se ha asignado a las columnas nombres de clases en lugar de ID. Por ejemplo, dos divs de barra lateral podrían apilarse si fuera necesario. Si lo prefiere, éstas pueden cambiarse a ID fácilmente, siempre y cuando las utilice una sola vez por documento.

4) Si prefiere que la navegación esté a la izquierda en lugar de a la derecha, simplemente haga que estas columnas floten en dirección opuesta (todas a la izquierda en lugar de todas a la derecha) y éstas se representarán en orden inverso. No es necesario mover las divs por el código fuente HTML.

*/
.sidebar1 {
	float: right;
	width: 20%;
	background-color: #93A5C4;
	padding-bottom: 10px;
}
.content {
	padding: 10px 0;
	width: 80%;
		float: right;
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
	text-decoration: none;
	background-color: #8090AB;
	color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* esto cambia el color de fondo y del texto tanto para usuarios que naveguen con ratón como para los que lo hagan con teclado */
	background-color: #6F7D94;
	color: #FFF;
}

/* ~~ El pie de página ~~ */
.footer {
	padding: 10px 0;
	background-color: #6F7D94;
	position: relative;/* esto da a IE6 hasLayout para borrar correctamente */
	clear: both; /* esta propiedad de borrado fuerza a .container a conocer dónde terminan las columnas y a contenerlas */
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
</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* este margen negativo de 1 px puede situarse en cualquiera de las columnas de este diseño con el mismo efecto corrector. */
ul.nav a { zoom: 1; }  /* la propiedad de zoom da a IE el desencadenante hasLayout que necesita para corregir el espacio en blanco extra existente entre los vínculos */
</style>
<![endif]--></head>

<body>

<div class="container">
  <div class="header"><a href="../../../../menuAdmin.php"><img src="../../../../Img/logox.jpg" width="200" height="100" /></a><!-- end .header --></div>
  <div class="sidebar1">
    <div align="right">
      <ul class="nav">
        <li><a href="../../../../MenuPlatillo.php">Platillo <img src="../../../../Img/icons/spoon-fork.png" width="32" height="32" /></a></li>
        <li><a href="../../../../Menumenu.php">Menu <img src="../../../../Img/icons/bell.png" width="32" height="32" /></a></li>
        <li><a href="../../../../menu%20usuarios.php">Usuarios <img src="../../../../Img/icons/plate.png" width="32" height="32" /></a></li>
        <li><a href="../../../../menu%20empleado.php">Empleados <img src="../../../../Img/icons/chef-hat.png" width="32" height="32" /></a></li>
        <li><a href="../../../../menuVentas.php">Ventas<img src="../../../../Img/icons/menu-card.png" width="32" height="32" alt="Administrar ventas" /></a></li>
        <li><a href="../../../../menuConfiguracion.php">Configuración<img src="../../../../Img/icons/wifi.png" width="32" height="32" /></a></li>
        <li><a href="../../../../Menu%20Clientes.php">Clientes<img src="../../../../Img/icons/lift.png" width="32" height="32" alt="clientes" /></a></li>
        <li><a href="../../../../Loging.php">Salir</a></li>
      </ul>
    </div>
    <p align="right">&nbsp;</p>
    <div align="right">
      <!-- end .sidebar1 -->
    </div>
  </div>
  <div class="content"><!-- end .content --><!-- InstanceBeginEditable name="EditRegion3" -->
    <p>Agregar antojitos al menu del dia: <?php echo $fecha = $_GET['fecha']; ?>
      <label for="id_menu"></label>
      <input type="hidden" name="id_menu" id="id_menu" value="<?php echo $id_menu = $_GET['id_menu'];?>" />
      <br />
    </p>
    <div align="center">
      <table width="663" border="0">
        <tr>
          <td><form id="Nombre" name="nombre" method="get" action="3 nombre.php">
            <label for="nombre2">Nombre: </label>
            <input type="text" name="nombre" id="nombre2" />
            <input type="submit" name="button" id="button" value="Buscar" />
            <input type="hidden" name="id_menu" id="id_menu" value="<?php echo $id_menu = $_GET['id_menu'];?>" />
            <label for="fecha"></label>
            <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha;?>" />
          </form></td>
          <td><form id="form2" name="form2" method="get" action="3 clave.php">
            <label for="clave2">Clave:</label>
            <input type="text" name="clave" id="clave2" />
            <input type="submit" name="button2" id="button2" value="Buscar" />
            <input type="hidden" name="id_menu" id="id_menu" value="<?php echo $id_menu = $_GET['id_menu'];?>" />
            <label for="fecha3"></label>
            <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha;?>" />
          </form></td>
        </tr>
      </table>
      Busqueda por nombre:<br />
    </div>
    <div align="center">
      <table width="200" border="0">
        <tr>
          <td rowspan="5"><table border="1">
            <tr>
              <td>Clave</td>
              <td>Nombre</td>
              <td>Precio</td>
              <td>&nbsp;</td>
              </tr>
            <?php do { ?>
              <tr>
                <td><?php echo $row_sopa['id_plat']; ?></td>
                <td><?php echo $row_sopa['nombre_plat']; ?></td>
                <td><?php echo $row_sopa['precio']; ?></td>
                <td><a href="3_1.php?id=<?php echo $row_sopa['id_plat']; ?>&amp;id_menu=<?php echo $id_menu; ?>&amp;fecha=<?php echo $fecha; ?>"><img src="../../../../Img/aceptar-este-hecho-tan-bien-verde-con-exito-icono-8880-96.png" width="35" height="35" alt="Aceptar" /></a></td>
                </tr>
              <?php } while ($row_sopa = mysql_fetch_assoc($sopa)); ?>
          </table></td>
          <td><table border="1">
            <tr>
              <td>Clave</td>
              <td>Menu</td>
              <td>Nombre</td>
              <td></a></td></td>
              </tr>
            <?php do { ?>
              <tr>
                <td><?php echo $row_SopaActual['id_plat']; ?></td>
                <td><?php echo $row_SopaActual['id_menu']; ?></td>
                <td><?php echo $row_SopaActual['nombre']; ?></td>
                <td><a href="Elimina.php?id_plat=<?php echo $row_SopaActual['id_plat']; ?>&id_menu=<?php echo                                                                   $row_SopaActual['id_menu']; ?>&fecha=<?php echo $fecha;?>"><img src="../../../../Img/eliminar-icono-4790-96.png" width="41" height="35" alt="Eliminar" /></td>
                </tr>
              <?php } while ($row_SopaActual = mysql_fetch_assoc($SopaActual)); ?>
          </table></td>
        </tr>
        <tr>
          <td><center><a href="../Editar Menu.php?fecha=<?php echo $fecha ;?>" class="button medium yellow"/>Regresar a la edicion</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
  <div class="footer">
    <p align="right">&nbsp;</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($sopa);

mysql_free_result($especial);

mysql_free_result($SopaActual);
?>

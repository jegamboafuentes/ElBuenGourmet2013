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
$query_IdMenu_porFecha = "SELECT id_menu FROM menu ORDER BY id_menu DESC";
$IdMenu_porFecha = mysql_query($query_IdMenu_porFecha, $COnexionGourmet) or die(mysql_error());
$row_IdMenu_porFecha = mysql_fetch_assoc($IdMenu_porFecha);
$totalRows_IdMenu_porFecha = mysql_num_rows($IdMenu_porFecha);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Sopas = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre, platillo.precio FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Sopa' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$Sopas = mysql_query($query_Sopas, $COnexionGourmet) or die(mysql_error());
$row_Sopas = mysql_fetch_assoc($Sopas);
$totalRows_Sopas = mysql_num_rows($Sopas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Ensaladas = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre, platillo.precio FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Ensalada' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$Ensaladas = mysql_query($query_Ensaladas, $COnexionGourmet) or die(mysql_error());
$row_Ensaladas = mysql_fetch_assoc($Ensaladas);
$totalRows_Ensaladas = mysql_num_rows($Ensaladas);

$maxRows_Antojitos = 10;
$pageNum_Antojitos = 0;
if (isset($_GET['pageNum_Antojitos'])) {
  $pageNum_Antojitos = $_GET['pageNum_Antojitos'];
}
$startRow_Antojitos = $pageNum_Antojitos * $maxRows_Antojitos;

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Antojitos = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre, platillo.precio FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Antojito' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$query_limit_Antojitos = sprintf("%s LIMIT %d, %d", $query_Antojitos, $startRow_Antojitos, $maxRows_Antojitos);
$Antojitos = mysql_query($query_limit_Antojitos, $COnexionGourmet) or die(mysql_error());
$row_Antojitos = mysql_fetch_assoc($Antojitos);

if (isset($_GET['totalRows_Antojitos'])) {
  $totalRows_Antojitos = $_GET['totalRows_Antojitos'];
} else {
  $all_Antojitos = mysql_query($query_Antojitos);
  $totalRows_Antojitos = mysql_num_rows($all_Antojitos);
}
$totalPages_Antojitos = ceil($totalRows_Antojitos/$maxRows_Antojitos)-1;

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Guisados = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre, platillo.precio FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Guisado' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$Guisados = mysql_query($query_Guisados, $COnexionGourmet) or die(mysql_error());
$row_Guisados = mysql_fetch_assoc($Guisados);
$totalRows_Guisados = mysql_num_rows($Guisados);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_Postres = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre, platillo.precio FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Postre' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));
$Postres = mysql_query($query_Postres, $COnexionGourmet) or die(mysql_error());
$row_Postres = mysql_fetch_assoc($Postres);
$totalRows_Postres = mysql_num_rows($Postres);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla Creacion Menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="http://elbuengourmet.mx/Img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Fin</title>
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
	margin: 0 auto; /* el valor automático de los lados, unido a la anchura, centra el diseño. No es necesario si establece la anchura de .container en el 100%. */
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

<div class="container">
  <div class="header">
    <table width="595" border="0">
      <tr>
        <td><img src="../../../Img/logox.jpg" width="181" height="97" /></td>
        <td>Asistente para la creacion del menu</td>
      </tr>
    </table>
  </div>
  <div class="content"><!-- InstanceBeginEditable name="BODY" -->
    <h1>Editar Menu de <?php echo $fecha = $_GET['fecha']; ?> 
    </h1>
    <div align="center">
      <table width="200" border="0">
        <tr>
          <td>Sopas</td>
          <td><a href="paso 1 link.php"><img src="../../Img/mas.png" width="35" height="35" alt="Insertar" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;
            <table border="1">
              <tr>
                <td>Clave</td>
                <td>Menu</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_Sopas['id_plat']; ?></td>
                  <td><?php echo $row_Sopas['id_menu']; ?></td>
                  <td><?php echo $row_Sopas['nombre']; ?></td>
                  <td><?php echo $row_Sopas['precio']; ?></td>
                  <td><a href="Elimina fin.php?id_plat=<?php echo $row_Sopas['id_plat']; ?>&id_menu=<?php echo                                                                   $row_Sopas['id_menu']; ?>""><img src="../../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Elminar" /></a></td>
                </tr>
                <?php } while ($row_Sopas = mysql_fetch_assoc($Sopas)); ?>
            </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Ensaladas</td>
          <td><a href="Paso 2/paso 2 link.php"><img src="../../Img/mas.png" width="35" height="35" alt="Insertar" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;
            <table border="1">
              <tr>
                <td>Clave</td>
                <td>Menu</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_Ensaladas['id_plat']; ?></td>
                  <td><?php echo $row_Ensaladas['id_menu']; ?></td>
                  <td><?php echo $row_Ensaladas['nombre']; ?></td>
                  <td><?php echo $row_Ensaladas['precio']; ?></td>
                  <td><a href="Elimina fin.php?id_plat=<?php echo $row_Ensaladas['id_plat']; ?>&amp;id_menu=<?php echo                                                                   $row_Ensaladas['id_menu']; ?>""><img src="../../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Elminar" /></a><a href="Elimina fin.php"></a></td>
                </tr>
                <?php } while ($row_Ensaladas = mysql_fetch_assoc($Ensaladas)); ?>
            </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Antojitos</td>
          <td><a href="Paso 3/paso 3 link.php"><img src="../../Img/mas.png" width="35" height="35" alt="Insertar" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;
            <table border="1">
              <tr>
                <td>Clave</td>
                <td>Menu</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_Antojitos['id_plat']; ?></td>
                  <td><?php echo $row_Antojitos['id_menu']; ?></td>
                  <td><?php echo $row_Antojitos['nombre']; ?></td>
                  <td><?php echo $row_Antojitos['precio']; ?></td>
                  <td><a href="Elimina fin.php?id_plat=<?php echo $row_Antojitos['id_plat']; ?>&amp;id_menu=<?php echo                                                                   $row_Antojitos['id_menu']; ?>""><img src="../../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Elminar" /></a><a href="Elimina fin.php"></a></td>
                </tr>
                <?php } while ($row_Antojitos = mysql_fetch_assoc($Antojitos)); ?>
            </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Guisados</td>
          <td><a href="Paso 4/paso 4 link.php"><img src="../../Img/mas.png" width="35" height="35" alt="Insertar" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;
            <table border="1">
              <tr>
                <td>Clave</td>
                <td>Menu</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_Guisados['id_plat']; ?></td>
                  <td><?php echo $row_Guisados['id_menu']; ?></td>
                  <td><?php echo $row_Guisados['nombre']; ?></td>
                  <td><?php echo $row_Guisados['precio']; ?></td>
                  <td><a href="Elimina fin.php?id_plat=<?php echo $row_Guisados['id_plat']; ?>&amp;id_menu=<?php echo                                                                   $row_Guisados['id_menu']; ?>""><img src="../../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Elminar" /></a><a href="Elimina fin.php"></a></td>
                </tr>
                <?php } while ($row_Guisados = mysql_fetch_assoc($Guisados)); ?>
            </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Postres</td>
          <td><a href="Paso 5/paso 5 link.php"><img src="../../Img/mas.png" width="35" height="35" alt="Insertar" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;
            <table border="1">
              <tr>
                <td>Clave</td>
                <td>Menu</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_Postres['id_plat']; ?></td>
                  <td><?php echo $row_Postres['id_menu']; ?></td>
                  <td><?php echo $row_Postres['nombre']; ?></td>
                  <td><?php echo $row_Postres['precio']; ?></td>
                  <td><a href="Elimina fin.php?id_plat=<?php echo $row_Postres['id_plat']; ?>&amp;id_menu=<?php echo                                                                   $row_Postres['id_menu']; ?>""><img src="../../Img/eliminar-icono-4790-96.png" width="35" height="35" alt="Elminar" /></a><a href="Elimina fin.php"></a></td>
                </tr>
                <?php } while ($row_Postres = mysql_fetch_assoc($Postres)); ?>
          </table></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <div align="center">
      <table width="874" border="0">
        <tr>
          <td width="117"><div align="left"><!-- InstanceBeginEditable name="left" --><!-- InstanceEndEditable --></div></td>
          <td width="606"><div align="center"><!-- InstanceBeginEditable name="center" --><!-- InstanceEndEditable --></div></td>
          <td width="129"><div align="right"><!-- InstanceBeginEditable name="right" --><!-- InstanceEndEditable --></div></td>
        </tr>
      </table>
    </div>
  </div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($IdMenu_porFecha);

mysql_free_result($Sopas);

mysql_free_result($Ensaladas);

mysql_free_result($Antojitos);

mysql_free_result($Guisados);

mysql_free_result($Postres);
?>

<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
<?php require_once('../../../../Connections/COnexionGourmet.php'); ?>
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

  $insertGoTo = "paso 5_1.php";
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

$colname_quiereplatillo = "-1";
if (isset($_GET['id'])) {
  $colname_quiereplatillo = $_GET['id'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_quiereplatillo = sprintf("SELECT nombre_plat FROM platillo WHERE id_plat = %s", GetSQLValueString($colname_quiereplatillo, "text"));
$quiereplatillo = mysql_query($query_quiereplatillo, $COnexionGourmet) or die(mysql_error());
$row_quiereplatillo = mysql_fetch_assoc($quiereplatillo);
$totalRows_quiereplatillo = mysql_num_rows($quiereplatillo);

$colname_sopas = "-1";
if (isset($_GET['clave'])) {
  $colname_sopas = $_GET['clave'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_sopas = sprintf("SELECT id_plat, nombre_plat, precio FROM platillo WHERE tipo='Postre' and id_plat = %s", GetSQLValueString($colname_sopas, "text"));
$sopas = mysql_query($query_sopas, $COnexionGourmet) or die(mysql_error());
$row_sopas = mysql_fetch_assoc($sopas);
$totalRows_sopas = mysql_num_rows($sopas);

mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_VerSopasAct = sprintf("SELECT platillo.id_plat,detalle_menu.id_menu, case platillo.especial when 1 then detalle_menu.nombre_especial when 0 then platillo.nombre_plat  end as nombre FROM platillo, detalle_menu WHERE detalle_menu.id_plat = platillo.id_plat and platillo.tipo='Postre' and id_menu = %s ",GetSQLValueString($row_IdMenu_porFecha['id_menu'], "text"));;
$VerSopasAct = mysql_query($query_VerSopasAct, $COnexionGourmet) or die(mysql_error());
$row_VerSopasAct = mysql_fetch_assoc($VerSopasAct);
$totalRows_VerSopasAct = mysql_num_rows($VerSopasAct);

$colname_especial = "-1";
if (isset($_GET['id'])) {
  $colname_especial = $_GET['id'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_especial = sprintf("SELECT especial FROM platillo WHERE id_plat = %s", GetSQLValueString($colname_especial, "text"));
$especial = mysql_query($query_especial, $COnexionGourmet) or die(mysql_error());
$row_especial = mysql_fetch_assoc($especial);
if ($row_especial['especial'] == 1){header ("Location: paso 5 especial.php?id=".$_GET['id']);}
$totalRows_especial = mysql_num_rows($especial);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla Creacion Menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="http://elbuengourmet.mx/Img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Paso 5</title>
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
        <td><img src="../../../../Img/logox.jpg" width="181" height="97" /></td>
        <td>Asistente para la creacion del menu</td>
      </tr>
    </table>
  </div>
  <div class="content"><!-- InstanceBeginEditable name="BODY" -->
    <h1>Selecciona el postre</h1>
    <table width="291" border="0" cellspacing="10">
      <tr>
        <td>Busqueda </td>
        <td>|<a href="paso 5 nombre.php">Nombre</a>| </td>
        <td>|<a href="paso 5 clave.php">Clave</a>|</td>
      </tr>
    </table>
    <div align="center">
       <table width="879" border="0">
         <tr>
           <td width="670"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="post">
             <p align="left">
               <label for="id_menu2"></label>
               <input name="id_menu" type="hidden" id="id_menu2" value="<?php echo $row_IdMenu_porFecha['id_menu']; ?>" />
               <label for="id_plat2"></label>
               <input type="hidden" name="id_plat" id="id_plat2" value="<?php echo $_GET['id']?>" />
               <label for="especial"></label>
               <input name="especial" type="hidden" id="especial" value="<?php echo $row_especial['especial'];?>" />
             </p>
             <p align="left">
               <input type="hidden" name="MM_insert" value="form1" />
            </p>
             </form>
           </td>
           
           <td width="193">&nbsp;</td>
         </tr>
         <tr>
           <td rowspan="5"><div align="left">
             <table border="1">
               <tr>
                 <td>Clave</td>
                 <td>Nombre</td>
                 <td>Precio</td>
                 <td>&nbsp;</td>
                </tr>
               <?php do { ?>
                 <tr>
                   <td><?php echo $row_sopas['id_plat']; ?></td>
                   <td><?php echo $row_sopas['nombre_plat']; ?></td>
                   <td><?php echo $row_sopas['precio']; ?></td>
                   <td><a href="paso 5.php?id=<?php echo $row_sopas['id_plat']; ?>"><img src="../../../../Img/aceptar-este-hecho-tan-bien-verde-con-exito-icono-8880-96.png" alt="" width="35" height="35" /></a></td>
                 </tr>
                 <?php } while ($row_sopas = mysql_fetch_assoc($sopas)); ?>
             </table>
           </div></td>
           <td>&nbsp;
             <table border="1">
               <tr>
                 <td>Clave</td>
                 <td>Menu</td>
                 <td>Nombre</td>
                 <td>&nbsp;</td>
               </tr>
               <?php do { ?>
                 <tr>
                   <td><?php echo $row_VerSopasAct['id_plat']; ?></td>
                   <td><?php echo $row_VerSopasAct['id_menu']; ?></td>
                   <td><?php echo $row_VerSopasAct['nombre']; ?></td>
                   <td><a href="Elimina.php?id_plat=<?php echo $row_VerSopasAct['id_plat']; ?>&amp;id_menu=<?php echo                                                                   $row_VerSopasAct['id_menu']; ?>"><img src="../../../../Img/eliminar-icono-4790-96.png" width="41" height="35" alt="Eliminar" /></a></td>
                 </tr>
                 <?php } while ($row_VerSopasAct = mysql_fetch_assoc($VerSopasAct)); ?>
           </table></td>
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
         <tr>
           <td>&nbsp;</td>
         </tr>
        </table>
     </div>
     <p>&nbsp;</p>
     <div align="center"></div>
     <p><br />
    </p>
  <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <div align="center">
      <table width="874" border="0">
        <tr>
          <td width="117"><div align="left"><!-- InstanceBeginEditable name="left" --><a href="../Paso 4/paso 4 link.php"><img src="../../../../Img/left.png" alt="" width="95" height="65" /></a><!-- InstanceEndEditable --></div></td>
          <td width="606"><div align="center"><!-- InstanceBeginEditable name="center" --><a href="../Rev.php" target="_blank"><img src="../../../../Img/ball.png" alt="" width="50" height="50" /></a><!-- InstanceEndEditable --></div></td>
          <td width="129"><div align="right"><!-- InstanceBeginEditable name="right" --><a href="../Fin.php"><img src="../../../../Img/right.png" alt="Derecha" width="95" height="65" /></a><a href="../Paso 2/paso 2_0.php"></a><!-- InstanceEndEditable --></div></td>
        </tr>
      </table>
    </div>
  </div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($especial);

mysql_free_result($IdMenu_porFecha);

mysql_free_result($quiereplatillo);

mysql_free_result($sopas);

mysql_free_result($VerSopasAct);
?>

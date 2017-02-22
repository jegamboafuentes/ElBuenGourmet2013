<?php require_once('../Connections/COnexionGourmet.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO cliente (nombre, apellido, id_cliente, pass, tel, direccion, cod_postal, ciudad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['id_cliente'], "text"),
                       GetSQLValueString($_POST['pass'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['cod_postal'], "text"),
                       GetSQLValueString($_POST['ciudad'], "text"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($insertSQL, $COnexionGourmet) or die(mysql_error());
  $id_cliente = trim( GetSQLValueString($_POST['id_cliente'], "text"),"'");
  
  $insertGoTo = "ordenarclientes.php?id_cliente=$id_cliente";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
		<link rel="icon" href="../favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="../style/reset.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="../style/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" media="screen,print" />
		<link rel="stylesheet" type="text/css" href="../style/template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../style/menu.css" media="screen" />
		<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="style/ie.css" media="screen" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="../pcss/ordenar.css" media="screen" />
		<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
		<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
		<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../res/jquery.js?31"></script>
		<script type="text/javascript" src="../res/x5engine.js?31"></script>
		<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
		<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
		<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
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
				<div style="float: left;">
					<div style="height: 30px;">&nbsp;</div>
				</div>
				<div id="imFooPad" style="height: 350px; float: left;">&nbsp;</div>
			  <p>&nbsp;</p>
                <p align="center">Ordena lo que se te antoje y paga en tu domicilio. </p>
                <p align="center">&nbsp;</p>
                <p align="center">&nbsp;</p>
                <p align="center" style="color: #063">Registro de clientes frecuentes:</p>
                <p align="center" style="color: #063">&nbsp;</p>
              <p align="center" style="color: #063">&nbsp;</p>
              <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                <div align="center">
                  <table align="center">
                    <tr valign="baseline">
                      <td nowrap align="right">Nombre:</td>
                      <td><span id="sprytextfield1">
                        <input type="text" name="nombre" value="" size="32">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Apellido:</td>
                      <td><span id="sprytextfield2">
                        <input type="text" name="apellido" value="" size="32">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Correo electronico:</td>
                      <td><span id="sprytextfield3">
                      <input type="text" name="id_cliente" value="" size="32" id="id_cliente">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Repetir Correo electronico:</td>
                      <td><span id="spryconfirm1">
                        <label for="repetiremail"></label>
                        <input name="repetiremail" type="text" id="repetiremail" size="32">
                      <span class="confirmRequiredMsg">Se necesita un valor.</span><span class="confirmInvalidMsg">Los valores no coinciden.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Contraseña:</td>
                      <td><span id="sprytextfield4">
                        <input type="password" name="pass" value="" size="32" id="password">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Repetir Contraseña:</td>
                      <td><label for="repetirpass"></label>
                        <span id="spryconfirm2">
                        <input name="repetirpass" type="password" id="repetirpass" size="32">
                      <span class="confirmRequiredMsg">Se necesita un valor.</span><span class="confirmInvalidMsg">Los valores no coinciden.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Telefono:</td>
                      <td><span id="sprytextfield5">
                        <input type="text" name="tel" value="" size="32">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right" valign="top">Direccion:</td>
                      <td><span id="sprytextarea1">
                        <textarea name="direccion" cols="50" rows="5"></textarea>
                      <span class="textareaRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Codigo postal:</td>
                      <td><span id="sprytextfield6">
                      <input type="text" name="cod_postal" value="" size="5">
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">Ciudad:</td>
                      <td><select name="ciudad">
                        <option value="Pachuca" <?php if (!(strcmp("Pachuca", ""))) {echo "SELECTED";} ?>>Pachuca</option>
                      </select></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right">&nbsp;</td>
                      <td><input type="submit" value="Insertar registro"></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1">
                </div>
              </form>
              <p>&nbsp;</p>
<div id="imBtMn"><a href="../home.html">Página de inicio</a> | <a href="../menu-de-hoy.html">Menu de hoy</a> | <a href="../ordenar.html">Ordenar</a> | <a href="../ubicacion.html">Ubicacion</a> | <a href="../contactanos.html">Contactanos</a> | <a href="../sobre-nosotros.html">Sobre nosotros</a> | <a href="../imsitemap.html">Mapa general del sitio</a></div>				  
				<div class="imClear"></div>
			</div>
			<div id="imFooter">
				
			</div>
		</div>
		<span class="imHidden"><a href="#imGoToCont" title="Lea esta página de nuevo">Regreso al contenido</a> | <a href="#imGoToMenu" title="Lea este sitio de nuevo">Regreso al menu principal</a></span>
		
    <script type="text/javascript">
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "id_cliente", {validateOn:["blur"]});
var spryconfirm2 = new Spry.Widget.ValidationConfirm("spryconfirm2", "password", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "zip_code");
    </script>
	</body>
</html>

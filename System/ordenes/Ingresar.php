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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}


if (isset($_POST['correo'])) {
  $loginUsername=$_POST['correo'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "ordenarclientes.php?id_cliente=$loginUsername";
  $MM_redirectLoginFailed = "Ingresar.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  
  $LoginRS__query=sprintf("SELECT id_cliente, pass FROM cliente WHERE id_cliente=%s AND pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $COnexionGourmet) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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
		<script type="text/javascript" src="../res/jquery.js?31"></script>
		<script type="text/javascript" src="../res/x5engine.js?31"></script><script type="text/javascript">
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
                <div align="center">
                  <form action="<?php echo $loginFormAction; ?>" method="POST" name="loging" id="loging">
                    <table width="487" border="1">
                      <tr>
                        <td><p style="color: #00F">Ingreso</p>
                        <p>&nbsp;</p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Correo electronico:</td>
                        <td><label for="correo2"></label>
                          <input type="text" name="correo" id="correo2"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Password:</td>
                        <td><label for="pass"></label>
                          <input type="password" name="pass" id="pass"></td>
                        <td><input type="submit" name="button" id="button" value="Enviar"></td>
                      </tr>
                    </table>
                  </form>
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

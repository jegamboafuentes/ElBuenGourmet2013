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

$colname_recuperarPass = "-1";
if (isset($_GET['email'])) {
  $colname_recuperarPass = $_GET['email'];
}
mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
$query_recuperarPass = sprintf("SELECT pass FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_recuperarPass, "text"));
$recuperarPass = mysql_query($query_recuperarPass, $COnexionGourmet) or die(mysql_error());
$row_recuperarPass = mysql_fetch_assoc($recuperarPass);
$totalRows_recuperarPass = mysql_num_rows($recuperarPass);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recuperando..</title>
</head>

<body>
<?php 
			  $destino = $_GET['email'];
			  $desde = "From:"."servicios";
			  $asunto = "El Buen Gourmet: Contraseña de Pedidos";
			  $mensaje = "Tu contraseña es: ".$row_recuperarPass['pass'];
			  if (mail($destino,$asunto,$mensaje,$desde)){
				echo "Correo Enviado a ".$destino;  
			  } else {
				echo "Problemas al enviar";
			  }
			  
		  ?>
<form id="form1" name="form1" method="post" action="">
  <label for="textfield"></label>
  <input name="textfield" type="hidden" id="textfield" value="<?php echo $row_recuperarPass['pass']; ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($recuperarPass);
?>

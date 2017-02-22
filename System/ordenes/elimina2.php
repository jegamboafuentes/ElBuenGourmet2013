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

if ((isset($_GET['id_detalleordenes'])) && ($_GET['id_detalleordenes'] != "")) {
  $deleteSQL = sprintf("DELETE FROM detalle_ordenes WHERE id_detalleordenes=%s and id_ordenes=%s and id_plat=%s",
                       GetSQLValueString($_GET['id_detalleordenes'], "int"),GetSQLValueString($_GET['id_ordenes'], "int"),GetSQLValueString($_GET['id_plat'], "int"));

  mysql_select_db($database_COnexionGourmet, $COnexionGourmet);
  $Result1 = mysql_query($deleteSQL, $COnexionGourmet) or die(mysql_error());
  $fecha = $_GET['fecha'];
  $hora = $_GET['hora'];
  $nombre = $_GET['nombre'];
  
  $deleteGoTo = "ordenar20.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
do
</body>
</html>
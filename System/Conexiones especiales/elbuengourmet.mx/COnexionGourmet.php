<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_COnexionGourmet = "localhost";
$database_COnexionGourmet = "elbuengo_master";
$username_COnexionGourmet = "elbuengo";
$password_COnexionGourmet = "moraleja";
$COnexionGourmet = mysql_pconnect($hostname_COnexionGourmet, $username_COnexionGourmet, $password_COnexionGourmet) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
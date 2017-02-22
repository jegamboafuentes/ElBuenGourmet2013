<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_COnexionGourmet = "localhost";
$database_COnexionGourmet = "gourmet";
$username_COnexionGourmet = "user";
$password_COnexionGourmet = "123";
$COnexionGourmet = mysql_pconnect($hostname_COnexionGourmet, $username_COnexionGourmet, $password_COnexionGourmet) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
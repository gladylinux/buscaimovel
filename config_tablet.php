<?php
# Informa qual o conjunto de caracteres ser� usado.
header('Content-Type: text/html; charset=utf-8');

//error_reporting(0);

$host    = "localhost"; # Endere�o do servidor MySQL
$usuario = "root"; # Nome de usu�rio do MySQL
$passwd  = "tux2001"; # Senha do MySQL
//$bd = "dbimo_sg"; # Nome do Banco de Dados
$bd = "dbimo_sg_2"; # Nome do Banco de Dados
  


# Conex�o com o BD;

$conexao = mysql_connect("$host", "$usuario", "$passwd") or die ("N�o foi poss�vel conectar a base de dados");
$db = mysql_select_db("$bd", $conexao) or die ("N�o foi poss�vel selecionar a base de dados");

# Aqui est� o segredo
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


?>

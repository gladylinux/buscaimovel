<?php
include("config_tablet.php");

$sql_cidade_combo = "SELECT DISTINCT cidade FROM imoveis where situacao='vazio'  ORDER BY cidade";

$res = mysql_query($sql_cidade_combo, $conexao);
$num = mysql_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysql_fetch_array($res);
    $arrCidades[$dados['cidade']] = $dados['cidade'];

}
?>

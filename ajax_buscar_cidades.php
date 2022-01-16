<?php
//include('conexao.php');

include("config_tablet.php");

$cidade = $_GET['cidade_'];//VALOR DO name do combo box arquivo index_combo.php
//$estado = $_GET['estado'];

/*FOI COLOCADO ASPAS SIMPLES AQUI

$sql = "SELECT DISTINCT bairro FROM imoveis WHERE cidade='$cidade' and situacao='vazio' ORDER by bairro ASC";

1- ERRADO
ANTES 

 cidade=$cidade pois assim o select não recebia como UMA STRING

2- CERTO
DEPOIS
cidade='$cidade' FOI COLOCADO ASPAS SIMPLES AQUI


*/

$sql = "SELECT DISTINCT bairro FROM imoveis WHERE cidade='$cidade' and situacao='vazio' ORDER by bairro ASC";

$res = mysql_query($sql, $conexao);
$num = mysql_num_rows($res);

for ($i = 0; $i < $num; $i++) {

  $dados = mysql_fetch_array($res);

  //ANTES
  //$arrCidades[$dados['bairro']] = utf8_encode($dados['bairro']);
  $arrCidades[$dados['bairro']] = ($dados['bairro']);
}
?>
<link href="css/geral.css" rel="stylesheet" type="text/css" />

 <label class="busca_imovel_pag_detalhes">Bairro:</label>

<select name="bairro_" id="bairro_" class="campos_imovel_detalhes">
  <?php foreach($arrCidades as $value => $nome){
    echo "<option value='{$value}'>{$nome}</option>";
  }
?>
</select>

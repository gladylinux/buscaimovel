<?php
include("config_tablet.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Buscar imóveis </title>

<!-- <link rel="stylesheet" href="jquery-ui.css" /> -->

<!-- SE CONFLITAR EU COLOCO NUM ARQUIVO PHP E DOU O INCLUDE 
AQUI -->

<?php include include("jquerycombox.php");  ?>

 <script language="JavaScript">
   function buscar_cidades(){
    
             //alert ('ENTROU NA FUNCAO BUSCA CIDADES !');

        var cidade = $('#cidade_').val();
        if(cidade){
          var url = 'ajax_buscar_cidades.php?cidade_='+cidade;

//alert ("Chamou o arquivo !");
          
          $.get(url, function(dataReturn) {
            $('#load_bairros').html(dataReturn);
//alert ("Carregou os bairros Glória Deus !");
          });
        }
      }
</script>
<link href="css/geral.css" rel="stylesheet" type="text/css" />

</head>
<body>

<!-- HEADER -->
<br>
<br><br><br><br><br>
<center>
<br>>
<form name="busca" id="busca" method="post" action="index_combo.php">
<table width="936" border="0">
  <tr>
    <td width="129"></td>
    <td width="123"></td>
    <td width="123"><span class="Fleft">
      
    </span></td>
    <td width="139">&nbsp;</td>
<td width="123"><span class="Fleft">
      
    </span></td>
    <td width="139">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Fleft">
<label class="busca_imovel_pag_detalhes">
Tipo Imovel:</label>
    </span>
      <select name="tipo_" class="campos_imovel_detalhes">
        <option value="" >Todos</option>
        <?php
            $sql = mysql_query("SELECT DISTINCT tpimovel FROM imoveis WHERE situacao='vazio'");
            while( $linha = mysql_fetch_array( $sql ) ) {
              echo '<option value="'.$linha['tpimovel'].'">'.$linha['tpimovel'].'</option>';
            }
          ?>
      </select>
    </span></td>
    
     <td><span class="Fleft">
<label class="busca_imovel_pag_detalhes">Valor:</label>
     
     <!-- COLOCAR A MUDANÇA AQUI DOS INTERVALOS ESTÁTICOS -->
     
      <select name="valor_" id="valor_" class="campos_imovel_detalhes">
        <option value="" >Selecione o Valor</option>
        <option value="500" >At&#233;  R$ 500,00</option>
	<option value="1000" >De R$ 500,00 at&#233;  R$ 1.000,00 </option>
	<option value="2000" >De R$ 1.000,00 at&#233;  R$ 2.000,00</option>
	<option value="3000" >De R$ 2.000,00 at&#233;  R$ 3.000,00</option>
      </select>
    </span></td>
    
    <td>
<label class="busca_imovel_pag_detalhes">Cidade:</label>
      <select name="cidade_" id="cidade_" class="campos_imovel_detalhes" onchange="buscar_cidades()"  >
          <option value="">Selecione Cidade...</option>
          
          <?php
    
	  include("carrega_combo_cidade.php");      
    
          foreach ($arrCidades as $value => $name) {
            echo "<option value='{$value}'>{$name}</option>";
          }
          ?>
          
        </select>
	  </td>
    <td width="123"> 
       <div id="load_bairros">
       <span class="Fleft">
<label class="busca_imovel_pag_detalhes">Bairro:</label>
        <select name="bairro_" id="bairro_" class="campos_imovel_detalhes">
          <option value="">Selecione o bairro</option>
        </select>
    </div>	
      </select>
    </span> </td>



  </tr>
      <tr><td><center>
<input  srname="submit" type="submit" class="btnEnviar botao_imovel_detalhes" value=" " ></td></tr></center>
</table>
</form>
</center>

<div id="contentsdiv" > <!-- COM SCROLL -->

<div id="content">

    <h1>Busca de Imoveis</h1>

<hr />
    
    <?php
    
    $cidade_ = strip_tags( $_POST['cidade_'] );
    $bairro_ = strip_tags( $_POST['bairro_'] );
    $tipo_ = strip_tags( $_POST['tipo_'] );
    $valor_ = strip_tags( $_POST['valor_'] );
   // $valorMin_ = strip_tags( $_POST['valorMin_'] );
    //$valorMax_ = strip_tags( $_POST['valorMax_'] );
    $codigo_ = strip_tags( $_POST['codigo_'] );
    
    if( isset($_GET['cidade_'] ) )  $cidade_ = strip_tags( $_GET['cidade_'] );
    if( isset($_GET['bairro_'] ) )  $bairro_ = strip_tags( $_GET['bairro_'] );
    if( isset($_GET['tipo_'] ) )    $tipo_ = strip_tags( $_GET['tipo_'] );
    if( isset($_GET['valor_'] ) ) $valor_ = strip_tags( $_GET['valor_'] );
   // if( isset($_GET['valorMin_'] ) )  $valorMin_ = strip_tags( $_GET['valorMin_'] );
   // if( isset($_GET['valorMax_'] ) )  $valorMax_ = strip_tags( $_GET['valorMax_'] );
    if( isset($_GET['codigo_'] ) )  $codigo_ = strip_tags( $_GET['codigo_'] );
    
    /*
     switch($valor_){
		case '500';
		$preco = 'AND valor <= 500';
		break;
		case '1000';
		$preco = 'AND valor BETWEEN 500 AND 1000';
		break;
		case '2000';
		$preco = 'AND valor BETWEEN 1000 AND 2000';
		break;
	      }
  */ 
    
            /* MONTA CRITERIOS DE BUSCA */              
              $where = "i.situacao ='vazio'";
             //A CLAUSULA WHERE É CONCATENADA COM OS CONTEUDOS DOS COMBO BOX 
              if ( !empty( $cidade_ ) ) {//CAMPO TABELA = NAME DO SELEC
                $where .=" AND i.cidade='$cidade_'";
              }
              if ( !empty( $bairro_ ) ) {
                $where .=" AND i.bairro='$bairro_'";
              }
              if ( !empty( $tipo_ ) ) {
                $where .=" AND i.tpimovel='$tipo_'";
              }           
              if ( !empty( $valor_ ) ) {
                $where .=" AND i.valor='$valor_'";
              }
              if ( !empty( $codigo_ ) ) {
                $where ="i.situacao='vazio' AND i.codigo='$codigo_'";
              }


                //A CONSULTA ABAIXO REALIZA A CONTAGEM DE QUANTOS FORAM ACHADOS

                $sql = mysql_query("SELECT i.*  FROM imoveis i WHERE $where") or print(mysql_error());
echo"<span class='Fleft'>";
echo"=========================================================";
echo "<div><B><H1>OPCOES ESCOLHIDAS:</B></H1><B><H1> Tipo Imovel:$tipo_ || Cidade:  $cidade_ || Bairro: $bairro_ || Valor: $valor_ </B></H1> </div>";
echo"=========================================================";
echo"</span>";


//echo "<B><H3>QUERY DO PAGINADOR SELECT</H3></B><br>";
//echo "<B><H3>CONTEUDO VARIAVEL SQL:</H3></B><B>$sql</B> ";
//==============================================================           
             //PREPARAÇÃO PARA A PAGINAÇÃO
//============================================================
            if (!isset( $_GET["pagina"] ) )
                $pagina = 1;
            else
                $pagina = strip_tags( $_GET["pagina"] );

            $max=15;
            $inicio = $pagina - 1;
            $inicio = $max * $inicio;
            $total = mysql_num_rows($sql);
            
            /* calcula a quantidade de produtos sendo exibidos no momento */
            $pgs = ceil($total / $max);
            $de = $max * $pagina; 
            if($pagina == $pgs) $de = $total;
            $temp = $inicio + 1; 
   echo "<p><h2><b>Foram encontrados</h2></b> <b><h1>$total imóveis.</h1></b> </p>";
            echo "<p align=\"center\"><b>Página:</b> $pagina de $pgs</p><br /><br />";
            ////////// utf8_encode($dados['bairro'])
    
      $sql = mysql_query("SELECT i.rgimv, i.situacao, i.foto_exibicao, i.codigo, i.tpimovel,i.end, i.num, i.cidade, i.bairro, i.especifica, i.valor FROM imoveis i
            WHERE $where ORDER BY cidade ASC LIMIT $inicio, $max") or print(mysql_error());

echo "Passou do primeiro SELECT<br><br>";
//echo "CONTEUDO VARIAVEL SQL:$sql ";
//echo "<br><br>";
echo "<B><H3>TESTE DAS VARIAVEIS DOS COMBO BOX QUE SAO<BR> TRANSFERIDAS PARA CLAUSULA  WHERE:</B></H3><br><B><H3><BR>  <br> Condição = $where </B></H3>";
      
      while( $linha = mysql_fetch_array( $sql ) ) {


//                 
        
    ?>
      <div class="listaImoveis">
        <a title="<?php echo $linha['tpimovel'] . ' ' . $linha['end'] .' em '. $linha['cidade'] . ' /' . $linha['bairro']; ?>" href="detalhes_imovel_tablet.php?Cod=<?php echo $linha['rgimv'];?>"><img src="img_imoveis/<?php echo $linha['foto_exibicao']; ?>" width="200" height="200" alt="<?php echo $linha['tpimovel'] . ' ' . $linha['end'] .' em '. $linha['cidade'] . ' /' . $linha['bairro']; ?>" /></a>
               


             <!-- 1 LISTA IMOVEIS BOX -->
        <div class="listaImoveisbox">
            <p><b>Tipo Imóvel:<?php echo $linha['tpimovel']; ?></b></p></b><br>

<p class="valor_busca">Valor: <?php echo ( empty( $linha['valor'] ) || $linha['valor'] == '0.00' ? 'Consulte-nos' : 'R$ ' . number_format( $linha['valor'], 2, ',', '.')  ); ?></p><br>

<p class="valor_busca" ><b>Taxas:<?php echo $linha['taxa']; ?></b></p></b><br>            
                       
<p class="valor_busca" ><b>Situação:<?php echo $linha['situacao']; ?></b></p></b><br>            

        </div>

                <!-- 2 LISTA IMOVEIS BOX -->
        <div class="listaImoveisbox">
            <p>Cidade:<b><?php echo $linha['cidade'] . '/' . $linha['bairro']; ?></b></p></br>
            <p>Bairro<?php echo $linha['bairro']; ?></p><br>
            <p>Endereço: <?php echo $linha['end']; ?></p>
            <p>Especifica: <?php echo $linha['especifica']; ?> </p><br>



        </div>
        
        <!-- 3 LISTA IMOVEIS BOX -->

        <div class="listaImoveisbox">
            <p class="fRight"><a title="<?php echo $linha['tpimovel'] . ' ' . $linha['cidade'] .' no '. $linha['bairro'] . ' /' . $linha['end']; ?>" href="detalhes_imovel_tablet.php?Cod=<?php echo $linha['rgimv'];?>"><img src="imagens/img-descricao-busca.jpg" border="0"></a></p>
        </div>
        
      </div>
      <br class="clear" />
    <?php } ?>
    <br /><br /><br /><br />
    
    <?php
            echo "<p align=\"center\"><b>Página:</b> $pagina de $pgs</p><br /><br />";
    ?>
    
            <div id="paginacao">
            <?php
            // Calculando pagina anterior
            $menos = $pagina - 1;
            // Calculando pagina posterior
            $mais = $pagina + 1;
            $pgs = ceil($total / $max);
            
            $url = "cidade_=$cidade_&bairro_=$bairro_&tipo_=$tipo_&codigo_=$codigo_&valor_=$valor_";
            
            if($pgs > 1 )
            {
                if($menos > 7) 
                    echo "<a title='primeira pagina' class='lk' href='index_combo.php?$url'>Início</a> ";
                
                if($menos >0)
                echo "<a title='pagina anterior' class='lk' href='index_combo.php?$url&pagina=$menos'>Anterior</a> ";

                if (($pagina-7) < 1 )
                    $anterior = 1;
                else
                    $anterior = $pagina-7;

                if (($pagina+7) > $pgs )
                    $posterior = $pgs;
                else
                    $posterior = $pagina + 7;

                for($i=$anterior;$i <= $posterior; $i++)
                    if($i != $pagina)
                        echo " <a title='pagina $i' href='index_combo.php?$url&pagina=$i'>$i</a>";
                    else
                        echo "<strong>$i</strong>";

                if($mais <= $pgs)
                    echo " <a title='proxima pagina' class='lk' href='index_combo.php?$url&pagina=$mais'>Próxima</a>";
                
                if($mais < ($pgs - 3)) 
                    echo " <a title='ultima pagina' class='lk' href='index_combo.php?$url&pagina=$pgs'>Última</a>";
            }
            ?>
            </div>

</div>

</div><!-- FIM DA DIV PARA DEIXAR O FUNDO PARADO COM SCROLL -->
<br class="clear" />
<!-- AND CONTENT -->


<!-- FOOTER -->

<!-- FOOTER -->
</body>
</html>

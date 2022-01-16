<?php //include("jquerycombox.php");  ?>


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
    <td> 
       <div id="load_bairros">
       <span class="Fleft">
<label class="busca_imovel_pag_detalhes">Bairro:</label>
        <select name="bairro_" id="bairro_" class="campos_imovel_detalhes">
          <option value="">Selecione o bairro</option>
        </select>
    </div>	
      </select>
    </span> </td>
<td><span class="Fleft">
<label class="busca_imovel_pag_detalhes">Valor:</label>
      <select name="valor_" id="valor_" class="campos_imovel_detalhes">
        <option value="" >Todos</option>
        <?php
            $sql = mysql_query("SELECT DISTINCT valor FROM imoveis WHERE situacao='vazio'");
            while( $linha = mysql_fetch_array( $sql ) ) {
              echo '<option value="'.$linha['valor'].'">'.$linha['valor'].'</option>';
            }
          ?>
      </select>
    </span></td>

    <td>
<input  srname="submit" type="submit" class="btnEnviar botao_imovel_detalhes" value=" " ></td>
  </tr>
</table>
</form>

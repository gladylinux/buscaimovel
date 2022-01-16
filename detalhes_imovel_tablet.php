<?php
include("config_tablet.php");
//include("tags.php");
//include("tags.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/geral.css" rel="stylesheet" type="text/css" />
<link href="css/galleriffic.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="js/jquery-1.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery_002.js"></script>

		
</head>
<body>

<!-- HEADER -->



<center>
<br><br><br><br><br><br><br>

<?php
include("form_jquery.php");

?>



</center>
<br class="clear" />
<!-- AND HEADER -->

<!-- CONTENT -->
<div id="contentsdiv" > <!-- COM SCROLL -->
<div id="content">
  
    <?php
      $id = strip_tags( $_GET['Cod'] );
      //$sql = mysql_query("SELECT i.rgimv, i.foto_exibicao, i.codigo, i.tpimovel,i.end, i.num, i.cidade, i.bairro, i.especifica FROM imoveis i

$sql = mysql_query("SELECT i.* FROM imoveis i
      WHERE i.rgimv='$id' AND i.situacao='vazio'") or print(mysql_error());
      
      $l = mysql_fetch_array( $sql );
      

//PARA EXIBIR O VALOR DO IMOVEL
     	// if( $l['valor'] == '0.00' || empty( $l['valor'] ) )
        //$valor = 'Consulte-nos';
      //else
        //$valor = 'R$ ' . number_format( $l['valor'], 2, ',', '.' );
    ?>
    <h1 style="color:#000000; text-transform:uppercase;font-size:12px;"><?php echo $l['tpimovel'] .' - ' . $l['cidade'] . '/' . $l['bairro'] . ' - '. $l['especifica'];?></h1>
    <?php if( !empty( $l['rgimv'] ) )  { ?><p style="font-size:12px; font-family:arial, verdana,; font-weight:bold;">C&oacute;digo do im&oacute;vel: <b><?php echo $l['rgimv']; ?></b></p><?php } ?>
    
    <!-- inicio galeria -->
        <div id="container">
				<div style="display: block;" id="gallery" class="content">
					<div class="slideshow-container">
						<div style="display: none;" id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow">
						<span style="opacity: 1;" class="image-wrapper current">
						<a class="advance-link" rel="history" href="img_imoveis/<?=$l['foto_grande']?>" title="">&nbsp;<img src="img_imoveis/<?=$l['foto_grande']?>" alt=""></a></span></div>
					</div>
				</div>
        
      <div style="width:300px; float: left; opacity: 1;" id="thumbs" class="navigation"><div class="top pagination"></div>
					<ul class="thumbs">
						<li class="" style="opacity: 0.67; display: none;">
							<a rel="history" class="thumb" href="img_imoveis/<?=$l['foto_grande']?>" title="Ampliar">
								<img src="img_imoveis/<?=$l['foto_exibicao']?>" width="100" height="72" border="0" alt="Ampliar">
							</a>
							
						</li>
        <?php
        $i = 1;
        $sql = mysql_query("SELECT * FROM fotos WHERE id_imovel='$id'");
        while($linha = mysql_fetch_array($sql))
             //LOCAL ABAIXO QUE DÁ UMA OPACIDADE NA FOTO PEQUENA
        {//propriedade de opacidade
        echo '<li class="" style="opacity: 0.67; display: none;"> 
        <a rel="history" class="thumb" href="img_imoveis/album/'.$linha['foto'].'" title="Ampliar">
        <img src="img_imoveis/album/'.$linha['foto'].'" width="100" height="72" border="0" alt="Ampliar"></a>
        ';
      $i++;
        }
        ?>
					</ul>
				<div class="bottom pagination"></div></div>
				<div class="clear"></div>
      </div>
<!-- FIM GALERIA -->
    
    <h2 style="margin-left:0px;padding-left:0;">Ficha técnica</h2><br>
    <div class="div250">
        <h5 class="destaque_detalhes_imovel">Detalhe Imovel</h5>
        <p><?php echo $l['cidade'] . '/' .$l['uf']; ?></p>
        <p><?php echo $l['bairro']; ?></p>
        <p><?php echo $l['situacao']; ?> </p>
        
    </div>
    
    <br class="clear" /><br /><br /><h2>Descrição do imóvel</h2>
   
    
  

</div>
<br class="clear" />
<!-- AND CONTENT -->


<!-- FOOTER -->

<!-- FOOTER -->
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.navigation').css({'width' : '350px', 'float' : 'left'});
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs

                                //ESTA PROPRIEDADE ONMOUSEOUTOPACITY QUE TIRA O EFEITO OU COLOCA
				var onMouseOutOpacity = 1;
				$('#thumbs ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				
				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     7000,
					numThumbs:                 9,
					preloadAhead:              10,
					enableTopPager:            true,
					enableBottomPager:         true,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play',
					pauseLinkText:             'Pausa',
					prevLinkText:              '&lsaquo; Foto anterior',
					nextLinkText:              'Próxima foto &rsaquo;',
					nextPageLinkText:          'Próxima &rsaquo;',
					prevPageLinkText:          '&lsaquo; Anterior',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
			});
		</script>
		
</DIV> <!-- FIM DIV COM SCROOLL -->		
</body>
</html>

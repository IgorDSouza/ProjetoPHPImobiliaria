<?php
//Chama uma função PHP que permite informar a classe e o Método que será acionado
if(isset($_GET['tipo'])){
  $imoveis = call_user_func(array('ImovelController','listarTipo'),$_GET['tipo']);
}else{
  $imoveis = call_user_func(array('ImovelController','listar'));
}

?>
<div class="container">

<h1>Imóveis</h1>
<hr>
<table class="table" style="top:40px;">
        <tbody>
        <?php 
        $cont=0;
        //Verifica se houve algum retorno
        if (isset($imoveis) && !empty($imoveis)) {
          foreach ($imoveis as $imovel) {
            
            if($cont==0){
              echo '<tr>';
            }
            
            echo '<td>';
            echo '<img class="img-thumbnail" style="width: 300px; height: 200px" src="'.$imovel->getPath().'"> <br>';
            
            echo substr($imovel->getDescricao(),0,70);
            echo '<br><strong>Valor: </strong>'.$imovel->getValor().'<br>';
            $tipo = $imovel->getTipo();
            echo '<strong>Tipo: </strong>'.$tipo.'<br>';
            echo '<a href="index.php?action=editar&id='.$imovel->getId().'&page=imovel" class="btn btn-primary btn-sm">Editar</a>&nbsp;&nbsp;&nbsp;';
            echo '<a href="index.php?action=excluir&id='.$imovel->getId().'&page=imovel" class="btn btn-danger btn-sm">Excluir</a>&nbsp;&nbsp;&nbsp;';
            echo '<a href="index.php?action=add&idImovel='.$imovel->getId().'&page=imovel" class="btn btn-success btn-sm">Album de Fotos</a>';

            $cont++;
            if($cont==4)
              $cont=0;

          }
        }else{
            ?>
                <tr>
                    <td colspan="3">Nenhum registro encontrado</td>
                </tr>
                <?php
        }
?>
        </tbody>
</table>
</div>



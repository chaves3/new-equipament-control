<?php

require('Application.php');
require('MySql.php');

?>

<style>

*{
   margin: 0 auto;
   padding: 0;
   box-sizing: border-box;
}

h2{
    background-color: #333;
    color: white;
    padding: 8px;
}

.box{
    width: 900px;
    margin: 0 auto;
}

table{
    width: 900px;
    margin-top: 15px;
    border-collapse: collapse;
}

table td {
    font-size: 14px;
    padding: 8px;
    border: 1px solid #ccc;
}

</style>

<div class="box">
    <?php
        $nome = (isset($_GET['emprestimos']) && $_GET['emprestimos'] == 'finalizados') ? 'Concluidos' : 'Pendentes';
    ?>
<h2><i class="bi bi-person-vcard-fill"></i> Pagamentos <?php print($nome); ?></h2>
<div class="wraper-table">
<table>
<tr>
    <td style="font-weight: bold;">Quem Emprestou:</td>
    <td style="font-weight: bold;">E-mail</td>
    <td style="font-weight: bold;">Equpamento</td>
    <td style="font-weight: bold;">Ativo</td>
    <td style="font-weight: bold;">Data de retirada</td>
    <td style="font-weight: bold;">Data de devolução</td>
    <td style="font-weight: bold;">Observação</td>
    <td style="font-weight: bold;">Nome solicitante</td>
    <td style="font-weight: bold;">E-mail solicitante</td>

</tr>


<?php

if($nome == 'finalizados')
    $nome = 2;
 else
    $nome = 1;


$sql = MySql::conectar()->prepare("SELECT * FROM `tb_emprestimos_equipamentos` WHERE status = $nome ORDER BY id DESC");
$sql->execute();

$finalizados = $sql->fetchAll();

foreach ($finalizados as $key => $value) {

?>
    <tr>
        <td><?php echo $value['nome']; ?></td>
        <td><?php echo  $value['email']; ?></td>
        <td><?php echo $value['equipamento']; ?></td>
        <td><?php echo $value['ativo']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($value['data_retirada'])); ?></td>
        <td><?php echo date('d-m-Y', strtotime($value['data_devolucao'])); ?></td>
        <td><?php echo $value['observacao']; ?></td>
        <td><?php echo $value['nome_solicitante']; ?></td>
        <td><?php echo $value['email_solicitante']; ?></td>
    </tr>

<?php } ?>


</table>
</div><!--wraper-table-->
</div>


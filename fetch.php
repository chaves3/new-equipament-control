<?php
require('Application.php');
require('MySql.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_emprestimos_equipamentos` WHERE ativo = ?");
    $sql->execute(array($id));
   
    if(($sql) and ($sql->rowCount() != 0)){
        $row_emprestimo = $sql->fetch(PDO::FETCH_ASSOC);
        $retorna = ['status'=> true, 'dados' => $row_emprestimo];
    }else{
        $retorna = ['status'=> false, 'msg' => "<div class='alert alert-danger' role='alert'> Nenhum Empréstimo encontrado </div>"];
    }
}else{
    $retorna = ['status'=> false, 'msg' => "<div class='alert alert-danger' role='alert'> Nenhum Empréstimo encontrado </div>"];
}

print(json_encode($retorna));

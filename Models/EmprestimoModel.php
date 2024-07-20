<?php

namespace Models;

class EmprestimoModel
{
    private $pdo;

    public static function cadastrarEmprestimos($nome, $email, $equipamento, $ativo, $data_devolucao, $data_retirada, $observacao, $nome_solicitante, $email_solicitante,$status)
    {
        $sql = \MySql::conectar()->prepare('INSERT INTO `tb_emprestimos_equipamentos` VALUES (null,?,?,?,?,?,?,?,?,?,?) ');
        $sql->execute([$nome, $email, $equipamento, $ativo, $data_devolucao, $data_retirada, $observacao, $nome_solicitante, $email_solicitante,$status]);
        $data_retirada = date('d/m/Y', strtotime($data_retirada));
        $data_devolucao = date('d/m/Y', strtotime($data_devolucao));
        $assunto = 'Empréstimo realizado com sucesso';
        $corpo = "<h2>Seu Empréstimo<h2>
              <p>Nome do responsável pelo empréstimo: $nome</p>
              <p>E-mail do responsável pelo empréstimo: $email</p>
              <p>Equipamento: $equipamento</p>  
              <p>Ativo: $ativo</p>  
              <p>Data de retirada: $data_retirada</p>  
              <p>Data de devolução: $data_devolucao</p>  
              <p>Observação: $observacao</p>  
              <p>Nome do solicitante: $nome_solicitante</p>  
              <p>E-mail do solicitante: $email_solicitante</p>   
              ";
        $info = ['assunto' => $assunto, 'corpo' => $corpo];
        $mail = new \Email('smtp.gmail.com', 'mdfconnection@gmail.com', 'znekbkdkshnikiuq', 'CHAVES TI');
        $mail->addAdress($email, $nome);
        $mail->formatarEmail($info);
        $mail->enviarEmail();
        \Painel::redirect(INCLUDE_PATH.'consulta?inclusao=1');
    }

    public static function todosEmprestimos($query){
        $every = \MySql::conectar()->prepare("SELECT * FROM `tb_emprestimos_equipamentos` $query ");
        $every->execute();
        return $every->fetchAll();
    }

    public static function darBaixa($id){

        $devolveu = \MySql::conectar()->prepare("UPDATE `tb_emprestimos_equipamentos` SET status = ? WHERE id = ?");
        $devolveu->execute(array(2,$id));
        \Painel::redirect(INCLUDE_PATH.'consulta?inclusao=2');

    }

    public static function todosEmprestimosId($id){
        $todosId = \MySql::conectar()->prepare("SELECT * FROM `tb_emprestimos_equipamentos` WHERE id = ?");
        $todosId->execute(array($id));
        return $todosId = $todosId->fetchAll();
    }

    public static function editarEmprestimos($nome, $email, $equipamento, $ativo, $data_devolucao, $data_retirada, $observacao, $nome_solicitante, $email_solicitante, $id){
        $editar = \MySql::conectar()->prepare("UPDATE `tb_emprestimos_equipamentos` SET nome = ?, email = ?, equipamento = ?, ativo = ?, data_devolucao = ?, data_retirada = ?, observacao = ?, nome_solicitante = ?, email_solicitante = ? WHERE id = ?");
        $editar->execute(array($nome, $email, $equipamento, $ativo, $data_devolucao, $data_retirada, $observacao, $nome_solicitante, $email_solicitante, $id));
        \Painel::redirect(INCLUDE_PATH.'consulta?inclusao=3');
    }



}

<?php

namespace Models;

class CalibracaoModel{

    public static function cadastrarEquipamento($status_emprestimos,$equip,$act,$cod,$data_calibracao,$cert,$obs,$status){
        $cadastrar = \MySql::conectar()->prepare("INSERT INTO `tb_calibracao_equipamentos` VALUES(null,?,?,?,?,?,?,?,?)");
        $cadastrar->execute(array($status_emprestimos,$equip,$act,$cod,$data_calibracao,$cert,$obs,$status));
        \Painel::redirect(INCLUDE_PATH.'consult?inclusao=1');

    }

    public static function mostrarEquipamentos(){
        $every = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` ");
        $every->execute();
        return $every->fetchAll();
    }

    public static function deletarEquipamento($idDeletar){
        $cadastrar = \MySql::conectar()->prepare("DELETE FROM `tb_calibracao_equipamentos` WHERE id = ?");
        $cadastrar->execute(array($idDeletar));
      
    }

    public static function pegarTodosEquipamentosId($id){
        $todosId = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` WHERE id = ? ");
        $todosId->execute(array($id));
        return $todosId->fetchAll();
    }

    public static function updateEquipamento($equip,$act,$cod,$data_calibracao,$cert,$obs,$status,$id){
        $update = \MySql::conectar()->prepare("UPDATE `tb_calibracao_equipamentos` SET equi = ?, act = ?, cod_calibracao = ?, data_calibracao = ?, certificado = ?, obs = ?, status = ? WHERE id = ?");
        $update->execute(array($equip,$act,$cod,$data_calibracao,$cert,$obs,$status,$id));
        \Painel::redirect(INCLUDE_PATH.'consult?inclusao=2');
    }

}
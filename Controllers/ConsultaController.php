<?php

namespace Controllers;

class ConsultaController
{
    public function __construct()
    {
        $this->view = new \Views\MainView('consulta', 'headerlogado');
    }

    public function executar()
    {
        $this->view->render(['titulo' => 'Consulta']);

        if (!isset($_SESSION['email_logado'])) {
            \Painel::redirect(INCLUDE_PATH);
        }

        if (isset($_GET['sair'])) {
            session_unset();
            session_destroy();
            \Painel::redirect(INCLUDE_PATH);
        }

        if (isset($_GET['idbaixa'])) {
            $id = intval($_GET['idbaixa']);
            \Models\EmprestimoModel::darBaixa($id);
            $updatestatusEquipamento = \MySql::conectar()->prepare("SELECT status, ativo FROM `tb_emprestimos_equipamentos` WHERE id = ?");
            $updatestatusEquipamento->execute(array($id));
            $updatestatusEquipamento = $updatestatusEquipamento->fetchAll();
            foreach($updatestatusEquipamento as $key){
            }
            $updateCalibracaoStatus = \MySql::conectar()->prepare("UPDATE `tb_calibracao_equipamentos` SET id_status_emprestimo = ? WHERE act = ? ");
            $updateCalibracaoStatus->execute(array($key['status'],$key['ativo']));
            
        }


        
        

        if (isset($_POST['editar'])) {
            $data['sucesso'] = true;
            $idEditar = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $equipamento = $_POST['equipamento'];
            $ativo = $_POST['ativo'];
            $data_retirada = $_POST['data_retirada'];
            $data_devolucao = $_POST['data_devolucao'];
            $observacao = $_POST['observacao'];
            $nome_solicitante = $_POST['nome_solicitante'];
            $email_solicitante = $_POST['email_solicitante'];
            
            $conferirAtivo = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` WHERE act = ?");
            $conferirAtivo->execute(array($ativo));
            if($conferirAtivo->rowCount() == 1){
              $updateEquipamento = \MySql::conectar()->prepare("UPDATE `tb_calibracao_equipamentos` SET id_status_emprestimo = ? WHERE act = ?");
              $updateEquipamento->execute(array(2, $ativo));
            
            \Models\EmprestimoModel::editarEmprestimos($nome,$email,$equipamento,$ativo,$data_retirada,$data_devolucao,$observacao,$nome_solicitante,$email_solicitante,$idEditar);
            exit(json_encode($data)); 
            }
        }
        
   
    }
}

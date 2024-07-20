<?php

namespace Controllers;

class ConsultController
{
    public function __construct()
    {
        $this->view = new \Views\MainView('consult', 'headerlogado');
    }

    public function executar()
    {
        $this->view->render(['titulo' => 'Calibração']);

        if (!isset($_SESSION['email_logado'])) {
            \Painel::redirect(INCLUDE_PATH);
        }

        if (isset($_GET['sair'])) {
            session_unset();
            session_destroy();
            \Painel::redirect(INCLUDE_PATH);
        }

        if($_GET['url'] == 'consult'){
            print("
            <script>
                  $('#link2').removeClass('corLaranja');
                  $('#link2').css('color', 'white');
            </script>");
            }

        if (isset($_GET['iddelete'])) {
            $id = $_GET['iddelete'];
            \Models\CalibracaoModel::deletarEquipamento($id);
        }

        if (isset($_GET['idedit'])) {
            $id = $_GET['idedit'];
            \Models\CalibracaoModel::pegarTodosEquipamentosId($id);
        }

        


    }
}

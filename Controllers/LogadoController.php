<?php 

namespace Controllers;

class LogadoController{

    public function __construct()
    {
        $this->view = new \Views\MainView('logado', 'headerlogado');

    }

    public function executar()
    {
        $this->view->render(['titulo' => 'Logado']);

        if(!isset($_SESSION['email_logado'])){
            \Painel::redirect(INCLUDE_PATH);
        }

        if(isset($_GET['sair'])){
            session_unset();
            session_destroy();
            \Painel::redirect(INCLUDE_PATH);
        }

       
        if($_GET['url'] == 'logado'){
        print("
        <script>
              $('#link0').removeClass('corLaranja');
              $('#link0').css('color', 'white');
        </script>");
        }
        
    }    
}
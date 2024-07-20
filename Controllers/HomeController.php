<?php

namespace Controllers;

class HomeController
{
    public function __construct()
    {
        $this->view = new \Views\MainView('home');
    }

    public function executar()
    {
        $this->view->render(['titulo' => 'Home']);

        if (isset($_SESSION['email_logado'])){
			\Painel::redirect(INCLUDE_PATH.'logado');
		}

        if(isset($_POST['acao'])) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $verificar = \MySql::conectar()->prepare("SELECT * FROM `login_equipamentos` WHERE email = ? AND senha = ?");
            $verificar->execute(array($email, $senha));

            if($verificar->rowCount()==1){
                $info = $verificar->fetch();
                $_SESSION['email_logado'] = $email;
                $_SESSION['nome'] =  $info['nome'];
                $_SESSION['id'] =  $info['id'];
                print("<div class='alert alert-success' role='alert'>
                    Logado com sucesso!
                    </div>");
                \Painel::redirect(INCLUDE_PATH.'logado');
            }else{
                print("<div class='alert alert-danger' role='alert'>
                 E-mail ou Senha incorretos!
                </div>"); 
            }
        }
    }

    
}

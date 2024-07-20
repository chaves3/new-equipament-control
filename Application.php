
<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
define('INCLUDE_PATH', 'http://localhost/controle_equipamento2-0/');
define('INCLUDE_PATH_FULL', 'http://localhost/controle_equipamento2-0/Views/pages/');
require('vendor2/autoload.php');
// Conectar com o banco de dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'modulo_8');
class Application{
    public function executar(){

        $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'Home';

        $url = ucfirst($url);

        $url.="Controller";

        if(file_exists('Controllers/'.$url.'.php')){
            $className = 'Controllers\\'.$url;
            $controller = new $className;
            $controller->executar();
        }else{
            die("Não existe esse controlador");
        }
    }
}

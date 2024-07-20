<?php

$autoload = function($class){
    if ($class == 'Email') {
        require_once 'phpmailer/src/PHPMailer.php';
        require_once 'phpmailer/src/SMTP.php';
        require_once 'phpmailer/src/Exception.php';
    }
    include $class.'.php';
};

spl_autoload_register($autoload);

$app = new Application();
$app->executar();
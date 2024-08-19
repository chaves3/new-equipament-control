<?php

  use phpmailer\PHPMailer\Exception;
  use phpmailer\PHPMailer\PHPMailer;
  use phpmailer\PHPMailer\SMTP;

class Email
{
    private $mailer;

    public function __construct($host, $username, $senha, $name)
    {
        $this->mailer = new PHPMailer(true);

        try {
            // $this->mailer->SMTPDebug = false;
            $this->mailer->isSMTP();
            $this->mailer->Host = gethostbyname($host);
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->SMTPDebug = false;
            // echo 'SMTP secure...<br/>';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $username;
            $this->mailer->Password = $senha;
            $this->mailer->Port = 587;
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->setFrom($username, $name);
            $this->mailer->SMTPOptions = [
            'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
            ],
            ];
            $this->mailer->isHTML(true);
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->mailer->ErrorInfo}";
        }
    }

    public function addAdress($email, $nome)
    {
        $this->mailer->addAddress($email, $nome);
    }

    public function formatarEmail($info)
    {
        $this->mailer->Subject = $info['assunto'];
        $this->mailer->Body = $info['corpo'];
        $this->mailer->AltBody = strip_tags($info['corpo']);
    }

    public function enviarEmail()
    {
        if ($this->mailer->send()) {
            return true;
        } else {
            return false;
        }
    }

    // https://cursos.dankicode.com/campus/curso-desenvolvimento-web-completo/aplicando-ajax
}

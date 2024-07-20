<?php

namespace Controllers;

class EditController
{
    public function __construct()
    {
        $this->view = new \Views\MainView('edit', 'headerlogado');
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

        if($_GET['url'] == 'edit'){
          print("
          <script>
                $('#link2').removeClass('corLaranja');
                $('#link2').css('color', 'white');
          </script>");
          }

        
        if(isset($_POST['acao'])){
              
            $id = $_POST['id'];
            $equip = $_POST['equip'];
            $act = $_POST['ativo'];
            $cod = $_POST['cod'];
            $data_calibracao = $_POST['data_calibracao'];
            $pdf = $_FILES['pdf'];
            $cert = $_POST['cert_atual'];
            $obs = $_POST['obs'];
            $status = $_POST['status'];

            if($pdf['name'] != ''){
             \Painel::deleteFile($cert);
             //Existe o upload de pdf.
            

           $ativo_real = preg_match('/[0-9]/', $act);

           $verificar = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` WHERE act = ?");
           $verificar->execute(array($act));
           if($verificar->rowCount() == 1){
           print("
           <script>
            Swal.fire('Equipamento já cadastrado');
           </script>");
           }else if($equip == ''){
            print("
            <script>
              $('.erro1').css('display', 'block');
            </script>");
           }else if(!$ativo_real){
            print("
            <script>
              $('.erro2').css('display', 'block');
            </script>");
           }else if($cod == ''){
            print("
            <script>
              $('.erro3').css('display', 'block');
            </script>");
           }else if($data_calibracao == ''){
            print("
            <script>
              $('.erro4').css('display', 'block');
            </script>");
           }else if(\Painel::validarPdf($pdf) == false){
            print("
            <script>
              $('.erro5').css('display', 'block');
            </script>");
           }else if($status == ''){
                print("
                <script>
                $('.erro6').css('display', 'block');
                </script>");
            }else{
                $extensao = strtolower(substr($pdf['name'], -4));
                $novo_nome = md5(time()) . $extensao;
                $diretorio = "uploads/";
                move_uploaded_file($pdf['tmp_name'], $diretorio . $novo_nome);
                \Models\CalibracaoModel::updateEquipamento($equip,$act,$cod,$data_calibracao,$novo_nome,$obs,$status,$id);
            }

         }
        
        }
            
    }
}

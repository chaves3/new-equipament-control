<?php

namespace Controllers;

class CalibracaoController{

    public function __construct()
    {
        $this->view = new \Views\MainView('calibracao', 'headerlogado');
    }

    public function executar(){
        $this->view->render(['titulo' => 'Calibração']);

        if(!isset($_SESSION['email_logado'])){
            \Painel::redirect(INCLUDE_PATH);
        }

        if(isset($_GET['sair'])){
            session_unset();
            session_destroy();
            \Painel::redirect(INCLUDE_PATH);
        }

        if($_GET['url'] == 'calibracao'){
            print("
            <script>
                  $('#link2').removeClass('corLaranja');
                  $('#link2').css('color', 'white');
            </script>");
            }

            if(isset($_POST['acao'])){
              
                $status_emprestimos = 1;
                $equip = $_POST['equip'];
                $act = $_POST['ativo'];
                $cod = $_POST['cod'];
                $data_calibracao = $_POST['data_calibracao'];
                $cert = $_FILES['cert'];
                $obs = $_POST['obs'];
                $status = $_POST['status'];

                $ativo_real = preg_match('/[0-9]/', $act);

               $verificar = \MySql::conectar()->prepare("SELECT * FROM `tb_emprestimos_equipamentos` WHERE ativo = ?");
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
               }else if(\Painel::validarPdf($cert) == false){
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
                    $extensao = strtolower(substr($cert['name'], -4));
                    $novo_nome = md5(time()) . $extensao;
                    $diretorio = "uploads/";
                    move_uploaded_file($cert['tmp_name'], $diretorio . $novo_nome);
                    \Models\CalibracaoModel::cadastrarEquipamento($status_emprestimos,$equip,$act,$cod,$data_calibracao,$novo_nome,$obs,$status);
                }

             }
    }
}

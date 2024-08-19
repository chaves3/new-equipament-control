<?php

namespace Controllers;

class EmprestimoController
{
    public function __construct()
    {
        $this->view = new \Views\MainView('emprestimo', 'headerlogado');
    }

    public function executar()
    {
        $this->view->render(['titulo' => 'Empréstimos']);

        if (!isset($_SESSION['email_logado'])) {
            \Painel::redirect(INCLUDE_PATH);
        }

        if (isset($_GET['sair'])) {
            session_unset();
            session_destroy();
            \Painel::redirect(INCLUDE_PATH);
        }

        if ($_GET['url'] == 'emprestimo') {
            echo "
            <script>
                  $('#link1').removeClass('corLaranja');
                  $('#link1').css('color', 'white');
            </script>";
        }

        if (isset($_POST['acao'])) {
            $equipamento = $_POST['equipamento'];
            $ativo = $_POST['ativo'];
            $dataHoje = date('Y-m-d');
            $data = $_POST['data'];
            $observacao = $_POST['observacao'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $status = 1;

            $verifica_nome = preg_match('/[a-z]{3,}/', $nome);

            if ($equipamento == '') {
                echo "<script>
                    $(function(){
                       $('.erro1').css('display', 'block');
                    });
                </script>";
            } elseif (!is_numeric($ativo)) {
                echo "<script>
                $(function(){
                   $('.erro2').css('display', 'block');
                });
            </script>";
            } elseif ($data == '') {
                echo "<script>
                $(function(){
                   $('.erro3').css('display', 'block');
                });
                </script>";
            } elseif (!$verifica_nome) {
                echo "<script>
                $(function(){
                   $('.erro4').css('display', 'block');
                });
            </script>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                $(function(){
                   $('.erro5').css('display', 'block');
                });           
                </script>";
            } else {
                $conferirEmprestimoFeito =  \MySql::conectar()->prepare('SELECT * FROM `tb_emprestimos_equipamentos` WHERE ativo = ?');
                $conferirEmprestimoFeito->execute(array($ativo));
                if($conferirEmprestimoFeito->rowCount() == 1){
                    print("<script>
                        $('.jacadastrado').show();
                    </script>");
                }else{
                $conferirAtivo = \MySql::conectar()->prepare('SELECT * FROM `tb_calibracao_equipamentos` WHERE act = ?');
                $conferirAtivo->execute([$ativo]);
                if ($conferirAtivo->rowCount() == 1) {
                    $updateEquipamento = \MySql::conectar()->prepare('UPDATE `tb_calibracao_equipamentos` SET id_status_emprestimo = ? WHERE act = ?');
                    $updateEquipamento->execute([1, $ativo]);
                }
                    $loginEmail = \MySql::conectar()->prepare('SELECT * FROM login_equipamentos WHERE id = ?');
                    $loginEmail->execute([$_SESSION['id']]);
                    $todos = $loginEmail->fetchAll();

                    foreach ($todos as $key2 => $value2) {
                        $value2['nome'];
                        $value2['email'];
                    }

                    \Models\EmprestimoModel::cadastrarEmprestimos($value2['nome'], $value2['email'], $equipamento, $ativo, $dataHoje, $data, $observacao, $nome, $email, $status);
                
            }
            }
        }
    }
}

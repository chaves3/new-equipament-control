<?php
class Painel{

    public static function redirect($url){
        echo '<script>location.href="'.$url.'"</script>';
        die();
    }

    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo "<div class ='alert alert-success cima' role='alert'><i class='bi bi-check'></i> $mensagem </div>";
        } elseif ($tipo == 'erro') {
            echo "<div class='alert alert-danger cima' role='alert'><i class='bi bi-x-circle'></i> $mensagem </div>";
        }
    }

    public static function validarPdf($file){
        if($file['type'] == 'application/pdf'){
                return true;
        }else{
            print("
            <script>
             Swal.fire('Arquivo não é PDF');
            </script>");
            return false;
        }
    }

    public static function deleteFile($file){
        @unlink('uploads/'.$file);
     }

     public static function selectAll($tabela, $start = null, $end = null, $query){
        if($start == null && $end == null){
        $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $query ORDER BY id ASC");
     
        }else{
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $query ORDER BY id ASC LIMIT $start,$end"); 
        }
        $sql->execute();
        return $sql->fetchAll();
    }


}
<?php

$resultados_por_pagina = 2;

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

$offset = ($pagina - 1) * $resultados_por_pagina;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $termo_de_busca = $_POST['pesquisar'];
    $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` WHERE equi LIKE '%$termo_de_busca%' OR cod_calibracao LIKE '%$termo_de_busca%' LIMIT $resultados_por_pagina OFFSET $offset");
    $sql->execute();
} else {
    $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_calibracao_equipamentos` LIMIT $resultados_por_pagina OFFSET $offset");
    $sql->execute();
}
?>

<section class="consulta_emprestimo">
    <div class="container">
    <div class="box">
        <div id="errolendario"></div>
    <script src="<?php echo INCLUDE_PATH_FULL; ?>js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>
    
    <div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Equipamento cadastrado com sucesso</h5>
		</div>
        <script>
        setTimeout(() => {
            window.location.href ="<?php echo INCLUDE_PATH.'consult'; ?>";
        }, 5000);
        </script>
    <?php } ?> 


    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 2) { ?>
    
    <div class="bg-info pt-2 text-white d-flex justify-content-center">
			<h5>Equipamento editado com sucesso</h5>
		</div>
        <script>
        setTimeout(() => {
            window.location.href ="<?php echo INCLUDE_PATH.'consult'; ?>";
        }, 5000);
        </script>
    <?php } ?> 

    <h2>Consulta dos Equipamentos <i class="bi bi-binoculars-fill"></i></h2>
    <div class="search">
        <form action="" method="post">
        <div class="input-group mb-3">
        <button class="btn btn-outline-dark" name="pesquisa" type="submit" id="button-addon1">Pesquisar</button>
        <input style="min-width:300px;" name="pesquisar" type="text" class="form-control " placeholder="Equipamento ou Código" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>
        </form>
    </div><!--search-->

    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Equipamento</th>
            <th>Ativo</th>
            <th>Cód calibração</th>
            <th>Data de calibração</th>
            <th>Certificado</th>
            <th>Obervação</th>
            <th>status</th>
            <th>Editar</th>
            <th>Deletar</th>
            <th class="desblo1">Empréstimo</th>
            </tr>
        </thead>
        <tbody>
            <?php

  // $pegarEquipamentos = \Models\CalibracaoModel::mostrarEquipamentos();

  if ($sql->rowCount() > 0) {
      foreach ($sql->fetchAll() as $key => $value) {
          $hoje = date('Y-m-d');
          if ($hoje > $value['data_calibracao']) {
              $color = 'table-danger';
              $calibrar = \MySql::conectar()->prepare('UPDATE `tb_calibracao_equipamentos` SET status = ? WHERE CURDATE() > data_calibracao');
              $calibrar->execute(['precisa calibrar']);
          } else {
              $color = 'table-dark';
          }

          ?>
            <tr class="<?php echo $color; ?>">
                <?php
                      $data_cali = date('d/m/Y', strtotime($value['data_calibracao']));

          ?>
                <td><?php echo $value['equi']; ?></td>
                <td><?php echo $value['act']; ?></td>
                <td><?php echo $value['cod_calibracao']; ?></td>
                <td><?php echo $data_cali; ?></td>
                <td><?php echo $value['certificado']; ?></td>
                <td><?php echo $value['obs']; ?></td>
                <td><?php echo $value['status']; ?></td>
                <td><a class="btn btn-light" href="<?php echo INCLUDE_PATH; ?>edit?idedit=<?php echo $value['id']; ?>"><i class="bi bi-pencil-fill"></i></a></td>
                <td>
                    
                <button class="btn btn-danger" onclick="deletarEquip(<?php echo $value['id']; ?>)"><i class="bi bi-trash-fill"></i></button>
                </td>       
                
                <td >
                    <button style="display: none; border: 0;" class="btn btn-dark desbloquear" onclick="mandarAtivo(<?php echo $value['act']; ?>)">
                        Emprestado
                    </button>
                    <p class="texto">Não está emprestado</p>
                    </form>
                </td>
                <?php

          $pegarDadosEmprestimo = \MySql::conectar()->prepare('SELECT * FROM `tb_emprestimos_equipamentos` WHERE ativo = ?');
          $pegarDadosEmprestimo->execute([$value['act']]);
          $todosAtivos = $pegarDadosEmprestimo->fetchAll();

          foreach ($todosAtivos as $key2 => $value2) {
              if ($value['act'] == $value2['ativo'] and $value['id_status_emprestimo'] == $value2['status']) {
                  echo "
                    <script>
                    $('.desbloquear').css('display', 'block');
                    $('.texto').css('display', 'none');
                    </script>";
              }else{
                echo "
                <script>
                $('.desbloquear').css('display', 'none');
                $('.texto').css('display', 'block');
                </script>";
              }
          }

          ?>

            </tr>
        </tbody>
       <?php
      }
  }
?>
    </table>
    </div><!--responsable-table-->
    <div class="paginacao">
     <?php
    $sql_total = MySql::conectar()->prepare('SELECT COUNT(id) AS total FROM `tb_calibracao_equipamentos`');
    $sql_total->execute();
    $row_total = $sql_total->fetch();
    $total_resultados = $row_total['total'];
    $total_paginas = ceil($total_resultados / $resultados_por_pagina);

for ($i = 1; $i <= $total_paginas; ++$i) {
    if ($i == $pagina) {
        echo "<a class='page-selected' href='".INCLUDE_PATH."consult?pagina=$i'>$i</a>";
    } else {
        echo "<a  href='".INCLUDE_PATH."consult?pagina=$i'>$i</a>";
    }
}

?>
    </div><!--paginacao-->

    <!--modal-->
    <div class="modal fade" id="cadEmprestimoModal" tabindex="-1" aria-labelledby="cadEmprestimoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cadEmprestimoModal">Equipamento emprestado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mostrar-emprestimos">
        <div class="container">
           <label for="">id:</label>
           <p id="id"></p>
            <label for="">Emprestador:</label>
            <p id="nome"></p>
            <hr>
            <label for="">E-mail:</label>
            <p id="email"></p>
            <hr>
            <label for="">Equipamento:</label>
            <p id="equipamento"></p>
            <hr>
            <label for="">Ativo:</label>
            <p id="ativo"></p>
            <hr>
            <label for="">Data de retirada:</label>
            <p id="data_retirada"></p>
            <hr>
            <label for="">Data de devolução:</label>
            <p id="data_devolucao"></p>
            <hr>
            <label for="">Observação:</label>
            <p id="observacao"></p>
            <hr>
            <label for="">Nome solicitante:</label>
            <p id="nome_solicitante"></p>
            <hr>
            <label for="">E-mail solicitante:</label>
            <p id="email_solicitante"></p>
            <hr>
        </div><!--container-->  
        </div><!--mostrar-emprestimos-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

    </div><!--box-->
    </div><!--container-->
</section><!--consulta_emprestimo-->


<script>




  function deletarEquip(id){

            Swal.fire({
                title: 'Quer mesmo deletar este equipamento?',
                text: 'Você pode cancelar ainda!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                        
                    });
                    executar();
                   
                }
                
});

function executar(){
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Deletado com sucesso",
        showConfirmButton: false,
        timer: 3500
})
        setTimeout(function() {
            window.location = 'consult?iddelete='+id;
        }, 4000);
    }

}        
        
</script>





<?php






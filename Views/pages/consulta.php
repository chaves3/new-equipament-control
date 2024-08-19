<section class="consulta_emprestimo">
    <div class="container">
    <div class="box">
 
  <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>
    
    <div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Item inserido com sucesso</h5>
		</div>
        <script>
        setTimeout(() => {
            window.location.href ="<?php echo INCLUDE_PATH.'consulta'; ?>";
        }, 5000);
        </script>
    <?php } ?> 


    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 2) { ?>
    
    <div class="bg-info pt-2 text-white d-flex justify-content-center">
			<h5>Equipamento devolvido com sucesso</h5>
		</div>
        <script>
        setTimeout(() => {
            window.location.href ="<?php echo INCLUDE_PATH.'consulta'; ?>";
        }, 5000);
        </script>
    <?php } ?> 


    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 3) { ?>
    
    <div class="bg-primary pt-2 text-white d-flex justify-content-center">
			<h5>Equipamento editado com sucesso</h5>
		</div>
        <script>
        setTimeout(() => {
            window.location.href ="<?php echo INCLUDE_PATH.'consulta'; ?>";
        }, 5000);
        </script>
    <?php } ?> 

    <h2>Consulta dos Empréstimos <i class="bi bi-binoculars-fill"></i></h2>
    <div class="search">
        <form action="" method="post">
        <div class="input-group mb-3">
        <button class="btn btn-outline-dark" name="acao" type="submit" id="button-addon1">Pesquisar</button>
        <input style="min-width:300px;" name="pesquisar" type="text" class="form-control " placeholder="Equipamento,E-mail,Nome,Data" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>
        </form>
    </div><!--search-->

    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Emprestador</th>
            <th>E-mail do emprestador</th>
            <th>Equipamento</th>
            <th>Ativo</th>
            <th>Data de retirada</th>
            <th>Data de devolução</th>
            <th>Obervação</th>
            <th>Nome do solicitante</th>
            <th>E-mail do solicitante</th>
            <th>Dar baixa</th>
            <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
  $query = ' WHERE status <> 2';
  if (isset($_POST['acao'])) {
      $pesquisa = $_POST['pesquisar'];
      $query = " WHERE equipamento LIKE '%$pesquisa%' OR data_retirada LIKE '%$pesquisa%' OR nome_solicitante LIKE '%$pesquisa%' OR email_solicitante LIKE '%$pesquisa%' AND status <> 2";
      echo "<div class='alert alert-primary' role='alert'>Resultados da pesquisa $pesquisa <i class='bi bi-search'></i></div>";
  }
  $pegarEmprestimos = \Models\EmprestimoModel::todosEmprestimos($query);
  foreach ($pegarEmprestimos as $key => $value) {
      $hoje = date('Y-m-d');

      if ($hoje > $value['data_devolucao']) {
          $color = 'table-danger';
      } else {
          $color = 'table-dark';
      }

      ?>
            <tr class="<?php echo $color; ?>">
                <?php
                    $data_retirada = date('d/m/Y', strtotime($value['data_retirada']));
                    $data_devolucao = date('d/m/Y', strtotime($value['data_devolucao']));
                ?>
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><?php echo $value['equipamento']; ?></td>
                <td><?php echo $value['ativo']; ?></td>
                <td><?php echo $data_retirada; ?></td>
                <td><?php echo $data_devolucao; ?></td>
                <td><?php echo $value['observacao']; ?></td>
                <td><?php echo $value['nome_solicitante']; ?></td>
                <td><?php echo $value['email_solicitante']; ?></td>
                <td><a class="btn btn-light" href="consulta?idbaixa=<?php echo $value['id']; ?>"><i class="bi bi-play-fill"></i></a></td>
               
               
                <td>
                 <button class="btn btn-success" data-bs-toggle = 'modal' data-bs-target = '#id' data-bs-whatever = '<?php echo $value['id']; ?>' data-bs-whatever1 = '<?php echo $value['nome']; ?>' data-bs-whatever2 = '<?php echo $value['email']; ?>'
                  data-bs-whatever3 = '<?php echo $value['equipamento']; ?>' data-bs-whatever4 = '<?php echo $value['ativo']; ?>' data-bs-whatever5 = '<?php echo $value['data_retirada']; ?>'
                  data-bs-whatever6 = '<?php echo $value['data_devolucao']; ?>' data-bs-whatever7 = '<?php echo $value['observacao']; ?>' data-bs-whatever8 = '<?php echo $value['nome_solicitante']; ?>' data-bs-whatever9 = '<?php echo $value['email_solicitante']; ?>'
                  onclick="window.location.href='consulta?id=<?php echo $value['id']; ?>"><i class="bi bi-pencil-fill"></i>
                </button>
                </td>
               
            </tr>
        </tbody>
       <?php
  }
  ?>
    </table>
    </div><!--responsable-table-->

    <!-- Modal -->
<div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Equipamento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form" action="" method="post">

        <input type="hidden" id="id" name="id">

        <div class="input-group ">
                <span class="input-group-text"><i class="bi bi-person-fill-check"></i></span>
                <div class="form-floating">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
                    <label for="nome">Nome:</label>
                </div>
            </div>
            <small style="display: none;" class="erro1">Por favor insira Nome corretamente:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-arrow-up-fill"></i></span>
                <div class="form-floating">
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail">
                    <label for="email">E-mail:</label>
                </div>
            </div>
            <small style="display: none;" class="erro2">Por favor digitar o E-mail:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tools"></i></span>
                <div class="form-floating">
                    <input type="text" name="equipamento" class="form-control" id="equipamento" placeholder="Equipamento">
                    <label for="equipamento">Equipamento:</label>
                </div>
            </div>

            <small style="display: none;" class="erro3">Por favor digitar Equipamento:</small>
            <br>



            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-123"></i></span>
                <div class="form-floating">
                    <input type="number" name="ativo" class="form-control" id="ativo" placeholder="Ativo">
                    <label for="ativo">Ativo:</label>
                </div>
            </div>

            <small style="display: none;" class="erro4">Por favor digitar a Ativo:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <div class="form-floating">
                    <input type="date" name="data_retirada" class="form-control" id="data_retirada" placeholder="Data retirada">
                    <label for="data_retirada">Data retirada:</label>
                </div>
            </div>

            <small style="display: none;" class="erro5">Por favor digitar a Data retirada:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <div class="form-floating">
                    <input type="date" name="data_devolucao" class="form-control" id="data_devolucao" placeholder="Data devolução">
                    <label for="data_devolucao">Data devolução:</label>
                </div>
            </div>

            <small style="display: none;" class="erro6">Por favor digitar a Data devolução:</small>
            <br>


            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-dots-fill"></i></span>
                <div class="form-floating">
                <textarea name="observacao" class="form-control" id="observacao" rows="3"></textarea>
                <label for="observacao">Observação:</label>
                </div>
            </div>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <div class="form-floating">
                    <input type="text" name="nome_solicitante" class="form-control" id="nome_solicitante" placeholder="Nome solicitante">
                    <label for="nome_solicitante">Nome solicitante:</label>
                </div>
            </div>

            <small style="display: none;" class="erro7">Por favor digitar o nome do requisitante:</small>
            <br>


            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-check-fill"></i></span>
                <div class="form-floating">
                    <input type="email" name="email_solicitante" class="form-control" id="email_solicitante" placeholder="E-mail solicitante">
                    <label for="email_solicitante">E-mail solicitante:</label>
                </div>
            </div>

            <small style="display: none;" class="erro8">Por favor digitar o e-mail do requisitante:</small>
            <br>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button  type="submit"  name="editar" id="edit" class="btn btn-primary">Editar</button>
        </form>
    </div>
    </div>
  </div>
</div>
<br>

<a target="_blank" class="btn btn-dark corLaranja" href="<?php print(INCLUDE_PATH) ?>gerar-pdf.php?emprestimos=finalizados">Em PDF os ultimos empréstimos</a>

    </div><!--box-->
    </div><!--container-->
</section><!--consulta_emprestimo-->

<script>
        const exampleModal = document.getElementById('id', 'nome', 'email', 'equipamento', 'ativo', 'data_retirada', 'data_devolucao', 'observacao', 'nome_solicitante', 'email_solicitante')
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient33 = button.getAttribute('data-bs-whatever')
            const recipient1 = button.getAttribute('data-bs-whatever1')
            const recipient2 = button.getAttribute('data-bs-whatever2')
            const recipient3 = button.getAttribute('data-bs-whatever3')
            const recipient4 = button.getAttribute('data-bs-whatever4')
            const recipient5 = button.getAttribute('data-bs-whatever5')
            const recipient6 = button.getAttribute('data-bs-whatever6')
            const recipient7 = button.getAttribute('data-bs-whatever7')
            const recipient8 = button.getAttribute('data-bs-whatever8')
            const recipient9 = button.getAttribute('data-bs-whatever9')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle33 = exampleModal.querySelector('.modal-title')
            const modalBodyInput33 = exampleModal.querySelector('.modal-body input')

            const modalTitle1 = exampleModal.querySelector('#nome')
            const modalBodyInput1 = exampleModal.querySelector('#nome')
            const modalTitle2 = exampleModal.querySelector('#email')
            const modalBodyInput2 = exampleModal.querySelector('#email')
            const modalTitle3 = exampleModal.querySelector('#equipamento')
            const modalBodyInput3 = exampleModal.querySelector('#equipamento')
            const modalTitle4 = exampleModal.querySelector('#ativo')
            const modalBodyInput4 = exampleModal.querySelector('#ativo')
            const modalTitle5 = exampleModal.querySelector('#data_retirada')
            const modalBodyInput5 = exampleModal.querySelector('#data_retirada')
            const modalTitle6 = exampleModal.querySelector('#data_devolucao')
            const modalBodyInput6 = exampleModal.querySelector('#data_devolucao')
            const modalTitle7 = exampleModal.querySelector('#observacao')
            const modalBodyInput7 = exampleModal.querySelector('#observacao')
            const modalTitle8 = exampleModal.querySelector('#nome_solicitante')
            const modalBodyInput8 = exampleModal.querySelector('#nome_solicitante')
            const modalTitle9 = exampleModal.querySelector('#email_solicitante')
            const modalBodyInput9 = exampleModal.querySelector('#email_solicitante')


            modalTitle33.textContent = `Edição ${recipient33}`
            modalBodyInput33.value = recipient33

            modalTitle1.textContent = `New message to ${recipient1}`
            modalBodyInput1.value = recipient1

            modalTitle2.textContent = `New message to ${recipient2}`
            modalBodyInput2.value = recipient2

            modalTitle3.textContent = `New message to ${recipient3}`
            modalBodyInput3.value = recipient3

            modalTitle4.textContent = `New message to ${recipient4}`
            modalBodyInput4.value = recipient4

            modalTitle5.textContent = `New message to ${recipient5}`
            modalBodyInput5.value = recipient5

            modalTitle6.textContent = `New message to ${recipient6}`
            modalBodyInput6.value = recipient6

            modalTitle7.textContent = `New message to ${recipient7}`
            modalBodyInput7.value = recipient7

            modalTitle8.textContent = `New message to ${recipient8}`
            modalBodyInput8.value = recipient8

            modalTitle9.textContent = `New message to ${recipient9}`
            modalBodyInput9.value = recipient9
        })
    </script>




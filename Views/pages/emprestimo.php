
<section class="emprestimo-form">
    <div class="container">
        <div class="box">
            <h2>Realizar um Empréstimo <?php print($_SESSION['nome']); ?> <i class="bi bi-pen-fill"></i> </h2>
            <div style="display: none;" class='alert alert-danger jacadastrado' role='alert'> Equipamento já está emprestado </div>
            <form action="" method="post">
            <div class="input-group ">
                <span class="input-group-text"><i class="bi bi-floppy-fill"></i></span>
                <div class="form-floating">
                    <input type="text" name="equipamento" class="form-control" id="equipa" placeholder="Equipamento">
                    <label for="equipa">Equipamento:</label>
                </div>
            </div>
            <small style="display: none;" class="erro1">Por favor digitar o equipamento:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-123"></i></span>
                <div class="form-floating">
                    <input type="number" name="ativo" class="form-control" id="ativo1" placeholder="Ativo">
                    <label for="ativo1">Ativo:</label>
                </div>
            </div>
            <small style="display: none;" class="erro2">Por favor digitar o ativo:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <div class="form-floating">
                    <input type="date" name="data" class="form-control" id="data1" placeholder="Data Devolução">
                    <label for="data1">Data Devolução:</label>
                </div>
            </div>

            <small style="display: none;" class="erro3">Por favor digitar a data de devolução:</small>
            <br>


            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-dots-fill"></i></span>
                <div class="form-floating">
                <textarea name="observacao" class="form-control" id="obs"></textarea>
                <label for="obs">Observação:</label>
                </div>
            </div>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <div class="form-floating">
                    <input type="text" name="nome" class="form-control" id="nome1" placeholder="Nome">
                    <label for="nome1">Nome do solicitante:</label>
                </div>
            </div>

            <small style="display: none;" class="erro4">Por favor digitar o nome do solicitante:</small>
            <br>


            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-check-fill"></i></span>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email1" placeholder="E-mail do solicitante">
                    <label for="email1">E-mail do solicitante:</label>
                </div>
            </div>

            <small style="display: none;" class="erro5">Por favor digitar o e-mail do solicitante:</small>
            <br>


            <div class="input-group mb-3">
                <button type="submit" name="acao" class="btn btn-dark mb-3 emprestar">Emprestar</button>
                </div>
            </div>
            </form>
            <a class="btn btn-dark" href="<?php echo INCLUDE_PATH.'consulta'; ?>">Consultar Empréstimos</a>
        </div><!--box-->
    </div><!--container-->
</section><!--emprestimo-form-->

<?php  ?>
<section class="emprestimo-form">
    <div class="container">
        <div class="box">
            <h2>Cadastrar Equipamento <?php print($_SESSION['nome']); ?> <i class="bi bi-pen-fill"></i> </h2>
            
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-group ">
                <span class="input-group-text"><i class="bi bi-floppy-fill"></i></span>
                <div class="form-floating">
                    <input type="text" name="equip" class="form-control" id="equipa" placeholder="Equipamento">
                    <label for="equipa">Equipamento:</label>
                </div>
            </div>
            <small style="display: none;" class="erro1">Por favor digitar o equipamento:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-123"></i></span>
                <div class="form-floating">
                    <input type="text" name="ativo" class="form-control" id="ativo1" placeholder="Ativo">
                    <label for="ativo1">Ativo:</label>
                </div>
            </div>
            <small style="display: none;" class="erro2">Por favor digitar o ativo:</small>
            <br>

            <div class="input-group ">
                <span class="input-group-text"><i class="bi bi-code"></i></span>
                <div class="form-floating">
                    <input type="text" name="cod" class="form-control" id="cod" placeholder="Equipamento">
                    <label for="cod">Cod Calibração:</label>
                </div>
            </div>
            <small style="display: none;" class="erro3">Por favor digitar o código de calibração:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <div class="form-floating">
                    <input type="date" name="data_calibracao" class="form-control" id="data_calibracao" placeholder="Data de Calibração">
                    <label for="nome1">Data de Calibração:</label>
                </div>
            </div>

            <small style="display: none;" class="erro4">Por favor digitar a data de calibração:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-file-earmark-pdf"></i></span>
                <div class="form-floating">
                    <input type="file" name="cert" class="form-control" id="cert" accept="application/pdf" placeholder="Certificado">
                    <label for="nome1">Certificado:</label>
                </div>
            </div>

            <small style="display: none;" class="erro5">Por favor Upload do certificado:</small>
            <br>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-dots-fill"></i></span>
                <div class="form-floating">
                <textarea name="obs" class="form-control" id="obs"></textarea>
                <label for="obs">Observação:</label>
                </div>
            </div>
            <br>


            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-clipboard2-check-fill"></i></span>
                <div class="form-floating">
                <select class="form-select" name="status" aria-label="Default select example">
                    <option selected>Status</option>
                    <option value="calibrado">Calibrado</option>
                    <option value="precisa calibrar">Precisa Calibrar</option>
                </select>
                </div>
            </div>

            <small style="display: none;" class="erro6">Por favor digitar o status:</small>
            <br>

            <div class="input-group mb-3">
                <button type="submit" name="acao" class="btn btn-dark mb-3 emprestar">Cadastrar</button>
                </div>
            </div>
            </form>
            <a class="btn btn-dark" href="<?php echo INCLUDE_PATH.'consult'; ?>">Consultar Equipamentos</a>
        </div><!--box-->
    </div><!--container-->
</section><!--emprestimo-form-->

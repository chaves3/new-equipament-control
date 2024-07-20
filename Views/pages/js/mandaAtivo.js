

    async function mandarAtivo(idAtivo){
     
        const dados = await fetch('teste.php?id='+idAtivo);
        const resposta = await dados.json();
        console.log(resposta);

        if(!resposta['status']){
            document.getElementById("errolendario").innerHTML = resposta["msg"];
        }else{
            document.getElementById("errolendario").innerHTML = "";
           const visModal = new bootstrap.Modal(document.getElementById('cadEmprestimoModal'));
           visModal.show();

           document.getElementById("id").innerHTML = resposta['dados'].id;
           document.getElementById("nome").innerHTML = resposta['dados'].nome;
           document.getElementById("email").innerHTML = resposta['dados'].email;
           document.getElementById("equipamento").innerHTML = resposta['dados'].equipamento;
           document.getElementById("ativo").innerHTML = resposta['dados'].ativo;
           document.getElementById("data_retirada").innerHTML = resposta['dados'].data_retirada;
           document.getElementById("data_devolucao").innerHTML = resposta['dados'].data_devolucao;
           document.getElementById("observacao").innerHTML = resposta['dados'].observacao;
           document.getElementById("nome_solicitante").innerHTML = resposta['dados'].nome_solicitante;
           document.getElementById("email_solicitante").innerHTML = resposta['dados'].email_solicitante;
        }
           
        }



$(function(){



  //Modal edit
$('#edit').click(function(){
  var nome = $('#nome').val(); 
  var email = $('#email').val();
  var equipamento = $('#equipamento').val();
  var ativo = $('#ativo').val();
  var data_retirada = $('#data_retirada').val();
  var data_devolucao = $('#data_devolucao').val();
  var observacao = $('#observacao').val();
  var nome_solicitante = $('#nome_solicitante').val();
  var email_solicitante = $('#email_solicitante').val();


  nome_real =  nome.match(/[a-z]{3,}/);
  $mail_real = email.match(/^([a-z0-9-_.]{1,})+@+([a-z.]{1,})$/)== null
  ativo_real = ativo.match(/[0-9]/);
  nome_solicitante_real = nome_solicitante.match(/[a-z]{3,}/);
  email_solicitante_real = email_solicitante.match(/^([a-z0-9-_.]{1,})+@+([a-z.]{1,})$/)== null

  if(!nome_real){
    $('.erro1').css('display', 'block');
    return false; 
  }else if ($mail_real) {
    $('.erro2').css('display', 'block');
    return false;
  }else if (equipamento == '') {
    $('.erro3').css('display', 'block');
    return false; 
  }else if (!ativo_real) {
    $('.erro4').css('display', 'block');
    return false; 
  }else if (data_retirada == '') {
    $('.erro5').css('display', 'block');
    return false; 
  }else if (data_devolucao == '') {
    $('.erro6').css('display', 'block');
    return false; 
  }else if (!nome_solicitante_real) {
    $('.erro7').css('display', 'block');
    return false; 
  }else if (email_solicitante_real) {
    $('.erro8').css('display', 'block');
    return false; 
  }else{

  $('.ajax').ajaxForm({
    dataType:'json',
    beforeSend:function(){
      $('.ajax').animate({'opacity':'0.6'});
      $('.ajax').find('button[type=submit]').attr('disabled', 'true');
    },
    success: function(data){
        $('.ajax').animate({'opacity':'1'});
        $('.ajax').find('button[type=submit]').removeAttr('disabled');
        
    }

});
}

});

});
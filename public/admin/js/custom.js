$(document).ready(function(){

  $('.afocus').focus();
  $(".preloader").fadeOut();
  $('[data-toggle="tooltip"]').tooltip();

  if( $('.form-bv').length > 0 ){
    $('.form-bv').bootstrapValidator({
      live: 'disabled'
    });
  }

  if( $('.icheck').length > 0 ){
    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });
  }

  $('.m_data').mask('00/00/0000');

  if( $('.summernote-artigo-1').length > 0 )
  {
    $('.summernote-artigo-1').summernote({
      lang: 'pt-BR',
      height: 350,
      toolbar: [
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']]
      ]
    });
  }

  $('.confirm-remover-artigo').click(function(){
    var url = $(this).attr('data-url');

    swal({
      title: "Remover Este Artigo?",
      text: "Você tem certeza que deseja remover este artigo da plataforma ?",
      type: "error",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#10af05",
      confirmButtonText: "Sim, remova-o!",
      closeOnConfirm: false
    }, function(){
      location.href = url;
    });
  });

});

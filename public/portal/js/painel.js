$(document).ready(function(){

  $('[data-toggle="tooltip"]').tooltip();

  $('.confirm-remover-foto').click(function(){
    var url = $(this).attr('data-url');

    if(confirm("Você realmente deseja remover essa foto ?"))
      location.href = url;
    else
      return false;
  });

  $('.confirm-remover-imovel').click(function(){
    var url = $(this).attr('data-url');

    if(confirm("Você realmente deseja remover este imóvel ?"))
      location.href = url;
    else
      return false;
  });

  $('.confirm-remover-interesse').click(function(){
    var url = $(this).attr('data-url');

    if(confirm("Você realmente deseja remover este interesse ?"))
      location.href = url;
    else
      return false;
  });

  $('.confirm-remover-imovel-favorito').click(function(){
    var url = $(this).attr('data-url');

    if(confirm("Você realmente deseja desfavoritar este imóvel ?"))
      location.href = url;
    else
      return false;
  });

});

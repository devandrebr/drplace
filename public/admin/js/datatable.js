$.extend( $.fn.dataTableExt.oSort, {
    "date-br-hour-pre": function ( a ) {
        var ukDatea = a.replace(/<(?:.|\n)*?>/gm, '').split('/');
        var ukDateb = ukDatea[2].split(' ');
        var ukHoura = ukDateb[1].split(':');
        var ukMinutes = ukHoura[0]+ukHoura[1]+ukHoura[2];

        return (ukDateb[0] + ukDatea[1] + ukDatea[0] + ukMinutes) * 1;
    },

    "date-br-hour-asc": function ( a, b ) {
        var a = a.replace(/<(?:.|\n)*?>/gm, '');
        var b = b.replace(/<(?:.|\n)*?>/gm, '');
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },

    "date-br-hour-desc": function ( a, b ) {
        var a = a.replace(/<(?:.|\n)*?>/gm, '');
        var b = b.replace(/<(?:.|\n)*?>/gm, '');
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    },

    "date-br-pre": function ( a ) {
        var ukDatea = a.replace(/<(?:.|\n)*?>/gm, '').split('/');
        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
    },

    "date-br-asc": function ( a, b ) {
        var a = a.replace(/<(?:.|\n)*?>/gm, '');
        var b = b.replace(/<(?:.|\n)*?>/gm, '');
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },

    "date-br-desc": function ( a, b ) {
        var a = a.replace(/<(?:.|\n)*?>/gm, '');
        var b = b.replace(/<(?:.|\n)*?>/gm, '');
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }

} );

$.extend( true, $.fn.dataTable.defaults, {
    "bPaginate"         : true,
    "bFilter"           : true,
    "bLengthChange"     : false,
    "bSort"             : true,
    "bInfo"             : true,
    "bAutoWidth"        : false,
    "aaSorting"         : [[0, "asc"]],
    "aoColumnDefs"      : [{'bSortable': false, 'aTargets': [ -1, -2 ]}],
    "aLengthMenu"       : [[25, 50, 100, 200, -1], [25, 50, 100, 200, "Todos"]],
    "iDisplayLength"    : 25,
    "fnPreDrawCallback" : function() {
                                // $('.dataTables_filter input').addClass('form-control');
                                $('.dataTables_filter input').attr('placeholder', 'Pesquisar por...');
                            },
    "oLanguage"         : {
                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "_MENU_ resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": '<i class="fa fa-search"></i> ',
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }
                        }

} );

$(document).ready(function(){

  $('#tb-lista-campanha1').DataTable({
    "bLengthChange" : true,
    "iDisplayLength" : 50,
    "aaSorting" : [[2, "desc"]],
    "aoColumns" : [
                  null,
                  { "bSortable": true },
                  { "bSortable": true, "sType": "date-br-hour" }
                ]
  });

  $('#tb-lista-parceiro').DataTable({
    "bLengthChange" : true,
    "iDisplayLength" : 25,
    "aaSorting" : [[0, "asc"]],
    "aoColumns" : [
                  null,
                  { "bSortable": true, "sType": "date-br-hour" },
                  { "bSortable": false }
                ]
  });

  $('#tb-lista-acesso').DataTable({
    "bLengthChange" : true,
    "iDisplayLength" : 50,
    "aaSorting" : [[0, "desc"]],
    "aoColumns" : [
                  {"sType": "date-br-hour"},
                  null,
                  { "bSortable": true },
                  { "bSortable": true }
                ]
  });

  $('#tb-lista-artigo').DataTable({
    "bLengthChange" : true,
    "iDisplayLength" : 25,
    "aaSorting" : [[1, "desc"]],
    "aoColumns" : [
                  null,
                  {"sType": "date-br-hour"},
                  { "bSortable": false },
                  { "bSortable": false },
                  { "bSortable": false }
                ]
  });

});

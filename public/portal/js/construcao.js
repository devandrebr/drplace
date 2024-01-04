$(function () {

    "use strict";

    $(window).on('load', function () {
      setTimeout(function () {
        $(".page_loader").fadeOut("fast");
        $('link[id="style_sheet"]').attr('href', 'portal/css/skins/dr-2018.css');
      }, 1000);
    });

    var endDate = "October 17, 2018 23:00:00";
    $('.countdown.simple').countdown({ date: endDate });
    $('.countdown.styled').countdown({
      date: endDate,
      render: function(data) {
        $(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " <span>Dias</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>Horas</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>Minutos</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>Segundos</span></div>");
      }
    });
    $('.countdown.callback').countdown({
      date: +(new Date) + 10000,
      render: function(data) {
        $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
      },
      onEnd: function() {
        $(this.el).addClass('ended');
      }
    }).on("click", function() {
      $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
    });
});

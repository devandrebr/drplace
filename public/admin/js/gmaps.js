$(document).ready(function(){

  // map = new GMaps({
  //   el: '#gmaps-dashboard',
  //   lat: -22.4818598,
  //   lng: -47.4593897,
  //   zoom : 14,
  //   panControl : false,
  //   streetViewControl : false,
  //   mapTypeControl: false,
  //   overviewMapControl: false
  // });

  var customLabel = {
      aberta: {
        label: 'AB',
        icon:  {
            url :_base_url_assets+'images/icon/gmaps-emaberto.png'
          }
      },
      cancelada: {
        label: 'CA',
        icon: {
            url : _base_url_assets+'images/icon/gmaps-cancelado.png'
          }
      },
      emandamento: {
        label: 'AD',
        icon:  {
            url : _base_url_assets+'images/icon/gmaps-emvisita.png'
          }
      },
      finalizada: {
        label: 'OK',
        icon: {
            url : _base_url_assets+'images/icon/gmaps-finalizado.png'
          }
        }
    };

  var map = new google.maps.Map(document.getElementById('gmaps-dashboard'), {
    // center: new google.maps.LatLng(-22.4818598, -47.4593897),
    zoom: 8
  });
  var bounds = new google.maps.LatLngBounds();
  var infoWindow = new google.maps.InfoWindow;

  // Change this depending on the name of your PHP or XML file
  downloadUrl(_url_ajax_app+'dashboard', function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('marker');
    Array.prototype.forEach.call(markers, function(markerElem) {
      var emp_id  = markerElem.getAttribute('idemp');
      var oco_id  = markerElem.getAttribute('idoco');
      var name    = markerElem.getAttribute('nome');
      var address = markerElem.getAttribute('logradouro');
      var type    = markerElem.getAttribute('tipo');
      var point   = new google.maps.LatLng(
                      parseFloat(markerElem.getAttribute('lat')),
                      parseFloat(markerElem.getAttribute('lng'))
                    );

      var infowincontent = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = name;
      infowincontent.appendChild(strong);
      infowincontent.appendChild(document.createElement('br'));

      var text = document.createElement('text');
      text.textContent = address;
      infowincontent.appendChild(text);
      var icon = customLabel[type] || {};
      var marker = new google.maps.Marker({
        map: map,
        position: point,
        //label: icon.label,
        icon: icon.icon,
        // labelContent: '',
        // labelAnchor: new google.maps.Point(15,33),
        // labelClass: "labels", // the CSS class for the label
        labelInBackground: false
      });

      bounds.extend(marker.position);
      // marker.addListener('click', function() {
      //   infoWindow.setContent(infowincontent);
      //   infoWindow.open(map, marker);
      // });
      marker.addListener('click', function() {
        //$('.icheck').iCheck('uncheck');
        $('#rd_img_depois').iCheck('check');
        $('#modal-form input[type=text], #modal-form textarea').val('');
        $('#box-historico').html('<p id="aviso"><i class="fas fa-sync"></i> Nenhum relato informado até o momento.</p>');

        $('#modal-marker .modal-title').text('Cliente: '+name);
        $('#modal-marker #emp_id').val(emp_id);
        $('#modal-marker #oco_id').val(oco_id);
        $('#modal-marker').modal('show');

        updtHistoricoRelato(oco_id, function(response) {
      		$('#box-historico').html(response);
      	});
      });
    });

    map.fitBounds(bounds);
  });

  function downloadUrl(url, callback)
  {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing(){}

  function updtHistoricoRelato(ocorrencia, callBack)
  {
  	var acesso = _url_ajax_app+'historico-ocorrencia/'+parseInt(ocorrencia);

    $.ajax({
      url: acesso,
      async: true,
      dataType: 'html',
      // beforeSend: function() {
      //   $('.rtnMsg').html("<img src=_cssStyleImg_-A-loading.gif>");
      // },
      type: "GET",
      // data: data,
      cache: false,
      success: function(data, textStatus, xhr) {
        return callBack( data );
      }
    });
  	// $.getJSON( acesso, function(data) {
  	// 	callback(JSON.stringify(data));
  	// });
  }


  /* Modal - Upload de Imagem da Galeria com Preview */
  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
  });

  $('.btn-file :file').on('fileselect', function(event, label) {
    var input = $(this).parents('.input-group').find(':text'),
        log = label;

    if( input.length ) {
      input.val(log);
    } else {
      if( log ) alert(log);
    }
  });
  function readInputFile(input,rotate) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.img-upload').attr('src', e.target.result).show();
      }
      // reader.onloadend = function() {
      //   var exif = EXIF.readFromBinaryFile(new BinaryFile(this.result));
      //   switch(exif.Orientation)
      //   {
      //     case 2:
      //       // horizontal flip
      //       ctx.translate(canvas.width, 0);
      //       ctx.scale(-1, 1);
      //       break;
      //   case 3:
      //       // 180° rotate left
      //       ctx.translate(canvas.width, canvas.height);
      //       ctx.rotate(Math.PI);
      //       break;
      //   case 4:
      //       // vertical flip
      //       ctx.translate(0, canvas.height);
      //       ctx.scale(1, -1);
      //       break;
      //   case 5:
      //       // vertical flip + 90 rotate right
      //       ctx.rotate(0.5 * Math.PI);
      //       ctx.scale(1, -1);
      //       break;
      //   case 6:
      //       // 90° rotate right
      //       ctx.rotate(0.5 * Math.PI);
      //       ctx.translate(0, -canvas.height);
      //       break;
      //   case 7:
      //       // horizontal flip + 90 rotate right
      //       ctx.rotate(0.5 * Math.PI);
      //       ctx.translate(canvas.width, -canvas.height);
      //       ctx.scale(-1, 1);
      //       break;
      //   case 8:
      //       // 90° rotate left
      //       ctx.rotate(-0.5 * Math.PI);
      //       ctx.translate(-canvas.width, 0);
      //       break;
      //   }
      // }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inp_img_galeria").change(function(){
    readInputFile(this,false);
  });
  $("#inp_img_camera").change(function(){
    readInputFile(this,true);
  });
});

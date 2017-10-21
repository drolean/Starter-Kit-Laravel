(function () {
  window.alert = function (str) {
    alertify.alert(str);
  };
})();

$(document).ready(function () {
  var $searchBar = $(".search-bar");
  $(".js-search").on("click", function () {
    $searchBar.addClass("open"), $searchBar.find('input[type="text"]').focus()
  }), $searchBar.find(".close-search").on("click", function () {
    $searchBar.removeClass("open"), $searchBar.find('input[type="text"]').val("")
  }), $searchBar.find('input[type="text"]').on("keyup", function (b) {
    if (27 == b.keyCode) {
      $searchBar.removeClass("open"), $searchBar.find('input[type="text"]').val("")
    }
  })

  Flatpickr.localize(Flatpickr.l10ns.pt);
  flatpickr('.v-date', { dateFormat: 'd/m/Y', allowInput: true });

  $(".alert").alert();

  $('.dropdown-menu-right').on('click', function (e) {
    e.stopPropagation();
  });

  $('.openChat').on('click', function (ev) {
    ev.preventDefault();
    $('.chat-conversation').toggleClass('show');
    var objDiv = document.getElementsByClassName("scroll-y");
    if (objDiv && objDiv[0]) objDiv[0].scrollTop = objDiv[0].scrollHeight;
  })

  $('.close-chat').on('click', function (ev) {
    ev.preventDefault();
    $('.chat-conversation').toggleClass('show');
  });

  $('#notification-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var UserID = button.data('userid');
    var UserName = button.data('username');

    var modal = $(this);
    modal.find('.modal-title').text('Enviar Notificação para: ' + UserName);
    modal.find('.modal-body input[name=user]').val(UserID);
    modal.find('.modal-body input[name=titulo]').val('');
    modal.find('.modal-body textarea[name=mensagem]').val('');
  });

  $('#notification').submit(function () {
    alertify.logPosition("top right");
    alertify.log("Notificação enviada com sucesso!");
    $('#notification-modal').modal('hide');
  });

  var url = window.location;
  $('ul.nav a[href="' + url + '"]').parent().addClass('active');

  $('ul.nav a').filter(function () {
    var string = window.location;
    return url.href.indexOf(this.href) !== -1;
  }).parents('li').addClass('open');

  $('[rel="tooltip"]').tooltip();

  $('.moreinfo').popover({ trigger: "hover" });

  $('a[rel=modal]').on('click', function (ev) {
    ev.preventDefault();
    var modal = $('#modal-helper');
    modal
      .find('.modal-body')
      .load($(this).attr('href'), function (responseText, textStatus) {
        if (textStatus === 'success' ||
          textStatus === 'notmodified') {
          modal.modal('show');
        }
      });
  });

  // Sidebar SubMenu
  $(".sidebar-panel nav a").on("click", function (n) {
    var i = $(this),
      r = i.parents("li"),
      o = i.closest("li"),
      s = $(".sidebar-panel nav li").not(r),
      a = i.next();

    if (a.hasClass("sub-menu")) {
      s.removeClass("open"), a.is("ul") && 0 === a.height() ? o.addClass("open") : o.removeClass("open");
    }
  });

  // Logs de Atividade
  $('.list-group-item').on('click', '.expand', function () {
    $('#' + $(this).data('display')).toggle();
  });

  // Liga Popover
  $("body").popover({
    selector: "[data-toggle='popover']",
    container: "body",
    html: true
  });

  // Menu Mobile
  $("[data-toggle=sidebar]").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $('.app').toggleClass("offscreen move-right");
  })

  // Mostra menu se estiver escondido ao passar no toogle
  $(".toggle-offscreen").on({
    mouseenter: function (e) {
      e.preventDefault();
      e.stopPropagation();
      if ($('.app').hasClass("offscreen move-right")) {
        $('.app').toggleClass("offscreen move-right");
      }
    },
  });

  // Mask Telefone
  var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    optionsTelefone = {
      onKeyPress: function (val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    },
    optionsCpfCnpj = {
      onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'],
          mask = (cpf.length > 14) ? masks[1] : masks[0];
        el.mask(mask, op);
      }
    };

  $('.ipt_telefone').mask(SPMaskBehavior, optionsTelefone);
  $('.ipt_data').mask('00/00/0000');
  $('.ipt_cep').mask('00000-000');
  $('.ipt_placa').mask('SSS-0000');
  $('.ipt_ddmm').mask('00/0000');
  $('.ipt_ano').mask('0000');
  $('.ipt_uf').mask('SS');
  $('.ipt_cnpj').mask('00.000.000/0000-00', optionsCpfCnpj);
  $('.ipt_money').mask('#.##0,00', { reverse: true });

  $('#cep').blur(function () {
    if ($(this).val().length == 9) {
      var url = "https://viacep.com.br/ws/" + $(this).val() + "/json";
      $.ajax({
        url: url,
        success: function (data) {
          if (data.logradouro) {
            $("#endereco").val(data.logradouro);
          }
          if (data.bairro) {
            $("#bairro").val(data.bairro);
          }
          if (data.localidade) {
            $("#cidade").val(data.localidade);
          }
          if (data.uf) {
            $("#uf").val(data.uf);
          }
        }
      });
    }
  });
});

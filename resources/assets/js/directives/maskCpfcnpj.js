export default {
  bind: function (el) {
    var options = {
      onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'],
          mask = (cpf.length > 14) ? masks[1] : masks[0];
        el.mask(mask, op);
      }
    }
    $(el).mask('000.000.000-000', options);
  }
};

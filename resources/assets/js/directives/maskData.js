export default {
  bind: function (el) {
    $(el).mask('00/00/0000');
    $(el).addClass('v-date')
  }
};

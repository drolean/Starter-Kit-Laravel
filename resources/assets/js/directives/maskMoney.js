export default {
  bind: function (el) {
    $(el).mask("#.##0,00", { reverse: true });
  }
};

export default {
  bind: function (el, binding) {
    $(el).mask(binding.expression)
  },
};

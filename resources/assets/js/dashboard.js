import Vue from 'vue'
import VueTimeago from 'vue-timeago'
import Echo from 'laravel-echo'
import axios from 'axios';
import Pusher from 'pusher-js'
import BabelPolyFill from 'babel-polyfill'

// Importando Componenetes
import NotificationsDemo from './components/NotificationsDemo'
import NotificationsDropdown from './components/NotificationsDropdown.vue'
import ChatMessages from './components/ChatMessages.vue'
import ChatForm from './components/ChatForm.vue'

// Diretivas
import * as directives from './directives'
Object.keys(directives).forEach((name) => {
  Vue.directive(name, directives[name]);
});

// Setando locale
Vue.use(VueTimeago, {
  locale: 'pt-BR',
  locales: { 'pt-BR': require('json-loader!vue-timeago/locales/pt-BR.json') }
})

// Definindo instancia do VUE
window.Vue = Vue

// Verifica se esta permitido o pusher
const { key, cluster } = window.Laravel.pusher
if (key) {
  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: key,
    cluster: cluster,
    encrypted: true
  })

  axios.interceptors.request.use(
    config => {
      config.headers['X-Socket-ID'] = window.Echo.socketId()
      return config
    },
    error => Promise.reject(error)
  )
}

// cria uma nova instancia do axios para uso paralelo
// sem o header X-Socket-ID
var instance = axios.create();
instance.defaults.headers.common = {};

// Definindo instancia do axios
window.axios = axios

// Definiciao do VUE
new Vue({
  el: '#dashboard',
  data: {
    messages: []
  },
  created() {
    this.fetchMessages();
  },
  mounted() {
    if (window.Echo) {
      this.listenChat()
    }
  },
  components: {
    NotificationsDemo,
    NotificationsDropdown,
    ChatMessages,
    ChatForm
  },
  methods: {
    // Muda de Empresa
    toggleCompanie: function (companie) {
      axios.post(window.Laravel.baseUrl + `/profile/companie`, {
          companie: companie
        })
        .then(response => {
          alertify.delay(5000).success('<h5>Empresa Alterada com sucesso</h5>');
          location.reload();
        })
        .catch(e => {
          alertify.delay(5000).error('<h5>Tente novamente.</h5>');
        })
    },
    // recupera mensagens do char
    fetchMessages() {
      axios.get(window.Laravel.baseUrl + `/chat/messages`).then(response => {
        this.messages = response.data;
      });
    },
    // adiciona mensagem ao chat
    addMessage(message) {
      this.messages.push(message);
      axios.post(window.Laravel.baseUrl + `/chat/messages`, message).then(response => {});
    },
    // escuta o canal do chat para novos push's
    listenChat() {
      window.Echo.private(`chat`)
        .listen('MessageSent', (e) => {
          this.messages.push({
            message: e.message.message,
            user: e.user
          });
          var elem = $('.chat-conversation');
          if (!elem.hasClass('show')) {
            elem.addClass('show').show('slow');
          }
        })
    },
  }
});

<template>
    <div>
        <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" id="dropdownNotifications" aria-haspopup="true" aria-expanded="false" aria-label="Abrir lista de notificações">
            <i :data-count="total" class="fa fa-bell fa-2x" :class="{ 'faa-ring animated': hasUnread }"></i>
            <span class="badge badge-pill badge-danger" style="position: absolute;top: 10px;right: 5px;" :class="{ 'invisible': !hasUnread }">{{ total }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownNotifications" style="padding: 0;width: 360px;">
            <div class="list-group">
                <notification v-for="notification in notifications"
                    :key="notification.id"
                    :notification="notification"
                    v-on:read="markAsRead(notification)"
                ></notification>
                <li v-if="!hasUnread"class="list-group-item disabled">
                    Você não tem nenhum notificações não lidas.
                </li>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import Notification from './Notification.vue'

export default {
  components: { Notification },

  data: () => ({
    total: 0,
    notifications: []
  }),

  mounted () {
    this.fetch()

    if (window.Echo) {
      this.listen()
    }

    this.initDropdown()
  },

  computed: {
    hasUnread () {
      return this.total > 0
    }
  },

  methods: {
    /**
     * Fetch notifications.
     *
     * @param {Number} limit
     */
    fetch (limit = 5) {
      axios.get(window.Laravel.baseUrl + '/notifications', { params: { limit }})
        .then(({ data: { total, notifications }}) => {
          this.total = total
          this.notifications = notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: created,
              action_url: data.action_url
            }
          })
        })
    },

    /**
     * Mark the given notification as read.
     *
     * @param {Object} notification
     */
    markAsRead ({ id }) {
      const index = this.notifications.findIndex(n => n.id === id)

      if (index > -1) {
        this.total--
        this.notifications.splice(index, 1)
        axios.patch(window.Laravel.baseUrl + `/notifications/${id}/read`)
      }
    },

    /**
     * Mark all notifications as read.
     */
    markAllRead () {
      this.total = 0
      this.notifications = []

      axios.post('/admin/notifications/mark-all-read')
    },

    /**
     * Initialize the notifications dropdown.
     */
    initDropdown () {
      const dropdown = $(this.$refs.dropdown)

      $(document).on('click', (e) => {
        if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0 &&
          !$(e.target).parent().hasClass('notification-mark-read')) {
          dropdown.removeClass('open')
        }
      })
    },

    /**
     * Listen for Echo push notifications.
     */
    listen () {
      window.Echo.private(`App.User.${window.Laravel.user.id}`)
        .notification(notification => {
          this.total++
          this.notifications.unshift(notification)
        })
        .listen('NotificationRead', ({ notificationId }) => {
          this.total--

          const index = this.notifications.findIndex(n => n.id === notificationId)
          if (index > -1) {
            this.notifications.splice(index, 1)
          }
        })
        .listen('NotificationReadAll', () => {
          this.total = 0
          this.notifications = []
        })
    },    

    /**
     * Toggle the notifications dropdown.
     */
    toggleDropdown () {
      $(this.$refs.dropdown).toggleClass('open')
    }
  }
}
</script>

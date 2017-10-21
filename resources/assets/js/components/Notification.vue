<template>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1"><a :href="notification.action_url">{{ notification.title }}</a></h5>
            <small><timeago :since="notification.created" :auto-update="30"></timeago></small>
        </div>
        <p class="mb-1">{{ notification.body }}</p>
        <small>
            <a href="#" @click.prevent="markAsRead" class="notification-mark-read" title="Mark as read">
                Marcar como lida
            </a>
        </small>
    </a>
</template>

<script>
export default {
  props: ['notification'],

  methods: {
    markAsRead () {
      this.$emit('read')
    }
  }
}
</script>

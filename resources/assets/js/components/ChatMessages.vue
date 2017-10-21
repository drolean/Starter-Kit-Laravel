<template>
<div>
    <div v-for="message in messages">
        <div v-if="message.user.id === user.id">
            <div class="d-flex p-2 conversation flex-row justify-content-end">
                <div class="chat-menu-reply">
                    <p class="p-2 m-0">{{ message.message }}</p>
                </div>
                <div class="media-right photo-table">
                    <a href="#!">
                        <img class="media-object img-circle m-t-5" :src="'/images/' + message.user.avatar" :alt="user.name">
                    </a>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="d-flex p-2 conversation">
                <a class="pr-3 photo-table" href="#!">
                    <img class="img-circle" :src="'/images/' + message.user.avatar + '?name=' + message.user.name" :alt="user.name">
                </a>
                <div class="chat-menu-content">
                    <p class="p-2 m-0">{{ message.message }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
  export default {
    props: ['messages'],
    data () {
      return {
        user: window.Laravel.user
      }
    },
    updated () {
        var objDiv = document.getElementsByClassName("scroll-y");
        if(objDiv && objDiv[0]) objDiv[0].scrollTop = objDiv[0].scrollHeight;
    },
  };
</script>
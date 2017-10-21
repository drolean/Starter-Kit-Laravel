<template>
    <div class="right-icon-control">
        <input type="text" class="form-control search-text pr-5" placeholder="Compartilhe seus pensamentos..." name="message" v-model="newMessage" @keyup.enter="sendMessage">
        <div class="form-icon">
            <a v-on:click.stop="sendMessage">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: window.Laravel.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>
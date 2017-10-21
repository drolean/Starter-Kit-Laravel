        <div class="chat-conversation fade">
            <div class="text-center bold inner-header p-3 mb-3">
                <span class="h5"> CHAT </span>
                <span class="pull-right close-chat">
                    <i aria-hidden="true" class="fa fa-times-circle fa-lg"></i>
                </span>
            </div>

            <div class="scroll-y">
                <chat-messages :messages="messages"></chat-messages>
            </div>

            <div class="chat-reply-box p-2">
                <chat-form v-on:messagesent="addMessage"></chat-form>
            </div>
        </div>
<template>
  <app-layout title="Home">
    <div class="py-12">
      <Enter>
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl grid grid-cols-2">
            <div class="border-r border-gray-100">
              <Enter>
                <h2 class="m-5">Messages</h2>
              </Enter>
              <p v-if="chats.length == 0">{{ chatMessage }}</p>
              <chats
                :chats="chats"
                :currentChat="currentChat"
                v-on:updateCurrent="updateCurrent"
                :messageAlert="messageAlert"
              />
            </div>
            <messages
              v-if="currentChat !== -1"
              :chat="chats[currentChat]"
              :newMessage="newMessage"
            />
          </div>
        </div>
      </Enter>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Enter from "@/Components/Enter.vue";
import Chats from "@/Pages/Home/Chats.vue";
import Messages from "@/Pages/Home/Messages.vue";
import miniToast from "mor-mini-toast";

export default {
  components: {
    AppLayout,
    Enter,
    Chats,
    Messages,
  },
  props: ["chats"],
  data: function () {
    return {
      chatMessage: "No chat to show",
      currentChat: -1,
      newMessage: [],
      messageAlert: [],
    };
  },
  methods: {
    updateCurrent(index) {
      this.messageAlert[this.chats[index].id] = false;
      this.currentChat = index;
    },
  },
  created() {
    window.Echo.private("user." + this.$page.props.user.id).listen(
      "NewChatMessage",
      (e) => {
        let current_chat_id;
        if (this.currentChat == -1) {
          current_chat_id = -1;
        } else {
          current_chat_id = this.chats[this.currentChat].id;
        }
        if (e.chatMessage.chat_id == current_chat_id) {
          this.newMessage = e.chatMessage;
        } else {
          this.messageAlert[parseInt(e.chatMessage.chat_id)] = true;
          let toastArgs = {
            position: "bottom-center",
            in: "slide-bottom",
            out: "slide-bottom",
            borderRadius: "0",
            fontFamily: "inherit",
            icon: "none",
            advanced: {
              enterDuration: 750,
              exitDuration: 750,
            },
          };
          miniToast.init("You have new message", toastArgs).show();
        }
      }
    );
  },
};
</script>
<style scoped>
.chat-num0 {
  background: rgba(243, 244, 246, var(--tw-border-opacity));
}
</style>

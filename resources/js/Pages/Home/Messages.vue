<template>
  <div>
    <h2 class="border-b border-gray-100 p-5">
      <img
        v-if="chat.user.profile_photo_url"
        :src="chat.user.profile_photo_url"
        class="inline w-10"
      />
      {{ chat.user.name }}
    </h2>
    <div
      class="h-300 overflow-y-scroll relative p-2"
      id="message-box"
      style="height: 300px"
    >
      <Enter>
        <div
          class="message"
          v-for="(message, i) in messages"
          :key="i"
          v-bind:class="
            'px-5 py-2 my-1 bg-gray-100  ' +
            [message.user_id == $page.props.user.id ? 'left' : 'right']
          "
        >
          <p>{{ message.message }}</p>
        </div>
      </Enter>
    </div>
    <div class="relative m-1">
      <div style="border-top: 1px solid #e6e6e6" class="flex p-1">
        <div class="w-full">
          <textarea
            type="text"
            v-model="message"
            placeholder="Say something..."
            class="
              outline-none
              w-full
              border-0
              hover:border-0
              ring-0
              focus:ring-0
            "
            @keyup.enter.exact.prevent="sendMessage()"
          ></textarea>
        </div>
        <div class="w-2/12">
          <button
            @click="sendMessage()"
            class="
              block
              bg-gray-100
              hover:bg-gray-300
              p-2
              m-1
              rounded-lg
              w-full
            "
          >
            Send
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Enter from "@/Components/Enter.vue";

export default {
  components: {
    Enter,
  },
  props: ["chat", "newMessage"],
  data() {
    return {
      height: false,
      messages: [],
      message: "",
      messageSent: "",
      check: [],
    };
  },
  async mounted() {
    await this.getMessages();
    this.setHeightOfMessages();
  },
  updated() {
    if (this.height) {
      this.setHeightOfMessages();
      this.height = false;
    }
  },
  methods: {
    async getMessages() {
      await axios
        .post("/messages/get", { chat_id: this.chat.id })
        .then((response) => {
          this.messages = response.data.reverse();
        });
    },
    async sendMessage() {
      this.messageSent = this.message;
      this.addToMessages();
      this.message = "";
      await this.sendRequest();
      this.setHeightOfMessages();
    },
    async sendRequest() {
      const data = {
        chat_id: this.chat.id,
        message: this.messageSent,
      };
      await axios
        .post("/messages/send", data)
        .then((response) => {
          this.messageSent = "";
          this.messages[this.check[0]] = response.data;
          this.check.shift();
        })
        .catch((e) => {
          console.log(e);
        });
    },
    addToMessages() {
      let id;

      if (this.messages.length == 0) {
        id = 0;
      } else {
        id = this.messages[this.messages.length - 1].id;
      }
      let data = {
        id: id,
        chat_id: this.chat.id,
        message: this.messageSent,
        user_id: this.$page.props.user.id,
        created_at: Date.now(),
        updated_at: Date.now(),
      };
      this.messages.push(data);

      let last = this.messages.length - 1;
      this.check.push(last);

      this.height = true;
    },
    setHeightOfMessages() {
      var element = document.getElementById("message-box");
      element.scrollTop = element.scrollHeight;
    },
  },
  watch: {
    async chat(newVal) {
      await this.getMessages();
      this.setHeightOfMessages();
    },
    newMessage(newVal) {
      if (newVal.length !== 0) {
        this.messages.push(newVal);
      }
      this.height = true;
    },
  },
};
</script>

<style scoped>
#message-box {
  scroll-behavior: smooth;
}
.message.left {
  float: left;
  clear: both;
}
.message.right {
  float: right;
  clear: both;
}
*::-webkit-scrollbar {
  width: 5px;
}

*::-webkit-scrollbar-track {
  background: transparent;
}

*::-webkit-scrollbar-thumb {
  background: rgba(243, 244, 246, var(--tw-border-opacity));
}

*::-webkit-scrollbar-thumb:hover {
  background: rgb(59, 59, 59) (243, 244, 246, var(--tw-border-opacity));
}
</style>

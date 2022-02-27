<template>
  <div v-if="chats">
    <div
      v-for="(chat, i) in chats"
      :key="i"
      :class="
        'p-5 relative hover:bg-gray-100 transition-all cursor-pointer ' +
        [currentChat == i ? 'bg-gray-100' : '']
      "
      @click="changeChat(i)"
    >
      <Enter>
        <img
          v-if="chat.user.profile_photo_url"
          :src="chat.user.profile_photo_url"
          class="inline"
        />
        <span class="ml-2 font-semibold">{{ chat.user.name }}</span>
        <span
          v-if="messageAlert[chat.id]"
          class="
            right-2
            top-1/2
            -translate-y-1/2
            absolute
            bg-red-500
            rounded-lg
            p-1
            block
            text-white
          "
          >NEW</span
        >
      </Enter>
    </div>
  </div>
</template>

<script>
import Enter from "@/Components/Enter.vue";

export default {
  components: {
    Enter,
  },
  props: ["chats", "currentChat", "messageAlert"],
  methods: {
    changeChat(i) {
      this.$emit("updateCurrent", i);
    },
  },
};
</script>

<template>
  <app-layout title="Friends">
    <div class="py-12">
      <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl" style="height: 60vh">
          <div class="flex justify-center m-2">
            <div>
              <input
                type="text"
                v-model="email"
                placeholder="User Email Address"
                class="outline-0 border-0 ring-0 focus:ring-0"
              />
            </div>
            <div class="flex px-2">
              <button @click="addFriend()">Add Friend</button>
            </div>
          </div>
          <div class="">
            <div
              v-for="(friend, i) in friends"
              :key="i"
              :class="'p-5 hover:bg-gray-100 transition-all cursor-pointer'"
            >
              <img
                v-if="friend.user.profile_photo_url"
                :src="friend.user.profile_photo_url"
                class="inline"
              />
              <span class="ml-2 font-semibold">{{ friend.user.name }}</span>
              <span class="ml-2 font-light text-sm"> {{ friend.status }}</span>
              <button
                class="mx-2 text-gray-500 border-gray-500 border p-2 rounded-lg"
                v-if="
                  friend.status == 'pending' &&
                  friend.data.pending == $page.props.user.id
                "
                @click="acceptFriend(friend.user.id, i)"
              >
                Accept
              </button>
              <button
                class="mx-2 text-gray-500 border-gray-500 border p-2 rounded-lg"
                v-if="
                  friend.status == 'pending' &&
                  friend.data.pending == $page.props.user.id
                "
                @click="denyFriend(friend.user.id, i)"
              >
                Deny
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import miniToast from "mor-mini-toast";

export default {
  components: {
    AppLayout,
  },
  props: ["friends"],
  data() {
    return {
      email: "",
      toastArgs: {
        position: "bottom-center",
        in: "slide-bottom",
        out: "slide-bottom",
        borderRadius: "0",
        icon: "none",
        advanced: {
          enterDuration: 750,
          exitDuration: 750,
        },
      },
    };
  },
  methods: {
    addFriend() {
      let data = {
        email: this.email,
      };
      axios.post("/friends/add", data).then((response) => {
        if (response.data) {
          this.email = "";
          miniToast
            .init("Friend request has been sent.", this.toastArgs)
            .show();
          this.friends.push(response.data);
        }
      });
    },
    acceptFriend(id, i) {
      axios
        .post("/friends/update", { action: "accept", id: id })
        .then((response) => {
          if (response.data) {
            this.friends[i].status = "accepted";
            miniToast
              .init("New friend has been accepted.", this.toastArgs)
              .show();
          }
        });
    },
    denyFriend(id, i) {
      axios
        .post("/friends/update", { action: "deny", id: id })
        .then((response) => {
          if (response.data) {
            this.friends.splice(i,1);
            miniToast
              .init("User has been denied.", this.toastArgs)
              .show();
          }
        });
    },
  },
};
</script>


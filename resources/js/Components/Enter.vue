<template>
  <transition :name="name">
    <div v-if="show">
      <slot></slot>
    </div>
  </transition>
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      default: 'slide-bottom-fade',
    },
  },
  data() {
    return {
      show: false,
    };
  },
  mounted() {
    this.show = true;
  },
};
</script>
<style scoped>
.slide-bottom-fade-enter-active {
  transition: all 0.3s ease-out;
}
.slide-bottom-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-bottom-fade-enter-from,
.slide-bottom-fade-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}

.slide-left-fade-enter-active {
  transition: all 0.3s ease-out;
}
.slide-left-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-left-fade-enter-from,
.slide-left-fade-leave-to {
  transform: translateX(-20px);
  opacity: 0;
}

.slide-right-fade-enter-active {
  transition: all 0.3s ease-out;
}
.slide-right-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-right-fade-enter-from,
.slide-right-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>

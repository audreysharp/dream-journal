<template>
<div id="overlay">
  <transition name="fade">
    <MoonLoader color="#A8DBA8" size="100px"></MoonLoader>
  </transition>
</div>
</template>

<script>

import MoonLoader from 'vue-spinner/src/MoonLoader.vue';

export default {

  components: {
    MoonLoader
  }

}
</script>

<style scoped>

/* overlay spinner on top */
#overlay {
  padding: 50px;
  z-index: 1;
  position: fixed;
  left: calc(50vw - 100px);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s
}

.fade-enter,
.fade-leave-to {
  opacity: 0
}
</style>
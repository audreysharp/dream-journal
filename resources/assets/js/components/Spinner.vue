<template>
<div id="overlay">
  <transition name="fade">
    <center><MoonLoader color="#A8DBA8" size="100px"></MoonLoader></center>
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
  position: absolute;
  z-index: 1;
}

/* Styling for desktop devices */
@media (min-width: 40.0rem) { 
  #overlay {
    margin-left: 350px;
  }
}

/* Styling for mobile devices */
@media (max-width: 40.0rem) { 
  #overlay {
    margin-left: 60px;
  }
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
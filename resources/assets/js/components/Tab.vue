<template>
  <div v-show="isActive">
    <slot></slot>
  </div>
</template>

<script>
  export default {
    props: {
      name: {
        required: true
      },
      selected: {
        default: false
      }
    },

    data () {
      return {
        isActive: false
      }
    },

    computed: {
      href () { // add tab name to URL
        return '#' + this.name.toLowerCase().replace(/ /g, '-') // replace spaces with dashes
      }
    },

    mounted () {
      this.isActive = this.selected
    }
  }

</script>

<style>
</style>
<template>
  <div v-show="isActive"> 
    <slot></slot> <!-- Show tab content -->
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
      this.isActive = this.selected // see if tab is active
    }
  }

</script>

<style>
</style>
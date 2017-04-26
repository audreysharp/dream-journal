<template>
    <div id="app-add" v-cloak>
      <EntryForm></EntryForm>
    </div>
</template>

<script>
import axios from 'axios';
import EntryForm from './EntryForm';

export default {

  components: {
    EntryForm
  },

  data() {
    return {
    }
  },

  mounted() {
    console.log('App -> mounted.')
  },

  beforeDestroy() {
    console.log('App -> beforeDestroy.')
  },

  methods: {

  }

}
</script>

<style>
</style>
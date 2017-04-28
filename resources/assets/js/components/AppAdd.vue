// Page that shows form to add an entry

<template>
    <div id="app-add" v-cloak>
      <EntryForm :id="id"></EntryForm>
    </div>
</template>

<script>
import EntryForm from './EntryForm';

export default {

  components: {
    EntryForm
  },

  props: [
    'update-entry-id'
  ],

  data() {
    return {
      id: this.updateEntryId
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

<style scoped>
@media (min-width: 40.0rem) {
  .container {
    width: 800px;
  }
}
</style>
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
      entries: [],
      loading: false
    }
  },

  mounted() {
    console.log('App -> mounted.')
    this.$evt.$on('addEntry', this.entryAdded)
    this.fetch(); // get entries from database
  },

  beforeDestroy() {
    console.log('App -> beforeDestroy.')
    this.$evt.$off('addEntry', this.entryAdded)
  },

  methods: {

    entryAdded() {
      console.log('App -> entryAdded');
      this.fetch();
    },

    fetch() { // fetch database entries
      console.log('App -> fetch');
      this.loading = true;
      axios.get('/entries')
        .then((response) => {
          console.log('App -> fetch success');
          // console.log(response.data);
          this.entries = response.data;
          this.loading = false;
        })
        .catch((response) => {
          console.log('App -> fetch error');
          // show error
          console.log(reponse);
          this.loading = false;
        })
    },

    update(data) { // update entry
      this.fetch();
      var i = this.entries.indexOf(data.entry);
      for (var d in data) {
        this.entries[i][d] = data[d];
      }
    },

    remove(i) { // remove entry
      console.log(`App -> remove ID: ${i}`);
      this.entries.splice(i, 1);
    }

  }

}
</script>

<style>
* {
  font-family: Lato;
  font-weight: 400;
}

body {
  padding-top: 65px;
  padding-bottom: 10px;
}
</style>
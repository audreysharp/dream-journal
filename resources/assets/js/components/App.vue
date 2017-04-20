<template>
  <div id="container">
    <div id="app" v-cloak>
      <h4>Testing</h4>
    </div>
  </div>

</template>

<script>
import axios from 'axios';
import Entry from './Entry';
import EntryForm from './EntryForm';
import MainLoader from './MainLoader';

export default {

  components: {
    Entry,
    EntryForm,
    MainLoader
  },

  data() {
    return {
      entries: [],
      loading: false
    }
  },

  mounted() {
    this.fetch();
  },

  methods: {

    fetch () {
      console.log('App -> fetch');
      this.loading = true;
      axios.get('/entries')
        .then((response) => {
          console.log('App -> fetch success');
          console.log(response.data);
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

    update (data) {
      // this.fetch();
      var i = this.entries.indexOf(data.entry);
      for (var d in data) {
        this.entries[i][d] = data[d];
      }
    },

    remove (i) {
      console.log(`App -> remove ID: ${i}`);
      this.entries.splice(i, 1);
    }

  }

}
</script>

<style>

</style>
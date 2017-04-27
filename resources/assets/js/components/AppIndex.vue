<template>
  <div id="app-index" v-cloak>

    <Spinner v-if="loading"></Spinner>

    <div class="EntryList" v-show="entries.length > 0 && !loading">
      <Entry v-for="(entry, index) in entries" :key="index" :entry="entry"></Entry>
    </div>
  
    <p v-show="entries.length === 0 && !loading">No one has added any dreams yet! You should <a href="http://localhost:8888/add">add one.</a></p>

  </div>
</template>

<script>
import axios from 'axios';
import Entry from './Entry';
import Spinner from './Spinner';

export default {

  components: {
    Entry,
    Spinner
  },

  data() {
    return {
      entries: [],
      loading: false
    }
  },

  mounted() {
    console.log('AppIndex -> mounted.')
    this.fetch(); // get entries from database
  },

  beforeDestroy() {
    console.log('App -> beforeDestroy.')
    this.$evt.$off('addEntry', this.entryAdded)
  },

  methods: {

    fetch() { // fetch database entries
      console.log('App -> fetch');
      this.loading = true;
      axios.get('/entries')
        .then((response) => {
          console.log('App -> fetch success');
          // console.log(response.data);
          this.loading = false; // stop showing spinner
          this.entries = response.data;
        })
        .catch((response) => {
          console.log('App -> fetch error');
          // show error
          console.log(reponse);
          this.loading = false;
        })
    }

  }

}
</script>

<style scoped>
p {
  color: #bbc0c8;
}
</style>
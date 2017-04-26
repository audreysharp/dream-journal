<template>
    <div id="app-view" v-cloak>
      <EntryView></EntryView>
    </div>
</template>

<script>
import axios from 'axios';
import EntryView from './EntryView';

export default {

  components: {
    EntryView
  },

  data() {
    return {
      entries: [],
    }
  },

  mounted() {
    console.log('App -> mounted.')
    this.fetch(); // get entries from database
  },

  beforeDestroy() {
    console.log('App -> beforeDestroy.')
  },

  methods: {

    entryAdded() {
      console.log('App -> entryAdded');
      this.fetch();
    },

    fetch() { // fetch database entries
      console.log('App -> fetch');
      axios.get('/entries')
        .then((response) => {
          console.log('App -> fetch success');
          // console.log(response.data);
          this.entries = response.data;
        })
        .catch((response) => {
          console.log('App -> fetch error');
          // show error
          console.log(reponse);
        })
    },

    update(data) { // update entry
      this.fetch();
      var i = this.entries.indexOf(data.entry);
      for (var d in data) {
        this.entries[i][d] = data[d];
      }
    }

  }

}
</script>

<style>
</style>
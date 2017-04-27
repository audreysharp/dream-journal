<template>
    <div id="app-view" v-cloak>

      <Spinner v-if="loading"></Spinner>

      <div class="EntryDisplay" v-show="!loading">
        <EntryView :entry="entryData"></EntryView>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import EntryView from './EntryView';
import Spinner from './Spinner';

export default {

  components: {
    EntryView,
    Spinner
  },

  props: [
    'entry-id'
  ],

  data() {
    return {
      entryData: [],
      loading: false,
      key: this.entryId
    }
  },

  mounted() {
    console.log('AppView -> mounted.');
    this.fetch(this.key); // get entry from database
  },

  beforeDestroy() {
    console.log('AppView -> beforeDestroy.')
  },

  methods: {

    fetch(entryId) { // fetch database entries
      console.log('AppView -> fetch');
      this.loading = true;
      axios.get('/entries/' + entryId)
        .then((response) => {
          console.log('AppView -> fetch success');
          // console.log(response.data);
          this.loading = false;
          this.entryData = response.data;
        })
        .catch((response) => {
          console.log('AppView -> fetch error');
          // show error
          console.log(reponse); // show error
          this.loading = false;
        })
    }

  }

}
</script>

<style>
</style>
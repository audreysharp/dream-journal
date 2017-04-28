// Index page that shows entries

<template>
  <div id="app-index" v-cloak>

    <div v-show="justDeleted" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> You have deleted your dream entry.
    </div>

    <Spinner v-if="loading"></Spinner>

    <div class="EntryList" v-show="entries.length > 0 && !loading">
      <Entry v-for="(entry, index) in entries" :key="index" :arrayIndex="index" :entry="entry"></Entry>
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

  props: [
    'just-deleted'
  ],

  data() {
    return {
      entries: [],
      loading: false,
      showDeletedMessage: this.justDeleted
    }
  },

  mounted() {
    console.log('AppIndex -> mounted.')
    this.fetch(); // get entries from database
    this.$evt.$on('indexPageUpvote', this.updateUpvotes)
    this.$evt.$on('indexPageDownvote', this.updateDownvotes)
  },

  beforeDestroy() {
    console.log('App -> beforeDestroy.')
    this.$evt.$off('indexPageUpvote', this.updateUpvotes)
    this.$evt.$off('indexPageDownvote', this.updateDownvotes)
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
          console.log(response);
          this.loading = false; // stop showing spinner
        })
    },

    updateUpvotes(data) {
      console.log('AppView -> update upvotes');
      axios.put('/entries/' + data.id, { upvotes: data.upvotes })
        .then((response) => {
          console.log('AppView -> upvote success');
          console.log(response.data);
          // update upvote total since fetch()ing again makes all the entires reload and that is bad
          this.entries[data.index].upvotes = data.upvotes;
        })
        .catch((response) => {
          console.log('AppView -> upvote error');
          console.log(response); // show error
        })
    },

    updateDownvotes(data) {
      console.log('EntryView -> update downvotes');
      axios.put('/entries/' + data.id, { downvotes: data.downvotes })
        .then((response) => {
          console.log('EntryView -> downvote success');
          console.log(response.data);
          // update downvote total since fetch()ing again makes all the entires reload
          this.entries[data.index].downvotes = data.downvotes;
        })
        .catch((response) => {
          console.log('EntryView -> downvote error');
          console.log(response); // show error
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
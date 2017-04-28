// View page that allows you to view single entry, vote on an entry, and delete or update an entry

<template>
  <div id="app-view" v-cloak>
  
    <div v-show="justCreated" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>You have successfully posted your dream!</strong> You can view it along with the rest of the dreams on the <a href="http://localhost:8888/">homepage</a>.
    </div>

    <div v-show="justUpdated" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> You have edited your dream entry.
    </div>
  
    <Spinner v-if="loading"></Spinner>
  
    <div class="EntryDisplay" v-show="!loading">
      <EntryView :entry="entryData"></EntryView>
      <button type="button" class="btn my-green-button btn-default pull-right" @click="deleteEntry" :disabled="loading" style="margin-top:-5px">Delete Entry</button>
      <button type="button" class="btn my-btn btn-default pull-right" @click="updateEntry" :disabled="loading" style="margin-right: 7px; margin-top:-5px">Edit Entry</button>
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
    'entry-id',
    'is-just-created',
    'was-just-updated'
  ],

  data() {
    return {
      entryData: [],
      loading: false, // stop showing spinner
      key: this.entryId, // component passed from view.blade.php file
      justCreated: this.isJustCreated,
      justUpdated: this.wasJustUpdated
    }
  },

  mounted() {
    console.log('AppView -> mounted');
    this.fetch(this.key); // get entry from database
    this.$evt.$on('upvote', this.updateUpvotes)
    this.$evt.$on('downvote', this.updateDownvotes)
  },

  beforeDestroy() {
    console.log('AppView -> beforeDestroy')
    this.$evt.$off('upvote', this.updateUpvotes)
    this.$evt.$off('downvote', this.updateDownvotes)
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
          console.log(response); // show error
          this.loading = false;
        })
    },

    deleteEntry() {
      axios.delete('/entries/' + this.entryData.id)
        .then((response) => {
          console.log('AppView -> delete success');
          console.log(response.data);
          // redirect user to page of newly created entry
          window.location.href = 'http://localhost:8888/?deleted=true';
        })
        .catch((response) => {
          console.log('AppView -> delete error');
          console.log(response); // show error
        })
    },

    updateEntry() {
      // redirect to entry edit page
      window.location.href = 'http://localhost:8888/add?update=' + this.key;
    },

    updateUpvotes(data) {
      console.log('AppView -> update upvotes');
      axios.put('/entries/' + this.entryData.id, { upvotes: data.upvotes })
        .then((response) => {
          console.log('AppView -> upvote success');
          console.log(response.data);
          this.entryData.upvotes = data.upvotes;
        })
        .catch((response) => {
          console.log('AppView -> upvote error');
          console.log(response); // show error
        })
    },

    updateDownvotes(data) {
      console.log('EntryView -> update downvotes');
      axios.put('/entries/' + this.entryData.id, { downvotes: data.downvotes })
        .then((response) => {
          console.log('EntryView -> downvote success');
          console.log(response.data);
          this.entryData.downvotes = data.downvotes;
        })
        .catch((response) => {
          console.log('EntryView -> downvote error');
          console.log(response); // show error
        })
    }

  }

}
</script>

<style>

</style>
// View page that allows you to view single entry, vote on an entry, and delete or update an entry

<template>
  <div id="app-view" v-cloak>
  
    <!-- Show success alert if just created new entry -->
    <div v-show="justCreated" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>You have successfully posted your dream!</strong> You can view it along with the rest of the dreams on the <a href="http://localhost:8888/">homepage</a>.
    </div>
  
    <!-- Show success alert if just updated new entry -->
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
      justCreated: this.isJustCreated, // if new entry was just created, show success alert box
      justUpdated: this.wasJustUpdated // if entry was just updated, show success alert box
    }
  },

  mounted() {
    console.log('AppView -> mounted');
    this.fetch(this.key); // get entry from database
    this.$evt.$on('voted', this.updateVotes) // add event handler
  },

  beforeDestroy() {
    console.log('AppView -> beforeDestroy')
    this.$evt.$off('voted', this.updateVotes) // remove event handler
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
          console.log(response); // show error
          this.loading = false;
        })
    },

    deleteEntry() { // delete dream journal entry
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

    updateEntry() { // update journal entry
      // redirect to entry edit page
      window.location.href = 'http://localhost:8888/add?update=' + this.key;
    },

    updateVotes(data) { // update vote count
      this.entryData.upvotes = data.upvotes;
      this.entryData.downvotes = data.downvotes;
    }

  }
}
</script>

<style>

</style>
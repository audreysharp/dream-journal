// Index page that shows entries

<template>
  <div id="app-index" v-cloak>

    <!-- Show modal only the first time the user logs into the application - if there are no entries, it's not loading, and the user didn't just delete the last entry' ' -->
    <div v-show="!showModal && entries.length === 0 && !loading && !justDeleted" class="model fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" @click="toggleModal">&times;</button>
            <h4 class="modal-title">Welcome!</h4>
          </div>
          <div class="modal-body">
            <p><b>Welcome to the dream journal!</b>  This web application is a public, anonymous dream journal 
            that lets you post your dreams, view others' dreams, and share and vote on the most interesting ones.</p>
            <p>If you like an entry, you can upvote it, and it will move closer to the top. Similarly, if
              you thought an entry was boring, you can downvote it, and it will move closer to the bottom.
            </p>
            <p>To get started, you can <a href="http://localhost:8888/add">add a new dream</a>. If you'd like, you can
            also <a href="https://audreysharp.gitbooks.io/dream-journal/content/">view the API documentation</a> for this
            application.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="toggleModal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Show success alert box if user just deleted entry -->
    <div v-show="justDeleted" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> You have deleted your dream entry.
    </div>
  
    <Spinner v-if="loading"></Spinner>
  
    <div class="EntryList" v-show="entries.length > 0 && !loading">
      <Entry v-for="(entry, index) in entries" :key="index" :arrayIndex="index" :entry="entry"></Entry>
    </div>
  
    <p v-show="entries.length === 0 && !loading" class="my-message">No one has added any dreams yet! You should <a href="http://localhost:8888/add">add one.</a></p>
  
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
      showDeletedMessage: this.justDeleted, // show success message if entry was just deleted
      showModal: false // show instructions on start
    }
  },

  mounted() {
    console.log('AppIndex -> mounted.')
    this.fetch(); // get entries from database
    this.$evt.$on('indexPageUpvote', this.updateUpvotes) // add event handlers
    this.$evt.$on('indexPageDownvote', this.updateDownvotes)
  },

  beforeDestroy() {
    console.log('AppIndex -> beforeDestroy.')
    this.$evt.$off('indexPageUpvote', this.updateUpvotes)
    this.$evt.$off('indexPageDownvote', this.updateDownvotes)
  },

  methods: {

    fetch() { // fetch database entries
      console.log('App -> fetch');
      this.loading = true;
      axios.get('/entries')
        .then((response) => {
          console.log('AppIndex -> fetch success');
          // console.log(response.data);
          this.loading = false; // stop showing spinner
          this.entries = response.data;
          this.entries.sort(this.compare); // sort entries to display based on number of upvotes
        })
        .catch((response) => {
          console.log('AppIndex -> fetch error');
          // show error
          console.log(response);
          this.loading = false; // stop showing spinner
        })
    },

    updateUpvotes(data) { // 'PUT' request to update upvote count
      console.log('AppView -> update upvotes');
      axios.put('/entries/' + data.id, { upvotes: data.upvotes })
        .then((response) => {
          console.log('AppIndex -> upvote success');
          console.log(response.data);
          // update upvote total since fetch()ing again makes all the entries reload and that is bad
          this.entries[data.index].upvotes = data.upvotes;
        })
        .catch((response) => {
          console.log('AppIndex -> upvote error');
          console.log(response); // show error
        })
    },

    updateDownvotes(data) { // 'PUT' request to update downvote count
      console.log('AppIndex -> update downvotes');
      axios.put('/entries/' + data.id, { downvotes: data.downvotes })
        .then((response) => {
          console.log('AppIndex -> downvote success');
          console.log(response.data);
          // update downvote total since fetch()ing again makes all the entries reload
          this.entries[data.index].downvotes = data.downvotes;
        })
        .catch((response) => {
          console.log('AppIndex -> downvote error');
          console.log(response); // show error
        })
    },

    toggleModal() { // close modal
      this.showModal = !this.showModal;
    },

    compare(a, b) { // function to sort entries and display the most upvoted entries first
      console.log(a);
      if (a.upvotes-a.downvotes > b.upvotes-b.downvotes) {
        return -1;
      }
      if (a.upvotes-a.downvotes < b.upvotes-b.downvotes) {
        return 1;
      }
      return 0;
    }

  }

}
</script>

<style scoped>
.my-message {
  color: #E3E5E9;
}

.my-modal {
  display: inline;
}
</style>
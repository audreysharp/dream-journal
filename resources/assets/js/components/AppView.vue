<template>
  <div id="app-view" v-cloak>
  
    <div v-show="justCreated" class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>You have successfully posted your dream!</strong> You can view it along with the rest of the dreams on the <a href="http://localhost:8888/">homepage</a>.
    </div>
  
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
    'entry-id',
    'is-just-created'
  ],

  data() {
    return {
      entryData: [],
      loading: false, // stop showing spinner
      key: this.entryId, // component passed from view.blade.php file
      justCreated: this.isJustCreated
    }
  },

  mounted() {
    console.log('AppView -> mounted');
    this.fetch(this.key); // get entry from database
    this.$evt.$on('upvoted', this.updateUpvotes)
    this.$evt.$on('downvoted', this.updateDownvotes)
  },

  beforeDestroy() {
    console.log('AppView -> beforeDestroy')
    this.$evt.$off('upvoted', this.updateUpvotes)
    this.$evt.$off('downvoted', this.updateDownvotes)
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
          console.log(reponse); // show error
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
          console.log(reponse); // show error
        })
    }

  }

}
</script>

<style>

</style>
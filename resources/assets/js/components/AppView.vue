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
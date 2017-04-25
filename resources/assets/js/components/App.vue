<template>
  <div id="container">
    <div id="app" v-cloak>
      <div class="container">
        <Navigation>
          <Tab name="Dreams" :selected="true">
            <div class="EntryList" v-show="entries.length > 0">
              <Entry v-for="(entry, index) in entries" :key="index" :entry="entry" @updated="update" @deleted="remove(index)"></Entry>
            </div>
          </Tab>
          <Tab name="Add Dream">
            <EntryForm></EntryForm>
          </Tab>
          <Tab name="Style Guide">
            Style Guide
          </Tab>
          <Tab name="Credits">
            Credits
          </Tab>
        </Navigation>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navigation from './Navigation';
import Tab from './Tab';
import Entry from './Entry';
import EntryForm from './EntryForm';

export default {

  components: {
    Navigation,
    Tab,
    Entry,
    EntryForm
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

    fetch() {
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

    update(data) {
      // this.fetch();
      var i = this.entries.indexOf(data.entry);
      for (var d in data) {
        this.entries[i][d] = data[d];
      }
    },

    remove(i) {
      console.log(`App -> remove ID: ${i}`);
      this.entries.splice(i, 1);
    }

  }

}
</script>

<style>
* {
  font-family: Lato;
  font-weight: 400;
}

body {
  padding-top: 60px;
  padding-bottom: 10px;
}
</style>
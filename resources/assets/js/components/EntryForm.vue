<template>
  <div class="ContactForm">
    <input type="text" v-model="date" />
    <input type="text" v-model="entry" />
    <input type="checkbox" v-model="favorite" />
    <button class="btn btn-primary" @click="create" :disabled="loading">Add Entry</button>
  </div>
</template>

<script>
import axios from 'axios';
import Loader from './Loader';

export default {
  components: {
    Loader
  },

  data() {
    return {
      date: '',
      entry: '',
      favorite: false,
      loading: false
    }
  },

  methods: {
    create () {
      console.log('EntryForm -> create');
      if (this.loading) {
        alert('Request is already being made');
        return false;
      }
      this.loading = true;
      this.sendRequest();
    },

    sendRequest () {
      axios.post('/contacts', {
        first: this.first,
        last: this.last,
        phone: this.phone,
        favorite: this.favorite
      })
      .then((response) => {
        console.log('ContactForm -> sendRequest success');
        console.log(response.data);
        this.loading = false;
        this.reset();
        this.$emit('created');
      })
      .catch((error) => {
        console.error('ContactForm -> sendRequest error');
        // show an error message
      });
    },

    reset () {
      this.first = '';
      this.last = '';
      this.phone = '';
      this.favorite = false;
    }
  }
};
</script>

<style scoped>
</style>

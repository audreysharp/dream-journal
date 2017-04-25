<template>
  <div class="EntryForm">
    <div class="container">
      <datepicker :value="creationDate.date" name="datePicker"></datepicker>
      <div class="form-group">
        <label for="exampleTextarea">Dream Journal Entry</label>
        <textarea class="form-control" id="entry" v-model="entry"></textarea>
      </div>
      <input type="checkbox" v-model="favorite" />
      <button class="btn btn-primary" @click="create" :disabled="loading">Add Entry</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';

export default {
  components: {
    Datepicker
  },

  data() {
    return {
      creationDate: new Date(2016, 9,  16),
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
      axios.post('/entries', {
        creationDate: this.creationDate,
        text: this.entryText,
        favorite: this.favorite
      })
      .then((response) => {
        console.log('EntryForm -> sendRequest success');
        console.log(response.data);
        this.loading = false;
        this.reset();
        this.$emit('created');
      })
      .catch((error) => {
        console.error('EntryForm -> sendRequest error');
        console.log(error);
        // show an error message
      });
    },

    reset () {
      this.creationDate = '',
      this.entryText = '',
      this.favorite = false
    }
  }
};
</script>

<style scoped>
</style>

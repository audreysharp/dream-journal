<template>
  <div class="EntryForm">
    <div class="container">
      <div class="input-group" id="date">
        <span class="glyphicon glyphicon-calendar" id="basic-addon"></span>
        <datepicker v-model="creationDate" name="datePicker" format="D MMMM dd yyyy"></datepicker>
      </div>
      <!--<datepicker v-model="creationDate" name="datePicker" format="D MMMM dd yyyy"></datepicker>-->
      <div class="form-group">
        <label for="entry">Dream Journal Entry</label>
        <textarea class="form-control" id="entry" v-model="entry"></textarea>
      </div>
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
      creationDate: new Date(),
      entry: '',
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
      console.log(this.creationDate);
      axios.post('/entries', {
        creationDate: this.creationDate,
        text: this.entryText,
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
      this.entryText = ''
    }
  }
};
</script>

<style scoped>

#date {
    width: 500px;
    overflow: hidden;
    white-space: nowrap;
    display: inline-block
}

</style>

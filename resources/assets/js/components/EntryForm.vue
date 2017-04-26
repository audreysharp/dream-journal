<template>
  <div class="EntryForm">
      <div class="input-group date">
        <Calendar></Calendar>
        <!--<datepicker v-model="creationDate" name="datePicker" format="D MMMM dd yyyy"></datepicker>-->
        <!--<Datepicker v-model="creationDate" value="creationDate" format="MMMM/dd/yyyy" placeholder="2015-06-09" ></Datepicker>-->
      </div>
      <div class="form-group">
        <label for="entry">Dream Journal Entry</label>
        <textarea class="form-control" id="entry" v-model="entry"></textarea>
      </div>
      <button class="btn btn-primary" @click="create" :disabled="loading">Add Entry</button>
  </div>
</template>

<script>
import axios from 'axios';
import Calendar from './Calendar';
// import Datepicker from 'vue-strap/src/datepicker';

export default {
  components: {
    // Datepicker
    Calendar
  },

  data() {
    return {
      creationDate: '2015-06-09',
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
        text: this.entry,
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

textarea {
  min-height: 200px;
}

</style>

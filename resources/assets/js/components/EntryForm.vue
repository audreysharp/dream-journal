<template>
  <div class="EntryForm">
  
    <div v-show="error" class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>There was an error adding your dream entry.</strong> Please refresh the page and try again!.
    </div>
  
    <!--<div v-show="success" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>There was an error adding your dream entry.</strong> Please refresh the page and try again!.
          </div>-->
  
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td class="calendar">
              <Datepicker v-model="creationDate" value="creationDate" format="MMMM/dd/yyyy" :inline="true"></Datepicker>
            </td>
            <td class="text-entry">
              <div class="form-group">
                <label for="entry">Dream Entry</label>
                <textarea class="form-control entry" id="entry" v-model="entry"></textarea>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--<Spinner spinner size="md" fixed text="I will close in 2 secs"></Spinner>-->
    <button class="btn btn-primary" @click="create" :disabled="loading">Add Entry</button>
  </div>
</template>

<script>
import axios from 'axios';
import Calendar from './Calendar';
import Spinner from 'vue-strap/src/spinner';
import Datepicker from 'vuejs-datepicker';

export default {
  components: {
    Datepicker,
    Calendar,
    Spinner
  },

  data() {
    return {
      creationDate: new Date().toString(),
      entry: '',
      loading: false,
      error: false,
      success: true
    }
  },

  methods: {

    create() {
      console.log('EntryForm -> create');
      if (this.loading) {
        alert('Request is already being made');
        return false;
      }
      this.loading = true;
      this.sendRequest();
    },

    sendRequest() {
      console.log(this.creationDate);
      axios.post('/entries', { // post input to 'entries' table
        creationDate: this.creationDate,
        text: this.entry
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
          console.log(error); // log error message
          this.error = true; // show error alert box
        });
    },

    reset() { // make form blank
      this.creationDate = new Date().toString(),
        this.entry = ''
    }
  },
};
</script>

<style scoped>
textarea {
  min-height: 295px;
}

.table {
  border-bottom: 0px !important;
  padding: 0px;
}

.table th,
.table td {
  border: 1px !important;
  padding: 0px;
}

.fixed-table-container {
  border: 0px !important;
  padding: 0px;
}

.calendar {
  width: 30%;
}

.text-entry {
  width: 70%;
  padding-left: 15px !important;
}
</style>

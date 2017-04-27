<template>
  <div class="EntryForm">

    <div v-show="error" class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>There was an error adding your dream entry.</strong> Please try again.
    </div>

    <Spinner v-if="loading"></Spinner>

    <div>
      <!-- A table was the only way to get them inline because of the Datepicker component I'm so sorry -->
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

    <button class="btn my-btn pull-right" @click="create" :disabled="loading">Add Entry</button>
  </div>
</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';
import Spinner from './Spinner';

export default {
  components: {
    Datepicker,
    Spinner
  },

  data() {
    return {
      creationDate: new Date().toString(),
      entry: '',
      loading: false,
      error: false,
      success: false,
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
          // redirect user to page of newly created entry
          window.location.href = 'http://localhost:8888/view/' + response.data.id + '?created=true';
        })
        .catch((error) => {
          console.error('EntryForm -> sendRequest error');
          console.log(error); // log error message
          this.error = true; // show error alert box
          this.loading = false;
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

label {
  color: #bbc0c8;
}

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

/* Styling for mobile devices */
@media (max-width: 40.0rem) {
  /*.entryForm {
    width: 100%;
  }*/

  td {
    display: block;
  }

  .calendar {
    height: 330px;
  }

  /*.text-entry {
    width: 100%;
  }*/
}

/* Styling for desktop devices */
@media (min-width: 40.0rem) {
  .calendar {
    width: 30%;
  }

  .text-entry {
    width: 70%;
    padding-left: 15px !important;
  }
}

.fixed-table-container {
  border: 0px !important;
  padding: 0px;
}
</style>

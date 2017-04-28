// Form where you add entry

<template>
  <div class="EntryForm">

    <!-- Show success alert if error adding new entry -->
    <div v-show="error" class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>There was an error adding your dream entry.</strong> Please try again.
    </div>

    <Spinner v-if="loading"></Spinner>

    <div>
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

    <button v-show="!update" class="btn my-btn pull-right" @click="create" :disabled="loading">Add Entry</button>
    <button v-show="update" class="btn my-btn pull-right" @click="updateEntry" :disabled="loading">Update Entry</button>
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

  props: [
    'id'
  ],

  data() {
    return {
      creationDate: new Date().toString(), // populate calendar
      entry: '',
      loading: false,
      error: false, // display error message
      key: this.id, // ID of entry if editing
      update: false // allows application to check if updating entry or adding new entry
    }
  },

  mounted() {
    // web.php router sends key as -1 if not editing an existing entry
    // so if editing an existing entry, populate it with the data
    if (parseInt(this.key) > -1) {
      this.setEntryData();
      this.update = true;
    }
  },

  methods: {

    create() { // create new entry
      console.log('EntryForm -> create');
      if (this.loading) {
        alert('Request is already being made');
        return false;
      }
      this.loading = true;
      this.sendPostRequest();
    },

    updateEntry() { // update entry
      this.loading = true;
      this.sendPutRequest();
    },

    sendPostRequest() { // add entry
      axios.post('/entries', { // POST input to 'entries' table
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
    },

    setEntryData() { // populate fields with entry you're editing
      console.log('AppView -> fetch');
      this.loading = true;
      axios.get('/entries/' + this.key)
        .then((response) => {
          console.log('EntryForm -> fetch success');
          // console.log(response.data);
          this.loading = false;
          this.creationDate = response.data.creationDate;
          this.entry = response.data.text;
        })
        .catch((response) => {
          console.log('EntryForm -> fetch error');
          // show error
          console.log(response); // show error
          this.loading = false;
        })
    },

    sendPutRequest() { // update entry
      axios.put('/entries/' + this.key, { // PUT new entry fields in table
        creationDate: this.creationDate, 
        text: this.entry 
      })
        .then((response) => {
          console.log('EntryForm -> update success');
          console.log(response.data);
          // redirect user to page of edited entry entry
          window.location.href = 'http://localhost:8888/view/' + this.key + '?updated=true';
        })
        .catch((response) => {
          console.log('EntryForm -> update error');
          console.log(response); // show error
        })
    }
  },
};
</script>

<style scoped>

label {
  color: #E3E5E9;
}

.my-btn {
  margin-top: -25px;
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
  td {
    display: block;
  }

  .calendar {
    height: 330px;
  }
}

/* Styling for desktop devices */
@media (min-width: 40.0rem) {
  .calendar {
    width: 45%;
  }

  .text-entry {
    width: 55%;
    padding-left: 15px !important;
  }
}

.fixed-table-container {
  border: 0px !important;
  padding: 0px;
}
</style>

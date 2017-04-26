<template>
  <div class="Entry">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ this.parseCreationDate(creationDate) }}
      </div>
      <div class="panel-body">
        {{ entry.text }}
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  
  export default {
  
    props: [
      'entry'
    ],
  
    data() {
      return {
        creationDate: this.entry.creationDate,
        entryText: this.entry.text,
        editing: false,
        loading: false
      }
    },
  
    methods: {
  
      remove() {
        console.log('Entry -> remove');
        this.loading = true;
        axios.delete(`/entries/${this.entry.id}`)
          .then((response) => {
            console.log('Entry -> remove success');
            this.$emit('deleted')
            this.loading = false;
          })
          .catch((error) => {
            console.log('Entry -> remove error');
            // stop deleting and dont remove from the dom
            // tell the user deletion failed
          });
      },
  
      save() {
        console.log('Entry -> save');
        axios.put(`/entries/${this.entry.id}`, {
            creationDate: this.creationDate,
            text: this.entryText
          })
          .then((response) => {
            console.log('Entry -> save success');
            this.$emit('updated', {
              creationDate: this.creationDate,
              text: this.entryText
            });
            this.editing = false;
          })
          .catch((error) => {
            console.log('Entry -> save error');
            // show the user that it couldn't be updated
          });
      },
  
      cancel() {
        console.log('Entry -> cancel');
        this.creationDate = this.entry.creationDate,
          this.entryText = this.entry.text,
          this.editing = false
      },

      parseCreationDate(dateToParse) { // parse date to "month day, year"
        var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
        var parsedDate = new Date(dateToParse);
        var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
        return result;
      }
  
    }
  
  }
</script>

<style>
</style>
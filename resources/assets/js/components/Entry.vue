<template>
  <div class="Entry" @mouseover="change">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ this.parseCreationDate(creationDate) }}
        <span class="pull-right"><a :href="linkToEntry">View Details</a></span>
      </div>
      <div class="panel-body">
        {{ entry.text }}
      </div>
    </div>
  </div>
</template>

<script>
  
  export default {
  
    props: [
      'entry'
    ],
  
    data() {
      return {
        creationDate: this.entry.creationDate,
        entryText: this.entry.text,
        id: this.entry.id,
        linkToEntry: '/view/' + this.entry.id, // to go to individual entry page
        editing: false,
        loading: false
      }
    },
  
    methods: {

      parseCreationDate(dateToParse) { // parse date to "month day, year"
        var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
        var parsedDate = new Date(dateToParse);
        var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
        return result;
      },

      change() {
        // alert("mouseover");
      }
  
    }
  
  }
</script>

<style scoped>

</style>
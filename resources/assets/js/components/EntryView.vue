<template>
  <div class="Entry">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ this.parseCreationDate(this.entry.creationDate) }}
      </div>
      <div class="panel-body">
        {{ this.entry.text }}
      </div>
    </div>
  </div>
</template>

<script>
  
  export default {
  
    props: [
      'entry',
    ],
  
    data() {
      return {
      }
    },
  
    methods: {

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
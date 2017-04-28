// Entry view shown on homepage

<template>
  <div class="Entry">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ this.parseCreationDate(creationDate) }}
        <span class="pull-right">
          <a :href="linkToEntry">View Details</a>&nbsp;&nbsp;&nbsp;
          <VoteArrows :entry="entry" :arrayIndex="arrayIndex" style="display:inline"></VoteArrows>&nbsp;
          <span>{{ totalScore }}</span>
        </span>
      </div>
      <div class="panel-body">
        {{ entry.text }}
      </div>
    </div>
  </div>
</template>

<script>
  
import VoteArrows from './VoteArrows';

  export default {

    components: {
      VoteArrows
    },
  
    props: [
      'entry',
      'arrayIndex'
    ],
  
    data() {
      return {
        creationDate: this.entry.creationDate,
        entryText: this.entry.text,
        id: this.entry.id,
        linkToEntry: '/view/' + this.entry.id, // to go to individual entry page
        loading: false, // show spinner
        upvoteArrowColor: '#0B486B',
        downvoteArrowColor: '#0B486B',
        upvoted: false, // to toggle upvoting
        downvoted: false // toggle downvoting
      }
    },
  
    methods: {

      parseCreationDate(dateToParse) { // parse date to "month day, year"
        var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
        var parsedDate = new Date(dateToParse);
        var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
        return result;
      },
  
    },

    computed: {
      totalScore() {
        return this.entry.upvotes - this.entry.downvotes
      }
    }
  
  }
</script>

<style>

</style>
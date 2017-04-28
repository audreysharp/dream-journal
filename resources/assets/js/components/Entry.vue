// Entry view shown on homepage

<template>
  <div class="Entry">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ this.parseCreationDate(creationDate) }}
        <span class="pull-right">
          <a :href="linkToEntry">View Details</a>&nbsp;&nbsp;&nbsp;
          <span class="glyphicon glyphicon-arrow-up" @click="upvote" :style="{ color: upvoteArrowColor }" ></span>
          <span class="glyphicon glyphicon-arrow-down" @click="downvote" :style="{ color: downvoteArrowColor }"></span>&nbsp;
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
  
  export default {
  
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
        editing: false,
        loading: false,
        upvoteArrowColor: '#0B486B',
        downvoteArrowColor: '#0B486B',
        upvoted: false, // to toggle upvoting
        downvoted: false
      }
    },
  
    methods: {

      parseCreationDate(dateToParse) { // parse date to "month day, year"
        var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
        var parsedDate = new Date(dateToParse);
        var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
        return result;
      },

      upvote() {
      if (!this.upvoted) {
        this.upvoted = true;
        this.upvoteArrowColor = '#79BD9A';
        this.$evt.$emit('indexPageUpvote', {
          upvotes: this.entry.upvotes+1,
          id: this.id,
          index: this.arrayIndex
        });
      } else {
        // remove upvote and change color back to default
        this.upvoted = false;
        this.upvoteArrowColor = '#0B486B';
        this.$evt.$emit('indexPageUpvote', {
          upvotes: this.entry.upvotes-1,
          id: this.id,
          index: this.arrayIndex
        });
      }
    },

    downvote() {
      if (!this.downvoted) {
        this.downvoted = true;
        this.downvoteArrowColor = '#79BD9A';
        this.$evt.$emit('indexPageDownvote', {
          downvotes: this.entry.downvotes+1,
          id: this.id,
          index: this.arrayIndex
        });
      } else {
        // remove downvoted and change color back to default
        this.downvoted = true;
        this.downvoteArrowColor = '#0B486B';
        this.$evt.$emit('indexPageDownvote', {
          downvotes: this.entry.downvotes-1,
          id: this.id,
          index: this.arrayIndex
        });
      }
    }
  
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
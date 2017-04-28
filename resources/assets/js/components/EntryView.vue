// Component that shows single entry in /view/{id}

<template>
  <div class="Entry">
    <h4><a href="/">← View all</a></h4>
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ creationDate }}
        <span class="pull-right">
          <span class="glyphicon glyphicon-arrow-up" @click="upvote" :style="{ color: upvoteArrowColor }" ></span>
          <span class="glyphicon glyphicon-arrow-down" @click="downvote" :style="{ color: downvoteArrowColor }"></span>
        </span>
      </div>
      <div class="panel-body">
        {{ entryText }}
      </div>
      <div class="panel-footer">
        <b>Total Entry Score</b>: {{ totalScore }}
        <br>
        <b>Upvotes</b>: {{ upvotes }}
        <br>
        <b>Downvotes</b>: {{ downvotes }}
        <br>
        <b>Share Link</b>: http://localhost:8888/view/{{ entryId }}
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
      entryData: this.entry,
      upvoteArrowColor: '#0B486B',
      downvoteArrowColor: '#0B486B',
      upvoted: false, // to toggle upvoting
      downvoted: false // toggle downvoting
    }
  },

  methods: {

    parseCreationDate(dateToParse) { // parse date to "month day, year"
      var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
      var parsedDate = new Date(dateToParse);
      var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
      return result;
    },

    upvote() {
      if (!this.upvoted) { // not already upvoted
        this.upvoted = true;
        this.upvoteArrowColor = '#79BD9A';
        console.log('upvote');
        this.$evt.$emit('upvote', {
          upvotes: this.entry.upvotes+1
        });
      } else {
        // remove upvote and change color back to default
        this.upvoted = false;
        this.upvoteArrowColor = '#0B486B';
        this.$evt.$emit('upvote', {
          upvotes: this.entry.upvotes-1
        });
      }
    },

    downvote() {
      if (!this.downvoted) {
        this.downvoted = true;
        this.downvoteArrowColor = '#79BD9A';
        this.$evt.$emit('downvote', {
          downvotes: this.entry.downvotes+1
        });
      } else {
        // remove downvoted and change color back to default
        this.downvoted = false;
        this.downvoteArrowColor = '#0B486B';
        this.$evt.$emit('downvote', {
          downvotes: this.entry.downvotes-1
        });
      }
    }

  },

  computed: { // based on 'entry' property, for easier access and to make template HTML look nicer
    entryText() {
      return this.entry.text
    },

    entryId() {
      return this.entry.id
    },

    creationDate() {
      return this.parseCreationDate(this.entry.creationDate)
    },

    upvotes() {
      return this.entry.upvotes
    },

    downvotes() {
      return this.entry.downvotes
    },

    totalScore() {
      return this.entry.upvotes - this.entry.downvotes
    }
  }

}
</script>

<style>
.glyphicon-arrow-up:hover,
.glyphicon-arrow-down:hover {
  cursor: pointer
}
</style>
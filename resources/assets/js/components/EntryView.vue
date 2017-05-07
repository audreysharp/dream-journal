// Component that shows single entry in /view/{id}

<template>
  <div class="Entry">
    <h4><a href="/">← View all</a></h4>
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ creationDate }}
        <span class="pull-right">
            <VoteArrows :entry="entry" style="display:inline"></VoteArrows>&nbsp;
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
import VoteArrows from './VoteArrows';

export default {

  components: {
    VoteArrows
  },

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
      var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var parsedDate = new Date(dateToParse);
      var result = monthNames[parsedDate.getMonth()] + ' ' + parsedDate.getDate() + ', ' + parsedDate.getFullYear();
      return result;
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
</style>

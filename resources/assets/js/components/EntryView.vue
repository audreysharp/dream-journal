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
        <b>Upvotes</b>: {{ upvotes }}
        <br>
        <b>Downvotes</b>: {{ downvotes }}
        <br>
        <b>Share Link</b>: http://localhost:8888/view/{{ this.entry.id }}
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios';

export default {

  props: [
    'entry',
  ],

  data() {
    return {
      entryData: this.entry,
      upvoteArrowColor: '#0B486B',
      downvoteArrowColor: '#0B486B',
      upvoted: false, // to toggle upvoting
      downvoted: false
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
      if (!this.upvoted) {
        this.upvoted = true;
        this.upvoteArrowColor = '#79BD9A';
        this.updateUpvotes();
      } else {
        // remove upvote and change color back to default
        this.upvoted = false;
        this.upvoteArrowColor = '#0B486B';
        this.updateUpvotes();
      }
    },

    downvote() {
      if (!this.downvoted) {
        this.downvoted = true;
        this.downvoteArrowColor = '#79BD9A';
        this.updateDownvotes();
      } else {
        // remove downvoted and change color back to default
        this.downvoted = false;
        this.downvoteArrowColor = '#0B486B';
        this.updateDownvotes();
      }
    },

    updateUpvotes() {
      if (this.upvoted) { // add upvote
        console.log('EntryView -> add upvote');
        axios.put('/entries/' + this.entry.id, { upvotes: upvotes+1 } )
          .then((response) => {
            console.log('EntryView -> upvote success');
            console.log(response.data);
            this.entryData = response.data;
          })
          .catch((response) => {
            console.log('EntryView -> upvote error');
            console.log(reponse); // show error
          })
      } else {
        console.log('EntryView -> remove upvote');
        axios.put('/entries/' + this.entry.id, { upvotes: this.upvotes-1 } )
          .then((response) => {
            console.log('EntryView -> upvote success');
            console.log(response.data);
            this.entryData = response.data;
          })
          .catch((response) => {
            console.log('EntryView -> upvote error');
            console.log(reponse); // show error
          })
      }
    },

    updateDownvotes() {
      if (this.downvoted) {
        console.log('EntryView -> add downvote');
        axios.put('/entries/' + this.entry.id, { downvotes: this.downvotes+1 } )
          .then((response) => {
            console.log('EntryView -> downvote success');
            console.log(response.data);
            this.entryData = response.data;
          })
          .catch((response) => {
            console.log('EntryView -> downvote error');
            console.log(reponse); // show error
          })
      } else {
        console.log('EntryView -> remove downvote');
        axios.put('/entries/' + this.entry.id, { downvotes: downvotes-1 } )
          .then((response) => {
            console.log('EntryView -> downvote success');
            console.log(response.data);
            this.entryData = response.data;
          })
          .catch((response) => {
            console.log('EntryView -> downvote error');
            console.log(reponse); // show error
          })
      }
    }

  },

  computed: {


    entryText() {
      return this.entryData.text
    },

    creationDate() {
      return this.parseCreationDate(this.entryData.creationDate)
    },

    upvotes() {
      return this.entryData.upvotes
    },

    downvotes() {
      return this.entryData.downvotes
    },


  }

}
</script>

<style>
.glyphicon-arrow-up:hover,
.glyphicon-arrow-down:hover {
  cursor: pointer
}
</style>
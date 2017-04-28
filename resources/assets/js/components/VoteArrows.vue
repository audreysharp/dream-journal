// Component that handles upvoting and downvoting

<template>
  <div class="arrows">
    <span class="glyphicon glyphicon-arrow-up" @click="upvote" :style="{ color: upvoteArrowColor }"></span>
    <span class="glyphicon glyphicon-arrow-down" @click="downvote" :style="{ color: downvoteArrowColor }"></span>
  </div>
</template>

<script>

import axios from 'axios';

export default {

  props: [
    'entry',
    'arrayIndex'
  ],

  data() {
    return {
      entryData: this.entry,
      upvoteArrowColor: '#0B486B',
      downvoteArrowColor: '#0B486B',
      upvoted: false, // to toggle upvoting
      downvoted: false, // toggle downvoting
    }
  },

  methods: {

    // give user feedback that they've upvoted by changing arrow color and update vote count in database table
    upvote() {
      if (!this.upvoted) { // not already upvoted
        this.upvoted = true;
        this.upvoteArrowColor = '#79BD9A';
        console.log('upvote');
        this.updateUpvotes(this.entry.upvotes + 1);
      } else {
        // if already upvoted, remove upvote and change color back to default
        this.upvoted = false;
        this.upvoteArrowColor = '#0B486B';
        this.updateUpvotes(this.entry.upvotes - 1);
      }
    },

    // give user feedback that they've downvoted by changing arrow color update vote count in database table
    downvote() {
      if (!this.downvoted) {
        this.downvoted = true;
        this.downvoteArrowColor = '#79BD9A';
        this.updateDownvotes(this.entry.downvotes + 1);
      } else {
        // if already downvoted, remove downvoted and change color back to default
        this.downvoted = false;
        this.downvoteArrowColor = '#0B486B';
        this.updateDownvotes(this.entry.downvotes - 1);
      }
    },

    // 'PUT' request to update upvote count and emit 'voted' event for parents to update
    updateUpvotes(newUpvoteCount) {
      console.log('AppView -> update upvotes');
      console.log(this.entryId);
      axios.put('/entries/' + this.entryId, { upvotes: newUpvoteCount })
        .then((response) => {
          console.log('AppIndex -> upvote success');
          console.log(response.data);
          // emit 'voted' entry so parent and grandparents components can update properly
          this.$evt.$emit('voted', {
            id: this.id,
            index: this.arrayIndex,
            upvotes: newUpvoteCount,
            downvotes: this.entry.downvotes
          });
        })
        .catch((response) => {
          console.log('AppIndex -> upvote error');
          console.log(response); // show error
        })
    },

    // 'PUT' request to update downvote count and emit 'voted' event for parents to update
    updateDownvotes(newDownvoteCount) {
      console.log('AppIndex -> update downvotes');
      axios.put('/entries/' + this.entryId, { downvotes: newDownvoteCount })
        .then((response) => {
          console.log('AppIndex -> downvote success');
          console.log(response.data);
          // emit 'voted' entry so parent and grandparents components can update properly
          this.$evt.$emit('voted', {
            id: this.id,
            index: this.arrayIndex,
            upvotes: this.entry.upvotes,
            downvotes: newDownvoteCount
          });
        })
        .catch((response) => {
          console.log('AppIndex -> downvote error');
          console.log(response); // show error
        })
    },

  },

  computed: { // based on 'entry' property, for easier access and to make template HTML look nicer
    entryId() {
      return this.entry.id
    },

    upvotes() {
      return this.entry.upvotes
    },

    downvotes() {
      return this.entry.downvotes
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
<template>
  <div class="Entry panel panel-default">
    <div class="panel-heading">
      <a :href="'tel:' + entry.phone">
        <i class="glyphicon glyphicon-earphone"></i>
      </a>

      <a class="tool" href="#" @click.prevent="remove">
        <i class="glyphicon glyphicon-remove pull-right"></i>
      </a>

      <a class="tool" href="#" @click.prevent="editing = true" v-show="!editing">
        <i class="glyphicon glyphicon-pencil pull-right"></i>
      </a>
    </div>
    <div class="panel-body">
      <div class="live" v-show="!editing">
        {{ entry.first }} {{ entry.last }}
      </div>
      <div class="editing" v-show="editing">
        <p>
          <input type="text" v-model="first" />
          <input type="text" v-model="last" />
          <input type="text" v-model="phone" />
        </p>
        <p>
          <button class="btn btn-success" @click="save">Save</button>
          <button class="btn btn-default" @click="cancel">Cancel</button>
        </p>
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

  data () {
    return {
      creationDate: this.entry.creationDate,
      entryText: this.entry.text,
      favorite: this.entry.favorite,
      editing: false,
      loading: false
    }
  },

  methods: {

    remove () {
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

    save () {
      console.log('Entry -> save');
      axios.put(`/entries/${this.entry.id}`, {
          creationDate: this.creationDate,
          entryText: this.entryText,
          favorite: this.favorite
        })
        .then((response) => {
          console.log('Entry -> save success');
          this.$emit('updated', {
            creationDate: this.creationDate,
            entryText: this.entryText,
            favorite: this.favorite
          });
          this.editing = false;
        })
        .catch((error) => {
          console.log('Entry -> save error');
          //show the user that it couldn't be updated
        });
    },

    cancel () {
      console.log('Entry -> cancel');
      this.creationDate = this.entry.creationDate,
      this.entryText = this.entry.text,
      this.favorite = this.entry.favorite,
      this.editing = false
    }

  }

}
</script>

<style>
.tool > i {
  margin-left: 15px;
}
</style>

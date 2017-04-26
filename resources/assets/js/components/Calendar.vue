<template>
  <div class="form-group">
    <div class="col-sm-5">
      <Datepicker name="picker" v-model="selectedDate" type="date" language="en-US" date-format="L"></Datepicker>
    </div>
    <div class="col-sm-4">
      <p class="form-control-static">
        Selected Date: <span class="vue-result3">{{formatDate(selectedDate)}}</span>
      </p>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vue-datetime-picker';

export default {

  components: {
    Datepicker
  },

  data() {
    return {
      selectedDate: null
    }
  },

  methods: {
    formatDatetime: function (datetime) {
      if (datetime === null) {
        return "[null]";
      } else {
        return datetime.format("YYYY-MM-DD HH:mm:ss");
      }
    },
    formatDate: function (date) {
      if (date === null) {
        return "[null]";
      } else {
        return date.format("YYYY-MM-DD");
      }
    },
    formatTime: function (time) {
      if (time === null) {
        return "[null]";
      } else {
        return time.format("HH:mm:ss");
      }
    },
    onStartDatetimeChanged: function (newStart) {
      var endPicker = this.$.endPicker.control;
      endPicker.minDate(newStart);
    },
    onEndDatetimeChanged: function (newEnd) {
      var startPicker = this.$.startPicker.control;
      startPicker.maxDate(newEnd);
    }
  }

}
</script>

<style>

</style>
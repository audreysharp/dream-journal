<template>
  <div>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header"> <!-- Collapse nav on mobile -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Dream Journal</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <!--<ul class="nav navbar-nav">
            <li v-for="tab in tabsLeft" :class="{ 'active' : tab.isActive }">
              <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
            </li>
          </ul>-->
          <ul class="nav navbar-nav navbar-right">
            <li v-for="tab in tabsRight" :class="{ 'active' : tab.isActive }">
              <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="tabs-content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return {
      tabs: [],
      tabsLeft: [],
      tabsRight: []
    }
  },

  created() {
    this.tabs = this.$children
    this.tabsLeft = this.tabs.slice(0, 2)
    this.tabsRight = this.tabs
  },

  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => { // avoid mutating a property directly; use data or property
        tab.isActive = (tab.name === selectedTab.name)
      })
    }
  }

}

</script>

<style>

</style>

<template>
  <v-app-bar
    fixed
    app
    class="mt-2 mx-2 app-bar"
  >
    <v-toolbar-title>{{ title }}</v-toolbar-title>

    <v-list
      class="d-flex ml-4 navbar"
    >
      <v-list-item
        v-for="(item, i) in items"
        :key="i"
        :to="item.to"
        router
        exact
        class="navbar-item"
        exact-active-class="navbar-item--active"
      >
        <v-list-item-action>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-action>

        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-app-bar>
</template>

<script lang="ts">
import Vue from 'vue'
import NavigationItemInterface from '~/models/NavigationItemInterface'

export default Vue.extend({
  name: 'AppHeader',
  props: {
    title: {
      type: String,
      required: true
    },
    items: {
      type: Array as () => Array<NavigationItemInterface>,
      required: true
    }
  }
})
</script>

<style lang="scss">
.navbar {
  background: none !important;

  &-item {
    border-radius: 6px;
    transition: .3s;

    &:before {
      background-color: unset;
      opacity: unset !important;
    }

    &:hover,
    &--active {
      background-color: rgba($primary, .24);
      color: $primary !important;
    }
  }
}

.app-bar {
  border-radius: $card-border-radius !important;
}
</style>

<template>
  <div>
    <v-app-bar
      absolute
      color="primary"
      elevate-on-scroll
      scroll-target="#scrolling-techniques-7"
    >
      <v-toolbar-title>{{ title }}</v-toolbar-title>

      <v-spacer />

      <v-app-bar-nav-icon
        @click="drawer = true"
      />
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Strona główna</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Zaloguj się</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
import breakpoint from '../../mixins/breakpoint';

export default {
  name: 'AppNavbar',
  mixins: [breakpoint],
  data: () => ({
    drawer: false,
    group: null,
  }),
  computed: {
    title() {
      return this.breakpoint.xsOnly && 'SDIWPIL' || 'System do internetowego wspomagania pacjenta i lekarza';
    },
  },
};
</script>

<style scoped>

</style>

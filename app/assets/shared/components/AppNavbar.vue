<template>
  <div>
    <v-app-bar
      fixed
      color="primary"
    >
      <v-app-bar-nav-icon
        v-if="breakpoint.xsOnly"
        color="white"
        class="navbar-btn"
        @click="drawer = true"
      />

      <v-spacer />

      <v-toolbar-title class="white--text">
        {{ title }}
      </v-toolbar-title>

      <v-spacer />
    </v-app-bar>

    <v-navigation-drawer
      v-if="breakpoint.xsOnly"
      v-model="drawer"
      fixed
      temporary
      height="100vh"
    >
      <mobile-nav-list :title="title" />

      <template #append>
        <div class="pa-2">
          <v-btn
            block
            color="accent"
          >
            Wyloguj się
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>
  </div>
</template>

<script>
import breakpoint from '../../mixins/breakpoint';

import MobileNavList from './MobileNavList';

export default {
  name: 'AppNavbar',
  components: { MobileNavList },
  mixins: [breakpoint],
  data: () => ({
    drawer: false,
  }),
  computed: {
    title() {
      return this.breakpoint.xsOnly && 'SDIWPIL' || 'System do internetowego wspomagania pacjenta i lekarza';
    },
  },
};
</script>

<style scoped lang="scss">
.navbar {
  &-btn {
    position: absolute;
  }
}
</style>

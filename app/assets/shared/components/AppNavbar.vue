<template>
  <div>
    <v-app-bar
      fixed
      :color="color"
    >
      <v-app-bar-nav-icon
        v-if="breakpoint.mdAndDown"
        color="white"
        class="navbar-btn"
        @click="drawer = true"
      />

      <v-spacer v-if="breakpoint.mdAndDown" />

      <v-toolbar-title class="white--text">
        {{ title }}
      </v-toolbar-title>

      <v-spacer v-if="breakpoint.mdAndDown" />
    </v-app-bar>

    <v-navigation-drawer
      v-if="breakpoint.mdAndDown"
      v-model="drawer"
      fixed
      temporary
      height="100vh"
    >
      <mobile-nav-list :title="navTitle" />

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
  props: {
    colorSchema: {
      type: String,
      default: 'patient',
      validator: (value) => ['patient', 'doctor', 'receptionist', 'management'].includes(value),
    },
  },
  data: () => ({
    drawer: false,
    navTitle: 'SDIWPIL',
  }),
  computed: {
    title() {
      return this.breakpoint.xsOnly && 'SDIWPIL' || 'System do internetowego wspomagania pacjenta i lekarza';
    },
    color() {
      switch (this.colorSchema) {
        case 'doctor':
          return 'secondary';
        case 'receptionist':
          return 'accent';
        case 'management':
          return 'success';
        default:
          return 'primary';
      }
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

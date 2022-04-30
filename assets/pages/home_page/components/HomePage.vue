<template>
  <v-app class="home-page--bg">
    <app-navbar ref="navbar" />

    <vue-snotify />

    <mobile-container
      v-if="breakpoint.mdAndDown"
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <main-container
      v-else
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import { get } from 'lodash';
import AppNavbar from '../../../shared/components/AppNavbar';
import AppFooter from '../../../shared/components/AppFooter';
import MobileContainer from './MobileContainer';
import MainContainer from './MainContainer';
import breakpoint from '../../../mixins/breakpoint';
import mainComponentHelper from '../../../mixins/mainComponentHelper';

export default {
  name: 'HomePage',
  components: {
    AppNavbar, AppFooter, MobileContainer, MainContainer,
  },
  mixins: [breakpoint, mainComponentHelper],
  mounted() {
    this.handleAccessDeniedErrors();
  },
  methods: {
    handleAccessDeniedErrors() {
      const errors = get(window, 'state.errors', []);
      errors.forEach((error) => this.$snotify.error(error.message));
    },
  },
};
</script>

<style scoped lang="scss">
@import '../../../styles/colors';

.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}

.home-page {
  &--bg {
    background-color: rgba($primary, 0.2);
  }
}
</style>

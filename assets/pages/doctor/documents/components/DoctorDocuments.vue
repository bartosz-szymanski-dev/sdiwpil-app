<template>
  <v-app class="documents--bg">
    <app-navbar
      ref="navbar"
      color-schema="doctor"
    />

    <vue-snotify />

    <mobile-container
      v-if="breakpoint.mdAndDown"
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <desktop-container
      v-else
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../../shared/components/AppNavbar';
import mainComponentHelper from '../../../../mixins/mainComponentHelper';
import breakpoint from '../../../../mixins/breakpoint';
import MobileContainer from './MobileContainer';
import DesktopContainer from './DesktopContainer';
import AppFooter from '../../../../shared/components/AppFooter';

export default {
  name: 'DoctorDocuments',
  components: {
    AppFooter, DesktopContainer, MobileContainer, AppNavbar,
  },
  mixins: [breakpoint, mainComponentHelper],
};
</script>

<style scoped lang="scss">
@import 'assets/styles/colors';

.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}

.documents {
  &--bg {
    background-color: rgba($primary, 0.2);
  }
}
</style>

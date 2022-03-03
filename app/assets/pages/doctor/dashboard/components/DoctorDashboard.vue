<template>
  <v-app class="dashboard--bg">
    <app-navbar ref="navbar" />

    <doctor-dashboard-mobile-container
      v-if="breakpoint.mdAndDown"
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../../shared/components/AppNavbar';
import AppFooter from '../../../../shared/components/AppFooter';
import DoctorDashboardMobileContainer from './DoctorDashboardMobileContainer';
import breakpoint from '../../../../mixins/breakpoint';
import mainComponentHelper from '../../../../mixins/mainComponentHelper';

export default {
  name: 'DoctorDashboard',
  components: { DoctorDashboardMobileContainer, AppFooter, AppNavbar },
  mixins: [breakpoint, mainComponentHelper],
};
</script>

<style scoped>

</style>

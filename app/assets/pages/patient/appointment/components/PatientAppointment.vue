<template>
  <v-app>
    <app-navbar ref="navbar" />

    <patient-appointment-mobile-container
      v-if="breakpoint.mdAndDown"
      :footer-height="footerHeight"
      :navbar-height="navbarHeight"
    />
    <patient-appointment-desktop-container
      v-else
      :footer-height="footerHeight"
      :navbar-height="navbarHeight"
    />

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import mainComponentHelper from '../../../../mixins/mainComponentHelper';
import breakpoint from '../../../../mixins/breakpoint';
import PatientAppointmentMobileContainer from './PatientAppointmentMobileContainer';
import PatientAppointmentDesktopContainer from './PatientAppointmentDesktopContainer';
import AppNavbar from '../../../../shared/components/AppNavbar';
import AppFooter from '../../../../shared/components/AppFooter';

export default {
  name: 'PatientAppointment',
  components: {
    PatientAppointmentDesktopContainer, PatientAppointmentMobileContainer, AppNavbar, AppFooter,
  },
  mixins: [breakpoint, mainComponentHelper],
};
</script>

<style scoped>

</style>

<template>
  <v-app>
    <app-navbar ref="navbar" />

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <app-background />

      <patient-dashboard-screen />

      <patient-dashboard-functions />
    </v-container>

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../../shared/components/AppNavbar';
import AppFooter from '../../../../shared/components/AppFooter';
import mainComponentHelper from '../../../../mixins/mainComponentHelper';
import AppBackground from '../../../../shared/components/AppBackground';
import PatientDashboardScreen from './PatientDashboardScreen';
import PatientDashboardFunctions from './PatientDashboardFunctions';

export default {
  name: 'PatientDashboard',
  components: {
    PatientDashboardFunctions,
    PatientDashboardScreen,
    AppBackground,
    AppFooter,
    AppNavbar,
  },
  mixins: [mainComponentHelper],
};
</script>

<style scoped>
.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}
</style>
